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
    $name_index = 0;
    $quantity_index = 1;
    $type_index = 2;

    // Flag variable to track whether we are processing the first row
    $is_first_row = true;

    // Loop through each row in the file
    while (($row = fgetcsv($file)) !== false) {
        // If this is the first row, skip it
        if ($is_first_row) {
            $is_first_row = false;
            continue;
        }

        // Add the row data to the data array
        $data[] = [
            'name' => $row[$name_index],
            'slug' => Str::slug($row[$name_index]), // Add a slug column to the array and set it to the slug of the name
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
