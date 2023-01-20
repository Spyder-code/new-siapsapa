@extends('layouts.admin')
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => '/'],
            ['name' => 'Agenda', 'url' => '#'],
        ]"

        :title="'Agenda'"
        :description="'List Agenda'"
    />
    @if (Auth::user()->role != 'anggota')
    <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
        <a href="{{ route('agenda.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Agenda</a>
    </div>
    @endif
</div>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Agenda Baru ({{ $data->where('is_finish',0)->count() }})</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Agenda Selesai ({{ $data->where('is_finish',1)->count() }})</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row mt-2">
                    @forelse ($data->where('is_finish',0) as $item)
                        <div class="col-12 col-md-6">
                            <x-agenda_card :item="$item" />
                        </div>
                    @empty
                        <img src="{{ asset('images/empty.png') }}" class="img-fluid" width="100%">
                    @endforelse
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row mt-2">
                    @forelse ($data->where('is_finish',1) as $item)
                        <div class="col-12 col-md-6">
                            <x-agenda_card :item="$item" />
                        </div>
                    @empty
                        <img src="{{ asset('images/empty.png') }}" class="img-fluid" width="100%">
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    const deleteAgenda = (id) =>{
        if(confirm('are you sure?')){
            $.ajax({
                url: "{{ url('api/delete-agenda') }}"+"/"+id,
                type: 'DELETE',
                success: function(response){
                    window.location.reload();
                }
            });
        }
    }
</script>
@endsection

