<?php

namespace App\Http\DTO\Invoice;

class InvoiceDTO
{
    public function __construct(
        public int $vendor_id,
        public float $amount,
        public string $status,
        public ?int $organization_id = null,
    ) {}

    public function toArray(): array
    {
        $data = [
            'vendor_id' => $this->vendor_id,
            'amount' => $this->amount,
            'status' => $this->status,
        ];

        if ($this->organization_id !== null) {
            $data['organization_id'] = $this->organization_id;
        }

        return $data;
    }
}

