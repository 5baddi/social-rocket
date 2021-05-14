<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use BADDIServices\SocialRocket\Models\Pack;
use BADDIServices\SocialRocket\Repositories\PackRepository;
use Illuminate\Database\Eloquent\Collection;

class PackService extends Service
{
    /** @var PackRepository */
    private $packRepository;

    public function __construct(PackRepository $packRepository)
    {
        $this->packRepository = $packRepository;
    }

    public function all(): Collection
    {
        return $this->packRepository->all();
    }
    
    public function findById(string $id): Pack
    {
        return $this->packRepository->findById($id);
    }
}