<!DOCTYPE html>
<html lang="en">
<head>
    <title>Print</title>
    <link rel="stylesheet" href="{{ asset('css/print.css') }}?time={{ time() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
</head>
<body>
    <div id="print">
        @foreach ($data as $card)
        <page size="A4">
            <div class="container">
                @foreach ($card as $item)
                {{-- <div class="card" style="background-image: url('{{ asset('berkas/kta/no-depan.png') }}'); background-size: cover; background-position: center;"> --}}
                <div class="card" style="background-image: url('{{ asset('berkas/kta/'.$item->kta->depan) }}'); background-size: cover; background-position: center;">
                    <div class="circle-left"></div>
                    <div class="circle-right"></div>
                    <div class="img-left">
                        <img src="{{ asset('berkas/anggota/'. $item->anggota->foto) }}"  alt="foto" class="foto">
                        {{-- <img src="{{ asset('berkas/kta/foto.jpg') }}"  alt="foto" class="foto"> --}}
                        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG(route('social.userFeed',$item->anggota->id), 'QRCODE')}}"alt="QRCODE" class="qr">
                    </div>
                    <span class="exp">Masa Berlaku s/d {{ date('Y') + 3 }}</span>
                    <table cellspacing="1" cellpadding="0">
                        <tr>
                            <td width="50px">NTA</td>
                            <td style="font-weight: 900;">{{ $item->anggota->kode }}</td>
                        </tr>
                        <tr>
                            <td >Nama</td>
                            <td> {{  $item->anggota->nama  }}</td>
                        </tr>
                        <tr >
                            <td>TTL</td>
                            <td> {{ ucwords(strtolower($item->anggota->tempat_lahir)) }}, {{ date('d F Y', strtotime($item->anggota->tgl_lahir)) }}</td>
                        </tr>
                        <tr >
                            <td>Alamat</td>
                            <td> {{  ucwords(strtolower($item->anggota->alamat))  }}</td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td> {{  ucwords(strtolower($item->anggota->agama))  }}</td>
                        </tr>
                        @if (is_null($item->anggota->tingkat))
                        <tr >
                            <td>Golongan</td>
                            <td> {{  ucwords(strtolower($item->pramuka->name))  }} <span style="margin-left: 20px;">Gol.Darah: {{ $item->anggota->gol_darah }}</span></td>
                        </tr>
                        @else
                        <tr >
                            <td>Golongan</td>
                            <td> {{  ucwords(strtolower($item->anggota->document_type->pramuka->name))  }} <span style="margin-left: 20px;">Gol.Darah: {{ $item->anggota->gol_darah }}</span></td>
                        </tr>
                        @endif
                        @if ($item->anggota->gudep != null)
                            <tr >
                                <td>Pangkalan</td>
                                <td> {{ strtoupper($item->anggota->gudepInfo->nama_sekolah) }}</td>
                            </tr>
                        @endif
                        <tr >
                            <td>Kwaran</td>
                            <td> {{ ucwords(strtolower($item->anggota->district->name)) }}</td>
                        </tr>
                        <tr >
                            <td>Kwarcab</td>
                            <td> {{ ucwords(strtolower($item->anggota->city->name)) }}</td>
                        </tr>
                    </table>
                </div>
                <div class="card" style="background-image: url('{{ asset('berkas/kta/'.$item->kta->belakang) }}'); background-size: cover; background-position: center;">
                    <div class="circle-left"></div>
                    <div class="circle-right"></div>
                </div>
                @endforeach
            </div>
        </page>
        @endforeach
    </div>
    <div id="tools">
        <div class="tool">
            <div class="tool-icon">
                <img onclick="window.print()" src="https://iconarchive.com/download/i66379/iconshow/hardware/Printer.ico" alt="print" style="height: 100px; width:100px">
            </div>
        </div>
    </div>
</body>
</html>
