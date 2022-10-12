@extends('layouts.social')
@section('content')
<div class="container">
    <div class="product-page">
        <div class="product-breadcrumb block-box">
            <div class="breadcrumb-area">
                <h1 class="item-title">Shop Page</h1>
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>Shop</li>
                </ul>
            </div>
        </div>
        {{-- <div class="block-box product-filter">
            <label>Filter By:</label>
            <div class="select-box">
                <select class="select2 select2-hidden-accessible" data-placeholder="Select a Category" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    <option value="1" data-select2-id="3">Electronics</option>
                    <option value="2">Mens Fashion</option>
                    <option value="3">Women Fashion</option>
                    <option value="4">Mobile Accsessoris</option>
                    <option value="5">Computer Accsessoris</option>
                </select><span class="select2 select2-container select2-container--classic" dir="ltr" data-select2-id="2" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-jfgz-container"><span class="select2-selection__rendered" id="select2-jfgz-container" role="textbox" aria-readonly="true" title="Electronics">Electronics</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                <select class="select2 select2-hidden-accessible" data-placeholder="Sort by" data-select2-id="4" tabindex="-1" aria-hidden="true">
                    <option value="1" data-select2-id="6">Sort by Popularity</option>
                    <option value="2">Sort by New</option>
                    <option value="3">Sort by Old</option>
                </select><span class="select2 select2-container select2-container--classic" dir="ltr" data-select2-id="5" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-kg48-container"><span class="select2-selection__rendered" id="select2-kg48-container" role="textbox" aria-readonly="true" title="Sort by Popularity">Sort by Popularity</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
            </div>
            <div class="filter-btn">
                <a href="#" class="item-btn">Filter Product</a>
            </div>
        </div> --}}
        <div class="row">
            @forelse ($products as $item)
            <div class="col-lg-4 col-md-6">
                <div class="block-box product-box">
                    <div class="product-img">
                        <a href="{{ asset('berkas/product/'.$item->foto) }}" target="d-blank" class="popup-zoom">
                            <img src="{{ asset('berkas/product/'.$item->foto) }}" alt="{{ $item->nama }}">
                        </a>
                    </div>
                    <div class="product-content">
                        <div class="item-category">
                            <a href="{{ route('social.shop.detail',$item->id) }}">{{ $item->deskripsi }}</a>
                        </div>
                        <h3 class="product-title"><a href="{{ route('social.shop.detail',$item->id) }}">{{ $item->nama }} </a></h3>
                        <div class="product-price">Rp. {{ number_format($item->harga) }}</div>
                    </div>
                </div>
            </div>
            @empty
                <img src="{{ asset('images/empty.png') }}" class="img-fluid" width="100%">
            @endforelse
        </div>
        {{-- <div class="block-box load-more-btn">
            <a href="#" class="item-btn"><i class="icofont-refresh"></i>Load More</a>
        </div> --}}
    </div>
</div>
@endsection
