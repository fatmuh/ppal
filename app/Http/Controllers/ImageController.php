<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ImageController extends Controller
{
    public function getImage(Request $request)
    {
        // URL gambar dari domain eksternal
        $imageUrl = 'https://database.ppal.or.id/ppal/' . $request->input('image');

        // Mengambil gambar menggunakan Laravel HTTP Client
        $response = Http::get($imageUrl);

        // Mengembalikan gambar kepada klien
        return response($response->body())->header('Content-Type', 'image/jpeg');
    }
}
