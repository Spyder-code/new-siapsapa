@extends('layouts.admin')
@section('style')
    <style>
        .wrap{
            word-wrap: break-word;
            /* min-width: 160px; */
            max-width: 100%;
        }
    </style>
@endsection
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => '/'],
            ['name' => 'Anggota', 'url' => '#'],
            ['name' => 'Import Confirm', 'url' => '#'],
        ]"

        :title="'Import Anggota'"
        :description="'Form Import Anggota Dari Excel'"
    />
</div>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">Import Anggota</h4>
            </div>
            <form action="{{ route('anggota.store.array') }}" method="post" enctype="multipart/form-data" class="card-body needs-validation" novalidate>
                @csrf
                @method('POST')
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered table-striped file-export" style="width: 100%">
                        <thead>
                            <tr>
                                <th width="70">Foto</th>
                                <th width="220">NIK</th>
                                <th width="220">Nama</th>
                                <th width="180">Tgl Lahir</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $idx => $item)
                            <input type="hidden" name="foto[]" value="{{ $item->foto }}">
                            <input type="hidden" name="tempat_lahir[]" value="{{ $item->tempat_lahir }}">
                            <input type="hidden" name="email[]" value="{{ $item->email }}">
                            <input type="hidden" name="nohp[]" value="{{ $item->no_hp }}">
                            <input type="hidden" name="agama[]" value="{{ $item->agama }}">
                            <input type="hidden" name="jk[]" value="{{ $item->jk }}">
                            <input type="hidden" name="gol_darah[]" value="{{ $item->gol_darah }}">
                            <input type="hidden" name="keterangan[]" value="{{ $item->keterangan }}">
                            <tr>
                                <td>
                                    <img src="{{ asset('berkas/import/foto/'.$item->foto) }}" alt="{{ $item->nama }}" width="65" height="80">
                                </td>
                                <td>
                                    <input type="text" name="nik[]" class="form-control @error('nik.'.$idx) is-invalid @enderror" value="{{ $item->nik }}" />
                                </td>
                                <td>
                                    <textarea name="nama[]" class="form-control @error('nama.'.$idx) is-invalid @enderror">{{ $item->nama }}</textarea>
                                </td>
                                <td>
                                    <input type="text" name="tgl_lahir[]" class="form-control @error('tgl_lahir.'.$idx) is-invalid @enderror" value="{{ $item->tgl_lahir }}" />
                                </td>
                                <td class="wrap">
                                    <textarea name="alamat[]" class="form-control @error('alamat.'.$idx) is-invalid @enderror">{{ $item->alamat }}</textarea>
                                </td>
                            </tr>
                            @endforeach
                    </table>
                </div>
                <div class="mb-3 btn-group" id="confirm">
                    <a href="{{ route('anggota.import') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-outline-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

