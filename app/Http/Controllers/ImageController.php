<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ImageController extends Controller
{
    public function getImage(Request $request)
    {
        $url = 'https://database.ppal.or.id/ppal/foto/MxmEsJHod9nH4KGN8azuZBv6cn8Et2lWLAYE3sNW.jpg';
        $client = new Client();
        
        // Unduh gambar dari URL
        $response = $client->get($url);

        if ($response->getStatusCode() == 200) {
            // Ambil konten gambar
            $imageContent = $response->getBody()->getContents();

            // Dapatkan tipe konten gambar jika tersedia
            $contentType = $response->hasHeader('Content-Type') ? $response->getHeader('Content-Type')[0] : 'application/octet-stream';

            // Kembalikan gambar langsung dalam respons dengan header yang sesuai
            return response($imageContent, 200)->header('Content-Type', $contentType);
        } else {
            return response()->json(['message' => 'Failed to download image'], 500);
        }
    }
}
