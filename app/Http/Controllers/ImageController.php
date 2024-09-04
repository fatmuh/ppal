<?php

namespace App\Http\Controllers;

use App\Jobs\DeleteImageJob;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function getImage(Request $request)
    {
        $imageUrl = 'https://database.ppal.or.id/ppal/' . $request->input('image');

        $client = new Client();
        $response = $client->get($imageUrl);

        return response($response->getBody())->header('Content-Type', 'image/jpeg');
    }

    // public function getImage(Request $request)
    // {
    //     $imagePath = $request->query('image');

    //     $imageUrl = Storage::disk('spaces')->temporaryUrl($imagePath, now()->addMinutes(1));

    //     $client = new Client();
    //     $response = $client->get($imageUrl);

    //     return response($response->getBody())->header('Content-Type', 'image/jpeg');
    // }

}
