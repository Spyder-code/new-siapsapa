@forelse ($post as $item)
<div class="col-lg-4 col-md-6">
    <div class="block-box user-blog">
        <div class="blog-img">
            <a href="{{ route('social.news.detail', $item->id) }}"><img
                    style="max-width:100%; max-height:100%; object-fit: cover;" src="{{ $item->cover_image }}"
                    alt="Blog"></a>
        </div>
        <div class="blog-content">
            <div class="blog-category">
                <a href="#">{{ $item->name }}</a>
            </div>
            <h3 class="blog-title" style="text-transform: capitalize;"><a
                    href="{{ route('social.news.detail', $item->id) }}">
                    {{(strlen($item->title) >= 50) ? substr($item->title, 0, 50) . '...' : $item->title}}</a></h3>
            <div class="blog-date"><i class="icofont-calendar"></i>
                {{ date("j F, Y", strtotime($item->created_at)) }}
            </div>
            <p>{{(strlen($item->content) >= 120) ? substr($item->content, 0, 120) . '...' : $item->content}}</p>
        </div>
    </div>
</div>
@empty
<img src="{{ asset('images/empty.png') }}" class="img-fluid" width="100%">
@endforelse
