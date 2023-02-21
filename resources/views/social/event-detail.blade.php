@extends('layouts.social')
@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('agenda.peserta',$agenda) }}">Daftar Agenda</a>
            </div>
            <div class="card-body">
                <h3 class="card-title">{{ $agenda->nama }}</h3>
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
                                Admin: {{ $agenda->owner->anggota->nama }}
                            </li>
                            <li class=" list-group-item border-bottom-0 py-1 px-0 text-muted">
                                <i data-feather="check-circle" class="text-primary feather-sm me-2"></i>
                                Kategori: {{ $agenda->kategori }}
                            </li>
                            <li class=" list-group-item border-bottom-0 py-1 px-0 text-muted">
                                <i data-feather="check-circle" class="text-primary feather-sm me-2"></i>
                                Kepesertaan: {{ $agenda->kepesertaan }}
                            </li>
                            <li class=" list-group-item border-bottom-0 py-1 px-0 text-muted">
                                <i data-feather="check-circle" class="text-primary feather-sm me-2"></i>
                                Tingkat: {{ $agenda->tingkat ?? '-' }}
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h3 class="box-title mt-5">Detail Kegiatan</h3>
                        <div class="table-responsive">
                            <table class="table w-100" id="kegiatan">
                                <tbody>
                                    @forelse ($kegiatan as $idx => $keg)
                                        <tr>
                                            <td colspan="4" class="fw-bold">{{ date('d/m/Y', strtotime($idx)) }}</td>
                                        </tr>
                                        @foreach ($keg as $item)
                                        <tr data-id="{{ $item->id }}">
                                            <td width="200">{{ date('H:i', strtotime( $item->waktu_mulai)) }}</td>
                                            <td width="200">
                                                @if (date('Y-m-d')==date('Y-m-d',strtotime($item->waktu_selesai)))
                                                {{ date('H:i', strtotime( $item->waktu_selesai)) }}
                                                @else
                                                {{ date('H:i (d/m/y)', strtotime( $item->waktu_selesai)) }}
                                                @endif
                                            </td>
                                            <td>{{ $item->nama_kegiatan }}</td>
                                            <td>
                                                <div class="btn-group">
                                                @if (Auth::user()->role == 'admin' || $agenda->panitia->where('anggota_id',Auth::user()->anggota->id)->first())
                                                    <button type="button" onclick="editKegiatan('{{ $item->lomba?'lomba':'non' }}',{{ $item->id }},'{{ $item->waktu_mulai }}','{{ $item->waktu_selesai }}','{{ $item->nama_kegiatan }}')" class="btn btn-primary btn-sm">Edit</button>
                                                    <button type="button" onclick="deleteKegiatan({{ $item->id }})" class="btn btn-danger btn-sm">Hapus</button>
                                                    @endif
                                                    @if ($item->lomba)
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-expanded="false">Lomba</button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            @if (strtotime(date('Y-m-d H:i'))<strtotime($item->waktu_selesai))
                                                                <li><a href="{{ route('lomba.daftar',$item->lomba) }}" class="dropdown-item text-info">Daftar <i class="fas fa-pencil-alt"></i></a></li>
                                                                @if (Auth::user()->role!='anggota')
                                                                    @if ($item->lomba->penilaian=='vote')
                                                                        <li><a href="{{ route('lomba.file', $item->lomba) }}" class="dropdown-item text-primary">Upload File <i class="fas fa-paper-plane"></i></a></li>
                                                                    @endif
                                                                    @if ($item->lomba->penilaian=='subjective' && $agenda->panitia->where('anggota_id',Auth::user()->anggota->id)->first())
                                                                    <li><a href="{{ route('lomba.juri', $item->lomba) }}" class="dropdown-item text-warning">Management Juri <i class="fas fa-check-circle"></i></a></li>
                                                                    @endif
                                                                    @if ($item->lomba->penilaian=='objective' && ($agenda->panitia->where('anggota_id',Auth::user()->anggota->id)->first()||Auth::user()->role == 'admin'))
                                                                    <li><a href="{{ route('lomba.stage', $item->lomba) }}" class="dropdown-item text-warning">Management Pertandingan <i class="fas fa-check-circle"></i></a></li>
                                                                    @endif
                                                                @endif
                                                                @if ($item->lomba->penilaian!='objective')
                                                                    <li><a href="{{ route('lomba.nilai', $item->lomba) }}" class="dropdown-item text-danger">Penilaian <i class="fas fa-list-alt"></i></a></li>
                                                                @endif
                                                            @endif
                                                            <li>
                                                                <a href="{{ route('lomba.hasil', $item->lomba) }}" class="dropdown-item text-success">Hasil <i class="fas fa-trophy"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @empty
                                    <tr id="empty">
                                        <td colspan="@if (Auth::user()->role == 'admin' || $agenda->panitia->where('anggota_id',Auth::user()->anggota->id)->first()) 3 @else 2 @endif">Tidak ada data</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    @if ($agenda->panitia->where('anggota_id',Auth::user()->anggota->id)->first())
                                    <tr>
                                        <td colspan="2"><button type="button" data-toggle="modal" data-target="#nonLomba" class="btn btn-sm btn-outline-primary w-100">Tambah Kegiatan non Lomba</button></td>
                                        <td colspan="2"><button type="button" data-toggle="modal" data-target="#lomba" class="btn btn-sm btn-outline-success w-100">Tambah Kegiatan Lomba</button></td>
                                    </tr>
                                    @endif
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
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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
                <div class="col-12 lomba">
                    <span>Keterangan Penilaian</span>
                    <p class="fs-1" id="ket-lomba">Perlombaan bersifat digital yang mana sesuatu yang dilombakan bersifat digital seperti upload foto/video dll.Penilaian dilakukan dengan melakukan vote pada sesuatu yang dilombakan dan yang bisa melakukan vote adalah anggota aktif dan sudah memiliki Kartu Tanda Anggota (KTA)</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

        $('#penilaian').change(function (e) {
            var val = $(this).val();
            var ket = '';
            if(val=='vote'){
                ket = 'Perlombaan bersifat digital yang mana sesuatu yang dilombakan bersifat digital seperti upload foto/video dll.Penilaian dilakukan dengan melakukan vote pada sesuatu yang dilombakan dan yang bisa melakukan vote adalah anggota aktif dan sudah memiliki Kartu Tanda Anggota (KTA)';
            }
            if(val=='objective'){
                ket = 'Perlombaan bersifat lapangan yang mana ada sistem gugur seperti sepak bola, bulu tangkis, catur dll. Penilaian ditentukan siapa yang menang pada akhir perlombaan';
            }
            if(val=='subjective'){
                ket = 'Perlombaan bersifat penjurian yang mana ada seorang juri dalam lomba tersebut seperti lomba tari/nyanyi dll. Penilaian akan dilakukan oleh juri yang bersangkutan dan hasil penilaian ditentukan oleh akumulasi dari juri-juri yang terlibat';
            }
            $('#ket-lomba').html(ket);
        });

        const deleteKegiatan = (id) =>{
            if (confirm('Jika anda menghapus ini setiap data yang terkait dengan kegiatan ini akan hilang! apa anda yakin?')) {
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
