<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notebook;

class NotebookSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/notebook.txt');
        $file = fopen($path, 'r');

        if ($file === false) {
            throw new \RuntimeException("Could not open notebook.txt: {$path}");
        }

        try {
            fgetcsv($file, 0, "\t"); // Skip header

            while (($row = fgetcsv($file, 0, "\t")) !== false) {
                if (count($row) < 10) {
                    continue;
                }

                Notebook::updateOrCreate(
                    [
                        'manufacturer' => trim($row[0]),
                        'type' => trim($row[1]),
                    ],
                    [
                        'display' => trim($row[2]),
                        'memory' => trim($row[3]),
                        'harddisk' => trim($row[4]),
                        'videocontroller' => trim($row[5]),
                        'price' => (float) str_replace(',', '.', trim($row[6])),
                        'processorid' => (int) $row[7],
                        'opsystemid' => (int) $row[8],
                        'pieces' => (int) $row[9],
                    ]
                );
            }
        } finally {
            fclose($file);
        }
    }
}