<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class WhatsappRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $value;
    public function __construct()
    {
        //
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
        $this->value = $value;
        return substr($value, 0, 3) == '628';
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Nomor HP "'.$this->value.'" tidak valid. Nomor HP harus dimulai dengan angka 628.';
    }
}
