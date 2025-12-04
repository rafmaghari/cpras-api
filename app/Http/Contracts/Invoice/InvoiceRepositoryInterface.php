<?php

namespace App\Http\Contracts\Invoice;

use App\Http\DTO\Invoice\InvoiceDTO;
use App\Models\Invoice;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface InvoiceRepositoryInterface
{
    public function paginate(int $perPage = 20, array $filter = []): LengthAwarePaginator;

    public function findById(int $id): Invoice;

    public function create(InvoiceDTO $dto): Invoice;

    public function update(InvoiceDTO $dto, Invoice $invoice): Invoice;

    public function delete(Invoice $invoice): void;
}

