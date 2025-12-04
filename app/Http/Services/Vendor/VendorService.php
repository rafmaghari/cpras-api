<?php

namespace App\Http\Services\Vendor;

use App\Http\Contracts\Vendor\VendorRepositoryInterface;
use App\Http\DTO\Vendor\VendorDTO;
use App\Models\Vendor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class VendorService
{
    public function __construct(
        private VendorRepositoryInterface $vendorRepository
    ) {}

    public function paginate(int $perPage = 10, array $filter = []): LengthAwarePaginator
    {
        return $this->vendorRepository->paginate($perPage, $filter);
    }
}

