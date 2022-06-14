@php
    $role = $data[1];
    if ($role=='Provinsi') {
        $options = $data[0]->regency->pluck('name','id')->toArray();
        $options1 = [];
        if (!empty($anggota)) {
            $options1 = $anggota->city->district->pluck('name','id');
        }
    }elseif($role=='Kabupaten'){
        $options = $data[0]->district->pluck('name','id')->toArray();
    }else{
        $options = $data[0];
        $options1 = [];
        $options2 = [];
        if (!empty($anggota)) {
            $options1 = $anggota->province->regency->pluck('name','id');
            $options2 = $anggota->city->district->pluck('name','id');
        }
    }

    $options3 = [];
    if (!empty($anggota)) {
        if($anggota->gudep!=null){
            $options3 = $anggota->gudepInfo->pluck('nama_sekolah','id');
        }
    }
@endphp
<div class="row">
    <p class="font-weight-bold text-primary fs-5">1. Data Personal.</p>
    <hr>
    <x-input :type="'text'" :name="'nama'" :value="$anggota->nama ?? ''" :label="'Nama Lengkap'" :col="3" :attr="['required']"/>
    <x-input :type="'text'" :name="'tgl_lahir'" :value="$anggota->tgl_lahir ?? ''" :label="'Tanggal Lahir'" :col="3" :attr="['required']"/>
    <x-input :type="'text'" :name="'tempat_lahir'" :value="$anggota->tempat_lahir ?? ''" :label="'Tempat Lahir'" :col="3" :attr="['required']"/>
    <x-input :type="'select'" :name="'jk'" :label="'Jenis Kelamin'" :value="$anggota->jk ?? ''" :col="3" :options="['Laki-Laki'=>'Laki-laki','Perempuan'=>'Perempuan']" :attr="['required']"/>
    <x-input :type="'select'" :name="'kawin'" :label="'Status'" :value="$anggota->kawin ?? ''" :col="3" :options="[1=>'Nikah',0=>'Belum Nikah']" :attr="['required']"/>
    <x-input :type="'select'" :name="'gol_darah'" :label="'Golongan Darah'" :value="$anggota->gol_darah ?? ''" :col="3" :options="['-'=>'-','A'=>'A','B'=>'B','AB'=>'AB','O'=>'O']" :attr="['required']"/>
    <x-input :type="'select'" :name="'agama'" :label="'Agama'" :col="3" :value="$anggota->agama ?? ''" :options="['Islam'=>'Islam','Protestan'=>'Protestan','Katolik'=>'Katolik','Hindu'=>'Hindu','Budha'=>'Budha','Khonghucu'=>'Khonghucu']" :attr="['required']"/>
    <x-input :type="'text'" :name="'nohp'" :label="'No. Handphone'" :value="$anggota->nohp ?? ''" :col="3" :attr="['required']"/>
    <x-input :type="'textarea'" :name="'alamat'" :label="'Alamat'" :value="$anggota->alamat ?? ''" :col="12" :attr="['required']"/>
    <p class="font-weight-bold text-primary fs-5">2. Data Gugus.</p>
    <hr>
    @if ($role=='Provinsi')
        <input type="hidden" name="provinsi" value="{{ $data[0]->id }}">
        <x-input :value="$anggota->kabupaten??''" :name="'kabupaten'" :col="6" :label="'Kabupaten'" :type="'select'" :attr="['required']" :options="$options"/>
        <x-input :value="$anggota->kecamatan??''" :name="'kecamatan'" :col="6" :label="'Kecamatan'" :type="'select'" :attr="['required']" :options="$options1" />
    @elseif($role=='Kabupaten')
        <input type="hidden" name="provinsi" value="{{ $data[0]->province_id }}">
        <input type="hidden" name="kabupaten" value="{{ $data[0]->id }}">
        <x-input :value="$anggota->kecamatan??''" :name="'kecamatan'" :col="12" :label="'Kecamatan'" :type="'select'" :attr="['required']" :options="$options" />
    @elseif($role=='Kecamatan')
        <input type="hidden" name="provinsi" value="{{ $data[0]->regency->province_id }}">
        <input type="hidden" name="kabupaten" value="{{ $data[0]->regency_id }}">
        <input type="hidden" name="kecamatan" value="{{ $data[0]->id }}" :attr="['required']">
    @else
        <x-input :value="$anggota->provinsi??''" :name="'provinsi'" :col="4" :label="'Provinsi'" :type="'select'" :attr="['required']" :options="$options"/>
        <x-input :value="$anggota->kabupaten??''" :name="'kabupaten'" :col="4" :label="'Kabupaten'" :type="'select'" :attr="['required']" :options="$options1"/>
        <x-input :value="$anggota->kecamatan??''" :name="'kecamatan'" :col="4" :label="'Kecamatan'" :type="'select'" :attr="['required']" :options="$options2" />
    @endif
    <x-input :value="$anggota->gudep??''" :name="'gudep'" :col="6" :label="'Gudep'" :type="'select'" :options="$options3" />
    <x-input :value="$anggota->status_anggota??''" :name="'status_anggota'" :col="6" :label="'Status Anggota'" :type="'select'" :attr="['required']" :options="['Anggota Baru'=>'Anggota Baru','Anggota Lama'=>'Anggota Lama']" />
    <p class="font-weight-bold text-primary fs-5">2. Data Akun.</p>
    <hr>
    <x-input :value="$anggota->email??''" :type="'email'" :name="'email'" :label="'Email'" :col="6" :attr="['required']"/>
    <x-input :value="$anggota->nik??''" :type="'text'" :name="'nik'" :label="'NIK'" :col="6" :attr="['required']"/>
    <x-input :type="'file'" :name="'foto'" :label="'Foto'" :col="6"/>
    <div class="col-6">
        <img src="{{ !empty($anggota)?asset('berkas/anggota/'.$anggota->foto):'https://via.placeholder.com/150' }}" class="img-fluid" id="img-preview" style="width:150px; height:180px">
    </div>
</div>
