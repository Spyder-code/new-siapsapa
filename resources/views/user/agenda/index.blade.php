@extends('layouts.user')
@section('content')
    <div class="container mt-5">
        <div class="row">
            @forelse ($agenda as $item)
                <div class="col-12 col-md-6">
                    <x-agenda_card_user :item="$item" />
                </div>
            @empty
                <img src="{{ asset('images/empty.png') }}" class="img-fluid" width="100%">
            @endforelse
        </div>
    </div>
@endsection
