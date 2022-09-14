@extends('layouts.newuser')
@section('content')
    <section class="hero-banner">
        <div class="container text-center">
            <h1 class="text-white">{{ $agenda->nama }}</h1>
            <h3>{{ $agenda->jenis }}</h3>
        </div>
    </section>
    <section class="why-choose-us mb-5">
        <div class="container mt-2">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <div class="cards">
                        <div class="card-bodys">
                            <div class="d-flex mb-3 justify-content-between">
                                <div>
                                    <h3 class="card-title">{{ $agenda->nama }}</h3>
                                    <h6 class="card-subtitle">{{ $agenda->jenis }}</h6>
                                </div>
                                <a href="{{ route('page.agenda.peserta',$agenda) }}" class=""><u>Daftar Peserta</u></a>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="white-box text-center">
                                        <img src="{{ asset('berkas/agenda/'.$agenda->foto) }}" class="img-fluid" />
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-6">
                                    <h4 class="box-title mt-5">Deskripsi Agenda</h4>
                                    <p>{{ $agenda->deskripsi }}</p>
                                    <h3 class="box-title mt-5">Keterangan Lain</h3>
                                    <ul class="list-group list-group-flush ps-0">
                                        <li class=" list-group-item border-bottom-0 py-1 px-0 text-muted">
                                            <i data-feather="check-circle" class="text-primary feather-sm me-2"></i>
                                            Tanggal Mulai: {{ date('d/m/Y', strtotime($agenda->tanggal_mulai)) }}
                                        </li>
                                        <li class=" list-group-item border-bottom-0 py-1 px-0 text-muted">
                                            <i data-feather="check-circle" class="text-primary feather-sm me-2"></i>
                                            Tanggal Selesai: {{ date('d/m/Y', strtotime($agenda->tanggal_selesai)) }}
                                        </li>
                                        <li class=" list-group-item border-bottom-0 py-1 px-0 text-muted">
                                            <i data-feather="check-circle" class="text-primary feather-sm me-2"></i>
                                            Alamat: {{ $agenda->alamat }}
                                        </li>
                                        <li class=" list-group-item border-bottom-0 py-1 px-0 text-muted">
                                            <i data-feather="check-circle" class="text-primary feather-sm me-2"></i>
                                            Wilayah: {{ Str::lower($agenda->kecamatan->name) }}, {{ Str::lower($agenda->kabupaten->name) }}, Provinsi {{ Str::lower($agenda->provinsi->name) }}
                                        </li>
                                        <li class=" list-group-item border-bottom-0 py-1 px-0 text-muted">
                                            <i data-feather="check-circle" class="text-primary feather-sm me-2"></i>
                                            Kategori: {{ $agenda->kategori }}
                                        </li>
                                        <li class=" list-group-item border-bottom-0 py-1 px-0 text-muted">
                                            <i data-feather="check-circle" class="text-primary feather-sm me-2"></i>
                                            Kepesertaan: {{ $agenda->kepesertaan }}
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <h3 class="box-title mt-5">Detail Kegiatan</h3>
                                    <div class="table-responsive">
                                        <table class="table" id="kegiatan">
                                            <tbody>
                                                {{-- @if (Auth::user()->role == 'admin' || Auth::id()==$agenda->created_by)
                                                <tr>
                                                    <td width="290">
                                                        <input type="text" name="jam" id="jam" class="form-control" placeholder="jam kegiatan" required>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="nama_kegiatan" id="nama_kegiatan" placeholder="nama kegiatan" class="form-control" required>
                                                    </td>
                                                    <td>
                                                        <button type="button" onclick="addKegiatan()" class="btn btn-success btn-sm">Tambah</button>
                                                    </td>
                                                </tr>
                                                @endif --}}
                                                @forelse ($kegiatan as $item)
                                                <tr data-id="{{ $item->id }}">
                                                    <td width="390">{{ date('H:i', strtotime( $item->jam)) }}</td>
                                                    <td>{{ $item->nama_kegiatan }}</td>
                                                    @if (Auth::user()->role == 'admin' || Auth::id()==$agenda->created_by)
                                                    <td class="btn-group">
                                                        <button type="button" onclick="editKegiatan({{ $item->id }},'{{ $item->jam }}','{{ $item->nama_kegiatan }}')" class="btn btn-primary btn-sm">Edit</button>
                                                        <button type="button" onclick="deleteKegiatan({{ $item->id }})" class="btn btn-danger btn-sm">Hapus</button>
                                                    </td>
                                                    @endif
                                                </tr>
                                                @empty
                                                <tr id="empty">
                                                    <td colspan="@if (Auth::user()->role == 'admin' || Auth::id()==$agenda->created_by) 3 @else 2 @endif">Tidak ada data</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
