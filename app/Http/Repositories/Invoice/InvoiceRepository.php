<?php

namespace App\Http\Repositories\Invoice;

use App\Http\Contracts\Invoice\InvoiceRepositoryInterface;
use App\Http\DTO\Invoice\InvoiceDTO;
use App\Models\Invoice;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function paginate(int $perPage = 20, array $filter = []): LengthAwarePaginator
    {
        $invoice = Invoice::query();

        if (isset($filter['vendor_id'])) {
            $invoice->where('vendor_id', $filter['vendor_id']);
        }

        if (isset($filter['status'])) {
            $invoice->where('status', $filter['status']);
        }

        if (isset($filter['organization_id'])) {
            $invoice->where('organization_id', $filter['organization_id']);
        }

        return $invoice->with(['vendor', 'organization'])->paginate($perPage);
    }

    public function create(InvoiceDTO $dto): Invoice
    {
        return Invoice::create($dto->toArray());
    }

    public function update(InvoiceDTO $dto, Invoice $invoice): Invoice
    {
        $invoice->update($dto->toArray());

        return $invoice->fresh(['vendor', 'organization']);
    }

    public function findById(int $id): Invoice
    {
        return Invoice::with(['vendor', 'organization'])->findOrFail($id);
    }

    public function delete(Invoice $invoice): void
    {
        $invoice->delete();
    }
}

