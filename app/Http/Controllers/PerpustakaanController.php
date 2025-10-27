<?php

namespace App\Http\Controllers;

use App\Models\Perpustakaan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PerpustakaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perpustakaan = Perpustakaan::all();
        return view ('perpustakaan.index', compact('perpustakaan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('perpustakaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            //validasi data yang masuk
            $request->validate([
                'title' => 'required|string|max:255',
                'status' => 'required|string',
                'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            ]);

            //ambil data manual
            $data = $request->only('title', 'status', 'image');

            //upload image
            if($request->hasFile('image')){
                $image = $request->file('image');
                $imageName = $image->hashName();
                $imagePath = $image->storeAs('images', $imageName, 'public');
                $data['image'] = $imagePath;
            }

            //simpan data ke database
            Perpustakaan::create([
                'image' => $imageName,
                'title' => $request->input('title'),
                'status' => $request->input('status'),
            ]);
            //redirect kembali
            return redirect()->route('perpustakaan.index')
                             ->with('succes', 'Book created succesfully');
        } catch(\Exception $e) {
            return back()->withErrors(['error' => 'An error occured: '. $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Perpustakaan $perpustakaan)
    {
        return view ('perpustakaan.show', compact('perpustakaan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Perpustakaan $perpustakaan)
    {
        return view ('perpustakaan.edit', compact('perpustakaan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Perpustakaan $perpustakaan)
    {
        try{
            //validat4e
            $validateData = $request->validate([
                'title' => 'required|string|max:255',
                'status' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            ]);

            $imageName = $perpustakaan->image;
            if ($imageName){
                $imageFile = $request->file('image');

                if ($imageFile) {
                    $imageName = $imageFile->hashName();
                    $imageFile->storeAs('images', $imageName, 'public');
                }
                // $request->merge(['image' => $imagePath]);
            }

            $perpustakaan->update([
                'title' => $validateData['title'],
                'status' => $validateData['content'],
                'image' => $imageName,
            ]);
            return redirect()->route('perpustakaan.index')
                             ->with('succes', 'Book update succesfully');
        }catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurated: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Perpustakaan $perpustakaan)
    {
        try{
            if($perpustakaan->image) {
                Storage::disk('public')->delete('images/' . $perpustakaan->image);
            }

            $perpustakaan->delete();
            
            return redirect()->route('perpustakaan.index')
                             ->with('succes', 'Book deleted succesfully');

                            } catch (\Exception $e){
            return back()->withErrors(['error' => 'An error occurated' . $e->getMessage()]);
        }
    }
}
