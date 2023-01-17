<div class="col-12 col-md-8 mt-2">
    <div class="card">
        <div class="border-bottom title-part-padding">
            <h4 class="card-title mb-0">List Peserta {{ $agenda->nama }}</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if ($agenda->kepesertaan=='kelompok')
                <table class="table table-bordered" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Gudep</th>
                            <th>Peserta</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anggota as $item)
                            @foreach ($item as $a)
                            <tr>
                                @if ($loop->first)
                                <td rowspan="{{ $item->count() }}">{{ $loop->iteration }}</td>
                                <td rowspan="{{ $item->count() }}">{{ $item->first()->gudepInfo->nama_sekolah }}</td>
                                @endif
                                <td>{{ $a->nodaf($agenda->id) }} - {{ $a->nama }}</td>
                                <td>
                                    @if (Auth::user()->anggota->gudep==$a->gudep)
                                    <button type="button" class="btn btn-danger" onclick="deletePeserta('{{ $a->nodaf($agenda->id) }}')"><i class="fas fa-trash-alt"></i></button>
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
                        @foreach ($anggota as $item)
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
    <form action="{{ route('agenda.peserta.add') }}" method="post" class="modal-dialog modal-xl">
        @csrf
        <input type="hidden" name="agenda_id" value="{{ $agenda->id }}">
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
                                <th>NIK</th>
                                <th>Nama Lengkap</th>
                                <th>Tanggal Lahir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($daftarPeserta as $item)
                                <tr>
                                    <td><input type="checkbox" name="anggota_id[]" value="{{ $item->anggota_id }}"></td>
                                    <td><img src="{{ asset('berkas/anggota/'.$item->anggota->foto) }}" style="width: 60px; height:60px"></td>
                                    <td>{{ $item->anggota->nik }}</td>
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

