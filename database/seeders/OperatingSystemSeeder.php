<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OperatingSystem;

class OperatingSystemSeeder extends Seeder
{
    public function run(): void
    {
        $path = getenv('HOME')
            . '/Documents/5TH SEMESTER/Web programming 2/web2_lecture/Databases for Homeworks (2)/01-Notebook/opsystem.txt';

        $file = fopen($path, 'r');

        if ($file === false) {
            throw new \RuntimeException("Could not open opsystem.txt: {$path}");
        }

        try {
            fgetcsv($file, 0, "\t"); // Skip header

            while (($row = fgetcsv($file, 0, "\t")) !== false) {
                if (count($row) < 2) {
                    continue;
                }

                OperatingSystem::updateOrCreate(
                    ['id' => (int) $row[0]],
                    ['name' => trim($row[1])]
                );
            }
        } finally {
            fclose($file);
        }
    }
}