<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class JawabanRule implements Rule
{
    private $tipe = null;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($tipe)
    {
        $this->tipe = $tipe;
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
        if ($this->tipe == 2 || $this->tipe == 7 || $this->tipe == 8) {
            if ($value == null) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'jawaban wajib diisi ketika tipe adalah dropdown / kotak centang / pilihan ganda.';
    }
}
