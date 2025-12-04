<?php

namespace App\Http\Services\Invoice;

use App\Http\Contracts\Invoice\InvoiceRepositoryInterface;
use App\Http\DTO\Invoice\InvoiceDTO;
use App\Models\Invoice;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class InvoiceService
{
    public function __construct(
        private InvoiceRepositoryInterface $invoiceRepository
    ) {}

    public function paginate(int $perPage = 10, array $filter = []): LengthAwarePaginator
    {
        return $this->invoiceRepository->paginate($perPage, $filter);
    }

    public function findById(int $id): Invoice
    {
        return $this->invoiceRepository->findById($id);
    }

    public function create(InvoiceDTO $dto): Invoice
    {
        return $this->invoiceRepository->create($dto);
    }

    public function update(InvoiceDTO $dto, Invoice $invoice): Invoice
    {
        return $this->invoiceRepository->update($dto, $invoice);
    }

    public function delete(Invoice $invoice): void
    {
        $this->invoiceRepository->delete($invoice);
    }
}

