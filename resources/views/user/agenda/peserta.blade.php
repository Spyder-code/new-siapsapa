@extends('layouts.newuser')
@section('content')
    <section class="hero-banner">
        <div class="container text-center">
            <h1 class="text-white">{{ $agenda->nama }}</h1>
            <h3>{{ $agenda->kepesertaan }}</h3>
        </div>
    </section>
    <section class="why-choose-us mb-5">
        <div class="mt-3 container">
            <div class="row">
                <div class="col-12 col-md-12 mt-2">
                    <div class="cards">
                        <div class="title-part-padding">
                            {{-- <div class="alert alert-danger" id="message-danger">
                                <p id="message"></p>
                            </div> --}}
                            @if ($agenda->kepesertaan=='kelompok')
                            <div class="alert alert-info">
                                <p>Harap hubungi admin untuk mendaftar lomba</p>
                            </div>
                            @else
                            @if ($cek==null && $agenda->is_finish==0)
                            <button type="button" id="daftar" class="btn btn-success">Daftar</button>
                            @endif
                            @endif
                        </div>
                        <h4 class="card-title text-center">List Peserta {{ $agenda->nama }}</h4>
                        <div class="card-body">
                            <div class="table-responsive">
                                @if ($agenda->kepesertaan=='kelompok')
                                <table class="table table-bordered" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Gudep</th>
                                            <th>Peserta</th>
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
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $('.table').dataTable();
        $('#message-danger').hide();
        $('#daftar').click(function (e) {
            if(confirm('Apa anda yakin?')){
                const agenda_id = @json($agenda->id);
                const nik = @json(Auth::user()->anggota->nik);
                $.ajax({
                    url: "{{ url('/api/add-peserta') }}",
                    type: "POST",
                    data:{
                        agenda_id:agenda_id,
                        nik:nik
                    },
                    success: function(data){
                        var status = data.status;
                        if(status==0){
                            $('#message-danger').show();
                            $('#message').html(data.message);
                        }else{
                            alert('berhasil mendaftar');
                            location.reload();
                        }
                    }
                });
            }
        });

        function deletePeserta(id){
            if(confirm('are you sure?')){
                $.ajax({
                    url: "{{ url('/api/delete-peserta') }}",
                    type: "DELETE",
                    data:{
                        id:id
                    },
                    success: function(data){
                        alert('Pendaftar berhasil dihapus');
                        location.reload();
                    }
                });
            }
        }
    </script>
@endsection
