<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DeleteImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $imageName;
    /**
     * Create a new job instance.
     */
    public function __construct($imageName)
    {
        $this->imageName = $imageName;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Attempting to delete image: ' . $this->imageName);
        Storage::delete('foto/'.$this->imageName);
        Log::info('Image deleted: ' . $this->imageName);
    }
}
