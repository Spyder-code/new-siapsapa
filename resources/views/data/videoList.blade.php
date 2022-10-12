@forelse ($files as $item)
<div class="col-lg-3 col-md-4 col-6">
    <video width="320" height="240" controls>
        <source src="{{ asset($item->path) }}" type="video/mp4">
    </video>
</div>
@empty
<img src="{{ asset('images/empty.png') }}" class="img-fluid" width="100%">
@endforelse
