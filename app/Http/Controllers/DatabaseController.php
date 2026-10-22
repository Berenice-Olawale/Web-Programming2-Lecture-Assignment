<?php

namespace App\Http\Controllers;

use App\Models\Notebook;
use App\Models\Processor;
use App\Models\OperatingSystem;

class DatabaseController extends Controller
{
    public function index()
    {
        $notebooks = Notebook::with([
            'processor',
            'operatingSystem'
        ])->orderBy('manufacturer')->get();

        $processors = Processor::orderBy('manufacturer')
            ->orderBy('type')
            ->get();

        $operatingSystems = OperatingSystem::orderBy('name')
            ->get();

        return view('database', compact(
            'notebooks',
            'processors',
            'operatingSystems'
        ));
    }
}
