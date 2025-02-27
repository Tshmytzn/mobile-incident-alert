<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function uploadPicture($picture, string $path): array
    {
        if (!$picture || !$picture->isValid()) {
            return [null, false]; // Return null filename and false status
        }

        // Generate unique filename
        $filename = time() . '_' . $picture->getClientOriginalName();

        // Set the destination path inside `public/`
        $destinationPath = public_path($path); // Example: public/StudentPicture

        // Ensure directory exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        // Move the file to `public/{path}/`
        $moved = $picture->move($destinationPath, $filename);

        // Return the filename and success status
        return ['filename' => $filename, 'status' => $moved ? true : false];
    }

    public function deletePicture(string $path, string $filename): bool
    {
        // Define the full path inside the public folder
        $filePath = public_path("{$path}/{$filename}");

        // Check if the file exists
        if (file_exists($filePath)) {
            return unlink($filePath); // Delete the file and return true if successful
        }

        return false; // Return false if file does not exist
    }

}
