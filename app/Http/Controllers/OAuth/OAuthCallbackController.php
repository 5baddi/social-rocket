<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\OAuth;

use BADDIServices\SocialRocket\Common\Services\Subscription\PackService;
use Throwable;
use Carbon\Carbon;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use BADDIServices\SocialRocket\AppLogger;
use BADDIServices\SocialRocket\Common\Entities\Shop\Shop;
use BADDIServices\SocialRocket\Common\Services\Shop\ShopService;
use BADDIServices\SocialRocket\Common\Services\Shopify\MyShopService;
use BADDIServices\SocialRocket\Models\OAuth;
use BADDIServices\SocialRocket\Entities\Alert;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use BADDIServices\SocialRocket\Events\WelcomeMail;
use BADDIServices\SocialRocket\Services\StoreService;
use BADDIServices\SocialRocket\Services\ShopifyService;
use BADDIServices\SocialRocket\Http\Requests\OAuthCallbackRequest;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;

class OAuthCallbackController extends Controller
{
    /** @var ShopifyService */
    private $shopifyService;

    /** @var StoreService */
    private $storeService;

    public function __construct(
        ShopifyService $shopifyService,
        StoreService $storeService,
        private PackService $packService,
        private MyShopService $myShopService,
        private ShopService $shopService
    )
    {
        parent::__construct();

        $this->shopifyService = $shopifyService;
        $this->storeService = $storeService;
    }

    public function __invoke(OAuthCallbackRequest $request)
    {
        try {
            $shopSlug = $this->myShopService->getShopSlug($request->query('shop'));
            $shop = $this->shopService->findBySlug($shopSlug);
            dd($shop);
            if (!$shop instanceof Shop) {
                abort(Response::HTTP_NOT_FOUND, 'Store not found');
            }

            $accessToken = $this->shopifyService->getStoreAccessToken($request->query());
            $attributes = $request->merge($accessToken)->only([
                OAuth::STORE_ID_COLUMN,
                OAuth::CODE_COLUMN,
                OAuth::ACCESS_TOKEN_COLUMN,
                OAuth::SCOPE_COLUMN,
                OAuth::TIMESTAMP_COLUMN,
            ]);

            DB::beginTransaction();

            $oauth = $this->storeService->updateStoreOAuth($shop, $attributes);
            abort_unless($oauth instanceof OAuth, Response::HTTP_BAD_REQUEST, 'Something going wrong during authentification');

            $shop = $this->storeService->updateConfigurations($shop);
            $this->storeService->enableStore($shop);

            $user = $this->userService->findByEmail($shop->email);
            if (!$user instanceof User) {
                $firstName = ucwords($shop->name);
                $lastName = 'Admin';

                $shopOwner = explode(' ', $shop->shop_owner);
                if (sizeof($shopOwner) === 2) {
                    $firstName = ucfirst($shopOwner[0]);
                    $lastName = ucfirst($shopOwner[1]);
                }

                $user = $this->userService->create(
                    $shop,
                    [
                        User::FIRST_NAME_COLUMN    => $firstName,
                        User::LAST_NAME_COLUMN     => $lastName,
                        User::EMAIL_COLUMN         => $shop->email,
                        User::PHONE_COLUMN         => $shop->phone
                    ]
                );
            }

            Event::dispatch(new WelcomeMail($shop, $user));

            $authenticateUser = Auth::loginUsingId($user->id);
            if (!$authenticateUser) {
                return $this->redirect('signin')
                    ->with('error', 'Something going wrong with the authentification');
            }

            $this->userService->update($user, [
                User::LAST_LOGIN_COLUMN    =>  Carbon::now()
            ]);

            DB::commit();

            return $this->redirect('dashboard')
                ->with(
                    'alert',
                    new Alert('Your store has been linked successfully', 'success')
                );
        } catch (ValidationException $e) {
            return $this->redirect('connect')
                ->withInput()
                ->withErrors($e->errors());
        } catch (HttpException $e) {
            throw $e;
        } catch (Throwable $e) {
            DB::rollBack();

            AppLogger::setStore($shop ?? null)->error($e, 'store:oauth-callback', $request->all());

            return $this->redirect('connect')
                ->with('error', 'Internal server error');
        }
    }
}
