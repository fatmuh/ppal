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
        // URL gambar dari domain eksternal
        $imageUrl = 'https://database.ppal.or.id/ppal/' . $request->input('image');

        // Menggunakan GuzzleHttp untuk mengambil gambar
        $client = new Client();
        $response = $client->get($imageUrl);

        // Mendapatkan konten gambar
        $imageContent = $response->getBody()->getContents();

        // Menyimpan gambar ke penyimpanan publik
        $imageName = uniqid() . '.jpg'; // Ubah nama file jika perlu
        Storage::put('foto/' . $imageName, $imageContent);

        // Penjadwalan untuk menghapus gambar setelah 10 detik
        $deleteJob = (new DeleteImageJob($imageName))->delay(now()->addSeconds(25));
        Bus::dispatch($deleteJob);

        // Mendapatkan URL gambar yang baru diunggah
        $imageUrl = Storage::url('foto/'.$imageName);

        // Mengembalikan URL gambar kepada klien
        return redirect($imageUrl);
    }
}
