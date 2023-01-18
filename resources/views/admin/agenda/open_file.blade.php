@extends('layouts.social')
@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="mb-3">
            <a href="{{ route('social.event') }}"><i class=" icofont-arrow-left"></i> Kembali</a>
            <div class="d-flex justify-content-between">
                <span class="fw-bold">{{ $file->agenda->nama }}</span>
                <span class="fw-bold">{{ $file->anggota->nama }}</span>
            </div>
        </div>
        @if ($file)
            <div class="mt-3">
                <div id="playerContainer"></div>
            </div>
        @endif
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/indigo-player@1/lib/indigo-player.js"></script>
<script>
    let file = @json($file);
        if (file!=null) {
            const config = {
                sources: [
                    {
                        type: 'mp4',
                        src: @json(asset($file->file_path ?? '')),
                    }
                ],
            };

            const element = document.getElementById('playerContainer');
            const player = IndigoPlayer.init(element, config);
        }
</script>
@endsection


