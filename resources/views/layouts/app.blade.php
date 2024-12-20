<!-- bisa dikatakan sebagai tempat kerangka tampilandari sebuah website -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKENSA UNPATI - Official Website</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
</head>
<body>
    <div id="app">
        <div class="main-wrapper">
            <!-- untuk memanggil bagian header -->
            @include('shared.header')

            <div class="main-content">
            <!-- akan memanggil bagian section content yang akan berubah
            sesuai yang akan ditampilkan -->
                @yield('content')
            </div>
            <!-- memanggil bagian footer -->
            @include('shared.footer')
        </div>
    </div>
</body>
</html>