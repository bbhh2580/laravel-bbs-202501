<?php

namespace App\Handlers;

use Illuminate\Support\Str;

/**
 * Image upload handler
 */
class ImageUploadHandler
{
    /**
     * @var array|string[] Allowed file extensions
     */
    protected array $allowed_ext = ['png', 'jpg', 'jpeg', 'gif'];

    /**
     * Upload image
     *
     * @param $file
     * @param $folder
     * @param $file_prefix
     * @return array|bool
     */
    public function save($file, $folder, $file_prefix): array|bool
    {
        // build storage folder
        // ex:  upload/images/avatars/201709/21/
        $folder_name = "uploads/images/$folder/" . date("Ym/d", time());

        // The path of the file storage folder
        // ex: /Library/WebServer/Documents/php/laravel-bbs-202501/
        $upload_path = public_path() . '/' . $folder_name;

        // Get the file extension from the file
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        //The file name is composed of the prefix, the date of the upload, and the file extension
        $filename = $file_prefix . '_' . time() . '_' . Str::random(10) . '.' . $extension;

        // If the upload file is not an imag, terminate the operation
        if (!in_array($extension, $this->allowed_ext)) {
            return false;
        }

        // Move the file to the specified folder
        $file->move($upload_path, $filename);

        return [
            'path' => config('app.url') . "/$folder_name/$filename"
        ];
    }
}
