<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Person;
use App\Models\Patient;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'f_last_name' => ['required', 'string', 'max:255'],
            'm_last_name' => ['required', 'string', 'max:255'],
            'ci' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'sex' => ['required'],
            'password' => $this->passwordRules(),
            'password_confirmation' => 'required|same:password',
            // 'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $person = new Person();
        $person->name = $input['name'];
        $person->f_last_name = $input['f_last_name'];
        $person->m_last_name = $input['m_last_name'];
        $person->ci = $input['ci'];
        $person->address = "Dirección";
        $person->type = "1";
        $person->sex = $input['sex'];
        $person->save();

        $patient = new Patient;
        $patient->person_id = $person->id;
        $patient->save();
        $patient->createMedicalHistory($patient->id);

        $redirect = User::create([
            'person_id' => $person->id,
            'username' => $person->ci,
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
        ]);

        $user = User::all()->last();
        $user->assignRole('Paciente');

        return $redirect;
    }
}
