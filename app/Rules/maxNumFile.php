<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class maxNumFile implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($num)
    {
        $this->num = $num;
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
        $countImg = request("imgs") ? count(request("imgs")) : 0;
        $countFile = !empty($_FILES["files"]["name"][0]) ? count($_FILES["files"]["name"]) : 0;
        return $this->num >= $countImg + $countFile;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
