@extends('layouts.admin')
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => '/'],
            ['name' => 'Agenda', 'url' => route('agenda.show',$lomba->kegiatan->agenda)],
            ['name' => 'Management Pertandingan', 'url' => '#'],
        ]"

        :title="$lomba->kegiatan->nama_kegiatan"
        :description="'Management Pertandingan'"
    />
</div>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-8 mt-2">
        <div class="card shadow p-3">
            <span>Pertandingan ke- {{ $peserta->max('stage') }}</span> <span class="text-success">LIVE</span>
            <hr>
            <div class="table-responsive">
                <table class="table table-sm table-bordered" style="font-size: .7rem">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>{{ $lomba->kepesertaan=='kelompok'?ucfirst($lomba->kegiatan->agenda->tingkat):'Nama' }}</th>
                            <th>Pertandingan Ke</th>
                            <th>Point</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($lomba->kepesertaan=='kelompok')
                            @forelse ($lives as $item)
                                <tr  @if($item->first()->is_elimination==1) style="background-color: lightcoral; color:white" @endif>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($lomba->kegiatan->agenda->tingkat=='provinsi')
                                            {{ $item->first()->peserta->anggota->province->name }}
                                        @elseif($lomba->kegiatan->agenda->tingkat=='kabupaten')
                                            {{ $item->first()->peserta->anggota->city->name }}
                                        @elseif($lomba->kegiatan->agenda->tingkat=='kecamatan')
                                            {{ $item->first()->peserta->anggota->district->name }}
                                        @elseif($lomba->kegiatan->agenda->tingkat=='gudep')
                                            {{ $item->first()->peserta->anggota->gudepInfo->nama_sekolah }}
                                        @endif
                                    </td>
                                    <td>{{ $item->first()->stage }}</td>
                                    <td>{{ $item->first()->point==0?'-':$item->first()->point }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#lomba-stage-{{ $item->first()->id }}">
                                            Set
                                        </button>
                                        <div class="modal fade" id="lomba-stage-{{ $item->first()->id }}" tabindex="-1" aria-labelledby="lomba-stage-{{ $item->first()->id }}Label" aria-hidden="true">
                                            <form action="{{ route('lomba.update.lomba_stage',$item->first()) }}" method="post" class="modal-dialog modal-xl">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="lomba-stage-{{ $item->first()->id }}Label">Data Lomba</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-2">
                                                            <label for="point">Point</label>
                                                            <input type="number" name="point" id="point" class="form-control" value="{{ $item->first()->point }}">
                                                        </div>
                                                        @if ($lives->count()>1)
                                                        <div class="mb-2">
                                                            <label for="is_elimination-{{ $item->first()->id }}">
                                                                <input type="checkbox" name="is_elimination" id="is_elimination-{{ $item->first()->id }}" value="1" {{ $item->first()->is_elimination==1?'checked':'' }}> Eliminasi Peserta
                                                            </label>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak Ada Peserta</td>
                                </tr>
                            @endforelse
                        @else
                            @forelse ($lives as $item)
                                <tr @if($item->is_elimination==1) style="background-color: lightcoral; color:white" @endif>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->peserta->anggota->nama }}</td>
                                    <td>{{ $item->stage }}</td>
                                    <td>{{ $item->point==0?'-':$item->point }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#lomba-stage-{{ $item->id }}">
                                            Set
                                        </button>
                                        <div class="modal fade" id="lomba-stage-{{ $item->id }}" tabindex="-1" aria-labelledby="lomba-stage-{{ $item->id }}Label" aria-hidden="true">
                                            <form action="{{ route('lomba.update.lomba_stage',$item) }}" method="post" class="modal-dialog modal-xl">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="lomba-stage-{{ $item->id }}Label">Data Lomba</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-2">
                                                            <label for="point">Point</label>
                                                            <input type="number" name="point" id="point" class="form-control" value="{{ $item->point }}">
                                                        </div>
                                                        @if ($lives->count()>1)
                                                        <div class="mb-2">
                                                            <label for="is_elimination-{{ $item->id }}" class="text-danger">
                                                                <input type="checkbox" name="is_elimination" id="is_elimination-{{ $item->id }}" value="1" {{ $item->is_elimination==1?'checked':'' }}> Eliminasi Peserta
                                                            </label>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak Ada Peserta</td>
                                </tr>
                            @endforelse
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4 mt-2">
        <div class="card shadow p-3">
            <span>Pertandingan Berikutnya</span>
            <hr>
            @if ($lives->count()>1)
            <p>*Untuk lanjut pertandingan berikutnya, harap isi point terlebih dahulu pada pertandingan <i>LIVE</i> dan eliminasi peserta jika mengharuskan untuk mengeliminasi</p>
            <form action="{{ route('lomba.stage.next',$lomba) }}" method="post">
                @csrf
                <input type="hidden" name="stage" value="{{ $peserta->max('stage') }}">
                <button type="submit" class="btn btn-success btn-sm w-100" onclick="return confirm('are you sure?')">Lanjut Pertandingan Berikutnya</button>
            </form>
            @endif
        </div>
    </div>
    <div class="col-12 mt-5">
        <div class="card shadow p-3">
            <span>List History Pertandingan</span>
            <hr>
            <div class="table-responsive">
                <table class="table table-sm table-bordered" style="font-size: .7rem">
                    <thead>
                        <tr>
                            <th>Pertandingan Ke</th>
                            <th>{{ $lomba->kepesertaan=='kelompok'?'Gudep':'Nama' }}</th>
                            <th>Point</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($lomba->kepesertaan=='kelompok')
                            @forelse ($peserta->groupBy('stage') as $stages)
                                @foreach ($stages->groupBy('gudep_id') as $item)
                                <tr>
                                    <td>{{ $item->first()->stage }}</td>
                                    <td>{{ $item->first()->gudep->nama_sekolah }}</td>
                                    <td>{{ $item->first()->point==0?'-':$item->first()->point }}</td>
                                </tr>
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak Ada Peserta</td>
                                </tr>
                            @endforelse
                        @else
                            @forelse ($peserta as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->peserta->anggota->nama }}</td>
                                    <td>{{ $item->stage }}</td>
                                    <td>{{ $item->point==0?'-':$item->point }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak Ada Peserta</td>
                                </tr>
                            @endforelse
                        @endif
                    </tbody>
                </table>
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


