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
            ['name' => 'Peserta', 'url' => '#'],
        ]"

        :title="'Peserta '.$agenda->nama"
        :description="'Daftar peserta'"
    />
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-12 col-md-8 mt-2">
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">List Peserta {{ $agenda->nama }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
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
                </div>
            </div>
        </div>
    </div>
    @if (Auth::id()==$agenda->created_by)
    <div class="col-12 col-md-4 mt-2">
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
    </div>
    @endif
</div>
@endsection

@section('script')
<script>
    $('#message-danger').hide();
    var table = $(".file-export").DataTable();
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

    $('#daftar').click(function (e) {
        const agenda_id = @json($agenda->id);
        const nik = $('#nik').val();
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
                    alert('Anggota berhasil di daftarkan');
                    location.reload();
                }
            }
        });
    });
</script>
@endsection

