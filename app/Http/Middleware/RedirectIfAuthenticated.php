<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use BADDIServices\SocialRocket\Services\UserService;

class RedirectIfAuthenticated
{
    /** @var UserService */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                /** @var User */
                $user = Auth::user();

                $this->userService->update($user, [
                    User::LAST_LOGIN_COLUMN    =>  Carbon::now()
                ]);

                if ($user->isSuperAdmin()) {
                    return redirect()->route('admin.stats');
                }
                
                return redirect(RouteServiceProvider::HOME)->with('success', 'Welcome back ' . strtoupper($user->first_name));
            }
        }

        return $next($request);
    }
}
