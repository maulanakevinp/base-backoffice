<?php

namespace App\Rules;

use App\Models\HasilPengelolaan;
use Illuminate\Contracts\Validation\Rule;

class HasilPengelolaanRule implements Rule
{
    protected $area_id, $tahun;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($area_id)
    {
        $this->area_id = $area_id;
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
        $this->tahun = $value;
        if (request()->isMethod('post')) {
            foreach (HasilPengelolaan::where('area_id', $this->area_id)->get() as $item) {
                if ($item->tahun == $value) {
                    return false;
                }
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
        return 'Hasil Pengelolaan TKD Tahun '. $this->tahun .' sudah tersedia.';
    }
}
