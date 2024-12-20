<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Jurusan;
use GuzzleHttp\Client;


use GuzzleHttp\Client as HttpClient; 

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response{

        $jurusans = Jurusan::all();
        // Variabel $jurusans kemudian kita passing sebagai parameter ketika render view
        return response(view('jurusans.index', ['jurusans' => $jurusans]));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        // Variabel $jurusans kemudian kita passing sebagai parameter ketika render view
        return response(view('jurusans.create'));
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
       // Custom validation messages (optional, for more informative error messages)
    $messages = [
        //  
        'id.integer' => 'Stock produk harus berupa angka bulat (tanpa koma atau desimal).',
    ];

    // Validation rules with clear explanations
    $validatedData = $request->validate([
        'id' => 'required|string|max:10|unique:jurusans',
        'jurusan' => 'required|string|regex:/^[a-zA-Z\s]+$/u|max:255',
        'kakomli' => 'required|string|regex:/^[a-zA-Z\s]+$/u|max:255',
    ], $messages);

    if (Jurusan::create($validatedData)) {
        return redirect()->route('jurusans.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    return redirect()->route('jurusans.index')->with('error', 'Gagal menambahkan produk!');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): Response
    {
        dd('halaman show');
    }

    /**
     * Show the form for editing the specified resource.
     */

     public function edit($id)
    {
        $jurusan = Jurusan::findOrFail($id);

        return view('jurusans.edit', compact('jurusan'));
    }



    public function update(Request $request, $id)
    {
        $jurusan = new Client();

        try {
            $response = $jurusan->put("http://localhost:8000/api/v1/jurusan/update/$id", [
                'form_params' => [
                    'jurusan' => $request->jurusan,
                    'kakomli' => $request->kakomli,
                ],
                'timeout' => 10,
            ]);

            if ($response->getStatusCode() == 200) {
                return response()->json(['success' => 'Data Ekstrakulikuler berhasil diupdate.']);
            } else {
                return response()->json(['error' => 'Gagal mengupdate data ekstrakulikuler.'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat menghubungi API.'], 500);
        }
    }

    public function destroy($id)
    {
        $ekskul = Ekskul::findOrFail($id);

        try {
            $response = $ekskul->destroy("http://localhost:8000/api/v1/ekskuls/delete/{$id}", [
                'timeout' => 60,
            ]);

            if ($response->getStatusCode() == 204) {
                return redirect()->route('ekskuls.index')->with('success', 'Data Ekstrakurikuler berhasil dihapus.');
            } else {
                return redirect()->route('ekskuls.index')->with('error', 'Gagal menghapus data ekstrakurikuler.');
            }
        } catch (\Exception $e) {
            return redirect()->route('ekskuls.index')->with('error', 'Terjadi kesalahan saat menghubungi API.');
        }
    }

    
}
