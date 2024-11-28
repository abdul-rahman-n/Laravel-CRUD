<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomersExport;
use App\Imports\CustomersImport;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(10);
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|regex:/^[\pL\s]+$/u|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|numeric',
        ]);

        Customer::create($validated);

        return redirect()->route('customers.index')->with('success', 'Customer added successfully!');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|regex:/^[\pL\s]+$/u|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id, // Ignore current customer's email during validation
            'phone' => 'required|numeric',
        ]);

        $customer->update($validated);

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully!');
    }
    
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully!');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            Excel::import(new CustomersImport, $request->file('file'));

            return back()->with('success', 'Data imported successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'There was an issue with the import: ' . $e->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new CustomersExport, 'customers.xlsx');
    }
}
