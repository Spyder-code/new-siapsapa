@extends('social.user-timeline')
@section('content-user')
@if (Auth::id()==$user->id)
<div class="block-box post-input-tab">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item" role="presentation" data-toggle="tooltip" data-placement="top" title="STATUS">
            <a class="nav-link active" data-toggle="tab" href="#post-status" role="tab" aria-selected="true"><i class="icofont-copy"></i>Sertifikat UMUM</a>
        </li>
        <li class="nav-item" role="presentation" data-toggle="tooltip" data-placement="top" title="MEDIA">
            <a class="nav-link" data-toggle="tab" href="#post-media" role="tab" aria-selected="false"><i class="icofont-image"></i>Sertifikat SAKA</a>
        </li>
        <li class="nav-item" role="presentation" data-toggle="tooltip" data-placement="top" title="BLOG">
            <a class="nav-link" data-toggle="tab" href="#post-blog" role="tab" aria-selected="false"><i class="icofont-list"></i>Sertifikat DEWASA</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="post-status" role="tabpanel">
            <div class="">
                <select name="pramuka" id="pramuka" class="form-control text-center" style="height: 60px">
                    <option disabled selected>Pilih Golongan</option>
                    @foreach ($pramuka as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                <select name="document_type_id" id="document_type_id" class="form-control text-center" style="height: 60px">
                </select>
            </div>
        </div>
        <div class="tab-pane fade" id="post-media" role="tabpanel">
            <!-- <label>Media Gallery</label>
            <a href="#" class="media-insert"><i class="icofont-upload-alt"></i>Upload</a> -->
            <textarea name="status-input" id="status-input2" class="form-control textarea" placeholder="Share what are you thinking . . ." cols="30" rows="6"></textarea>
        </div>
        <div class="tab-pane fade" id="post-blog" role="tabpanel">
            <textarea name="status-input" id="status-input3" class="form-control textarea" placeholder="Share what are you thinking . . ." cols="30" rows="6"></textarea>
        </div>
    </div>
    <div class="post-footer">
        <div class="insert-btn">
            <input type="file" name="file" id="file" class="form-control-file text-center" style="height: 60px">
        </div>
        <div class="submit-btn">
            <a href="user-timeline.html#">Post Submit</a>
        </div>
    </div>
</div>
@endif
<div class="user-list-view forum-member">
    {{-- <div class="widget-author block-box">
        <div class="author-heading">
            <div class="cover-img">
                <img src="media/figure/cover_1.jpg" alt="cover">
            </div>
            <div class="profile-img">
                <a href="#">
                    <img src="media/figure/author_1.jpg" alt="author">
                </a>
            </div>
            <div class="profile-name">
                <h4 class="author-name"><a href="#">Rebeca Powel</a></h4>
                <div class="author-location">@ahat akter</div>
            </div>
        </div>
        <ul class="author-badge">
            <li><a href="#" class="bg-salmon-gradient"><i class="icofont-star"></i></a></li>
            <li><a href="#" class="bg-sun-gradient"><i class="icofont-squirrel"></i></a></li>
            <li><a href="#" class="bg-jungle-gradient"><i class="icofont-rocket-alt-1"></i></a></li>
        </ul>
        <ul class="author-statistics">
            <li>
                <a href="#"><span class="item-number">30</span> <span class="item-text">POSTS</span></a>
            </li>
            <li>
                <a href="#"><span class="item-number">12</span> <span class="item-text">COMMENTS</span></a>
            </li>
            <li>
                <a href="#"><span class="item-number">1,125</span> <span class="item-text">VIEWS</span></a>
            </li>
        </ul>
    </div>
    <div class="widget-author block-box">
        <div class="author-heading">
            <div class="cover-img">
                <img src="media/figure/cover_2.jpg" alt="cover">
            </div>
            <div class="profile-img">
                <a href="#">
                    <img src="media/figure/author_3.jpg" alt="author">
                </a>
            </div>
            <div class="profile-name">
                <h4 class="author-name"><a href="#">Julia Zessy</a></h4>
                <div class="author-location">@zessyr</div>
            </div>
        </div>
        <ul class="author-badge">
            <li><a href="#" class="bg-salmon-gradient"><i class="icofont-star"></i></a></li>
            <li><a href="#" class="bg-sun-gradient"><i class="icofont-squirrel"></i></a></li>
            <li><a href="#" class="bg-jungle-gradient"><i class="icofont-rocket-alt-1"></i></a></li>
        </ul>
        <ul class="author-statistics">
            <li>
                <a href="#"><span class="item-number">30</span> <span class="item-text">POSTS</span></a>
            </li>
            <li>
                <a href="#"><span class="item-number">12</span> <span class="item-text">COMMENTS</span></a>
            </li>
            <li>
                <a href="#"><span class="item-number">1,125</span> <span class="item-text">VIEWS</span></a>
            </li>
        </ul>
    </div> --}}
    {{-- <div class="widget-author block-box">
        <div class="author-heading">
            <div class="cover-img">
                <img src="media/figure/cover_3.jpg" alt="cover">
            </div>
            <div class="profile-img">
                <a href="#">
                    <img src="media/figure/author_4.jpg" alt="author">
                </a>
            </div>
            <div class="profile-name">
                <h4 class="author-name"><a href="#">Fahim Rahman</a></h4>
                <div class="author-location">@rahman</div>
            </div>
        </div>
        <ul class="author-badge">
            <li><a href="#" class="bg-salmon-gradient"><i class="icofont-star"></i></a></li>
            <li><a href="#" class="bg-sun-gradient"><i class="icofont-squirrel"></i></a></li>
            <li><a href="#" class="bg-jungle-gradient"><i class="icofont-rocket-alt-1"></i></a></li>
        </ul>
        <ul class="author-statistics">
            <li>
                <a href="#"><span class="item-number">30</span> <span class="item-text">POSTS</span></a>
            </li>
            <li>
                <a href="#"><span class="item-number">12</span> <span class="item-text">COMMENTS</span></a>
            </li>
            <li>
                <a href="#"><span class="item-number">1,125</span> <span class="item-text">VIEWS</span></a>
            </li>
        </ul>
    </div>
    <div class="widget-author block-box">
        <div class="author-heading">
            <div class="cover-img">
                <img src="media/figure/cover_4.jpg" alt="cover">
            </div>
            <div class="profile-img">
                <a href="#">
                    <img src="media/figure/author_5.jpg" alt="author">
                </a>
            </div>
            <div class="profile-name">
                <h4 class="author-name"><a href="#">Aahat Akter</a></h4>
                <div class="author-location">@aahat</div>
            </div>
        </div>
        <ul class="author-badge">
            <li><a href="#" class="bg-salmon-gradient"><i class="icofont-star"></i></a></li>
            <li><a href="#" class="bg-sun-gradient"><i class="icofont-squirrel"></i></a></li>
            <li><a href="#" class="bg-jungle-gradient"><i class="icofont-rocket-alt-1"></i></a></li>
        </ul>
        <ul class="author-statistics">
            <li>
                <a href="#"><span class="item-number">30</span> <span class="item-text">POSTS</span></a>
            </li>
            <li>
                <a href="#"><span class="item-number">12</span> <span class="item-text">COMMENTS</span></a>
            </li>
            <li>
                <a href="#"><span class="item-number">1,125</span> <span class="item-text">VIEWS</span></a>
            </li>
        </ul>
    </div>
    <div class="widget-author block-box">
        <div class="author-heading">
            <div class="cover-img">
                <img src="media/figure/cover_5.jpg" alt="cover">
            </div>
            <div class="profile-img">
                <a href="#">
                    <img src="media/figure/author_6.jpg" alt="author">
                </a>
            </div>
            <div class="profile-name">
                <h4 class="author-name"><a href="#">Aahat Akter</a></h4>
                <div class="author-location">@aahat</div>
            </div>
        </div>
        <ul class="author-badge">
            <li><a href="#" class="bg-salmon-gradient"><i class="icofont-star"></i></a></li>
            <li><a href="#" class="bg-sun-gradient"><i class="icofont-squirrel"></i></a></li>
            <li><a href="#" class="bg-jungle-gradient"><i class="icofont-rocket-alt-1"></i></a></li>
        </ul>
        <ul class="author-statistics">
            <li>
                <a href="#"><span class="item-number">30</span> <span class="item-text">POSTS</span></a>
            </li>
            <li>
                <a href="#"><span class="item-number">12</span> <span class="item-text">COMMENTS</span></a>
            </li>
            <li>
                <a href="#"><span class="item-number">1,125</span> <span class="item-text">VIEWS</span></a>
            </li>
        </ul>
    </div>
    <div class="widget-author block-box">
        <div class="author-heading">
            <div class="cover-img">
                <img src="media/figure/cover_6.jpg" alt="cover">
            </div>
            <div class="profile-img">
                <a href="#">
                    <img src="media/figure/author_7.jpg" alt="author">
                </a>
            </div>
            <div class="profile-name">
                <h4 class="author-name"><a href="#">Aahat Akter</a></h4>
                <div class="author-location">@aahat</div>
            </div>
        </div>
        <ul class="author-badge">
            <li><a href="#" class="bg-salmon-gradient"><i class="icofont-star"></i></a></li>
            <li><a href="#" class="bg-sun-gradient"><i class="icofont-squirrel"></i></a></li>
            <li><a href="#" class="bg-jungle-gradient"><i class="icofont-rocket-alt-1"></i></a></li>
        </ul>
        <ul class="author-statistics">
            <li>
                <a href="#"><span class="item-number">30</span> <span class="item-text">POSTS</span></a>
            </li>
            <li>
                <a href="#"><span class="item-number">12</span> <span class="item-text">COMMENTS</span></a>
            </li>
            <li>
                <a href="#"><span class="item-number">1,125</span> <span class="item-text">VIEWS</span></a>
            </li>
        </ul>
    </div> --}}
    <div class="block-box load-more-btn">
        <a href="#" class="item-btn"><i class="icofont-refresh"></i>Load More Member</a>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $('#pramuka').change(function (e) {
            var val = $(this).val();
            console.log(val);
            $.ajax({
                url: '{{ url("api/get-document") }}'+'/'+val,
                type: 'GET',
                success: function (data) {
                    $('select[name="document_type_id"]').empty();
                    var html = '<option value="">Pilih Jenis Dokumen</option>';
                    $.each(data, function (idx, item) {
                        html += '<option value="'+item.id+'">'+item.name+'</option>';
                    });
                    $('select[name="document_type_id"]').html(html);
                }
            });
        });
    </script>
@endpush
