@extends('layouts.social')
@section('content')
<div class="block-box user-single-blog">
    <div class="blog-thumbnail">
        {{-- <img src="https://radiustheme.com/demo/html/cirkle/media/blog/blog_10.jpg" alt="Blog"> --}}
        <img style="width: 100%; max-height: auto; object-fit: cover;" src="{{ $post->cover_image }}" alt="Blog">
    </div>
    <div class="blog-content-wrap">
        <div class="blog-entry-header">
            <div class="entry-category">
                <a href="single-blog.html#">{{ $post->name }}</a>
            </div>
            <h2 style="text-transform: capitalize;" class="entry-title">{{ $post->title }}</h2>
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <ul class="entry-meta">
                        <li>
                            <img src="{{ asset('berkas/anggota/'.$post->user->anggota->foto) }}" alt="{{ $post->user->name }}" style="height: 44px; width:44px">
                            Oleh <a href="#">{{ $post->nama_user }}</a>
                        </li>
                        <li><i class="icofont-calendar"></i>{{ date("j F, Y", strtotime($post->created_at)) }}</li>
                        {{-- <li><i class="icofont-comment"></i> Comments: 05</li>
                        <li><i class="icofont-share"></i> Share: 02</li> --}}
                    </ul>
                </div>
                <div class="col-lg-4">
                    <ul class="blog-share">
                        <li><a href="single-blog.html#" class="bg-fb"><i class="icofont-facebook"></i></a></li>
                        <li><a href="single-blog.html#" class="bg-twitter"><i class="icofont-twitter"></i></a></li>
                        <li><a href="single-blog.html#" class="bg-dribble"><i class="icofont-dribbble"></i></a></li>
                        <li><a href="single-blog.html#" class="bg-youtube"><i class="icofont-youtube"></i></a></li>
                        <li><a href="single-blog.html#" class="bg-behance"><i class="icofont-behance"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="blog-content">
            <p style="text-transform: capitalize;">{{ $post->content }}</p>
            <div class="row">

                @foreach ($postMedia as $item)
                @if ($item->type == 'image')
                <div class="col-md-6">
                    <div class="content-img">
                        <img src="{{ asset($item->path) }}" alt="Blog">
                    </div>
                </div>
                @else
                <div class="col-md-6">
                    <video style="max-width: 100%; height: auto;" controls>
                        <source src="{{ asset($item->path) }}" type="video/mp4">
                    </video>
                </div>
                @endif
                @endforeach
                {{-- <div class="col-md-6">
                    <div class="content-img">
                        <img src="https://radiustheme.com/demo/html/cirkle/media/blog/blog_11.jpg" alt="Blog">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content-img">
                        <img src="https://radiustheme.com/demo/html/cirkle/media/blog/blog_12.jpg" alt="Blog">
                    </div>
                </div> --}}
            </div>

        </div>
        {{-- <div class="blog-footer">
            <div class="item-label">Choose your <span>Reaction!</span></div>
            <div class="reaction-icon">
                <a href="single-blog.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_1.png" alt="Like"></a>
                <a href="single-blog.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_6.png" alt="Like"></a>
                <a href="single-blog.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_2.png" alt="Like"></a>
                <a href="single-blog.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_7.png" alt="Like"></a>
                <a href="single-blog.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_3.png" alt="Like"></a>
                <a href="single-blog.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_5.png" alt="Like"></a>
            </div>
        </div> --}}
        {{-- <div class="blog-comment-form">
            <h3 class="item-title">Tinggalkan komentar</h3>
            <form>
                <div class="row gutters-20">
                    <div class="col-lg-4 form-group">
                        <input type="text" name="name" class="form-control" placeholder="Name">
                    </div>
                    <div class="col-lg-4 form-group">
                        <input type="email" name="email" class="form-control" placeholder="E-mail">
                    </div>
                    <div class="col-lg-4 form-group">
                        <input type="text" name="website" class="form-control" placeholder="website">
                    </div>
                    <div class="col-lg-12 form-group">
                        <textarea name="message" id="message" class="form-control textarea" placeholder="Comments" cols="30" rows="7"></textarea>
                    </div>
                    <div class="col-lg-12 form-group">
                        <input type="submit" class="submit-btn" name="post-comment" value="Submit komentar">
                    </div>
                </div>
            </form>
        </div> --}}
    </div>
</div>
{{-- <div class="realated-blog">
    <div class="block-box blog-heading">
        <h3 class="heading-title">Related Blog Posts</h3>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="block-box user-blog">
                <div class="blog-img">
                    <a href="single-blog.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/blog/blog_4.jpg" alt="Blog"></a>
                </div>
                <div class="blog-content">
                    <div class="blog-category">
                        <a href="single-blog.html#">Community</a>
                        <a href="single-blog.html#">Inspiration</a>
                    </div>
                    <h3 class="blog-title"><a href="single-blog.html#">Spoke with the developer sety 2020 Gaming Area</a></h3>
                    <div class="blog-date"><i class="icofont-calendar"></i> 15 October, 2020</div>
                    <p>when ann unknown printer took galley type and scrambled it to make aretype specimen book has survived not only.</p>
                </div>
                <div class="blog-meta">
                    <ul>
                        <li class="blog-reaction">
                            <div class="reaction-icon">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_1.png" alt="icon">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_2.png" alt="icon">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_3.png" alt="icon">
                            </div>
                            <div class="meta-text">+ 15 others</div>
                        </li>
                        <li><i class="icofont-comment"></i> 05</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="block-box user-blog">
                <div class="blog-img">
                    <a href="single-blog.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/blog/blog_5.jpg" alt="Blog"></a>
                </div>
                <div class="blog-content">
                    <div class="blog-category">
                        <a href="single-blog.html#">Sporty</a>
                    </div>
                    <h3 class="blog-title"><a href="single-blog.html#">Spoke with the developer sety 2020 Gaming Area</a></h3>
                    <div class="blog-date"><i class="icofont-calendar"></i> 15 October, 2020</div>
                    <p>when ann unknown printer took galley type and scrambled it to make aretype specimen book has survived not only.</p>
                </div>
                <div class="blog-meta">
                    <ul>
                        <li class="blog-reaction">
                            <div class="reaction-icon">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_1.png" alt="icon">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_2.png" alt="icon">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_3.png" alt="icon">
                            </div>
                            <div class="meta-text">+ 15 others</div>
                        </li>
                        <li><i class="icofont-comment"></i> 05</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="block-box user-blog">
                <div class="blog-img">
                    <a href="single-blog.html#"><img src="https://radiustheme.com/demo/html/cirkle/media/blog/blog_6.jpg" alt="Blog"></a>
                </div>
                <div class="blog-content">
                    <div class="blog-category">
                        <a href="single-blog.html#">Community</a>
                        <a href="single-blog.html#">Inspiration</a>
                    </div>
                    <h3 class="blog-title"><a href="single-blog.html#">Spoke with the developer sety 2020 Gaming Area</a></h3>
                    <div class="blog-date"><i class="icofont-calendar"></i> 15 October, 2020</div>
                    <p>when ann unknown printer took galley type and scrambled it to make aretype specimen book has survived not only.</p>
                </div>
                <div class="blog-meta">
                    <ul>
                        <li class="blog-reaction">
                            <div class="reaction-icon">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_1.png" alt="icon">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_2.png" alt="icon">
                                <img src="https://radiustheme.com/demo/html/cirkle/media/figure/reaction_3.png" alt="icon">
                            </div>
                            <div class="meta-text">+ 15 others</div>
                        </li>
                        <li><i class="icofont-comment"></i> 05</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
