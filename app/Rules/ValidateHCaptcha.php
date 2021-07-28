<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Rules;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Validation\Rule;

class ValidateHCaptcha implements Rule
{
    /** @var Client */
    private $client;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new Client([
            'debug'         => false,
            'http_errors'   => false,
        ]);
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
        try {
            $response = $this->client->request('POST', config('baddi.hcaptcha_verify_endpoint'), 
                [
                    'form_params'       => [
                        'secret'        => config('baddi.hcaptcha_secret'),
                        'response'      => $value
                    ],
                    'headers'   => [
                        'Accept'        => 'application/json'
                    ]
                ]
            );

            $data = json_decode($response->getBody(), true);
            if (isset($data['success']) && $data['success'] === true) {
                return true;
            }
        } catch (GuzzleException $e) {}

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('message.invalid_captcha');
    }
}