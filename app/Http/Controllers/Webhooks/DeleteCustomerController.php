<?php


/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\Webhooks;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Webhooks\CustomerRequest;
use BADDIServices\ClnkGO\Services\UserService;
use Illuminate\Routing\Controller as BaseController;

class DeleteCustomerController extends BaseController
{
    /** @var UserService */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    
    public function __invoke(CustomerRequest $request)
    {
        $user = $this->userService->findByEmail($request->input('customer_email'));
        if (!$user instanceof User) {
            abort(Response::HTTP_NOT_FOUND, 'Customer not found');
        }

        $userDeleted = $this->userService->delete($user);

        if (!$userDeleted) {
            return response()->json(['Something going wrong during deleting customer data!'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json(['Customer data deleted successfully.']);
    }
}