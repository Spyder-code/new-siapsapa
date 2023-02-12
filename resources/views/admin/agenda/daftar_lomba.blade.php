@extends('layouts.admin')
@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => '/'],
            ['name' => 'Agenda', 'url' => route('agenda.show',$lomba->kegiatan->agenda_id)],
            ['name' => $lomba->kegiatan->nama_kegiatan, 'url' => '#'],
        ]"

        :title="'Peserta '.$lomba->kegiatan->nama_kegiatan"
        :description="'Daftar peserta'"
    />
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-12 col-md-8 mt-2">
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">List Peserta {{ $lomba->kegiatan->nama_kegiatan }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if ($lomba->kepesertaan=='kelompok')
                    <table class="table table-bordered" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama {{ ucfirst($lomba->kegiatan->agenda->tingkat) }}</th>
                                <th>Peserta</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peserta as $item)
                                @foreach ($item as $a)
                                <tr>
                                    @if ($loop->first)
                                    <td rowspan="{{ $item->count() }}">{{ $loop->iteration }}</td>
                                    <td rowspan="{{ $item->count() }}">
                                        @if ($lomba->kegiatan->agenda->tingkat=='provinsi')
                                            {{ $item->first()->anggota->province->name }}
                                        @elseif($lomba->kegiatan->agenda->tingkat=='kabupaten')
                                            {{ $item->first()->anggota->city->name }}
                                        @elseif($lomba->kegiatan->agenda->tingkat=='kecamatan')
                                            {{ $item->first()->anggota->district->name }}
                                        @elseif($lomba->kegiatan->agenda->tingkat=='gudep')
                                            {{ $item->first()->anggota->gudepInfo->nama_sekolah }}
                                        @endif
                                    </td>
                                    @endif
                                    <td>{{ $a->nodaf }} - {{ $a->anggota->nama }}</td>
                                    <td>
                                        @if (Auth::id()==$lomba->kegiatan->agenda->created_by)
                                            <form action="{{ route('lomba.daftar.destroy',$a) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <table class="table table-bordered table-striped file-export" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Foto</th>
                                <th>Nomor Daftar</th>
                                <th>Nama</th>
                                <th>Kwarda</th>
                                <th>Kwarcab</th>
                                <th>Kwaran</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peserta as $item)
                            @php
                                if($item->anggota->pramuka==1){
                                    $warna = '<span class="badge bg-siaga">Siaga</span>';
                                }elseif($item->anggota->pramuka==2){
                                    $warna = '<span class="badge bg-penggalang">Penggalang</span>';
                                }elseif($item->anggota->pramuka==3){
                                    $warna = '<span class="badge bg-penegak">Penegak</span>';
                                }elseif($item->anggota->pramuka==4){
                                    $warna = '<span class="badge bg-pandega">Pandega</span>';
                                }elseif($item->anggota->pramuka==5){
                                    $warna = '<span class="badge bg-dewasa">Dewasa</span>';
                                }else{
                                    $warna = '<span class="badge bg-white text-dark">Pelatih</span>';
                                }
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="justify-content-center text-center">
                                        <img src="{{ asset('berkas/anggota/'.$item->anggota->foto) }}" class="img-thumbnail mx-auto d-block" height="80px" width="80px">
                                        {!! $warna !!}
                                    </div>
                                </td>
                                <td>{{ $item->nodaf }}</td>
                                <td>{{ $item->anggota->nama }}</td>
                                <td>{{ $item->anggota->province->name }}</td>
                                <td>{{ $item->anggota->city->name }}</td>
                                <td>{{ $item->anggota->district->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-danger" onclick="deletePeserta({{ $item->id }})"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4 mt-2">
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">Daftarkan Peserta</h4>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Pilih Peserta
                </button>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="{{ route('lomba.daftar.store', $lomba) }}" method="post" class="modal-dialog modal-xl">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">List Peserta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="fw-bold" style="font-size: .7rem">*Syarat menjadi peserta lomba adalah sudah cetak Kartu Tanda Anggota (KTA) dan merupakan Anggota Aktif</p>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered file-export" style="width: 100%; font-size:.8rem">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Foto</th>
                                    <th>Nodaf</th>
                                    <th>Nama Lengkap</th>
                                    <th>Tanggal Lahir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($daftarPeserta as $item)
                                    <tr>
                                        <td><input type="checkbox" name="anggota_id[]" value="{{ $item->anggota_id }}"></td>
                                        <td><img src="{{ asset('berkas/anggota/'.$item->anggota->foto) }}" style="width: 60px; height:60px"></td>
                                        <td>{{ $item->nodaf }}</td>
                                        <td>{{ $item->anggota->nama }}</td>
                                        <td>{{ date('d/m/Y',strtotime($item->anggota->tgl_lahir)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Daftarkan Anggota</button>
                </div>
            </div>
        </form>
    </div>
    {{-- <div class="col-12 col-md-4 mt-2">
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">Daftarkan Peserta</h4>
            </div>
            <div class="card-body">
                <div class="alert alert-danger" id="message-danger">
                    <p id="message"></p>
                </div>
                <x-input :name="'nik'" :type="'text'" :id="'nik'" :label="'NIK atau Email'" :col="12" :attr="['required']"/>
                <div class="mb-3">
                    <button type="button" class="btn btn-success" id="daftar">Daftarkan</button>
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection

@section('script')
<script>
    $('#message-danger').hide();
    var table = $(".file-export").DataTable();
    function deletePeserta(id){
        if(confirm('are you sure?')){
            $.ajax({
                url: "{{ url('/api/delete-peserta') }}",
                type: "DELETE",
                data:{
                    id:id
                },
                success: function(data){
                    alert('Pendaftar berhasil dihapus');
                    location.reload();
                }
            });
        }
    }

    $('#daftar').click(function (e) {
        const lomba_id = @json($lomba->id);
        const nik = $('#nik').val();
        $.ajax({
            url: "{{ url('/api/add-peserta') }}",
            type: "POST",
            data:{
                lomba_id:lomba_id,
                nik:nik
            },
            success: function(data){
                var status = data.status;
                if(status==0){
                    $('#message-danger').show();
                    $('#message').html(data.message);
                }else{
                    alert('Anggota berhasil di daftarkan');
                    location.reload();
                }
            }
        });
    });
</script>
@endsection

