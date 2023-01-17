<div class="row">
    <x-input :type="'text'" :name="'nama'" :value="$agenda->nama ?? ''" :label="'Nama Agenda'" :col="12" :attr="['required']"/>
    <x-input :type="'text'" :name="'tanggal_mulai'" :value="$agenda->tanggal_mulai ?? ''" :label="'Tanggal Mulai'" :col="4" :attr="['required']"/>
    <x-input :type="'text'" :name="'tanggal_selesai'" :value="$agenda->tanggal_selesai ?? ''" :label="'Tanggal Selesai'" :col="4" :attr="['required']"/>
    <x-input :value="$agenda->kepesertaan??''" :name="'kepesertaan'" :col="4" :label="'Kepesertaan'" :type="'select'" :attr="['required']" :options="['kelompok'=>'Kelompok','perorangan'=>'Perorangan']" />
    <x-input :value="$agenda->kategori??''" :name="'kategori'" :col="6" :label="'Kategori'" :type="'select'" :attr="['required']" :options="['putra'=>'Putra','putri'=>'Putri','campuran'=>'Campuran']" />
    <x-input :value="$agenda->jenis??'non_lomba'" :name="'jenis'" :col="6" :label="'Jenis'" :type="'select'" :attr="['required']" :options="['non_lomba'=>'Non Lomba','lomba'=>'Lomba']" />
    <x-input :type="'textarea'" :name="'deskripsi'" :label="'Deskripsi Agenda'" :value="$agenda->deskripsi ?? ''" :col="12" :attr="['required']"/>
    <x-input :type="'textarea'" :name="'alamat (optional)'" :label="'Alamat'" :value="$agenda->alamat ?? ''" :col="12" :attr="['required']"/>
    <hr>
    <x-input :type="'file'" :name="'foto'" :label="'Foto Banner Agenda'" :col="6"/>
    <div class="col-6">
        <img src="{{ !empty($agenda)?asset('berkas/agenda/'.$agenda->foto):'https://via.placeholder.com/300x180' }}" class="img-fluid" id="img-preview" style="width:300px; height:180px">
    </div>
</div>
