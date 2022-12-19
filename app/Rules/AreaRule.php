<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AreaRule implements Rule
{
    protected $kategori;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($kategori)
    {
        $this->kategori = $kategori;
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
        if ($this->kategori == 2) {
            if ($value) {
                return true;
            }
            return false;
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
        return ':attribute wajib diisi ketika kategori area adalah Tanah Kas Desa.';
    }
}
