@extends('layouts.social')
@section('content')
<div class="container">
    <div class="product-breadcrumb block-box">
        <div class="breadcrumb-area">
            <h1 class="item-title">Shop Page</h1>
            <ul>
                <li>
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li>
                    <a href="{{ route('social.shop') }}">Shop</a>
                </li>
                <li>{{ $product->nama }}</li>
            </ul>
        </div>
    </div>
    <div class="single-product">
        <div class="row">
            <div class="col-lg-6">
                <div class="product-gallery">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active show" id="related1">
                            <a href="#">
                                <img class="zoom_01 img-fluid" alt="single" src="{{ asset('berkas/product/'.$product->foto) }}" data-zoom-image="{{ asset('berkas/product/'.$product->foto) }}">
                            </a>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="related2">
                            <a href="#">
                                <img class="zoom_01 img-fluid" alt="single" src="{{ asset('berkas/product/'.$product->foto) }}" data-zoom-image="{{ asset('berkas/product/'.$product->foto) }}">
                            </a>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="related3">
                            <a href="#">
                                <img class="zoom_01 img-fluid" alt="single" src="{{ asset('berkas/product/'.$product->foto) }}" data-zoom-image="{{ asset('berkas/product/'.$product->foto) }}">
                            </a>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="related4">
                            <a href="#">
                                <img class="zoom_01 img-fluid" alt="single" src="{{ asset('berkas/product/'.$product->foto) }}" data-zoom-image="{{ asset('berkas/product/'.$product->foto) }}">
                            </a>
                        </div>
                    </div>
                    <ul class="nav nav-tabs tab-nav-list">
                        <li class="nav-item">
                            <a class="active" href="#related1" data-toggle="tab" aria-expanded="false">
                                <img alt="related1" src="{{ asset('berkas/product/'.$product->foto) }}" class="img-fluid">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#related2" data-toggle="tab" aria-expanded="false">
                                <img alt="related2" src="{{ asset('berkas/product/'.$product->foto) }}" class="img-fluid">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#related3" data-toggle="tab" aria-expanded="false">
                                <img alt="related3" src="{{ asset('berkas/product/'.$product->foto) }}" class="img-fluid">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#related4" data-toggle="tab" aria-expanded="false">
                                <img alt="related3" src="{{ asset('berkas/product/'.$product->foto) }}" class="img-fluid">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product-content">
                    {{-- <div class="item-category">BAG</div> --}}
                    <h2 class="item-title">{{ $product->nama }}</h2>
                    <div class="item-price">Rp. {{ number_format($product->harga) }}</div>
                    {{-- <ul class="entry-meta">
                        <li>SKU:
                            <span>9856000</span>
                        </li>
                        <li>Tags:
                            <a href="#">Bag,</a>
                            <a href="#">Leather</a>
                        </li>
                    </ul> --}}
                    <p>{{ $product->deskripsi }}</p>
                    <ul class="action-area">
                        <li id="quantity-holder">
                            <div class="input-group quantity-holder">
                                <button class="quantity-btn quantity-plus" type="button">
                                    <i class="icofont-plus" aria-hidden="true"></i>
                                </button>
                                <input type="text" name="quantity" class="form-control quantity-input" value="1" placeholder="1">
                                <button class="quantity-btn quantity-minus" type="button">
                                    <i class="icofont-minus" aria-hidden="true"></i>
                                </button>
                            </div>
                        </li>
                        <li>
                            <button type="submit" id="add-to-cart" class="btn btn-primary">Add to Cart</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="single-product-info">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#description" role="tab" aria-selected="true">Description</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#add-info" role="tab" aria-selected="false">Additional Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#reviews" role="tab" aria-selected="false">Reviews (1)</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active show" id="description" role="tabpanel">
                <div class="product-description">
                    <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui</p>
                    <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas eum iure reprehenderit voluptate.Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid.</p>
                </div>
            </div>
            <div class="tab-pane fade" id="add-info" role="tabpanel">
                <div class="row">
                    <div class="col-lg-4">
                        <ul class="additional-info">
                            <li>King Cheesey Pizza TinTIn</li>
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Lorem ipsum dolor sit amet</li>
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <ul class="additional-info">
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Lorem ipsum dolor sit amet</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="reviews" role="tabpanel">
                <div class="product-review">
                    <div class="media">
                        <div class="item-img">
                            <img src="media/figure/author_5.jpg" alt="blog">
                        </div>
                        <div class="media-body">
                            <div class="item-date">July 11, 2020</div>
                            <div class="author-name">
                                <h5 class="item-title">Matt Cloey</h5>
                                <div class="item-rating">
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                </div>
                            </div>
                            <p>Ahen an unknown printer took a galley of type and scrambled it to
                                make a type specimen book. It has survived not only five centuries.</p>
                        </div>
                    </div>
                    <div class="media">
                        <div class="item-img">
                            <img src="media/figure/author_6.jpg" alt="blog">
                        </div>
                        <div class="media-body">
                            <div class="item-date">July 11, 2020</div>
                            <div class="author-name">
                                <h5 class="item-title">Jessica Willium</h5>
                                <div class="item-rating">
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                    <i class="icofont-star"></i>
                                </div>
                            </div>
                            <p>Ahen an unknown printer took a galley of type and scrambled it to
                                make a type specimen book. It has survived not only five centuries.</p>
                        </div>
                    </div>
                </div>
                <div class="review-form">
                    <h3 class="heading-title">WRITE A REVIEW</h3>
                    <form>
                        <div class="row gutters-15">
                            <div class="col-lg-4 form-group">
                                <input type="text" placeholder="Name *" class="form-control" name="name" required="">
                            </div>
                            <div class="col-lg-4 form-group">
                                <input type="email" placeholder="E-mail *" class="form-control" name="email" required="">
                            </div>
                            <div class="col-lg-4 form-group">
                                <input type="text" placeholder="Subject *" class="form-control" name="subject" required="">
                            </div>
                            <div class="col-12 form-group">
                                <textarea class="form-control textarea" placeholder="Comment Here *" name="message" id="message" cols="30" rows="6"></textarea>
                            </div>
                            <div class="col-12 form-group">
                                <input type="submit" class="submit-btn" value="SUBMIT COMMENT">
                            </div>
                        </div>
                        <div class="form-response"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="related-product">
        <h3 class="heading-title">Related Products</h3>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="block-box product-box">
                    <div class="product-img">
                        <a href="#"><img src="media/figure/product_7.png" alt="product"></a>
                    </div>
                    <div class="product-content">
                        <div class="item-category">
                            <a href="#">COFFEE MUGS</a>
                        </div>
                        <h3 class="product-title"><a href="#">Black Coffee Mug</a></h3>
                        <div class="product-price">$29</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="block-box product-box">
                    <div class="product-img">
                        <a href="#"><img src="media/figure/product_8.png" alt="product"></a>
                    </div>
                    <div class="product-content">
                        <div class="item-category">
                            <a href="#">COFFEE MUGS</a>
                        </div>
                        <h3 class="product-title"><a href="#">Black Coffee Mug</a></h3>
                        <div class="product-price">$29</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="block-box product-box">
                    <div class="product-img">
                        <a href="#"><img src="media/figure/product_9.png" alt="product"></a>
                    </div>
                    <div class="product-content">
                        <div class="item-category">
                            <a href="#">COFFEE MUGS</a>
                        </div>
                        <h3 class="product-title"><a href="#">Black Coffee Mug</a></h3>
                        <div class="product-price">$29</div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection

@section('script')
    <script>
        var id = @json(Auth::id());
        var anggota_id = @json(Auth::user()->anggota->id);
        $('#add-to-cart').click(function (e) {
            if (confirm('are you sure?')) {
                $.ajax({
                    type: "POST",
                    url: @json(url('api/cart')),
                    data: {
                        user_id:id,
                        anggota_id:anggota_id,
                    },
                    success: function (response) {
                        console.log(response);
                    }
                });
            }
        });
    </script>
@endsection
