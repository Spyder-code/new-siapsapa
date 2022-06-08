<div class="col-md-5 align-self-center">
    <h3 class="page-title">{{ $title }}</h3>
    <p class="mt-2">{{ $description }}</p>
    <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @foreach ($links as $link)
                    <li href="{{ $link['url'] }}" class="breadcrumb-item @if($loop->last) active @endif" @if($loop->last) aria-current="page" @endif>{{ $link['name'] }}</li>
                @endforeach
            </ol>
        </nav>
    </div>
</div>
