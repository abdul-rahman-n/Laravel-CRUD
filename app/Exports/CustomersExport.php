<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CustomersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Retrieve the collection of customers.
     */
    public function collection()
    {
        return Customer::select('name', 'email', 'phone')->get();
    }

    /**
     * Define the headings for the Excel file.
     */
    public function headings(): array
    {
        return ['Name', 'Email', 'Phone'];
    }

    /**
     * Map each customer's data to match the headings.
     */
    public function map($customer): array
    {
        return [
            $customer->name,
            $customer->email,
            $customer->phone,
        ];
    }
}
