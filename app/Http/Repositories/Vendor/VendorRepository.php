<?php

namespace App\Http\Repositories\Vendor;

use App\Http\Contracts\Vendor\VendorRepositoryInterface;
use App\Models\Vendor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class VendorRepository implements VendorRepositoryInterface
{
    public function paginate(int $perPage = 20, array $filter = []): LengthAwarePaginator
    {
        $vendor = Vendor::query();

        if (isset($filter['name'])) {
            $vendor->where('name', 'like', '%'.$filter['name'].'%');
        }

        if (isset($filter['organization_id'])) {
            $vendor->where('organization_id', $filter['organization_id']);
        }

        return $vendor->paginate($perPage);
    }
}

