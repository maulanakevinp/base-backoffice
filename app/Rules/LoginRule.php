<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class LoginRule implements Rule
{
    private $pass, $remember;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($pass, $remember)
    {
        $this->pass = $pass;
        $this->remember = $remember;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $tipe = filter_var($value, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$tipe => $value, 'password' => $this->pass, 'status' => 1], $this->remember)) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Username/Email atau password salah.';
    }
}
