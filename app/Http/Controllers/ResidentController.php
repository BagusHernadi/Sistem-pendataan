<?php

namespace App\Http\Controllers;
use App\Models\Resident;
use Illuminate\Http\Request;
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
            'birtch_date' => ['required','date'],   // sesuai database
            'address' => ['required','max:700'],
            'religion' => ['nullable','max:50'],
            'marital_status' => ['required', Rule::in(['single','married','divorced','widowed'])],
            'occupation' => ['nullable','max:100'],
            'phone' => ['nullable','max:15'],
            'status' => ['required', Rule::in(['active','moved','deceased'])],
            'photo' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if($request->hasFile('photo')){
        $validated['photo'] = $request->photo->store('resident_photo', 'public');
        }

        Resident::create($validated);

        return redirect()->route('resident.index')->with('success','Data berhasil ditambahkan');
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
            'nik' => ['required','min:16','max:16'],
            'name' => ['required','max:100'],
            'gender' => ['required', Rule::in(['male','female'])],
            'birth_place' => ['required','max:100'],
            'birtch_date' => ['required','date'],   // tetap mengacu nama DB
            'address' => ['required','max:700'],
            'religion' => ['nullable','max:50'],
            'marital_status' => ['required', Rule::in(['single','married','divorced','widowed'])],
            'occupation' => ['nullable','max:100'],
            'phone' => ['nullable','max:15'],
            'status' => ['required', Rule::in(['active','moved','deceased'])],
        ]);

        Resident::findOrFail($id)->update($validated);

        return redirect()->route('resident.index')->with('success','Data berhasil diperbarui');
    }

    
    public function destroy($id)
    {
        Resident::findOrFail($id)->delete();
        return redirect()->route('resident.index')->with('success','Data berhasil dihapus');
    }

    
}

