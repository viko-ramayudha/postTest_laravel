<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class SiswaController extends Controller
{
    public function index()
    {
        try {
            // Menggunakan HTTP Client Laravel untuk mengambil data dari API
            $response = Http::get('http://localhost/pro/master/siswa/api/read.php');
            $data = json_decode($response->body(), true)['data'];
        } catch (\Exception $e) {
            // Menangani kesalahan jika tidak bisa mengambil data dari API
            return redirect()->route('siswa.index')->with('error', 'Gagal mengambil data dari API');
        }

        return view('siswa.index', ['siswa' => $data]);
        // dd($data);
    }

    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'nis' => 'required',
            'nama' => 'required',
            'tgl_lahir' => 'required',
            'jenkel' => 'required',
            'alamat' => 'required',
            'id_jurusan' => 'required',
        ]);

        $client = new Client();

        try {
            $response = $client->post('http://localhost/pro/master/siswa/api/insert.php', [
                'form_params' => [
                    'nis' => $request->input('nis'),
                    'nama' => $request->input('nama'),
                    'tgl_lahir' => $request->input('tgl_lahir'),
                    'jenkel' => $request->input('jenkel'),
                    'alamat' => $request->input('alamat'),
                    'id_jurusan' => $request->input('id_jurusan'),
                ]
            ]);
            return redirect()->route('siswa.index')->with('success', 'Data berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Jika terjadi exception atau error, redirect kembali ke halaman create dengan pesan error
            return redirect()->route('siswa.create')->with('error', 'Gagal menambahkan data blok: ' . $e->getMessage());
        }
    }        

    public function show($nis)
    {
        try {
            $siswatels = Siswa::findOrFail($nis);
        } catch (\Exception $e) {
            return redirect()->route('siswa.index')->with('error', 'Data siswa tidak ditemukan');
        }

        return view('siswa.show', ['siswa' => $siswatels]);
    }

    public function edit($nis)
    {
        try {
            $siswatels = Siswa::findOrFail($nis);
        } catch (\Exception $e) {
            return redirect()->route('siswa.index')->with('error', 'Data siswa tidak ditemukan');
        }

        return view('siswa.edit', ['siswa' => $siswatels]);
    }

    public function update(Request $request, $nis)
    {
        $validatedData = $request->validate([
            'nis' => 'required|integer|unique:nis,nis,' . $nis . ',nis',
            'nama' => 'required|string',
            'kelas' => 'required|string',
            'jenis_kelamin' => 'required|string|max:255',
        ]);

        try {
            $siswatels = Siswa::findOrFail($nis);
            if ($siswatels->update($validatedData)) {
                return redirect()->route('siswa.index')->with('success', 'Data berhasil diperbaharui');
            } else {
                return redirect()->route('siswa.index')->with('error', 'Gagal memperbaharui data!');
            }
        } catch (\Exception $e) {
            return redirect()->route('siswa.index')->with('error', 'Gagal memperbaharui data: ' . $e->getMessage());
        }
    }

    public function destroy($nis)
    {
        try {
            $siswatels = Siswa::findOrFail($nis);
            if ($siswatels->delete()) {
                return redirect()->route('siswa.index')->with('success', 'Data berhasil dihapus');
            } else {
                return redirect()->route('siswa.index')->with('error', 'Gagal menghapus data!');
            }
        } catch (\Exception $e) {
            return redirect()->route('siswa.index')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}