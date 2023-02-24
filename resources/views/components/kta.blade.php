<style>
    .item{
        margin-top: 10px;
        padding:0 50px 0 60px;
    }
    .item:first-child{
        padding-top:50px;
        margin-top:0;
    }
    tr td{
        font-size: .5rem;
        vertical-align: top;
    }
    table#data-kta tr{
        position: relative;
    }
    .watermark{
        width: inherit;
        height: inherit;
        position: absolute;
        left: 0;
        opacity: 0.5;
    }
    .watermark1{
        position: absolute;
        bottom:0;
        width:100%;
        height:40px;
        border-bottom-left-radius: 16px;
        border-bottom-right-radius: 16px;
        cursor: pointer;
    }
    table tr{
        line-height: 8px;
    }
</style>

@php
    $bln = [
        'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
    ];

    $bulan = (int)date('n', strtotime($anggota->tgl_lahir)) - 1;
    $tgl_lahir = date('d', strtotime($anggota->tgl_lahir)).' '.$bln[$bulan].' '.date('Y', strtotime($anggota->tgl_lahir));
@endphp
<div class="item">
    <div style="height:53.98mm;width:85.60mm;display:inline-block;margin-right:20px;position: relative; margin-top:10px">
        {{-- <img style="width:85.60mm" src="{{ asset('berkas/kta/depan.png') }}" class="img-kta"> --}}
        <img style="width:85.60mm" src="{{ asset('berkas/kta/'. $anggota->kta->depan) }}" class="img-kta">
        <img src="{{ asset('images/logosiap.png') }}" class="watermark">
        <div style="height:108px;position: absolute;top:65px;left:28px;">
            <img  style="position: absolute;top:0; width:55px; height:62px;" src="{{ asset('berkas/anggota/'.$anggota->foto) }}" id="pasfoto-kta" class="img rounded">
            <img  style="position: absolute;bottom:-10px; width:55px; height:55px;" src="data:image/png;base64,{{DNS2D::getBarcodePNG(route('social.userFeed',$anggota->id), 'QRCODE')}}" class="img">
        </div>
        <p style="font-size: 5.3pt; position: absolute !important; top:193px !important; left:20px !important; color:white;">Masa berlaku s/d {{ date('Y') + 3 }}</p>
        <table style="position: absolute;top:65px;left:100px; color:white;font-size: 0.6rem;width:60%; opacity:0.9; z-index:99999"id="data-kta" cellspacing="0" cellpadding="0">
            <tr>
                <td>NTA</td>
                <td> <b>{{ $anggota->kode }}</b></td>
            </tr>
            <tr>
                <td >Nama</td>
                <td> {{ $anggota->nama }}</td>
            </tr>
            <tr>
                <td>TTL</td>
                <td> {{ ucwords(strtolower($anggota->tempat_lahir)) }}, {{ $tgl_lahir }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td> {{ Str::words(ucwords(strtolower($anggota->alamat)), 20,'') }}</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td> {{ ucwords(strtolower($anggota->agama)) }}</td>
            </tr>
            <tr>
                <td>Golongan</td>
                <td> {{ ucwords(strtolower($anggota->golongan->name)) }} <span style="position: relative; left:20px">Gol.Darah: {{ $anggota->gol_darah }}</span></td>
            </tr>
            @if ($anggota->gudep != null)
                <tr>
                    <td>Pangkalan</td>
                    <td> {{ strtoupper(strtolower($anggota->gudepInfo->nama_sekolah)) }}</td>
                </tr>
                <tr>
                    <td>Kwaran</td>
                    <td> {{ ucwords(strtolower($anggota->district->name)) }}</td>
                </tr>
                <tr>
                    <td>Kwarcab</td>
                    <td> {{ ucwords(strtolower($anggota->city->name)) }}</td>
                </tr>
            @else
                <tr>
                    <td>Kwaran</td>
                    <td> {{ ucwords(strtolower($anggota->district->name)) }}</td>
                </tr>
                <tr>
                    <td>Kwarcab</td>
                    <td> {{ ucwords(strtolower($anggota->city->name)) }}</td>
                </tr>
            @endif
        </table>
        @if ($anggota->cetak)
            @if ($anggota->cetak->transactionDetail->payment_status > 3 )
                <div class="watermark1 text-center bg-success text-white" id="add-tocart">
                    <span class="text-white" style="top:7px; position:relative"><b>PESAN KTA</b></span>
                </div>
            @endif
        @else
        <div class="watermark1 text-center bg-success text-white" id="add-tocart">
            <span class="text-white" style="top:7px; position:relative"><b>PESAN KTA</b></span>
        </div>
        @endif
    </div>
    {{-- <div style="height:53.98mm;width:85.60mm;display:inline-block; margin-top:10px">
        <img style="width:85.60mm" src="{{ asset('berkas/kta/'. $anggota->kta->belakang) }}" class="img-kta">
    </div> --}}
</div>

@push('scripts')
<script>
    $('#add-tocart').click(function (e) {
        $.ajax({
            type: "POST",
            url: "{{ url('api/cart') }}",
            data: {
                user_id:@json(Auth::id()),
                anggota_id:@json($anggota->id)
            },
            success: function (response) {
                alert(response.message);
                location.reload();
            }
        });
    });
</script>
@endpush
