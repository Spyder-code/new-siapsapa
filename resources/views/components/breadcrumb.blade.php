<div class="row">
    <div class="col-md-5 align-self-center">
        <h3 class="page-title">{{ $title }}</h3>
        <p>{{ $description }}</p>
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
    {{-- <div class=" col-md-7 justify-content-end align-self-center d-none d-md-flex ">
        <div class="d-flex">
            <div class="dropdown me-2">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                January 2021
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#">February 2021</a></li>
                    <li><a class="dropdown-item" href="#">March 2021</a></li>
                    <li><a class="dropdown-item" href="#">April 2021</a></li>
                </ul>
            </div>
            <button class="btn btn-success">
                <i data-feather="plus" class="fill-white feather-sm"></i>
                Create
            </button>
        </div>
    </div> --}}
</div>
