<?php

namespace App\Http\Controllers;

use App\Exports\CardDataExport;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use thiagoalessio\TesseractOCR\TesseractOCR;

class CardDataController extends Controller
{
    private function parseTextToStructure($text)
    {
        // Split the text into lines
        $lines = explode("\n", $text);

        $structuredData = [];
        $otherData = [];

        foreach ($lines as $line) {
            $line = trim($line);

            // Skip empty lines
            if (empty($line)) {
                continue;
            }

            // Try to detect key-value pairs (e.g., "Label: Value")
            if (strpos($line, ':') !== false) {
                list($key, $value) = explode(':', $line, 2);
                $structuredData[trim($key)] = trim($value);
            } else {
                // If no key-value pair, treat it as unstructured data
                $otherData[] = $line;
            }
        }

        // Add unstructured data as a fallback field
        $structuredData['Other Data'] = implode("; ", $otherData);

        return $structuredData;
    }

    private function generateCsvFromStructuredData($structuredData)
    {
        $directory = storage_path('app/csv');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true); // Create directory if it doesn't exist
        }

        $filename = 'structured_data_' . time() . '.csv';
        $csvPath = 'csv/' . $filename;

        // Open file handle
        $handle = fopen(storage_path('app/' . $csvPath), 'w');

        // Write headers
        fputcsv($handle, array_keys($structuredData));

        // Write data
        fputcsv($handle, array_values($structuredData));

        // Close file
        fclose($handle);

        return storage_path('app/' . $csvPath);
    }

    public function processCard(Request $request)
    {
        // Validate image file
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,bmp|max:2048',
        ]);

        // Store the image
        $imagePath = $request->file('image')->store('temp');
        $fullImagePath = storage_path('app/' . $imagePath);

        $tesseractPath = 'C:\\Program Files\\Tesseract-OCR\\tesseract.exe';

        $ocr = new TesseractOCR($fullImagePath);
        $ocr->executable($tesseractPath);

        try {
            $extractedText = $ocr->run();
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Error processing the image: ' . $e->getMessage());
        }

        // Parse text into structured data
        $structuredData = $this->parseTextToStructure($extractedText);

        // Generate CSV and get the full path
        $csvPath = $this->generateCsvFromStructuredData($structuredData);

        // Return the file directly for download
        return response()->download($csvPath)->deleteFileAfterSend(true);
    }
}
