<div class="row">
    <x-input :value="$product->nama ?? ''" :type="'text'" :name="'nama'" :label="'Nama Produk'" :attr="['required']"/>
    <x-input :value="$product->deskripsi ?? ''" :type="'textarea'" :name="'deskripsi'" :label="'Deskripsi Produk'" :attr="['required']"/>
    <x-input :value="$product->harga ?? ''" :col="6" :type="'number'" :name="'harga'" :label="'Harga Produk'" :attr="['required']"/>
    <x-input :value="$product->jumlah ?? ''" :col="6" :type="'number'" :name="'jumlah'" :label="'Stock Produk'" :attr="['required']"/>
    <x-input :type="'file'" :col="6" :name="'foto'" :label="'Foto Produk'" :attr="['required']"/>
    <div class="col-6">
        <img id="img-preview" src="{{ !empty($product)?asset('berkas/product/'. $product->foto):'https://via.placeholder.com/150' }}" class="img-fluid" style="height: 150px">
    </div>
</div>
