@extends('layouts.profile')
@section('content-user')
<div class="card">
    <div class="card-body">
        <div class="row">
            @forelse ($agenda as $item)
                <div class="col-12 col-md-12">
                    <x-agenda_card_user :item="$item->agenda" />
                </div>
            @empty
                <img src="{{ asset('images/empty.png') }}" class="img-fluid" width="100%">
            @endforelse
        </div>
    </div>
</div>
@endsection

