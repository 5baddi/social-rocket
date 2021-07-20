<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Rules;

use Illuminate\Contracts\Validation\Rule;

class AccountPasswordRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) 
    {
        // TODO:
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {

    }
}