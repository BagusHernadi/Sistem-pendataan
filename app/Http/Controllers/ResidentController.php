<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ResidentController extends Controller
{
    public function index()
    {
        $residents = Resident::latest()->get();
        return view('pages.resident.index', compact('residents'));
    }

    public function create()
    {
        return view('pages.resident.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => ['required','min:16','max:16'],
            'name' => ['required','max:100'],
            'gender' => ['required', Rule::in(['male','female'])],
            'birth_place' => ['required','max:100'],
            'birtch_date' => ['required','date'],
            'address' => ['required','max:700'],
            'religion' => ['nullable','max:50'],
            'marital_status' => ['required', Rule::in(['single','married','divorced','widowed'])],
            'occupation' => ['nullable','max:100'],
            'phone' => ['nullable','max:15'],
            'status' => ['required', Rule::in(['active','moved','deceased'])],
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Handle file upload
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('resident_photos', 'public');
            $validated['photo'] = $path; // Store the relative path
        }

        Resident::create($validated);

        return redirect()->route('resident.index')
            ->with('success', 'Data berhasil disimpan');
    }


    public function edit($id)
    {
        $resident = Resident::findOrFail($id);
        return view('pages.resident.edit', compact('resident'));
    }
public function show($id)
{
    $resident = Resident::findOrFail($id);
    return view('pages.resident.show', compact('resident'));
}


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required','max:100'],
            'nik' => ['required','min:16','max:16'],
            'gender' => ['required', Rule::in(['male','female'])],
            'birth_place' => ['required','max:100'],
            'birtch_date' => ['required','date'],
            'address' => ['required','max:700'],
            'religion' => ['nullable','max:50'],
            'marital_status' => ['required', Rule::in(['single','married','divorced','widowed'])],
            'occupation' => ['nullable','max:100'],
            'phone' => ['nullable','max:15'],
            'status' => ['required', Rule::in(['active','moved','deceased'])],
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $resident = Resident::findOrFail($id);
        
        // Handle file upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($resident->photo && Storage::disk('public')->exists($resident->photo)) {
                Storage::disk('public')->delete($resident->photo);
            }
            // Store new photo
            $path = $request->file('photo')->store('resident_photos', 'public');
            $validated['photo'] = $path;
        }

        $resident->update($validated);

        return redirect()->route('resident.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    
    public function destroy($id)
    {
        $resident = Resident::findOrFail($id);
        
        // Delete the photo file if it exists
        if ($resident->photo && Storage::disk('public')->exists($resident->photo)) {
            Storage::disk('public')->delete($resident->photo);
        }
        
        $resident->delete();
        
        return redirect()->route('resident.index')
            ->with('success', 'Data berhasil dihapus');
    }

    public function laporan()
    {
    $residents = Resident::all();

    $genderCount = [
        'Laki-laki' => Resident::where('gender', 'male')->count(),
        'Perempuan' => Resident::where('gender', 'female')->count(),
    ];

    $statusCount = [
        'Aktif' => Resident::where('status', 'active')->count(),
        'Pindah' => Resident::where('status', 'moved')->count(),
        'Meninggal' => Resident::where('status', 'deceased')->count(),
    ];

    return view('pages.resident.laporan', compact('residents', 'genderCount', 'statusCount'));
    }


}

