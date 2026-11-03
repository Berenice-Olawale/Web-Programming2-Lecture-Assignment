<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotebookApiController extends Controller
{
    public function index(): JsonResponse
    {
        $notebooks = DB::connection('react')->table('notebooks')
            ->leftJoin('processors', 'processors.id', '=', 'notebooks.processorid')
            ->leftJoin('operating_systems', 'operating_systems.id', '=', 'notebooks.opsystemid')
            ->select(
                'notebooks.*',
                'processors.manufacturer as processor_manufacturer',
                'processors.type as processor_type',
                'operating_systems.name as operating_system'
            )
            ->orderBy('notebooks.manufacturer')
            ->orderBy('notebooks.type')
            ->get();

        return response()->json($notebooks);
    }

    public function lookups(): JsonResponse
    {
        $db = DB::connection('react');

        return response()->json([
            'processors' => $db->table('processors')->orderBy('manufacturer')->orderBy('type')->get(),
            'operating_systems' => $db->table('operating_systems')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $id = DB::connection('react')->table('notebooks')->insertGetId($this->validated($request));

        return response()->json(['id' => $id], 201);
    }

    public function update(Request $request, int $notebook): JsonResponse
    {
        $this->ensureExists($notebook);

        DB::connection('react')->table('notebooks')
            ->where('id', $notebook)
            ->update($this->validated($request));

        return response()->json(['id' => $notebook]);
    }

    public function destroy(int $notebook): JsonResponse
    {
        $this->ensureExists($notebook);

        DB::connection('react')->table('notebooks')->where('id', $notebook)->delete();

        return response()->json(null, 204);
    }

    private function ensureExists(int $id): void
    {
        abort_unless(
            DB::connection('react')->table('notebooks')->where('id', $id)->exists(),
            404
        );
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'manufacturer' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'display' => ['required', 'string', 'max:10'],
            'memory' => ['required', 'integer', 'min:1'],
            'harddisk' => ['required', 'integer', 'min:1'],
            'videocontroller' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'processorid' => ['required', 'integer', 'exists:react.processors,id'],
            'opsystemid' => ['required', 'integer', 'exists:react.operating_systems,id'],
            'pieces' => ['required', 'integer', 'min:0'],
        ]);
    }
}