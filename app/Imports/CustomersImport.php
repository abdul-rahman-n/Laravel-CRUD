<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CustomersImport implements ToModel, WithHeadingRow
{
    /**
     * Define the expected columns.
     *
     * @var array
     */
    private $expectedColumns = ['name', 'email', 'phone'];

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $missingColumns = array_diff($this->expectedColumns, array_keys($row));

        if (!empty($missingColumns)) {
            Session::flash('import_error', 'Missing columns: ' . implode(', ', $missingColumns));
            return null;
        }

        $validator = Validator::make($row, [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $errorMessages = $validator->errors()->all();
            Session::flash('import_error', 'Row has validation errors: ' . implode(', ', $errorMessages));
            return null;
        }

        return new Customer([
            'name'  => $row['name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
        ]);
    }
}