<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadTemplateRequest;
use App\TemplateProcessor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use XeroPHP\Application\PublicApplication;
use XeroPHP\Models\Accounting\Address;
use XeroPHP\Models\Accounting\Contact;
use XeroPHP\Models\Accounting\Invoice;
use XeroPHP\Models\Accounting\Organisation;

class InvoiceController extends Controller
{
    protected $xero;

    public function __construct(PublicApplication $xero)
    {
        $this->xero = $xero;
    }

    public function generate($invoice_id)
    {
//        try {
        if (!$this->getOAuthSession()) {
            Session::put('back_to', request()->fullUrl());
            Session::save();
            return redirect('authorize');
        }

        $this->xero->getOAuthClient()
            ->setToken(Session::get('oauth.token'))
            ->setTokenSecret(Session::get('oauth.token_secret'));

        /**@var Invoice $invoice */ //'37483409-699f-4cfa-83f0-773c5d62e79f'
        $invoice = $this->xero->loadByGUID(Invoice::class, $invoice_id);
        if (!$invoice)
            abort(404);
        /**@var Contact $contact */
        $contact = $this->xero->loadByGUID(Contact::class, $invoice->Contact->ContactID);
        /**@var Organisation $company */
        $company = $this->xero->load(Organisation::class)->first();
        /// dd($invoice->toStringArray(), $contact->toStringArray(), $company->toStringArray());
        /**@var \XeroPHP\Models\Accounting\Address $contactAddresses */
        $contactAddresses = collect($contact->getAddresses())->where('AddressType', 'POBOX')->first();

        $mapContact = [
            'ContactName' => $contact->getName(),
            'ContactPostalAddress' => $this->getAddress($contactAddresses),
            'ContactTaxDisplayName' => '---',
            'ContactTaxNumber' => $contact->getTaxNumber(),
            'ContactAccountNumber' => $contact->getAccountNumber(),
        ];

        $mapInvoice = [
            'InvoiceDate' => $invoice->getDate() ? $invoice->getDate()->format('Y-m-d') : '',
            'InvoiceDueDate' => $invoice->getDueDate() ? $invoice->getDueDate()->format('Y-m-d') : '',
            'InvoiceNumber' => $invoice->getInvoiceNumber(),
            'Reference' => $invoice->getReference(),
            'DefaultCurrencyTaxMessage' => '---',
            'CurrencyConversionMessage' => '---',
            'PaymentMessageAndUrl' => '',
            'TaxUnitName' => '---',
            'InvoiceAmountDue' => $invoice->getAmountDue(),
            'InvoiceCurrency' => $invoice->getCurrencyCode(),
            'InvoiceSubTotal' => $invoice->getSubTotal(),
            'TaxTotal' => $invoice->getTotalTax(),
            'TaxCode' => '---',
            'InvoiceTotal' => $invoice->getTotal(),
            'InvoiceTotalNetPayments' => '',
        ];

        /**@var \XeroPHP\Models\Accounting\Address $companyAddress */
        $companyAddress = collect($company->getAddresses())->where('AddressType', 'POBOX')->first();

        $companyMap = [
            'OrganisationName' => $company->getName(),
            'OrganisationPostalAddress' => $this->getAddress($companyAddress),
            'OrganisationTaxDisplayNumber' => $company->getTaxNumber(),
            'RegisteredOffice' => $this->getAddress($companyAddress, ", "),
        ];

        $keys = array_merge(array_merge(array_keys($mapInvoice), array_keys($mapContact)), array_keys($companyMap));
        $values = array_merge(array_merge(array_values($mapInvoice), array_values($mapContact)), array_values($companyMap));

        //        dd($keys, $values);
        $file = public_path('test.docx');
        if (Auth::user()->default_template)
            $file = Auth::user()->default_template;

        $templateProcessor = new TemplateProcessor($file);
        $templateProcessor->setValue($keys, $values);
        /*$templateProcessor->setImg('Insert logo here', array('src' =>
            public_path('40285063_1390586571074149_5104049348275077120_n.jpg'), 'swh' => '50'));*/
        //  dd($templateProcessor->getVariables());

        $templateProcessor->cloneRow('TableStart:LineItem', $invoice->getLineItems()->count());
        foreach ($invoice->getLineItems() as $key => $item) {
            $key = $key + 1;
            $templateProcessor->setValue("TableStart:LineItem#{$key}", '');
            $templateProcessor->setValue("ItemCode#{$key}", $item->getItemCode());
            $templateProcessor->setValue("Description#{$key}", $item->getDescription());
            $templateProcessor->setValue("Quantity#{$key}", $item->getQuantity());
            $templateProcessor->setValue("UnitAmount#{$key}", $item->getUnitAmount());
            $templateProcessor->setValue("TaxPercentageOrName#{$key}", $item->getTaxAmount());
            $templateProcessor->setValue("LineAmount#{$key}", $item->getLineAmount());
            $templateProcessor->setValue("TableEnd:LineItem#{$key}", '');
        }

        $filename = "files/" . str_random(20) . '.docx';
        $templateProcessor->saveAs(Storage::path($filename));

        if (request('type') && request('type') == 'pdf') {
            exec('doc2pdf '.Storage::path($filename));
//            $PHPWord = \PhpOffice\PhpWord\IOFactory::load(Storage::path($filename));
//            \PhpOffice\PhpWord\Settings::setPdfRendererPath(base_path("vendor/dompdf/dompdf"));
//            \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
//            $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($PHPWord, 'PDF');
//            $filename = "files/" . str_random(20) . '.pdf';
//            $xmlWriter->save(Storage::path($filename));
        }
        return \Storage::download($filename);
//        } catch (\Exception $exception) {
//            return redirect('home');
//        }
    }

    public function upload(UploadTemplateRequest $request)
    {
        $file = Session::pull('file');
    }

    private function getAddress(Address $address = null, $separation = " ")
    {
        if (!$address)
            return '';

        return $address->getAddressLine1() . $separation
            . $address->getCity() . $separation . $address->getRegion() . $separation
            . $address->getPostalCode() . $separation . $address->getCountry();
    }
}
