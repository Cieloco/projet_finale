<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    private function permission() {
        if(auth()->check()) {
            $user = auth()->user();
            if (!($user->role === 'admin')) {
                abort(403, 'Only Admin allowed to make this operation');
            }
        }
    }
    private function gate($service) {
        if(auth()->check()) {
            $user = auth()->user();
            if (!($user->service_id === $service->id) && !($user->role === 'admin')) {
                abort(403);
            }
        }
    }
    /**
     * Display a listing of the service.
     */
    public function index()
    {
        $this->permission();
        $services = Service::where('name', '!=', 'none')->get();
        return view('admin.index.service', compact('services'));
    }

    /**
     * Show the form for creating a new service.
     */
    public function create()
    {
        $this->permission();
        return view('admin.create.service');
    }

    /**
     * Store a newly created service in storage.
     */
    public function store(Request $request)
    {
        $this->permission();
        $request->validate([
            'name' => 'required|string|max:255|unique:services',
        ]);

        $service = new Service();
        $service->name = $request->name;
        $service->save();

        return redirect()->route('services.index')->with('success', 'Le service a été créé avec succès.');
    }

        /**
     * Display the specified service.
     */
    public function show(Service $service)
    {
        $this->gate($service);
        $chef = $service->utilisateurs()->where('role', 'chef')->first();

        $fonctionnaires = $service->utilisateurs()->where('role', 'fonctionnaire')->get();

        return view('admin.show.service', compact('service', 'chef', 'fonctionnaires'));
    }


    /**
     * Show the form for editing the specified service.
     */
    public function edit(Service $service)
    {
        $this->permission();
        return view('admin.edit.service', array('service' => $service));
    }

    /**
     * Update the specified service in storage.
     */
    public function update(Request $request, Service $service)
    {
        $this->permission();
        $request->validate([
            'name' => 'required|string|max:255|unique:services,name,' . $service->id,
        ]);

        $service->name = $request->name;
        $service->save();

        return redirect()->route('services.index')->with('success', 'Le service a été modifié avec succès.');
    }


    public function delete(Service $service)
    {
        $this->permission();
        return view('admin.delete.service', compact('service'));
    }

    /**
     * Remove the specified service from storage.
     */
        public function destroy(Service $service)
    {
        $this->permission();
        if ($service->delete()) {
            return redirect()->route('services.index')->with('success', 'Service supprimé avec succès');
        }
    }
}
