<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ImageController extends Controller
{
    public function getImage(Request $request)
    {
        $imageUrl = 'https://database.ppal.or.id/ppal/' . $request->input('image');

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->get($imageUrl);

            if ($response->getStatusCode() == 200) {
                $contentType = $response->getHeader('Content-Type');
                if (!empty($contentType)) {
                    return response($response->getBody())->header('Content-Type', $contentType[0]);
                } else {
                    // Log the headers received for debugging purposes
                    Log::error("Content-Type header not found for URL: " . $imageUrl);
                    Log::error("Response headers: " . json_encode($response->getHeaders()));
                    // Use a default Content-Type as fallback
                    return response($response->getBody())->header('Content-Type', 'image/jpeg');
                }
            } else {
                Log::error("Failed to retrieve image. Status code: " . $response->getStatusCode());
                return response("Error retrieving image", 500);
            }
        } catch (RequestException $e) {
            Log::error("RequestException: " . $e->getMessage());
            return response("Error retrieving image", 500);
        } catch (\Exception $e) {
            Log::error("Exception: " . $e->getMessage());
            return response("Error retrieving image", 500);
        }
    }
}
