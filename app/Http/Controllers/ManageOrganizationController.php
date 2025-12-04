<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrganizationResource;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Http\Services\Organization\ManageOrganizationService;
use Illuminate\Http\Request;

class ManageOrganizationController extends Controller
{
    public function __construct(private ManageOrganizationService $manageOrganizationService) {}

    public function index(Request $request)
    {
        $users = $this->manageOrganizationService->paginate(
            $request->per_page ?? 10,
            $request->filter ?? []
        );

        return UserResource::collection($users);
    }

    public function addUserToOrganization(RegisterRequest $request)
    {
        $organization = $this->manageOrganizationService->addUserToOrganization(
            $request->toDTO()
        );

        return new OrganizationResource($organization);
    }

    public function removeUserFromOrganization(Request $request)
    {
        $organization = $this->manageOrganizationService->removeUserFromOrganization(
            $request->organization_id,
            $request->user_id
        );

        return new OrganizationResource($organization);
    }
}
