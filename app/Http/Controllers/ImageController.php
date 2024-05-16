<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function getImage()
    {
        if (Storage::disk('ftp')->exists("foto/MxmEsJHod9nH4KGN8azuZBv6cn8Et2lWLAYE3sNW.jpg")) {
            $fileContent = Storage::disk('ftp')->get("foto/MxmEsJHod9nH4KGN8azuZBv6cn8Et2lWLAYE3sNW.jpg"); // Mengambil file dari FTP
    
            return response($fileContent)
                ->header('Content-Type', 'image/jpeg'); // Sesuaikan dengan tipe file
        } else {
            abort(404, 'File not found');
        }
    }
}
