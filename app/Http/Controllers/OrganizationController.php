<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationRequest;
use App\Http\Resources\OrganizationResource;
use App\Http\Services\Organization\OrganizationService;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function __construct(private OrganizationService $organizationService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $organizations = $this->organizationService->paginate(
            $request->per_page ?? 10,
            $request->filter ?? []
        );

        return OrganizationResource::collection($organizations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrganizationRequest $request)
    {
        $organization = $this->organizationService->create($request->toDTO());

        return new OrganizationResource($organization);
    }

    /**
     * Display the specified resource.
     */
    public function show(Organization $organization)
    {
        $organization = $this->organizationService->findById($organization->id);

        return OrganizationResource::make($organization);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrganizationRequest $request, Organization $organization)
    {
        $organization = $this->organizationService->update($request->toDTO(), $organization);

        return OrganizationResource::make($organization);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organization $organization)
    {
        $this->organizationService->delete($organization);

        return response()->noContent();
    }
}
