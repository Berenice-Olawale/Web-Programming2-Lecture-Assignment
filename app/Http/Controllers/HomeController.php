<?php

namespace App\Http\Controllers;

use App\Models\Notebook;
use App\Models\Processor;
use App\Models\OperatingSystem;

class HomeController extends Controller
{
    public function index()
    {
        $notebooks = Notebook::with([
            'processor',
            'operatingSystem'
        ])->orderBy('manufacturer')->get();

        $processorCount = Processor::count();
        $operatingSystemCount = OperatingSystem::count();
        $notebookCount = Notebook::count();

        return view('home', compact(
            'notebooks',
            'processorCount',
            'operatingSystemCount',
            'notebookCount'
        ));
    }
}
