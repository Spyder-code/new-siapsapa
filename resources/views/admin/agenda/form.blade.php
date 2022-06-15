@php
    $role = $data[1];
    if ($role=='Provinsi') {
        $options = $data[0]->regency->pluck('name','id')->toArray();
        $options1 = [];
        if (!empty($agenda)) {
            $options1 = $agenda->city->district->pluck('name','id');
        }
    }elseif($role=='Kabupaten'){
        $options = $data[0]->district->pluck('name','id')->toArray();
    }else{
        $options = $data[0];
        $options1 = [];
        $options2 = [];
        if (!empty($agenda)) {
            $options1 = $agenda->province->regency->pluck('name','id');
            $options2 = $agenda->city->district->pluck('name','id');
        }
    }
@endphp
<div class="row">

    <x-input :type="'text'" :name="'nama'" :value="$agenda->nama ?? ''" :label="'Nama Agenda'" :col="12" :attr="['required']"/>
    <x-input :type="'text'" :name="'tgl_mulai'" :value="$agenda->tgl_mulai ?? ''" :label="'Tanggal Mulai'" :col="4" :attr="['required']"/>
    <x-input :type="'text'" :name="'tgl_selesai'" :value="$agenda->tgl_selesai ?? ''" :label="'Tanggal Selesai'" :col="4" :attr="['required']"/>
    <x-input :value="$agenda->kepesertaan??''" :name="'kepesertaan'" :col="4" :label="'Kepesertaan'" :type="'select'" :attr="['required']" :options="['kelompok'=>'Kelompok','perorangan'=>'Perorangan']" />
    <x-input :value="$agenda->kategori??''" :name="'kategori'" :col="6" :label="'Kategori'" :type="'select'" :attr="['required']" :options="['putra'=>'Putra','putri'=>'Putri','campuran'=>'Campuran']" />
    <x-input :value="$agenda->jenis??'non_lomba'" :name="'kategori'" :col="6" :label="'Jenis'" :type="'select'" :attr="['required']" :options="['non_lomba'=>'Non Lomba']" />
    <x-input :type="'textarea'" :name="'deskripsi'" :label="'Deskripsi Agenda'" :value="$agenda->deskripsi ?? ''" :col="12" :attr="['required']"/>
    <x-input :type="'textarea'" :name="'alamat'" :label="'Alamat'" :value="$agenda->alamat ?? ''" :col="12" :attr="['required']"/>
    <p class="font-weight-bold text-primary fs-5">Wilayah</p>
    <hr>
    @if ($role=='Provinsi')
        <input type="hidden" name="provinsi" value="{{ $data[0]->id }}">
        <x-input :value="$agenda->kabupaten_id??''" :name="'kabupaten_id'" :col="6" :label="'Kabupaten'" :type="'select'" :attr="['required']" :options="$options"/>
        <x-input :value="$agenda->kecamatan_id??''" :name="'kecamatan_id'" :col="6" :label="'Kecamatan'" :type="'select'" :attr="['required']" :options="$options1" />
    @elseif($role=='Kabupaten')
        <input type="hidden" name="provinsi" value="{{ $data[0]->province_id }}">
        <input type="hidden" name="kabupaten" value="{{ $data[0]->id }}">
        <x-input :value="$agenda->kecamatan_id??''" :name="'kecamatan_id'" :col="12" :label="'Kecamatan'" :type="'select'" :attr="['required']" :options="$options" />
    @elseif($role=='Kecamatan')
        <input type="hidden" name="provinsi" value="{{ $data[0]->regency->province_id }}">
        <input type="hidden" name="kabupaten" value="{{ $data[0]->regency_id }}">
        <input type="hidden" name="kecamatan" value="{{ $data[0]->id }}" :attr="['required']">
    @else
        <x-input :value="$agenda->provinsi??''" :name="'provinsi_id'" :col="4" :label="'Provinsi'" :type="'select'" :attr="['required']" :options="$options"/>
        <x-input :value="$agenda->kabupaten_id??''" :name="'kabupaten_id'" :col="4" :label="'Kabupaten'" :type="'select'" :attr="['required']" :options="$options1"/>
        <x-input :value="$agenda->kecamatan_id??''" :name="'kecamatan_id'" :col="4" :label="'Kecamatan'" :type="'select'" :attr="['required']" :options="$options2" />
    @endif
    <x-input :type="'file'" :name="'foto'" :label="'Foto'" :col="6"/>
    <div class="col-6">
        <img src="{{ !empty($agenda)?asset('berkas/anggota/'.$agenda->foto):'https://via.placeholder.com/150' }}" class="img-fluid" id="img-preview" style="width:150px; height:180px">
    </div>
</div>
