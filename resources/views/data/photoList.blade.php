@forelse ($files as $item)
<div class="col-lg-3 col-md-4 col-6">
    <div class="user-group-photo">
        <a href="{{ asset($item->path) }}" class="popup-zoom">
            <img src="{{ asset($item->path) }}" alt="Gallery" class="img-fluid">
            {{-- <div style="background-image:url({{ asset($item->path) }});background-repeat:no-repeat;background-size:contain;background-position:center;height:400px;width:100%;
            "></div> --}}
        </a>
    </div>
</div>
@empty
<img src="{{ asset('images/empty.png') }}" class="img-fluid" width="100%">
@endforelse
