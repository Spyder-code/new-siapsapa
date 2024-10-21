<div class="row">
    <x-input :type="'text'" :name="'nama'" :value="$agenda->nama ?? ''" :label="'Nama Agenda'" :col="12" :attr="['required']"/>
    <x-input :type="'text'" :name="'tanggal_mulai'" :value="$agenda->tanggal_mulai ?? ''" :label="'Tanggal Mulai'" :col="4" :attr="['required']"/>
    <x-input :type="'text'" :name="'tanggal_selesai'" :value="$agenda->tanggal_selesai ?? ''" :label="'Tanggal Selesai'" :col="4" :attr="['required']"/>
    <x-input :value="$agenda->kepesertaan??''" :name="'kepesertaan'" :col="4" :label="'Kepesertaan'" :type="'select'" :attr="['required']" :options="['kelompok'=>'Kelompok','perorangan'=>'Perorangan']" />
    <x-input :value="$agenda->kategori??''" :name="'kategori'" :col="6" :label="'Kategori'" :type="'select'" :attr="['required']" :options="['putra'=>'Putra','putri'=>'Putri','campuran'=>'Campuran']" />
    <x-input :value="$agenda->tingkat??''" :name="'tingkat'" :col="6" :label="'Admin pendaftaran agenda'" :type="'select'" :attr="['required']" :options="['provinsi'=>'Provinsi','kabupaten'=>'Kabupaten','kecamatan'=>'Kecamatan','gudep'=>'gudep']" />
    <div class="col-6 mb-3 lomba">
        <label>Jenis Penilaian Lomba</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="penilaian" value="vote" id="penilaian1" checked>
            <label class="form-check-label" for="penilaian1">Suara Terbanyak</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="penilaian" value="objective" id="penilaian2">
            <label class="form-check-label" for="penilaian2">Objective</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="penilaian" value="subjective" id="penilaian3">
            <label class="form-check-label" for="penilaian3">Subjective</label>
        </div>
    </div>
    <x-input :type="'textarea'" :name="'deskripsi'" :label="'Deskripsi Agenda'" :value="$agenda->deskripsi ?? ''" :col="12" :attr="['required']"/>
    <x-input :type="'textarea'" :name="'alamat'" :label="'Alamat (optional)'" :value="$agenda->alamat ?? ''" :col="12"/>
    <hr>
    <x-input :type="'file'" :name="'foto'" :label="'Foto Banner Agenda'" :col="6"/>
    <div class="col-6">
        <img src="{{ !empty($agenda)?asset('berkas/agenda/'.$agenda->foto):'https://via.placeholder.com/300x180' }}" class="img-fluid" id="img-preview" style="width:300px; height:180px">
    </div>
</div>

@push('scripts')
    <script>
        $('#jenis').change(function (e) {
            var val = $(this).val();
            if (val=='lomba') {
                $('.lomba').show();
            }else{
                $('.lomba').hide();
            }
        });
        $('.lomba').hide();
    </script>
@endpush
