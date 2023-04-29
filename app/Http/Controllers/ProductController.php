<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xls,xlsx,csv'
    ]);

    $path = $request->file('file')->getRealPath();

    // Open the file in read-only mode
    $file = fopen($path, "r");

    // Define an array to hold the data from the file
    $data = [];

    // Define a mapping of column names to indices
    $name_index = null;
    $quantity_index = null;
    $type_index = null;

    // Loop through each row in the file
    while (($row = fgetcsv($file)) !== false) {
        // If this is the first row, extract the column indices
        if ($name_index === null) {
            $name_index = array_search('name', $row);
            $quantity_index = array_search('quantity', $row);
            $type_index = array_search('type', $row);
            continue; // skip the header row
        }

        // Add the row data to the data array
        $data[] = [
            'name' => $row[$name_index],
            'slug' => Str::slug($row[$name_index]),
            'qty' => $row[$quantity_index],
            'type' => $row[$type_index],
        ];
    }

    // Close the file
    fclose($file);

    // Insert the data into the database
    DB::table('products')->insert($data);

    // Redirect back to the previous page with a success message
    return redirect()->back()->with('success', 'Data has been imported successfully.');
}

}
