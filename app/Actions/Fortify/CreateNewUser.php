<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {

        $email = strtolower($input['email']);


        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nic' => ['nullable', 'string', 'max:12', Rule::requiredIf(!Str::endsWith(strtolower($input['email']), ['students.apiit.lk', 'apiit.lk']))],
            'school_id' => ['nullable', 'required_if:email,students.apiit.lk', 'string', 'max:255'],
            'year_id' => ['nullable', 'required_if:email,students.apiit.lk', 'string', 'in:Level 4,Level 5,Level 6'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $role = $this->getRoleFromEmail($input['email']);

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'nic' => $input['nic'] ?? null,
            'school_id' => $input['school_id'] ?? null,
            'year_id' => $input['year_id'] ?? null,
            'password' => Hash::make($input['password']),
            'role' => $role,
        ]);
    }
    private function getRoleFromEmail(string $email): string
    {
        if (Str::endsWith($email, 'students.apiit.lk')) {
            return User::ROLE_STUDENT;
        } elseif (Str::endsWith($email, 'apiit.lk')) {
            return User::ROLE_TEACHER;
        } else {
            return User::ROLE_DEFAULT;
        }
    }
}
