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
// Import the data using the selected mapping options
$path = $request->file('file')->getRealPath();

// Open the file in read-only mode
$file = fopen($path, "r");

// Define an array to hold the data from the file
$data = [];

// Get the selected mapping options
$name_index = ($request->input('name_column') == 'default') ? 0 : $request->input('name_column');
$type_index = ($request->input('type_column') == 'default') ? 2 : $request->input('type_column');
$quantity_index = ($request->input('quantity_column') == 'default') ? 1 : $request->input('quantity_column');

// Define an array to hold the mapping options
$mapping_options = [
    'name_index' => $name_index,
    'type_index' => $type_index,
    'quantity_index' => $quantity_index,
];
// Flag variable to track whether we are processing the first row
$is_first_row = true;

// Loop through each row in the file
while (($row = fgetcsv($file)) !== false) {
    // Add the row data to the data array
    //skip the first row
    if ($is_first_row) {
        $is_first_row = false;
        continue;
    }
    $data[] = [
        'name' => $row[$name_index],
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
