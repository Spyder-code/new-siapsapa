@extends('layouts.admin')
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => 'da'],
            ['name' => 'Fungsionaris Organisasi', 'url' => '#']
        ]"

        :title="$kwartir.' '.ucfirst(strtolower($title))"
        :description="'Data Fungsionaris '.strtolower($kwartir).' '. ucfirst($title)"
    />
    <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
        <ul class="list-group list-group-horizontal">
            <li class="list-group-item">Total Anggota: <strong id="total-anggota">-</strong></li>
            <li class="list-group-item">Total Admin: <strong id="total-admin">-</strong></li>
            @if($id_wilayah!='all')
                <li class="list-group-item">
                    <a href="{{ route('kwartir.anggota',$id_wilayah) }}" style="font-size: .8rem" class="btn btn-sm btn-outline-success">
                        <i class="fa fa-plus-circle"></i> Tambah admin
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
@endsection
@section('content')
@php
    $len = strlen($id_wilayah);
@endphp
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">Struktur Fungsionaris</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped file-export" style="width: 100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fungsionaris</th>
                                <th>Nama Anggota</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($anggota as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->organization->name }}</td>
                                    <td>{{ $item->anggota->nama }}</td>
                                    <td>
                                        <form action="{{ route('organization_user.destroy', $item) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('are you sure?')">Hapus</button>
                                        </form>
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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">List Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ol class="list-group list-group-numbered" id="list-admin"></ol>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        var table = $(".file-export").DataTable();
    </script>
@endsection
