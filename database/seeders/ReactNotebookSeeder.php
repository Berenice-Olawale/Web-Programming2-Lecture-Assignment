<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReactNotebookSeeder extends Seeder
{
    public function run(): void
    {
        $db = DB::connection('react');

        $db->table('notebooks')->delete();
        $db->table('processors')->delete();
        $db->table('operating_systems')->delete();

        foreach ($this->readRows('processor.txt') as $row) {
            $db->table('processors')->insert([
                'id' => (int) $row[0],
                'manufacturer' => $row[1],
                'type' => $row[2],
            ]);
        }

        foreach ($this->readRows('opsystem.txt') as $row) {
            $db->table('operating_systems')->insert([
                'id' => (int) $row[0],
                'name' => $row[1],
            ]);
        }

        foreach ($this->readRows('notebook.txt') as $row) {
            if (count($row) < 10) {
                continue;
            }

            $db->table('notebooks')->insert([
                'manufacturer' => $row[0],
                'type' => $row[1],
                'display' => $row[2],
                'memory' => (int) $row[3],
                'harddisk' => (int) $row[4],
                'videocontroller' => $row[5],
                'price' => (int) round((float) str_replace(',', '.', $row[6])),
                'processorid' => (int) $row[7],
                'opsystemid' => (int) $row[8],
                'pieces' => (int) $row[9],
            ]);
        }
    }

    private function readRows(string $file): array
    {
        $text = file_get_contents(database_path('seeders/data/'.$file));
        $text = preg_replace('/^\xEF\xBB\xBF/', '', $text);
        $lines = preg_split('/\r\n|\n|\r/', trim($text));
        array_shift($lines);

        $rows = [];
        foreach ($lines as $line) {
            if (trim($line) === '') {
                continue;
            }
            $rows[] = array_map('trim', explode("\t", $line));
        }

        return $rows;
    }
}