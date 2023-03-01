<?php

namespace App\Console\Commands;

use SplFileInfo;
use App\Models\Image;
use RecursiveIteratorIterator;
use Illuminate\Console\Command;
use RecursiveDirectoryIterator;

class ImportImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import images from public/images directory into database';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Updating images database...');

        $count = 0;

        try {
            $filesInDir = collect(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(public_path('images/')), RecursiveIteratorIterator::SELF_FIRST));

            $filesInDir->each(function (SplFileInfo $file) use (&$count) {
                if ($file->isFile() && in_array($file->getExtension(), ['jpg', 'jpeg', 'png', 'gif'])) {
                    $paths = explode('public\\', $file->getRealPath());
                    if (count($paths) < 2) {
                        $paths = explode('public/', $file->getRealPath());
                    }

                    Image::query()->updateOrCreate([
                        'path' => $paths[1],
                    ]);

                    $count++;

                    if ($count % 100 === 0) {
                        $this->info("{$count} images processed -");
                    }
                }
            });

            $this->info("{$count} total images processed");
            $this->info('Images database updated successfully');
        } catch (\Exception $e) {
            $this->error('An error occurred while updating images database');
            $this->error($e->getMessage());
        }
    }
}
