<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@600&display=swap" rel="stylesheet">
    <style>
        * {
            -webkit-print-color-adjust: exact !important;
            color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
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
            justify-content: center;
        }
        .name{
            text-align: center;
            margin-top: 280px;
            font-size: 30pt;
            font-family: 'Rajdhani', sans-serif;
        }
        @media print {
            .pagebreak { page-break-before: always; }
            body {
                margin: 0;
                padding: 0;
            }
        }
        @page {
            size: 900px 600px;
            margin: 0px;
        }
    </style>
</head>
<body>
    @foreach ($data as $peserta)
        <div class="container mb-5">
            <div class="cover" style="background-image: url('{{ asset('berkas/agenda/sertifikat-lomba-'.$peserta->lomba_id.'.jpg') }}') ">
                {{-- <img class="cover" src="" alt="{{ $peserta->nodaf }}"> --}}
                <div class="name">{{ strtoupper($peserta->anggota->nama) }}</div>
            </div>
        </div>
        <div class="pagebreak"></div>
    @endforeach
    <script>
        window.print()
    </script>
</body>
</html>
