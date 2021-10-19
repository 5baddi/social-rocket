<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Rules;

use BADDIServices\SocialRocket\Common\Services\FeatureService;
use Illuminate\Contracts\Validation\Rule;

class RequiredIfFeatureEnabled implements Rule
{
    private FeatureService $featureService;

    public function __construct(private string $feature)
    {
        $this->featureService = app(FeatureService::class);
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
        if ($this->featureService->isFeatureDisabled($this->feature)) {
            return true;
        }

        return ! empty($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.required', ['attribute' => $this->feature]);
    }
}
