@extends('layouts.admin')
@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => '/'],
            ['name' => 'Agenda', 'url' => route('agenda.index')],
            ['name' => 'Detail Agenda', 'url' => '#'],
        ]"

        :title="'Detail Agenda'"
        :description="'Detail Agenda Kegiatan'"
    />
</div>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">Detail Agenda</h4>
            </div>
            <div class="card-body">
                <h3 class="card-title">{{ $agenda->nama }}</h3>
                <h6 class="card-subtitle">{{ $agenda->jenis }}</h6>
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
                                Alamat: {{ $agenda->alamat ?? '-' }}
                            </li>
                            <li class=" list-group-item border-bottom-0 py-1 px-0 text-muted">
                                <i data-feather="check-circle" class="text-primary feather-sm me-2"></i>
                                @if ($agenda->jenis=='lomba')
                                Provinsi {{ Str::lower($agenda->provinsi->name) }}
                                @else
                                Wilayah: {{ Str::lower($agenda->kecamatan->name) }}, {{ Str::lower($agenda->kabupaten->name) }}, Provinsi {{ Str::lower($agenda->provinsi->name) }}
                                @endif
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
                            <table class="table w-100" id="kegiatan">
                                <tbody>
                                    {{-- @if (Auth::user()->role == 'admin' || Auth::id()==$agenda->created_by)
                                    <tr>
                                        <td width="240">
                                            <input type="text" name="jam" id="jam" class="form-control fs-2" placeholder="jam kegiatan" required>
                                        </td>
                                        <td width="350">
                                            <input type="text" name="nama_kegiatan" id="nama_kegiatan" placeholder="nama kegiatan" class="form-control fs-2" required>
                                        </td>
                                        <td>
                                            <button class="btn btn-warning btn-sm my-1 fs-1" type="button">Buat Kegiatan Lomba</button>
                                            <button type="button" onclick="addKegiatan()" class="btn btn-success btn-sm my-1 fs-1">Buat Kegiatan Non Lomba</button>
                                        </td>
                                    </tr>
                                    @endif --}}
                                    @forelse ($kegiatan as $idx => $keg)
                                        <tr>
                                            <td colspan="4" class="fw-bold">{{ date('d/m/Y', strtotime($idx)) }}</td>
                                        </tr>
                                        @foreach ($keg as $item)
                                        <tr data-id="{{ $item->id }}">
                                            <td width="200">{{ date('H:i', strtotime( $item->waktu_mulai)) }}</td>
                                            <td width="200">{{ date('H:i', strtotime( $item->waktu_selesai)) }}</td>
                                            <td>{{ $item->nama_kegiatan }}</td>
                                            <td>
                                                @if (Auth::user()->role == 'admin' || Auth::id()==$agenda->created_by)
                                                <div class="btn-group">
                                                    <button type="button" onclick="editKegiatan('{{ $item->lomba?'lomba':'non' }}',{{ $item->id }},'{{ $item->waktu_mulai }}','{{ $item->waktu_selesai }}','{{ $item->nama_kegiatan }}')" class="btn btn-primary btn-sm">Edit</button>
                                                    <button type="button" onclick="deleteKegiatan({{ $item->id }})" class="btn btn-danger btn-sm">Hapus</button>
                                                </div>
                                                @endif
                                                @if ($item->lomba)
                                                    <div class="btn-group">
                                                        @if (strtotime(date('Y-m-d'))<strtotime($item->waktu_selesai))
                                                            <a href="{{ route('lomba.daftar',$item->lomba) }}" class="btn btn-sm btn-success">Daftar</a>
                                                            @if (Auth::user()->role!='anggota')
                                                                @if ($item->lomba->penilaian=='vote')
                                                                    <a href="{{ route('lomba.file', $item->lomba) }}" class="btn btn-sm btn-outline-info w-100">Upload File <i class="fas fa-paper-plane"></i></a>
                                                                @endif
                                                                @if ($item->lomba->penilaian=='subjective' && Auth::id()==$item->agenda->created_by)
                                                                <a href="{{ route('lomba.juri', $item->lomba) }}" class="btn btn-sm btn-outline-warning w-100">Management Juri <i class="fas fa-check-circle"></i></a>
                                                                @endif
                                                            @endif
                                                            <a href="{{ route('lomba.nilai', $item->lomba) }}" class="btn btn-sm btn-outline-primary w-100">Penilaian <i class="fas fa-list-alt"></i></a>
                                                        @endif
                                                        <a href="{{ route('lomba.hasil', $item->lomba) }}" class="btn btn-sm btn-outline-success w-100">Hasil <i class="fas fa-trophy"></i></a>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    @empty
                                    <tr id="empty">
                                        <td colspan="@if (Auth::user()->role == 'admin' || Auth::id()==$agenda->created_by) 3 @else 2 @endif">Tidak ada data</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"><button type="button" data-bs-toggle="modal" data-bs-target="#nonLomba" class="btn btn-sm btn-outline-primary w-100">Tambah Kegiatan non Lomba</button></td>
                                        <td colspan="2"><button type="button" data-bs-toggle="modal" data-bs-target="#lomba" class="btn btn-sm btn-outline-success w-100">Tambah Kegiatan Lomba</button></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-kegiatan-non" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form class="modal-dialog" method="post" action="{{ route('kegiatan.updateRequest') }}">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <input type="hidden" name="id" id="n-id">
                <div class="mb-2 col-12">
                    <label for="waktu_mulai">Nama Kegiatan</label>
                    <input type="text" name="nama_kegiatan" id="n-nama_kegiatan" class="form-control" required>
                </div>
                <div class="mb-2 col-12 col-md-6">
                    <label for="waktu_mulai">Waktu Mulai</label>
                    <input type="text" name="waktu_mulai" id="n-waktu_mulai" class="form-control jam" required>
                </div>
                <div class="mb-2 col-12 col-md-6">
                    <label for="waktu_selesai">Waktu Selesai</label>
                    <input type="text" name="waktu_selesai" id="n-waktu_selesai" class="form-control jam" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>

{{-- Modal tmabah kegiatan non lomba --}}
<div class="modal fade" id="nonLomba" tabindex="-1" aria-labelledby="nonLombaLabel" aria-hidden="true">
    <form class="modal-dialog" action="{{ route('kegiatan.store') }}" method="POST">
        @csrf
        <input type="hidden" name="agenda_id" value="{{ $agenda->id }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nonLombaLabel">Tambah Kegiatan Non Lomba</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <div class="mb-2 col-12">
                    <label for="waktu_mulai">Nama Kegiatan</label>
                    <input type="text" name="nama_kegiatan" id="n-nama_kegiatan" class="form-control" required>
                </div>
                <div class="mb-2 col-12 col-md-6">
                    <label for="waktu_mulai">Waktu Mulai</label>
                    <input type="text" name="waktu_mulai" id="n-waktu_mulai" class="form-control jam" required>
                </div>
                <div class="mb-2 col-12 col-md-6">
                    <label for="waktu_selesai">Waktu Selesai</label>
                    <input type="text" name="waktu_selesai" id="n-waktu_selesai" class="form-control jam" required>
                </div>
                <div class="mb-2 col-12">
                    <label for="tempat">Tempat</label>
                    <textarea name="tempat" id="n-tempat" cols="2" rows="2" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>

{{-- Modal tambah lomba --}}
<div class="modal fade" id="lomba" tabindex="-1" aria-labelledby="lombaLabel" aria-hidden="true">
    <form class="modal-dialog modal-xl" action="{{ route('kegiatan.store') }}" method="POST">
        @csrf
        <input type="hidden" name="agenda_id" value="{{ $agenda->id }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lombaLabel">Tambah Kegiatan Lomba</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <div class="mb-2 col-12">
                    <label for="waktu_mulai">Nama Kegiatan</label>
                    <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" required>
                </div>
                <div class="mb-2 col-12 col-md-6">
                    <label for="waktu_mulai">Waktu Mulai</label>
                    <input type="text" name="waktu_mulai" id="waktu_mulai" class="form-control jam" required>
                </div>
                <div class="mb-2 col-12 col-md-6">
                    <label for="waktu_selesai">Waktu Selesai</label>
                    <input type="text" name="waktu_selesai" id="waktu_selesai" class="form-control jam" required>
                </div>
                <div class="mb-2 col-12 col-md-4">
                    <label for="kategori">Kategori</label>
                    <select name="lomba[kategori]" id="kategori" class="form-control">
                        <option value="putra">Putra</option>
                        <option value="putri">Putri</option>
                        <option value="campuran" selected>Campuran</option>
                    </select>
                </div>
                <div class="mb-2 col-12 col-md-4">
                    <label for="kepesertaan">Kategori</label>
                    <select name="lomba[kepesertaan]" id="kepesertaan" class="form-control">
                        <option value="perorangan">Peroragan</option>
                        <option value="kelompok" selected>Kelompok</option>
                    </select>
                </div>
                <div class="mb-2 col-12 col-md-4">
                    <label for="penilaian">Penilaian</label>
                    <select name="lomba[penilaian]" id="penilaian" class="form-control">
                        <option value="vote" selected>Pemungutan Suara</option>
                        <option value="subjective">Subjective</option>
                        <option value="objective">Objective</option>
                    </select>
                </div>
                <div class="mb-2 col-12">
                    <label for="tempat">Tempat</label>
                    <textarea name="tempat" id="tempat" cols="2" rows="2" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
        var jam = flatpickr('.jam',{
            enableTime: true,
            dateFormat: "Y-m-d H:i:s",
            altInput: true,
            altFormat: 'd/m/Y H:i',
            time_24hr: true,
            minDate: @json($agenda->tanggal_mulai),
            maxDate: @json($agenda->tanggal_selesai),
        });

        const addKegiatan = () =>{
            let jam = $('#jam').val();
            let nama_kegiatan = $('#nama_kegiatan').val();
            $.ajax({
                url: '{{ url("api/add-kegiatan") }}',
                type: 'POST',
                data: {
                    agenda_id: @json($agenda->id),
                    jam: jam,
                    nama_kegiatan: nama_kegiatan,
                },
                success: function(data){
                    // reload window
                    location.reload();
                }
            });
        }

        const deleteKegiatan = (id) =>{
            $.ajax({
                url: '{{ url("api/delete-kegiatan") }}',
                type: 'DELETE',
                data: {
                    id: id,
                },
                success: function(data){
                    var count = @json($kegiatan->count());
                    $('#kegiatan').find(`tr[data-id="${id}"]`).remove();
                }
            });
        }

        const editKegiatan = (type,id,waktu_mulai,waktu_selesai,nama_kegiatan) =>{
            if (type=='lomba') {
                $('#n-id').val(id);
                $('#n-waktu_mulai').val(waktu_mulai);
                $('#n-waktu_selesai').val(waktu_selesai);
                $('#n-nama_kegiatan').val(nama_kegiatan);
                $('#modal-edit-kegiatan-non').modal('show');
            } else {
                $('#n-id').val(id);
                $('#n-waktu_mulai').val(waktu_mulai);
                $('#n-waktu_selesai').val(waktu_selesai);
                $('#n-nama_kegiatan').val(nama_kegiatan);
                $('#modal-edit-kegiatan-non').modal('show');
            }

        }

        const updateKegiatan = () =>{
            let id = $('#id-edit').val();
            let jam = $('#jam-edit').val();
            let nama_kegiatan = $('#nama_kegiatan-edit').val();
            $.ajax({
                url: '{{ url("api/update-kegiatan") }}',
                type: 'PUT',
                data: {
                    id: id,
                    jam: jam,
                    nama_kegiatan: nama_kegiatan,
                },
                success: function(data){
                    // reload window
                    location.reload();
                }
            });
        }
</script>
@endsection
