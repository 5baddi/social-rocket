<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Entities;

class Alert
{
    /** @var string */
    public $message;
    public $type;

    public function __construct(string $message, string $type = 'error')
    {
        $this->message = $message;
        $this->type = $type;
    }
}
