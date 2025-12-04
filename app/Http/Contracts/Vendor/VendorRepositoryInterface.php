<?php

namespace App\Http\Contracts\Vendor;

use App\Http\DTO\Vendor\VendorDTO;
use App\Models\Vendor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface VendorRepositoryInterface
{
    public function paginate(int $perPage = 20, array $filter = []): LengthAwarePaginator;
}

