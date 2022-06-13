@php
    $role = $data[1];
    if ($role=='Provinsi') {
        $options = $data[0]->regency->pluck('name','id')->toArray();
    }elseif($role=='Kabupaten'){
        $options = $data[0]->district->pluck('name','id')->toArray();
    }else{
        $options = $data[0];
    }
@endphp
<div class="row">
    <x-input :name="'npsn'" :col="6" :label="'NPSN'" :type="'text'" :attr="['required']" />
    <x-input :name="'nama_sekolah'" :col="6" :label="'Nama Sekolah'" :type="'text'" :attr="['required']" />
    <x-input :name="'no_putra'" :col="6" :label="'Nomor Putra'" :type="'text'" :attr="['required']" />
    <x-input :name="'no_putri'" :col="6" :label="'Nomor Putri'" :type="'text'" :attr="['required']" />
    <x-input :name="'nama_gudep_putra'" :col="6" :label="'Nama Gudep Putra'" :type="'text'" :attr="['required']" />
    <x-input :name="'nama_gudep_putri'" :col="6" :label="'Nama Gudep Putri'" :type="'text'" :attr="['required']" />
    @if ($role=='Provinsi')
        <input type="hidden" name="provinsi" value="{{ $data[0]->id }}">
        <x-input :name="'kabupaten'" :col="6" :label="'Kabupaten'" :type="'select'" :attr="['required']" :options="$options"/>
        <x-input :name="'kecamatan'" :col="6" :label="'Kecamatan'" :type="'select'" :attr="['required']" :options="[]" />
    @elseif($role=='Kabupaten')
        <input type="hidden" name="provinsi" value="{{ $data[0]->province_id }}">
        <input type="hidden" name="kabupaten" value="{{ $data[0]->id }}">
        <x-input :name="'kecamatan'" :col="12" :label="'Kecamatan'" :type="'select'" :attr="['required']" :options="$options" />
    @elseif($role=='Kecamatan')
        <input type="hidden" name="provinsi" value="{{ $data[0]->regency->province_id }}">
        <input type="hidden" name="kabupaten" value="{{ $data[0]->regency_id }}">
        <input type="hidden" name="kecamatan" value="{{ $data[0]->id }}" :attr="['required']">
    @else
        <x-input :name="'provinsi'" :col="4" :label="'Provinsi'" :type="'select'" :attr="['required']" :options="$options"/>
        <x-input :name="'kabupaten'" :col="4" :label="'Kabupaten'" :type="'select'" :attr="['required']" :options="[]"/>
        <x-input :name="'kecamatan'" :col="4" :label="'Kecamatan'" :type="'select'" :attr="['required']" :options="[]" />
    @endif
</div>
