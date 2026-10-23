<?php

namespace App\Http\Controllers;

use App\Models\Notebook;

class GraphController extends Controller
{
    public function index()
    {
        $notebooksByManufacturer = Notebook::query()
            ->selectRaw('manufacturer, COUNT(*) as total')
            ->groupBy('manufacturer')
            ->orderBy('manufacturer')
            ->get();

        return view('graph', compact('notebooksByManufacturer'));
    }
}
