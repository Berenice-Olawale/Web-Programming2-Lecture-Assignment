<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Processor;

class ProcessorSeeder extends Seeder
{
    public function run(): void
    {
        $path = getenv('HOME')
            . '/Documents/5TH SEMESTER/Web programming 2/web2_lecture/Databases for Homeworks (2)/01-Notebook/processor.txt';

        $file = fopen($path, 'r');

        if ($file === false) {
            throw new \RuntimeException("Could not open processor.txt: {$path}");
        }

        try {
            fgetcsv($file, 0, "\t"); // Skip header

            while (($row = fgetcsv($file, 0, "\t")) !== false) {
                if (count($row) < 3) {
                    continue;
                }

                Processor::updateOrCreate(
                    ['id' => (int) $row[0]],
                    [
                        'manufacturer' => trim($row[1]),
                        'type' => trim($row[2]),
                    ]
                );
            }
        } finally {
            fclose($file);
        }
    }
}