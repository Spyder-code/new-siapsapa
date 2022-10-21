@extends('layouts.admin')
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => '/'],
            ['name' => 'Gudep', 'url' => '#'],
            ['name' => 'Transfer', 'url' => '#'],
        ]"

        :title="'Transfer Anggota di '. $gudep->nama_sekolah"
        :description="'Anggota Transfer'"
    />
</div>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-4 mt-2">
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">Form Tarik Anggota</h4>
            </div>
            <form action="{{ route('gudep.transfer.store') }}" method="post" class="card-body needs-validation" novalidate>
                <div class="alert alert-warning" id="info-search-false">Anggota dengan NIK "<span id="nik-info"></span>" tidak ditemukan</div>
                @csrf
                @method('PUT')
                <input type="hidden" name="from_gudep" value="{{ $gudep->id }}">
                <div class="row">
                    <x-input :type="'text'" :name="'nik'" :label="'NIK Anggota'" :attr="['required']"/>
                    {{-- <x-input :type="'text'" :name="'search'" :label="'Cari Gudep'" :attr="[]"/>
                    <x-input :type="'select'" :options="[]" :name="'gudep_id'" :label="'Pilih Gudep Tujuan'" :attr="['required']"/> --}}
                </div>
                <div id="info-search-true" class="my-2">
                </div>
                <div class="mb-3 btn-group">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Kembali</a>
                    <button type="submit" onclick="return confirm('apa anda yakin?')" class="btn btn-outline-primary">Tarik Anggota</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-sm-8 mt-2">
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">List Transfer Anggota ke Gudep Lain</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Anggota</th>
                                <th>Sekolah Awal</th>
                                <th>Sekolah Tujuan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transferFrom as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->anggota->nama }}</td>
                                    <td>{{ $item->gudepFrom->nama_sekolah }}</td>
                                    <td>{{ $item->gudepTo->nama_sekolah }}</td>
                                    @if ($item->status==0)
                                        <td class="bg-warning"><span class="text-white" style="font-size: .9rem">Menunggu persetujuan dari gudep tujuan</span></td>
                                    @elseif($item->status==1)
                                        <td class="bg-success"><span class="text-white" style="font-size: .9rem">Permintaan disetujui</span></td>
                                    @elseif($item->status==2)
                                        <td class="bg-danger"><span class="text-white" style="font-size: .9rem">Permintaan ditolak</span></td>
                                    @endif
                                    <td>
                                        @if ($item->status==0)
                                        <form action="{{ route('transfer.anggota.cancel', $item) }}" method="post">
                                            @csrf
                                            <button onclick="return confirm('apa anda yakin?')" class="btn btn-sm btn-danger rounded" type="submit">Cancel</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">List Permintaan Masuk Transfer Anggota</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Anggota</th>
                                <th>Sekolah Awal</th>
                                <th>Sekolah Tujuan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transferTo as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->anggota->nama }}</td>
                                    <td>{{ $item->gudepFrom->nama_sekolah }}</td>
                                    <td>{{ $item->gudepTo->nama_sekolah }}</td>
                                    @if ($item->status==0)
                                        <td class="bg-warning"><span class="text-white" style="font-size: .9rem">Menunggu persetujuan</span></td>
                                    @elseif($item->status==1)
                                        <td class="bg-success"><span class="text-white" style="font-size: .9rem">Permintaan disetujui</span></td>
                                    @elseif($item->status==2)
                                        <td class="bg-danger"><span class="text-white" style="font-size: .9rem">Permintaan ditolak</span></td>
                                    @endif
                                    <td>
                                        @if ($item->status==0)
                                        <form action="{{ route('transfer.anggota.approve', $item) }}" method="POST">
                                            @csrf
                                            <button onclick="return confirm('apa anda yakin?')" class="btn btn-sm btn-success rounded" type="submit">Setujui</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $("select").select2({
        theme: "bootstrap-5",
    });

    $('#info-search-false').hide();
    $('#info-search-true').hide();

    var timeout;
    var delay = 1000;

    function search (val) {
        if(timeout) {
            clearTimeout(timeout);
        }
        timeout = setTimeout(function() {
            searchNIK(val);
        }, delay);
    }

    function searchNIK(val) {
        $.ajax({
            type: "POST",
            url: "{{ url('api/anggota/search') }}",
            data: {
                nik:val,
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                console.log(response);
                if(response.status==404){
                    $('#nik-info').html(val);
                    $('#info-search-false').show();
                    $('#info-search-true').hide();
                }else{
                    let status;
                    if(response.data.status==0){
                        status = 'anggota tidak aktif';
                    }
                    if(response.data.status==1){
                        status = 'anggota aktif';
                    }
                    var html = `<ul class="list-group">
                        <li class="list-group-item">
                            <img src="${response.data.foto}" class="img-fluid" style="max-height: 80px">
                        </li>
                        <li class="list-group-item">NIK: ${response.data.nik}</li>
                        <li class="list-group-item">Nama: ${response.data.nama}</li>
                        <li class="list-group-item">Email: ${response.data.email}</li>
                        <li class="list-group-item">Gudep: ${response.data.gudep}</li>
                        <li class="list-group-item">Status: ${status}</li>
                    </ul>`;
                    $('#info-search-false').hide();
                    $('#info-search-true').show();
                    $('#info-search-true').html(html);
                }
            }
        });
    }

    $('#nik').keyup(function (e) {
        var val = $(this).val();
        search(val);
    });
</script>
@endsection

