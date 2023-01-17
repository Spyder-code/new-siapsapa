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
    <div class="col-12 col-md-8">
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
                            <table class="table" id="kegiatan">
                                <tbody>
                                    @if (Auth::user()->role == 'admin' || Auth::id()==$agenda->created_by)
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
                                    @endif
                                    @forelse ($kegiatan as $item)
                                    <tr data-id="{{ $item->id }}">
                                        <td width="390">{{ date('d/m/Y H:i', strtotime( $item->jam)) }}</td>
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

<div class="modal fade" id="modal-edit-kegiatan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id-edit">
                <div class="mb-3">
                    <input type="text" name="jam" id="jam-edit" class="form-control" placeholder="Jam kegiatan" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="nama_kegiatan" id="nama_kegiatan-edit" class="form-control" placeholder="Nama kegiatan" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="updateKegiatan()" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
        var jam = flatpickr('#jam',{
            enableTime: true,
            dateFormat: "Y-m-d H:i:s",
            time_24hr: true,
            minDate: @json($agenda->tanggal_mulai),
            maxDate: @json($agenda->tanggal_selesai),
        });
        var jam_edit = flatpickr('#jam-edit',{
            enableTime: true,
            dateFormat: "Y-m-d H:i:s",
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

        const editKegiatan = (id,jam,nama_kegiatan) =>{
            $('#id-edit').val(id);
            $('#jam-edit').val(jam);
            $('#nama_kegiatan-edit').val(nama_kegiatan);
            $('#modal-edit-kegiatan').modal('show');

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


{{-- <div class="row">
    <!-- Column -->
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
            <h3 class="card-title">Rounded Chair</h3>
            <h6 class="card-subtitle">globe type chair for rest</h6>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="white-box text-center">
                        <img
                        src="../../assets/images/gallery/chair.jpg"
                        class="img-fluid"
                        />
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-6">
                    <h4 class="box-title mt-5">Product description</h4>
                    <p>
                        Lorem Ipsum available, but the majority have suffered
                        alteration in some form, by injected humour, or
                        randomised words which don't look even slightly
                        believable. but the majority have suffered alteration in
                        some form, by injected humour
                    </p>
                    <h2 class="mt-5">
                        $153 <small class="text-success">(36% off)</small>
                    </h2>
                    <button
                        class="btn btn-dark btn-rounded me-1"
                        data-bs-toggle="tooltip"
                        title=""
                        data-original-title="Add to cart">
                        <i
                        data-feather="shopping-cart"
                        class="fill-white feather-sm"
                        ></i>
                    </button>
                    <button class="btn btn-primary btn-rounded">
                        Buy Now
                    </button>
                    <h3 class="box-title mt-5">Key Highlights</h3>
                    <ul class="list-group list-group-flush ps-0">
                        <li
                        class="
                            list-group-item
                            border-bottom-0
                            py-1
                            px-0
                            text-muted
                        "
                        >
                        <i
                            data-feather="check-circle"
                            class="text-primary feather-sm me-2"
                        ></i>
                        Lorem Ipsum available, but the majority have suffered
                        alteration in some form
                        </li>
                        <li
                        class="
                            list-group-item
                            border-bottom-0
                            py-1
                            px-0
                            text-muted
                        "
                        >
                        <i
                            data-feather="check-circle"
                            class="text-primary feather-sm me-2"
                        ></i>
                        Lorem Ipsum available, but the majority have suffered
                        alteration in some form
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
              <h3 class="box-title mt-5">General Info</h3>
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <td width="390">Brand</td>
                      <td>Stellar</td>
                    </tr>
                    <tr>
                      <td>Delivery Condition</td>
                      <td>Knock Down</td>
                    </tr>
                    <tr>
                      <td>Seat Lock Included</td>
                      <td>Yes</td>
                    </tr>
                    <tr>
                      <td>Type</td>
                      <td>Office Chair</td>
                    </tr>
                    <tr>
                      <td>Style</td>
                      <td>Contemporary &amp; Modern</td>
                    </tr>
                    <tr>
                      <td>Wheels Included</td>
                      <td>Yes</td>
                    </tr>
                    <tr>
                      <td>Upholstery Included</td>
                      <td>Yes</td>
                    </tr>
                    <tr>
                      <td>Upholstery Type</td>
                      <td>Cushion</td>
                    </tr>
                    <tr>
                      <td>Head Support</td>
                      <td>No</td>
                    </tr>
                    <tr>
                      <td>Suitable For</td>
                      <td>Study &amp; Home Office</td>
                    </tr>
                    <tr>
                      <td>Adjustable Height</td>
                      <td>Yes</td>
                    </tr>
                    <tr>
                      <td>Model Number</td>
                      <td>F01020701-00HT744A06</td>
                    </tr>
                    <tr>
                      <td>Armrest Included</td>
                      <td>Yes</td>
                    </tr>
                    <tr>
                      <td>Care Instructions</td>
                      <td>
                        Handle With Care, Keep In Dry Place, Do Not
                        Apply Any Chemical For Cleaning.
                      </td>
                    </tr>
                    <tr>
                      <td>Finish Type</td>
                      <td>Matte</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Column -->
  </div> --}}
