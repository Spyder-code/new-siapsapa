<div class="row">
    <x-input :type="'text'" :name="'penerima'" :value="$transaction->penerima ?? ''" :label="'Nama Penerima'" :col="6" :attr="['required']"/>
    <x-input :type="'text'" :name="'phone'" :value="$transaction->phone ?? ''" :label="'Nomor Telepone'" :col="6" :attr="['required']"/>
    <x-input :type="'textarea'" :name="'alamat'" :label="'Alamat lengkap'" :value="$transaction->alamat ?? ''" :col="12" :attr="['required']"/>
    <x-input :type="'text'" :name="'kota'" :value="$transaction->kota ?? ''" :label="'Kota'" :col="6" :attr="['required']"/>
    <x-input :type="'text'" :name="'kode_pos'" :value="$transaction->kode_pos ?? ''" :label="'Kode Pos'" :col="6" :attr="['required']"/>
    <x-input :type="'text'" :name="'total'" :value="'Rp. '.number_format($total) ?? ''" :label="'Total Harga'" :col="12" :attr="['required','readonly']"/>
    <hr>
</div>
