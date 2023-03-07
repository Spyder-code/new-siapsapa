<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@600&display=swap" rel="stylesheet">
    <style>
        .cover {
            height: 600px;
            width: 900px;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        .container{
            display: flex;
            justify-content: center
        }
        .name{
            text-align: center;
            margin-top: 280px;
            font-size: 30pt;
            font-family: 'Rajdhani', sans-serif;
        }
    </style>
</head>
<body>
    <div class="container mb-5">
        <div class="cover" style="background-image: url('{{ asset('berkas/agenda/sertifikat-lomba-'.$peserta->lomba_id.'.jpg') }}') ">
            {{-- <img class="cover" src="" alt="{{ $peserta->nodaf }}"> --}}
            <div class="name">{{ strtoupper($peserta->anggota->nama) }}</div>
        </div>
    </div>
</body>
</html>