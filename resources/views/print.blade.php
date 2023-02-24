<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/kta4.css') }}"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@800&display=swap" rel="stylesheet">
    {{-- cdn print js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <title>Print</title>
    <style>
        body{
    font-family: 'Roboto Slab', sans-serif;
}
table tr td{
    font-size: 5.6pt;
}
*{
    margin: 0;
    padding: 0;
}
.item{
    margin-top: 10px;
    padding:0 0 0 30px;
}
.item:first-child{
    padding-top:50px;
    margin-top:0;
}
.jarak{
    width: 100%;
    width: calc(100% / 3);
    height: 50px;
}
.garis{
    border-left: 1px dashed black;
    /* background-image: url("data:image/svg+xml,%3csvg width='100%25' height='100%25' xmlns='http://www.w3.org/2000/svg'%3e%3crect width='100%25' height='100%25' fill='none' stroke='black' stroke-width='4' stroke-dasharray='6%2c 14' stroke-dashoffset='0' stroke-linecap='square'/%3e%3c/svg%3e"); */
}
.lingkaran-kanan::before{
    content: '';
    height:1px;
    width: 100%;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: black;
}
.lingkaran-kanan::after{
    content: '';
    height:100%;
    width: 1px;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    background-color: black;
}
.lingkaran-kiri::before{
    content: '';
    height:1px;
    width: 100%;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: black;
}
.lingkaran-kiri::after{
    content: '';
    height:100%;
    width: 1px;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    background-color: black;
}
.lingkaran-kanan{
    border: 1px solid black;
    height:3.4mm;
    width:3.4mm;
    border-radius:100%;
    position: absolute;
    bottom:5.93mm;
    right:0;
}
.lingkaran-kiri{
    border: 1px solid black;
    height:3.4mm;
    width:3.4mm;
    border-radius:100%;
    position: absolute;
    bottom:5.93mm;
    left:0;
}
.no-print{
    display: none;
}
@media print {
    @page {
        margin: 0 0;
    }
    *{
        margin: 0;
        padding: 0;
        color: white;
    }
    .pagebreak { page-break-before: always; }
}
    </style>
</head>
<body>
    <div class="container">
        <div class="box">
            <img>
        </div>
        <div class="box">
            <img>
        </div>
        <div class="box">
            <img>
        </div>
    </div>
    <div class="container-fluid" id="print">
        <div class="pagebreak"></div>
            <div class="jarak"></div>
        @php
            $i  = 0;
        @endphp
        @foreach ($carts as $cart)
        <div class="item" style="position: relative; left:-23px;">
            <div style="height:58mm;width:7.7mm;display:inline-block;margin:0;padding:0;background-color:white;position: relative;">
                <img style="width:8.9cm;opacity:0;" src="{{ asset('berkas/kta/'. $cart->kta->depan) }}" class="img-kta">
                {{-- <img style="width:8.9cm;opacity:0;" src="{{ asset('berkas/kta/ex-depan.png') }}" class="img-kta"> --}}
                <div class="lingkaran-kanan"></div>
            </div>
            <div style="height:58mm;width:8.9cm;display:inline-block;margin:0;padding:0;position: relative;">
                {{-- <img style="width:8.9cm" src="{{ asset('berkas/kta/ex-depan.png') }}" class="img-kta"> --}}
                <img style="width:8.9cm" src="{{ asset('berkas/kta/'.$cart->kta->depan) }}" class="img-kta">
                <div style="height:108px;position: absolute;top:71px;left:30px;">
                    <img  style="position: absolute;top:0; width:55px; height:62px;" src="{{ asset('berkas/anggota/'. $cart->anggota->foto) }}" id="pasfoto-kta" class="img rounded">
                    <img  style="position: absolute;bottom:-10px; width:55px; height:55px;" src="data:image/png;base64,{{DNS2D::getBarcodePNG($cart->anggota->nik, 'QRCODE')}}" class="img">
                </div>
                <p style="font-size: 5pt; position: absolute !important; top:200px !important; left:28px !important; color:white;">Masa berlaku s/d {{ date('Y') + 3 }}</p>
                <table style="position: absolute;top:65px;left:100px; color:white;font-size: 0.6rem;width:70%;"id="data-kta" cellspacing="0" cellpadding="0">
                    <tr >
                        <td width="50px">NTA</td>
                        <td style="font-weight: 900 !important; font-size:.51rem !important">{{ $cart->anggota->kode }}</td>
                    </tr>
                    <tr>
                        <td >Nama</td>
                        <td> {{ $cart->anggota->nama }}</td>
                    </tr>
                    <tr >
                        <td>TTL</td>
                        <td> {{ ucwords(strtolower($cart->anggota->tempat_lahir)) }}, {{ date('d F Y', strtotime($cart->anggota->tgl_lahir)) }}</td>
                    </tr>
                    <tr >
                        <td>Alamat</td>
                        <td> {{ ucwords(strtolower($cart->anggota->alamat)) }}</td>
                    </tr>
                    <tr>
                        <td>Agama</td>
                        <td> {{ ucwords(strtolower($cart->anggota->agama)) }}</td>
                    </tr>
                    <tr >
                        <td>Golongan</td>
                        <td> {{ ucwords(strtolower($cart->pramuka->name)) }} <span style="margin-left: 20px;">Gol.Darah: {{ $cart->anggota->gol_darah }}</span></td>
                    </tr>
                    @if ($cart->anggota->gudep != null)
                        <tr >
                            <td>Pangkalan</td>
                            <td> {{ strtoupper($cart->anggota->gudepInfo->nama_sekolah) }}</td>
                        </tr>
                    @endif
                    <tr >
                        <td>Kwaran</td>
                        <td> {{ ucwords(strtolower($cart->anggota->district->name)) }}</td>
                    </tr>
                    <tr >
                        <td>Kwarcab</td>
                        <td> {{ ucwords(strtolower($cart->anggota->city->name)) }}</td>
                    </tr>
                </table>
            </div>
            <div style="height:58mm;width:8mm;display:inline-block;margin:0;padding:0;background-color:white;position: relative;">
                {{-- <img style="width:8.9cm;opacity:0;" src="{{ asset('berkas/kta/ex-belakang.png') }}" class="img-kta"> --}}
                <img style="width:8.9cm;opacity:0;" src="{{ asset('berkas/kta/'.$cart->kta->belakang) }}" class="img-kta">
                <div class="lingkaran-kiri"></div>
                <div class="garis" style="height:100%;position: absolute;bottom:0;right:3.9mm;top:0"></div>
                <div class="lingkaran-kanan"></div>
                <div class="lingkaran-kiri" style="position: relative; left:10cm; top:-35px"></div>
            </div>
            <div style="height:58mm;width:8.9cm;display:inline-block;margin:0;padding:0;">
                {{-- <img style="width:8.9cm" src="{{ asset('berkas/kta/ex-belakang.png') }}" class="img-kta"> --}}
                <img style="width:8.9cm" src="{{ asset('berkas/kta/'.$cart->kta->belakang) }}" class="img-kta">
            </div>
            {{-- <div style="height:58mm;width:7.7mm;display:inline-block;margin:0;padding:0;background-color:white;position: relative;">
                <img style="width:8.9cm;visibility:hidden" src="{{ asset('berkas/kta/'.$cart->kta->belakang) }}" class="img-kta">
                <div class="lingkaran-kiri"></div>
            </div> --}}
        </div>
        @php
            $i++;
        @endphp
        @if ($i%4==0)
            <div class="pagebreak"></div>
            <div class="jarak"></div>
        @endif
        @endforeach
    </div>
    {{-- cdn printjs --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // window.print();
    </script>
</body>
</html>
