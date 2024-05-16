<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ImageController extends Controller
{
    public function getImage(Request $request)
    {
        $imageUrl = 'https://database.ppal.or.id/ppal/' . $request->input('image');

        try {
            $response = Http::get($imageUrl);

            if ($response->successful()) {
                return response($response->body())->header('Content-Type', 'image/jpeg');
            } else {
                return response('Error fetching image', 404);
            }
        } catch (\Exception $e) {
            return response('Exception occurred: ' . $e->getMessage(), 500);
        }
    }
}
