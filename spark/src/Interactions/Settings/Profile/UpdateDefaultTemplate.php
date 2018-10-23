<?php

namespace Laravel\Spark\Interactions\Settings\Profile;

use App\Rules\CheckTemplate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Laravel\Spark\Contracts\Interactions\Settings\Profile\UpdateProfilePhoto as Contract;

class UpdateDefaultTemplate implements Contract
{
    /**
     * {@inheritdoc}
     */
    public function validator($user, array $data)
    {
        return Validator::make($data, [
            'default_template' => ['required','mimes:docx','max:4000', new CheckTemplate()],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function handle($user, array $data)
    {
        $file = \Session::pull('file');


        // We will store the profile photos on the "public" disk, which is a convention
        // for where to place assets we want to be publicly accessible. Then, we can
        // grab the URL for the image to store with this user in the database row.


        // Next, we'll update this URL on the local user instance and save it to the DB
        // so we can access it later. Then we will delete the old photo from storage
        // since we'll no longer need to access it for this specific user profile.
        $user->forceFill([
            'default_template' => $file
        ])->save();
    }
}
