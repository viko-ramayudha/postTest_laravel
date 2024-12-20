



@extends('layouts.app')

<!-- @section('content') menandakan tampilan dari section 
jurusans tersebut, dalam hal ini adalah menampilkan daftar produk dalam bentuk tabel -->

@section('content')
<head>
    <style>
        .cont {
            
            max-width: 780px;
            margin: 10px auto;
            margin-top: -270px;
            padding-top: 0px;
            padding-bottom: 30px;
            padding-left: 0px;
            padding-right: 0px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.8);
            opacity: 0.9;
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

        h2 {
            text-align: center;
            margin-top: 0px;
            padding: 20px;
            /* color: #9564da; */
            color: #fff;
            background-color:  #036A7F;
            border-radius: 15px;
        }


        form {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 10px;
        }

        label {
            display: block;
            width: 100%;
            margin-top: 10px;
            margin-bottom: 7px;
            margin-left: 0px;
            font-size: 15px;
            color: #000;
            font-weight: 500;
        }

        .inp {
            width: 630px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            color: #5a5a5a;
        }

        input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus {
            outline: none;
            box-shadow: 0 0 3px #5a5a5a;
        }
        .tmbh {
            width: 100%;
            padding: 10px;
            background-color: #036A7F;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
            margin-bottom: 15px;
            /* margin-left: 180px; */
            font-weight: bold;
        }

        .tmbh:hover {
            background-color: transparent;
            border-color: #036A7F;
            color: #036A7F;
            border: 1px solid #036A7F;
            padding: 9px;
        }

        .back {
            margin-top: 20px;
            width: 100%;
            padding: 9px 20px;
            background-color: transparent;
            border-color: #036A7F;
            color:#036A7F;
            border: 1px solid #036A7F;
            color: #036A7F;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-weight: bold;
            font-size: 15px;
            text-align: center;
        }
        .back:hover {
            background-color: #036A7F;
            border: none;
            color: #fff;
            border: 1px solid #036A7F;
            padding: 9px 20px;
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

    <script>
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    </script>
</head>
<div class="bck">
<div class="container" style="margin-top: 35px;">
        <div class="cont">
        <h2>Tambah Kejuruan Siswa</h2>
        <form method="POST" action="{{ route('jurusans.store') }}">  @csrf
        <p><span class="error-message text-danger fw-600">@error('price') {{ $message }} @enderror</span></p>&nbsp;
        <p><span class="error-message text-danger fw-600">@error('stock') {{ $message }} @enderror</span></p>&nbsp;
        <p><span class="error-message text-danger fw-600">@error('name') {{ $message }} @enderror</span></p>
            <table border="0">
                <tr>
                    <td><label for="nim">Kode Jurusan</label></td>
                </tr>
                <tr>
                    <td><input class="inp" type="text" id="kode" name="kd_jurusan" placeholder="Kode Jurusan"  required></td>
                    <span id="nim-error" class="error-message"></span>
                </tr>
                <tr>
                    <td><label>Nama Jurusan</label></td>
                </tr>
                <tr>
                    <td><input class="inp" type="text" id="name" name="jurusan" placeholder="Nama Jurusan" required></td>
                </tr>
                <tr>
                    <td><label>Kakomli</label></td>
                </tr>
                <tr>
                    <!-- <td>Prodi</td> -->
                    <td><input class="inp" type="text" name="kakomli" placeholder="Kakomli" required></td>
                </tr>
                
                <td>
                    <a href="./"><input type="button" class="back" Value="Cancel"></a>
                    <input class="tmbh" type="submit" value ="Save">
                </td>
            </table>
        </form>
    </div>
</div>
    </div>
@endsection