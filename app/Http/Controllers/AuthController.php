<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadTemplateRequest;
use App\Point;
use App\Service;
use App\TemplateProcessor;
use Illuminate\Support\Facades\Session;
use XeroPHP\Application\PrivateApplication;
use XeroPHP\Models\Accounting\Address;
use XeroPHP\Models\Accounting\Contact;
use XeroPHP\Models\Accounting\Invoice;
use XeroPHP\Models\Accounting\Organisation;

class AuthController extends Controller
{
    protected $xero;

    public function __construct(PrivateApplication $xero)
    {
        $this->xero = $xero;
    }


    public function test($invoice_id = null)
    {
        $service = Service::first();

        Point::create([
            "team_id" => request()->user()->currentTeam()->id ?? null,
            "user_id" => request()->user()->id,
            "points" => $service->points,
            "subscription_team_id" => request()->user()->currentTeam() && request()->user()->currentTeam()->subscription()->id ? request()->user()->currentTeam()->subscription()->id : null,
            "subscription_id" => request()->user()->currentTeam() ? null : request()->user()->subscription()->id,
            "service_id" => $service->id
        ]);

        /**@var Invoice $invoice */
        $invoice = $this->xero->loadByGUID(Invoice::class, $invoice_id ?? '37483409-699f-4cfa-83f0-773c5d62e79f');
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

        if (file_exists(public_path('test1.docx')))
            unlink(public_path('test1.docx'));

        //        dd($keys, $values);
        $templateProcessor = new TemplateProcessor(public_path('test.docx'));
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

        $templateProcessor->saveAs(storage_path('app/files/test1.docx'));

        return \Storage::download('files/test1.docx');
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
