<?php
$inputFilePath = 'database/seeders/static-data/regencies.csv';
$outputFilePath = 'database/seeders/static-data/regencies_formatted.csv';

// Open the input CSV file in read mode
$inputFile = fopen($inputFilePath, 'r');

// Open the output CSV file in write mode
$outputFile = fopen($outputFilePath, 'w');

// Read each line from the input CSV file
while (($data = fgetcsv($inputFile)) !== false) {

    // Remove the first two digits from the first element in the array
    $data[0] = substr($data[0], 2);

    // Write the processed data to the output CSV file
    fputcsv($outputFile, $data);
}

// Close the input and output CSV files
fclose($inputFile);
fclose($outputFile);

echo "CSV processing completed. Processed data saved to: " . $outputFilePath;
