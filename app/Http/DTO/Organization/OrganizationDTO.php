<?php

namespace App\Http\DTO\Organization;

class OrganizationDTO
{
    public function __construct(
        public string $name,
        public bool $is_active = true,
    ) {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'is_active' => $this->is_active,
        ];
    }
}
