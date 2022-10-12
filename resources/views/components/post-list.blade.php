<div class="col-lg-4 col-md-6">
    <div class="block-box user-blog">
        <div class="blog-img">
            <a href="{{ route('social.news.detail', $post->id) }}"><img
                    style="max-width:100%; max-height:100%; object-fit: cover;" src="{{ $post->cover_image }}"
                    alt="Blog"></a>
        </div>
        <div class="blog-content">
            <div class="blog-category">
                <a href="#">{{ $post->name }}</a>
            </div>
            <h3 class="blog-title" style="text-transform: capitalize;"><a
                    href="{{ route('social.news.detail', $post->id) }}">
                    {{(strlen($post->title) >= 50) ? substr($post->title, 0, 50) . '...' : $post->title}}</a></h3>
            <div class="blog-date"><i class="icofont-calendar"></i>
                {{ date("j F, Y", strtotime($post->created_at)) }}
            </div>
            <p>{{(strlen($post->content) >= 120) ? substr($post->content, 0, 120) . '...' : $post->content}}</p>
        </div>
    </div>
</div>
