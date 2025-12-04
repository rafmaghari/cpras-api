<?php

namespace App\Http\Controllers;

use App\Http\Services\Vendor\VendorService;
use App\Http\Resources\VendorResource;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function __construct(private VendorService $vendorService) {}

    public function index(Request $request)
    {
        $vendors = $this->vendorService->paginate(
            $request->per_page ?? 20,
            $request->filter ?? []
        );

        return VendorResource::collection($vendors);
    }
}
