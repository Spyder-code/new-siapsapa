<div class="row">

    <x-input :type="'text'" :name="'nama'" :value="$agenda->nama ?? ''" :label="'Nama Agenda'" :col="12" :attr="['required']"/>
    <x-input :type="'text'" :name="'tanggal_mulai'" :value="$agenda->tanggal_mulai ?? ''" :label="'Tanggal Mulai'" :col="4" :attr="['required']"/>
    <x-input :type="'text'" :name="'tanggal_selesai'" :value="$agenda->tanggal_selesai ?? ''" :label="'Tanggal Selesai'" :col="4" :attr="['required']"/>
    <x-input :value="$agenda->kepesertaan??''" :name="'kepesertaan'" :col="4" :label="'Kepesertaan'" :type="'select'" :attr="['required']" :options="['kelompok'=>'Kelompok','perorangan'=>'Perorangan']" />
    <x-input :value="$agenda->kategori??''" :name="'kategori'" :col="6" :label="'Kategori'" :type="'select'" :attr="['required']" :options="['putra'=>'Putra','putri'=>'Putri','campuran'=>'Campuran']" />
    <x-input :value="$agenda->jenis??'non_lomba'" :name="'jenis'" :col="6" :label="'Jenis'" :type="'select'" :attr="['required']" :options="['non_lomba'=>'Non Lomba']" />
    <x-input :type="'textarea'" :name="'deskripsi'" :label="'Deskripsi Agenda'" :value="$agenda->deskripsi ?? ''" :col="12" :attr="['required']"/>
    <x-input :type="'textarea'" :name="'alamat'" :label="'Alamat'" :value="$agenda->alamat ?? ''" :col="12" :attr="['required']"/>
    <p class="font-weight-bold text-primary fs-5">Wilayah</p>
    <hr>
    <x-input :value="$agenda->provinsi_id??''" :name="'provinsi_id'" :col="4" :label="'Provinsi'" :type="'select'" :attr="['required']" :options="$provinsi"/>
    <x-input :value="$agenda->kabupaten_id??''" :name="'kabupaten_id'" :col="4" :label="'Kabupaten'" :type="'select'" :attr="['required']" :options="[]"/>
    <x-input :value="$agenda->kecamatan_id??''" :name="'kecamatan_id'" :col="4" :label="'Kecamatan'" :type="'select'" :attr="['required']" :options="[]" />
    <x-input :type="'file'" :name="'foto'" :label="'Foto'" :col="6"/>
    <div class="col-6">
        <img src="{{ !empty($agenda)?asset('berkas/agenda/'.$agenda->foto):'https://via.placeholder.com/150' }}" class="img-fluid" id="img-preview" style="width:150px; height:180px">
    </div>
</div>
