<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use BADDIServices\SocialRocket\Models\Page;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use BADDIServices\SocialRocket\Repositories\PageRepository;

class PageService extends Service
{
    /** @var PageRepository */
    private $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function all(): Collection
    {
        return $this->pageRepository->all();
    }
    
    public function findById(string $id): Page
    {
        return $this->pageRepository->findById($id);
    }

    public function paginate(?int $page = null): LengthAwarePaginator
    {
        return $this->pageRepository->paginate($page);
    }

    public function create(array $attributes): Page
    {
        $attributes = Arr::only(
            $attributes,
            [
                Page::SLUG_COLUMN,
                Page::TITLE_COLUMN,
                Page::CONTENT_COLUMN
            ]
        );

        if (! Arr::has($attributes, Page::SLUG_COLUMN)) {
            $attributes[Page::SLUG_COLUMN] = Str::slug($attributes[Page::TITLE_COLUMN]);
        }

        return $this->pageRepository->create($attributes);
    }
}