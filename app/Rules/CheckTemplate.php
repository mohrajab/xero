<?php

namespace App\Rules;

use App\TemplateProcessor;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CheckTemplate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function passes($attribute, $value)
    {
        /**@var UploadedFile $value */
        $path = $value->store("files");
        $templateProcessor = new TemplateProcessor(Storage::path($path));
        $variables = $templateProcessor->getVariables();
        $toCheck = [
            'OrganisationName',
            'OrganisationPostalAddress' ,
            'OrganisationTaxDisplayNumber',
            'RegisteredOffice'
        ];

        if (!$variables || array_intersect($toCheck,$variables)!=$toCheck) {
            Storage::delete($path);
            return false;
        }

        Session::put('file', $path);

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'file is not valid.';
    }
}
