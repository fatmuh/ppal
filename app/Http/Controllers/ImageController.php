<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function getImage(Request $request)
    {
        // URL gambar dari domain eksternal
        $imageUrl = 'https://kta.ppal.or.id/ppal/' . $request->input('image');

        // Menggunakan GuzzleHttp untuk mengambil gambar
        $client = new Client();
        $response = $client->get($imageUrl);

        // Mengembalikan gambar kepada klien
        return response($response->getBody())->header('Content-Type', 'image/jpeg');
    }
}
