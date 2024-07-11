<?php
// File path where the output will be saved
$outputFile = 'students.txt';

// Open the file for writing
$fileHandle = fopen($outputFile, 'w');

// Check if the file is opened successfully
if ($fileHandle === false) {
    die('Error opening the file for writing');
}

// Loop through the numbers from 1 to 200
for ($i = 1; $i <= 200; $i++) {
    // Format the number with leading zeros
    $number = str_pad($i, 3, '0', STR_PAD_LEFT);
    // Create the line with the number and "Student"
    $line = $number . ",Student" . PHP_EOL;
    // Write the line to the file
    fwrite($fileHandle, $line);
}

// Close the file
fclose($fileHandle);

echo 'File has been generated successfully';
?>
