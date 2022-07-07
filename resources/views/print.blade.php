<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/kta4.css') }}">
    <title>Print</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap');
        body{
            font-family: 'Roboto Slab', sans-serif;
        }
        table tr td{
            font-size: 6.5pt;
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
    <div class="container-fluid">
        @php
            $i  = 0;
        @endphp
        @foreach ($carts as $cart)
        <div class="item">
            <div style="height:58mm;width:7.7mm;display:inline-block;margin:0;padding:0;background-color:white;position: relative;">
                <img style="width:91mm;opacity:0;" src="{{ asset('berkas/kta/'.$cart->kta->belakang) }}" class="img-kta">
                <div class="lingkaran-kanan"></div>
            </div>
            <div style="height:58mm;width:91mm;display:inline-block;margin:0;padding:0;position: relative;">
                <img style="width:91mm" src="{{ asset('berkas/kta/'.$cart->kta->depan) }}" class="img-kta">
                <div style="height:108px;position: absolute;top:74px;left:31.3px;">
                    <img  style="position: absolute;top:0; width:55px; height:62px;" src="{{ asset('berkas/anggota/'.$cart->anggota->foto) }}" id="pasfoto-kta" class="img rounded">
                    <img  style="position: absolute;bottom:-10px; width:55px; height:55px;" src="data:image/png;base64,{{DNS2D::getBarcodePNG($cart->anggota->nik, 'QRCODE')}}" class="img">
                </div>
                <p style="font-size: 5pt; position: absolute !important; top:205px !important; left:28px !important; color:white;">Masa berlaku s/d {{ date('Y') + 3 }}</p>
                <table style="position: absolute;top:65px;left:100px; color:white;font-size: 0.6rem;width:70%;"id="data-kta" cellspacing="0" cellpadding="0">
                    <tr >
                        <td width="50px">NTA</td>
                        <td><b> {{ $cart->anggota->kode }}</b></td>
                    </tr>
                    <tr>
                        <td >Nama</td>
                        <td> {{ ucwords(strtolower($cart->anggota->nama)) }}</td>
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
                <img style="width:91mm;opacity:0;" src="{{ asset('berkas/kta/'.$cart->kta->belakang) }}" class="img-kta">
                <div class="lingkaran-kiri"></div>
                <div class="garis" style="height:100%;position: absolute;bottom:0;right:3.9mm;top:0"></div>
                <div class="lingkaran-kanan"></div>
            </div>
            <div style="height:58mm;width:91mm;display:inline-block;margin:0;padding:0;">
                <img style="width:91mm" src="{{ asset('berkas/kta/'.$cart->kta->belakang) }}" class="img-kta">
            </div>
            <div style="height:58mm;width:7.7mm;display:inline-block;margin:0;padding:0;background-color:white;position: relative;">
                <img style="width:91mm;opacity:0;" src="{{ asset('berkas/kta/'.$cart->kta->belakang) }}" class="img-kta">
                <div class="lingkaran-kiri"></div>
            </div>
        </div>
        @php
            $i++;
        @endphp
        @if ($i%5==0)
            <div class="pagebreak"></div>
            <div class="jarak"></div>
        @endif
        @endforeach
    </div>
</body>
</html>
