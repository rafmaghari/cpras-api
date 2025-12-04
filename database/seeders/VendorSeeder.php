<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organizations = Organization::all();

        if ($organizations->isEmpty()) {
            $this->command->warn('No organizations found. Please seed organizations first.');
            return;
        }

        $vendorNames = [
            'Acme Corporation',
            'Tech Solutions Inc.',
            'Global Supplies Ltd.',
            'Premium Services Co.',
            'Digital Innovations',
            'Quality Products LLC',
            'Enterprise Solutions',
            'Advanced Technologies',
            'Professional Services Group',
            'Innovation Partners',
            'Strategic Business Solutions',
            'Elite Manufacturing Co.',
            'Reliable Distributors',
            'Modern Commerce Inc.',
            'Prime Suppliers Ltd.',
            'Excellence Industries',
            'Dynamic Enterprises',
            'Master Services Corp.',
            'Superior Products Co.',
            'Visionary Solutions',
        ];

        foreach ($organizations as $organization) {
            foreach ($vendorNames as $vendorName) {
                Vendor::create([
                    'organization_id' => $organization->id,
                    'name' => $vendorName,
                ]);
            }
        }

        $this->command->info('Created ' . count($vendorNames) . ' vendors for each organization.');
    }
}

