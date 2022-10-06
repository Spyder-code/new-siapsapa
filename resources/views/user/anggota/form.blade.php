@php
    $options = $provinsi;
    $options1 = [];
    $options2 = [];
    $options3 = [];
    if(!empty($anggota)){
        $options = $provinsi;
        $options1 = $anggota->province->regency->pluck('name','id')->toArray();
        $options2 = $anggota->city->district->pluck('name','id')->toArray();
        $options3 = $anggota->district->gudep->pluck('nama_sekolah','id')->toArray();
    }
@endphp
<div class="row">
    <p class="font-weight-bold text-primary fs-5">1. Data Personal.</p>
    <hr>
    <x-input :type="'text'" :name="'nama'" :value="$anggota->nama ?? ''" :label="'Nama Lengkap'" :col="6" :attr="['required']"/>
    <x-input :type="'text'" :name="'tgl_lahir'" :value="$anggota->tgl_lahir ?? ''" :label="'Tanggal Lahir'" :col="6" :attr="['required']"/>
    <x-input :type="'text'" :name="'tempat_lahir'" :value="$anggota->tempat_lahir ?? ''" :label="'Tempat Lahir'" :col="6" :attr="['required']"/>
    <x-input :type="'select'" :name="'jk'" :label="'Jenis Kelamin'" :value="$anggota->jk ?? ''" :col="6" :options="['L'=>'Laki-laki','P'=>'Perempuan']" :attr="['required']"/>
    <x-input :type="'select'" :name="'kawin'" :label="'Status'" :value="$anggota->kawin ?? ''" :col="6" :options="[1=>'Nikah',0=>'Belum Nikah']" :attr="['required']"/>
    <x-input :type="'select'" :name="'gol_darah'" :label="'Golongan Darah'" :value="$anggota->gol_darah ?? ''" :col="6" :options="['-'=>'-','A'=>'A','B'=>'B','AB'=>'AB','O'=>'O']" :attr="['required']"/>
    <x-input :type="'select'" :name="'agama'" :label="'Agama'" :col="6" :value="$anggota->agama ?? ''" :options="['Islam'=>'Islam','Protestan'=>'Protestan','Katolik'=>'Katolik','Hindu'=>'Hindu','Budha'=>'Budha','Khonghucu'=>'Khonghucu']" :attr="['required']"/>
    <x-input :type="'text'" :name="'nohp'" :label="'No. Handphone'" :value="$anggota->nohp ?? ''" :col="6" :attr="['required']"/>
    <x-input :type="'textarea'" :name="'alamat'" :label="'Alamat'" :value="$anggota->alamat ?? ''" :col="12" :attr="['required']"/>

    <p class="font-weight-bold text-primary fs-5">2. Data Gugus.</p>
    <hr>
    <x-input :value="$anggota->provinsi??''" :name="'provinsi'" :col="4" :label="'Provinsi'" :type="'select'" :attr="['required']" :options="$options"/>
    <x-input :value="$anggota->kabupaten??''" :name="'kabupaten'" :col="4" :label="'Kabupaten'" :type="'select'" :attr="['required']" :options="$options1"/>
    <x-input :value="$anggota->kecamatan??''" :name="'kecamatan'" :col="4" :label="'Kecamatan'" :type="'select'" :attr="['required']" :options="$options2" />
    <x-input :value="$anggota->gudep??''" :name="'gudep'" :col="6" :label="'Gudep'" :type="'select'" :options="$options3" />
    <x-input :value="$anggota->status_anggota??''" :name="'status_anggota'" :col="6" :label="'Status Anggota'" :type="'select'" :attr="['required']" :options="['Anggota Baru'=>'Anggota Baru','Anggota Lama'=>'Anggota Lama']" />
    {{-- <div class="mb-3" id="kode-input">
        <div class="d-flex justify-content-between">
            <span class="text-sm">Nomor Anggota <small>(Contoh: 22.02.02.123.123456)</small></span>
            <span class="text-sm">Hasil</span>
        </div>
        <div class="d-flex gap-2">
            <input type="text" minlength="2" readonly style="width: 10%" id="one" class="form-control no-kta text-center max-two">
            <input type="text" minlength="2" readonly style="width: 10%" id="two" class="form-control no-kta text-center max-two">
            <input type="text" minlength="2" readonly style="width: 10%" id="three" class="form-control no-kta text-center max-two">
            <input type="text" minlength="3" readonly style="width: 15%" id="four" class="form-control no-kta text-center max-three">
            <input type="text" minlength="6" readonly style="width: 20%" id="five" class="form-control no-kta text-center max-six">
            <input type="text" name="kode" style="width: 35%" id="output" class="form-control text-center" readonly>
        </div>
    </div> --}}
    <p class="font-weight-bold text-primary fs-5">2. Data Akun.</p>
    <hr>
    <x-input :value="Auth::user()->email" :type="'email'" :name="'email'" :label="'Email'" :col="6" :attr="['required']"/>
    <x-input :value="$anggota->nik??''" :type="'text'" :name="'nik'" :label="'NIK'" :col="6" :attr="['required']"/>
    <x-input :type="'file'" :name="'foto'" :label="'Foto'" :col="6"/>
    <div class="col-6">
        <img src="{{ !empty($anggota)?asset('berkas/anggota/'.$anggota->foto):'https://via.placeholder.com/150' }}" class="img-fluid" id="img-preview" style="width:150px; height:180px">
    </div>
</div>
