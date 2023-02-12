<?php

namespace App\Http\Controllers;

use App\Models\PanitiaAgenda;
use App\Repositories\PanitiaAgendaService;
use Illuminate\Http\Request;

class PanitiaAgendaController extends Controller
{
    private $panitiaagendaService;

    public function __construct(PanitiaAgendaService $panitiaagendaService)
    {
        $this->panitiaagendaService = $panitiaagendaService;
    }


    public function index()
    {
        $data = $this->panitiaagendaService->all();
        return view('admin.panitiaagenda.index', compact('data'));
    }


    public function create()
    {
        return view('admin.panitiaagenda.create');
    }


    public function store(Request $request)
    {
        $this->panitiaagendaService->store($request->all());
        return redirect()->route('panitiaagenda.index')->with('success','PanitiaAgenda has success created');
    }


    public function show(PanitiaAgenda $panitia_agenda)
    {
        return view('admin.panitiaagenda.show', compact('panitiaagenda'));
    }


    public function edit(PanitiaAgenda $panitia_agenda)
    {
        return view('admin.panitiaagenda.edit', compact('panitiaagenda'));
    }


    public function update(Request $request, PanitiaAgenda $panitia_agenda)
    {
        $this->panitiaagendaService->update($request->all(),$panitia_agenda->id);
        return redirect()->route('panitiaagenda.index')->with('success','PanitiaAgenda has success updated');
    }


    public function destroy(PanitiaAgenda $panitia_agenda)
    {
        $this->panitiaagendaService->destroy($panitia_agenda->id);
        return back()->with('success','PanitiaAgenda has success deleted');
    }
}
