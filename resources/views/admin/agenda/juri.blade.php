@extends('layouts.admin')
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => '/'],
            ['name' => 'Agenda', 'url' => route('agenda.show',$lomba->kegiatan->agenda)],
            ['name' => 'Management Juri', 'url' => '#'],
        ]"

        :title="$lomba->kegiatan->nama_kegiatan"
        :description="'Management Juri'"
    />
</div>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-8 mt-2">
        <div class="card shadow p-3">
            <span>List Juri</span>
            <hr>
            <div class="table-responsive">
                <table class="table table-sm table-bordered" style="font-size: .7rem">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Kabupaten</th>
                            <th>Kecamatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($juri as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ asset('berkas/anggota/'.$item->anggota->foto) }}" style="width: 60px; height:60px"></td>
                                <td>{{ $item->anggota->nama }}</td>
                                <td>{{ $item->anggota->city->name }}</td>
                                <td>{{ $item->anggota->district->name }}</td>
                                <td>
                                    <form action="{{ route('agenda.juri.delete',$item) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger" style="font-size: .7rem" onclick="return confirm('are you sure?')">Drop</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak Ada Juri</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot id="load-data">
                        <tr>
                            <td colspan="6">
                                <a href="{{ route('lomba.juri',$lomba) }}" class="btn btn-sm btn-info w-100">Load Data</a>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4 mt-2">
        <div class="card shadow p-3">
            <span>Tambah Juri</span>
            <hr>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah Juri
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">List Anggota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="fw-bold" style="font-size: .7rem">*Syarat menjadi juri lomba adalah sudah cetak Kartu Tanda Anggota (KTA) dan merupakan Anggota Aktif</p>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered file-export" style="width: 100%; font-size:.8rem">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>NIK</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-sm">Daftarkan Anggota</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('#load-data').hide();
        var table = $(".file-export").DataTable({
            processing: true,
            serverSide: true,
            scrollY: '500px',
            ajax: {
                url: '{!! route('datatable.lomba.juri') !!}',
                type: 'GET',
            },
            columns: [
                {data: 'foto', name: 'foto', searchable: false, orderable: false},
                {data: 'nik', name: 'tb_anggota.nik'},
                {data: 'nama', name: 'tb_anggota.nama'},
                {data: 'email', name: 'tb_anggota.email', visible:false},
                {data: 'action', name: 'action', searchable: false, orderable: false},
            ],
        });

        function addJuri(id){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: "{{ route('lomba.juri.add') }}",
                data: {
                    lomba_id : @json($lomba->id),
                    anggota_id: id,
                },
                success: function (response) {
                    table.ajax.reload();
                    $('#load-data').show();
                }
            });
        }
    </script>
@endsection


