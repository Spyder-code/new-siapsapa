@extends('social.user-timeline')
@section('content-user')

@if($errors->any())
<div class="alert alert-danger mx-4 mt-4" role="alert">
    <div><b>Error, gagal upload:</b></div>
    @foreach ($errors->all() as $error)
    <div>{{ $error }}</div>
    @endforeach
</div>
@endif


@if (Auth::id() == $user->id)
<form id="form-main" action="{{ route('dokumen.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="block-box post-input-tab">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation" data-toggle="tooltip" data-placement="top">
                <a class="nav-link active" data-toggle="tab" href="#post-anggotamuda" role="tab" aria-selected="true"><i
                        class="icofont-copy"></i>Sertifikat ANGGOTA MUDA</a>
            </li>
            <li class="nav-item" role="presentation" data-toggle="tooltip" data-placement="top">
                <a class="nav-link" data-toggle="tab" href="#post-saka" role="tab" aria-selected="false"><i
                        class="icofont-image"></i>Sertifikat SAKA</a>
            </li>
            <li class="nav-item" role="presentation" data-toggle="tooltip" data-placement="top">
                <a class="nav-link" data-toggle="tab" href="#post-dewasa" role="tab" aria-selected="false"><i
                        class="icofont-list"></i>Sertifikat DEWASA</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="post-anggotamuda" role="tabpanel">
                <div class="p-4">
                    <select name="pramuka" id="sertif-anggotamuda" class="select-golongan form-select text-center"
                        required>
                        <option disabled selected>Pilih Golongan</option>
                        @foreach ($pramuka as $item)
                        @if ($item->name == 'Siaga' || $item->name == 'Penggalang' || $item->name == 'Penegak' ||
                        $item->name == 'Pandega')
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endif
                        @endforeach
                    </select>
                    <select id="select-anggotamuda" name="document_type_id" class="form-select text-center mt-2"
                        required></select>
                </div>
            </div>
            <div class="tab-pane fade" id="post-saka" role="tabpanel">
                <div class="p-4">
                    <select name="pramuka" id="sertif-saka" class="select-golongan form-select text-center">
                        <option disabled selected>Pilih Golongan</option>
                        @foreach ($pramuka as $item)
                        @if ($item->name == 'Saka')
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endif
                        @endforeach
                    </select>
                    <select id="select-saka" name="document_type_id" class="form-select text-center mt-2"></select>
                </div>
            </div>
            <div class="tab-pane fade" id="post-dewasa" role="tabpanel">
                <div class="p-4">
                    <select name="pramuka" id="sertif-dewasa" class="select-golongan form-select text-center">
                        <option disabled selected>Pilih Golongan</option>
                        @foreach ($pramuka as $item)
                        @if ($item->name == 'Pembina' || $item->name == 'Pelatih')
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endif
                        @endforeach
                    </select>
                    <select id="select-dewasa" name="document_type_id" class="form-select text-center mt-2"></select>
                </div>
            </div>
        </div>
        <div class="post-footer">
            <div class="insert-btn">
                <input type="file" name="file" id="file" class="form-control-file text-center" style="height: 60px"
                    required>
            </div>
            <input class="btn btn-primary" type="submit" value="Submit Sertifikat">
        </div>
    </div>
</form>
@endif


<div class="user-list-view forum-member">

    @foreach ($data as $item)
    <div class="widget-author block-box">
        <div class="author-heading">
            <img src="{{ asset('images/document.png') }}" class="img-fluid rounded-start" width="100">
            <div class="profile-name">
                <h4 class="author-name">{{ $item->documentType->name }}</h4>
                <div class="author-location">Aktif</div>
            </div>
        </div>
        <ul class="author-badge">
            @if (Auth::id() == $user->id)
            <li><a id="delete-item" nilai="{{ $item->id }}" class="bg-salmon-gradient">
                    <i class="icofont-ui-delete"></i></a></li>
            @endif
            <li><a href="{{ asset('berkas/dokumen/'.$item->document_type_id.'/'.$item->file) }}"
                    class="bg-jungle-gradient"><i class="icofont-eye-alt"></i></a></li>
        </ul>
        <ul class="author-statistics">
            @if ($item->golongan->name == 'Siaga' || $item->golongan->name == 'Penggalang' || $item->golongan->name ==
            'Penegak' || $item->golongan->name == 'Pandega')
            <li>
                <a style="cursor: text;"><span class="item-text">Anggota Muda</span></a>
            </li>
            @elseif ($item->golongan->name == 'Pembina' || $item->golongan->name == 'Pelatih')
            <li>
                <a style="cursor: text;"><span class="item-text">Anggota Dewasa</span></a>
            </li>
            @elseif ($item->golongan->name == 'Saka')
            <li>
                <a style="cursor: text;"><span class="item-text">Anggota Saka</span></a>
            </li>
            @endif
            <li>
                <a style="cursor: text;"><span class="item-text">{{ $item->documentType->name }}</span></a>
            </li>
        </ul>
    </div>
    @endforeach


    {{-- <div class="block-box load-more-btn">
        <a href="#" class="item-btn"><i class="icofont-refresh"></i>Load More Member</a>
    </div> --}}

</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {

        let formName;
        $('.bg-jungle-gradient').magnificPopup({type:'image'});

        $('.select-golongan').change(function (e) {
            const idPramuka = $(this).val();
            idInput = $(this).attr('id')
            $.ajax({
                url: '{{ url("api/get-document") }}' + '/' + idPramuka,
                type: 'GET',
                success: function (data) {
                    $(this).next().empty();
                    let html = '<option disabled selected>Pilih Jenis Dokumen</option>';
                    $.each(data, function (idx, item) {
                        html += '<option value="'+item.id+'">'+item.name+'</option>';
                    });
                    switch (idInput) {
                        case 'sertif-anggotamuda':
                            $('select[id="select-anggotamuda"]').html(html);
                            break;
                        case 'sertif-saka':
                            $('select[id="select-saka"]').html(html);
                            break;
                        case 'sertif-dewasa':
                            $('select[id="select-dewasa"]').html(html);
                            break;
                    }
                }
            });
        });

        $('.nav-item').click(function (e) {
            formName = $(this).find('a.nav-link').attr('href');
            switch (formName) {
                case '#post-anggotamuda':
                    $('#sertif-anggotamuda').prop('required', true);
                    $('#select-anggotamuda').prop('required', true);
                    $('#sertif-saka').prop('required', false);
                    $('#select-saka').prop('required', false);
                    $('#sertif-dewasa').prop('required', false);
                    $('#select-dewasa').prop('required', false);
                    break;
                case '#post-saka':
                    $('#sertif-anggotamuda').prop('required', false);
                    $('#select-anggotamuda').prop('required', false);
                    $('#sertif-saka').prop('required', true);
                    $('#select-saka').prop('required', true);
                    $('#sertif-dewasa').prop('required', false);
                    $('#select-dewasa').prop('required', false);
                    break;
                case '#post-dewasa':
                    $('#sertif-anggotamuda').prop('required', false);
                    $('#select-anggotamuda').prop('required', false);
                    $('#sertif-saka').prop('required', false);
                    $('#select-saka').prop('required', false);
                    $('#sertif-dewasa').prop('required', true);
                    $('#select-dewasa').prop('required', true);
                    break;
            }
        });

        $('#form-main').on('submit', function() {
            switch (formName) {
                case '#post-anggotamuda':
                    $('#sertif-saka').remove();
                    $('#select-saka').remove();
                    $('#sertif-dewasa').remove();
                    $('#select-dewasa').remove();
                    break;
                case '#post-saka':
                    $('#sertif-anggotamuda').remove();
                    $('#select-anggotamuda').remove();
                    $('#sertif-dewasa').remove();
                    $('#select-dewasa').remove();
                    break;
                case '#post-dewasa':
                    $('#sertif-anggotamuda').remove();
                    $('#select-anggotamuda').remove();
                    $('#sertif-saka').remove();
                    $('#select-saka').remove();
                    break;

                default:
                    $('#sertif-saka').remove();
                    $('#select-saka').remove();
                    $('#sertif-dewasa').remove();
                    $('#select-dewasa').remove();
                    break;
            }
            return true;
        });

        $('a#delete-item').click(function (e) {
            const id = $(this).attr('nilai');
            if (confirm('are you sure?')) {
                $.ajax({
                    url: '{{ url("api/delete-document") }}',
                    type: 'DELETE',
                    data: {
                        user_id: '{{ Auth::user()->id }}',
                        document_id: id
                    },
                    success: function (data) {
                        location.reload();
                    }
                });
            }
        });
    });
</script>
@endpush
