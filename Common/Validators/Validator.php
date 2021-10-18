<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Validators;

use Illuminate\Validation\Factory;
use Illuminate\Validation\ValidationException;

abstract class Validator
{
    const ACTION_UPDATE = 'update';
    const ACTION_CREATE = 'create';

    /** @var Factory */
    protected $validatorFactory;

    public function __construct(Factory $factory)
    {
        $this->validatorFactory = $factory;
    }

    public function messages(): array
    {
        return [];
    }

    public function attributes(): array
    {
        return [];
    }

    /**
     * @param array $attributes
     *
     * @throws ValidationException
     */
    public function validateMany(array $attributes)
    {
        foreach ($attributes as $attribute) {
            $this->validate($attribute);
        }
    }

    /**
     * @param array $attributes
     *
     * @throws ValidationException
     */
    public function validate(array $attributes)
    {
        $validator = $this->validatorFactory->make($attributes, $this->rules());

        if ($validator->fails()) {
            throw new ValidationException($validator->errors());
        }
    }

    abstract public function rules(string $action = self::ACTION_CREATE): array;

    /**
     * Build array validation from the rules()
     *
     * @param string $key Key to use for array container input
     * @param array $extra Any extra rules to be added to the array container
     *
     * @return array
     */
    public function arrayRules(string $key, array $extra = []): array
    {
        $arrayRules = [];
        $arrayRules[$key] = array_merge($extra, ['array']);
        foreach ($this->rules() as $inputName => $rule) {
            $arrayRules[$key . ".*." . $inputName] = $rule;
        }

        return $arrayRules;
    }
}
