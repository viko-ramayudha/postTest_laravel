
@extends('layouts.app')

<!-- @section('content') menandakan tampilan dari section 
jurusans tersebut, dalam hal ini adalah menampilkan daftar produk dalam bentuk tabel -->

@section('content')
<head>
    <style>
        p {
            float: right;
        }
        .bck {
            background-image: url('https://www.ngopibareng.id/images/uploads/2022/2022-04-19/face-off-kota-pasuran--thumbnail-372');
            background-size: cover; 
      background-position: center;
      height: 140vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      font-family: sans-serif;
      color: #fff;
        }
        .btn-tamb {
            background-color: #036A7F;
            border: none;
            color: #fff;
            border: 1px solid green;
            padding: 10px 14px;
            border-radius: 5px;
            font-size: 13px;
            font-weight: bold;
            text-decoration: none;
            margin-right: 5px;
            margin-bottom: 5px;
        }
        .updt {
            border-color: #ffc107;
            border: 1px solid #ffc107;
            color: #ffc107;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-weight: bold;
            font-size: 13px;
            padding: 7px 13px;
            margin-left: -70px;
            margin-right: 5px;
        }
        .updt:hover {
            background-color: #ffc107;
            border: none;
            color: #fff;
            border: 1px solid #ffc107;
            padding: 7px 13px;
        }
        .del {
            background-color: #dc3545;
            border: none;
            color: #fff;
            border: 1px solid #dc3545;
            padding: 7px 14px;
            border-radius: 5px;
            font-size: 13px;
            font-weight: bold;
            margin-right: -70px;
        }
        .del:hover {
            background-color: transparent;
            border-color: #dc3545;
            border: 1px solid #dc3545;
            color: #dc3545;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-weight: bold;
            font-size: 13px;
            padding: 7px 14px;
        }
    </style>
</head>
<div class="bck">
<div class="container" style="margin-top: -490px; ">
    <h3 class="mt-4" style="text-align: center; font-weight: bold;">List Peserta Didik</h3>
    <div class="card-body">
        @if (session('success'))
        <div class="alert alert-success">{{ session('success')}}</div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">{{ session('error')}}</div>
        @endif
        <nav class="navbar navbar-light">
            <form class="form-inline">
                <div class="input-group">
                    <input style="background-color: #f0f0f0; margin-bottom: 8px;" type="text" class="form-control" placeholder="Search" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </form>
            <p>
                <a class="btn-tamb" href="{{ route('siswa.create')}}">+ New Siswa</a>
            </p>
        </nav>
    </div>
    <table class="table table-striped table-bordered" style="box-shadow: 0 2px 5px rgba(0, 0.5, 0, 0.6); border-radius: 10px; ">
        <thead style="background-color: #036A7F;">
            <tr>
                <th style="background-color: #036A7F; color: #fff; padding-top: 13px; padding-bottom: 13px; text-align: center;">NIS</th>
                <th style="background-color: #036A7F; color: #fff; padding: 13px; text-align: center;">Nama Siswa</th>
                <th style="background-color: #036A7F; color: #fff; padding: 13px; text-align: center;">Tanggal Lahir</th>
                <th style="background-color: #036A7F; color: #fff; padding: 13px; text-align: center;">Jenis Kelamin</th>
                <th style="background-color: #036A7F; color: #fff; padding: 13px; text-align: center;">Alamat</th>
                <th style="background-color: #036A7F; color: #fff; padding: 13px; text-align: center;">ID Jurusan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($siswa as $siswas)
                <tr>
                    <td style="text-align: center;">{{ $siswas['nis']}}</td>
                    <td style="text-align: center;">{{ $siswas['nama']}}</td>
                    <td style="text-align: center;">{{ $siswas['tgl_lahir']}}</td>
                    <td style="text-align: center;">{{ $siswas['jenkel']}}</td>
                    <td style="text-align: center;">{{ $siswas['alamat']}}</td>
                    <td style="text-align: center;">{{ $siswas['id_jurusan']}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4"></td>
                        Empty
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
    </div>
@endsection