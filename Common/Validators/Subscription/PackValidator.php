<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Validators\Subscription;

use BADDIServices\SocialRocket\Common\Validators\Validator;
use BADDIServices\SocialRocket\Models\Pack;
use Illuminate\Validation\Rule;

class PackValidator extends Validator
{
    public function rules(string $action = self::ACTION_CREATE): array
    {
        return [
            Pack::NAME_KEY_COLUMN           => ['required', 'string', 'min:2', 'max:100'],
            Pack::PRICE_COLUMN              => ['nullable', 'numeric'],
            Pack::TYPE_COLUMN               => ['required', Rule::in(Pack::TYPES)],
            Pack::INTERVAL_COLUMN           => ['nullable', Rule::in(Pack::INTERVALS)],
            Pack::REVENUE_SHARE_COLUMN      => ['nullable', 'numeric'],
            Pack::IS_POPULAR_COLUMN         => ['nullable', 'boolean'],
            Pack::TRIAL_DAYS_COLUMN         => ['nullable', 'integer'],
            Pack::CURRENCY_COLUMN           => ['nullable', 'string', 'min:1', 'max:10'],
            Pack::CURRENCY_SYMBOL_COLUMN    => ['nullable', 'string', 'min:1', 'max:10'],
        ];
    }
}
