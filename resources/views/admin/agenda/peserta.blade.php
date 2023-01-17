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
    @include('admin.agenda.peserta_lomba')
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

