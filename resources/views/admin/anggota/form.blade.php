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
    <x-input :type="'text'" :name="'nama'" :value="$anggota->nama ?? ''" :label="'Nama Lengkap'" :col="4" :attr="['required']"/>
    <x-input :type="'text'" :name="'tgl_lahir'" :value="$anggota->tgl_lahir ?? ''" :label="'Tanggal Lahir'" :col="4" :attr="['required']"/>
    <x-input :type="'text'" :name="'tempat_lahir'" :value="$anggota->tempat_lahir ?? ''" :label="'Tempat Lahir'" :col="4" :attr="['required']"/>
    <x-input :type="'select'" :name="'jk'" :label="'Jenis Kelamin'" :value="$anggota->jk ?? ''" :col="4" :options="['Laki-Laki'=>'Laki-laki','Perempuan'=>'Perempuan']" :attr="['required']"/>
    <x-input :type="'select'" :name="'kawin'" :label="'Status'" :value="$anggota->kawin ?? ''" :col="4" :options="[1=>'Nikah',0=>'Belum Nikah']" :attr="['required']"/>
    <x-input :type="'select'" :name="'gol_darah'" :label="'Golongan Darah'" :value="$anggota->gol_darah ?? ''" :col="4" :options="['-'=>'-','A'=>'A','B'=>'B','AB'=>'AB','O'=>'O']" :attr="['required']"/>
    <x-input :type="'select'" :name="'agama'" :label="'Agama'" :col="4" :value="$anggota->agama ?? ''" :options="['Islam'=>'Islam','Protestan'=>'Protestan','Katolik'=>'Katolik','Hindu'=>'Hindu','Budha'=>'Budha','Khonghucu'=>'Khonghucu']" :attr="['required']"/>
    <x-input :type="'text'" :name="'nohp'" :label="'No. Handphone'" :value="$anggota->nohp ?? ''" :col="4" :attr="['required']"/>
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
    @if (Auth::user()->role != 'gudep')
    <x-input :value="$anggota->gudep??''" :name="'gudep'" :col="6" :label="'Gudep'" :type="'select'" :options="$options3" />
    @else
        <input type="hidden" name="gudep" value="{{ Auth::user()->anggota->gudep }}">
    @endif
    <x-input :value="$anggota->status_anggota??''" :name="'status_anggota'" :col="6" :label="'Status Anggota'" :type="'select'" :attr="['required']" :options="['Anggota Baru'=>'Anggota Baru','Anggota Lama'=>'Anggota Lama']" />
    <div class="mb-3" id="kode-input">
        <div class="d-flex justify-content-between">
            <span class="text-sm">Nomor Anggota <small>(Contoh: 22.02.02.123.123456)</small></span>
            <span class="text-sm">Hasil</span>
        </div>
        <div class="d-flex gap-2">
            <input type="text" minlength="2" style="width: 10%" id="one" class="form-control no-kta text-center max-two">
            <input type="text" minlength="2" style="width: 10%" id="two" class="form-control no-kta text-center max-two">
            <input type="text" minlength="2" style="width: 10%" id="three" class="form-control no-kta text-center max-two">
            <input type="text" minlength="3" style="width: 15%" id="four" class="form-control no-kta text-center max-three">
            <input type="text" minlength="6" style="width: 20%" id="five" class="form-control no-kta text-center max-six">
            <input type="text" name="kode" style="width: 35%" id="output" class="form-control text-center" readonly>
        </div>
    </div>
    <p class="font-weight-bold text-primary fs-5">2. Data Akun.</p>
    <hr>
    <x-input :value="$anggota->email??''" :type="'email'" :name="'email'" :label="'Email'" :col="6" :attr="['required']"/>
    <x-input :value="$anggota->nik??''" :type="'text'" :name="'nik'" :label="'NIK'" :col="6" :attr="['required']"/>
    <x-input :type="'file'" :name="'foto'" :label="'Foto'" :col="6"/>
    <div class="col-6">
        <img src="{{ !empty($anggota)?asset('berkas/anggota/'.$anggota->foto):'https://via.placeholder.com/150' }}" class="img-fluid" id="img-preview" style="width:150px; height:180px">
    </div>
</div>
@php
    $anggotaAdmin = Auth::user()->anggota;
        $is_gudep = $anggotaAdmin->gudep;
        $gender = $anggotaAdmin->jk;
        if($is_gudep!=null){
            if($gender=='Perempuan'){
                $gudep = $anggotaAdmin->gudepInfo->no_putri;
            }else{
                $gudep = $anggotaAdmin->gudepInfo->no_putra;
            }
        }else{
            $gudep = '000';
        }
        $role = Auth::user()->role;
        $provinsi = $anggotaAdmin->province->no_prov;
        $kabupaten = $anggotaAdmin->city->no_kab;
        $kecamatan = $anggotaAdmin->district->no_kec;
@endphp

@push('scripts')
<script>
    var role = @json($role);
    var provinsi = @json($provinsi);
    var kabupaten = @json($kabupaten);
    var kecamatan = @json($kecamatan);
    var gudep = @json($gudep);


    if (role=='gudep') {
        $('#one').val(provinsi).attr('readonly',true);
        $('#two').val(kabupaten).attr('readonly',true);
        $('#three').val(kecamatan).attr('readonly',true);
        $('#four').val(gudep).attr('readonly',true);
    } else if(role=='kwaran') {
        $('#one').val(provinsi).attr('readonly',true);
        $('#two').val(kabupaten).attr('readonly',true);
        $('#three').val(kecamatan).attr('readonly',true);
    }else if(role=='kwarcab'){
        $('#one').val(provinsi).attr('readonly',true);
        $('#two').val(kabupaten).attr('readonly',true);
    }else if(role=='kwarda'){
        $('#one').val(provinsi).attr('readonly',true);
    }else if(role=='admin'){
        $('#one').val('');
        $('#two').val('');
        $('#three').val('');
        $('#four').val('');
        $('#five').val('');
        $('#kode').val('');
    }else{
        $('#one').val('').attr('readonly',true);
        $('#two').val('').attr('readonly',true);
        $('#three').val('').attr('readonly',true);
        $('#four').val('').attr('readonly',true);
        $('#five').val('').attr('readonly',true);
        $('#kode').val('').attr('readonly',true);
    }
    $('.max-two').keyup(function (e) {
            var val = $(this).val();
            if (val.length > 2) {
                $(this).val(val.substring(0, 2));
            }
        });
        $('.max-three').keyup(function (e) {
            var val = $(this).val();
            if (val.length > 3) {
                $(this).val(val.substring(0, 3));
            }
        });
        $('.max-six').keyup(function (e) {
            var val = $(this).val();
            if (val.length > 6) {
                $(this).val(val.substring(0, 6));
            }
        });
        $('.no-kta').keyup(function (e) {
            var one = $('#one').val();
            var two = $('#two').val();
            var three = $('#three').val();
            var four = $('#four').val();
            var five = $('#five').val();
            var output = one+"."+two+"."+three+"."+four+"."+five;
            $('#output').val(output);
        });
        $('#kode-input').hide();
        $('select[name="status_anggota"]').change(function (e) {
            var val = $(this).val();
            if(val=='Anggota Baru'){
                $('#kode-input').hide();
            }else{
                $('#kode-input').show();
            }
        });
</script>
@endpush
