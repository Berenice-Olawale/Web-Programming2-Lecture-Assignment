<?php

namespace App\Http\Controllers;

use App\Models\Notebook;
use App\Models\OperatingSystem;
use App\Models\Processor;
use Illuminate\Http\Request;

class NotebookController extends Controller
{
    private function rules(): array
    {
        return [
            'manufacturer'    => 'required|string|max:255',
            'type'            => 'required|string|max:255',
            'display'         => 'required|string|max:10',
            'memory'          => 'required|integer|min:1',
            'harddisk'        => 'required|integer|min:1',
            'videocontroller' => 'required|string|max:255',
            'price'           => 'required|numeric|min:0',
            'processorid'     => 'required|exists:processors,id',
            'opsystemid'      => 'required|exists:operating_systems,id',
            'pieces'          => 'required|integer|min:0',
        ];
    }

    public function index()
    {
        $notebooks = Notebook::with(['processor', 'operatingSystem'])
            ->orderBy('manufacturer')
            ->orderBy('type')
            ->get();

        return view('notebooks.index', compact('notebooks'));
    }

    public function create()
    {
        return view('notebooks.create', [
            'processors' => Processor::orderBy('manufacturer')->orderBy('type')->get(),
            'operatingSystems' => OperatingSystem::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        Notebook::create($request->validate($this->rules()));

        return redirect()->route('notebooks.index')
            ->with('success', 'Notebook successfully added.');
    }

    public function edit(Notebook $notebook)
    {
        return view('notebooks.edit', [
            'notebook' => $notebook,
            'processors' => Processor::orderBy('manufacturer')->orderBy('type')->get(),
            'operatingSystems' => OperatingSystem::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Notebook $notebook)
    {
        $notebook->update($request->validate($this->rules()));

        return redirect()->route('notebooks.index')
            ->with('success', 'Notebook successfully updated.');
    }

    public function destroy(Notebook $notebook)
    {
        $notebook->delete();

        return redirect()->route('notebooks.index')
            ->with('success', 'Notebook successfully deleted.');
    }
}