<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Admin\Pages;

use Throwable;
use BADDIServices\SafeHTML\SafeHTML;
use BADDIServices\SocialRocket\AppLogger;
use BADDIServices\SocialRocket\Entities\Alert;
use BADDIServices\SocialRocket\Services\PageService;
use BADDIServices\SocialRocket\Http\Requests\Admin\Pages\StorePageRequest;
use BADDIServices\SocialRocket\Http\Controllers\AdminController as ControllersAdminController;
use BADDIServices\SocialRocket\Models\Page;

class StorePageController extends ControllersAdminController
{
    public function __construct(private PageService $pageService, private SafeHTML $safeHTML) {}

    public function __invoke(StorePageRequest $request)
    {
        try {
            $attributes = $request->validated();

            $attributes[Page::CONTENT_COLUMN] = $this->safeHTML->sanitizeHTML($request->input(Page::CONTENT_COLUMN));

            // TODO: upload images https://www.codewall.co.uk/install-summernote-with-laravel-tutorial/
            
            $this->pageService->create($attributes);

            return redirect()
                ->route('admin.pages')
                ->with(
                    'alert', 
                    new Alert('Page has been created successfully', 'success')
                );
        } catch (Throwable $e) {
            AppLogger::error($e, 'admin:create-page');

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'alert', 
                    new Alert('An occurred error while saving the new page')
                );
        }
    }
}