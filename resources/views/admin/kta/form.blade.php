<x-input :type="'number'" :name="'harga'" :label="'Harga KTA'" :value="$harga" :attr="['required']" />
<div class="col-6">
    <img src="{{ $kta['siaga']['depan']??'http://via.placeholder.com/150' }}" style="width: 50%; height:150px">
</div>
<div class="col-6">
    <img src="{{ $kta['siaga']['belakang']??'http://via.placeholder.com/150' }}" style="width: 50%; height:150px">
</div>
<x-input :type="'file'" :name="'siaga[]'" :label="'Siaga Depan'" :col="6"/>
<x-input :type="'file'" :name="'siaga[]'" :label="'Siaga Belakang'" :col="6"/>
<div class="col-6">
    <img src="{{ $kta['penggalang']['depan']??'http://via.placeholder.com/150' }}" style="width: 50%; height:150px">
</div>
<div class="col-6">
    <img src="{{ $kta['penggalang']['belakang']??'http://via.placeholder.com/150' }}" style="width: 50%; height:150px">
</div>
<x-input :type="'file'" :name="'penggalang[]'" :label="'Penggalang Depan'" :col="6"/>
<x-input :type="'file'" :name="'penggalang[]'" :label="'Penggalang Belakang'" :col="6"/>
<div class="col-6">
    <img src="{{ $kta['penegak']['depan']??'http://via.placeholder.com/150' }}" style="width: 50%; height:150px">
</div>
<div class="col-6">
    <img src="{{ $kta['penegak']['belakang']??'http://via.placeholder.com/150' }}" style="width: 50%; height:150px">
</div>
<x-input :type="'file'" :name="'penegak[]'" :label="'Penegak Depan'" :col="6"/>
<x-input :type="'file'" :name="'penegak[]'" :label="'Penegak Belakang'" :col="6"/>
<div class="col-6">
    <img src="{{ $kta['pandega']['depan']??'http://via.placeholder.com/150' }}" style="width: 50%; height:150px">
</div>
<div class="col-6">
    <img src="{{ $kta['pandega']['belakang']??'http://via.placeholder.com/150' }}" style="width: 50%; height:150px">
</div>
<x-input :type="'file'" :name="'pandega[]'" :label="'Pandega Depan'" :col="6"/>
<x-input :type="'file'" :name="'pandega[]'" :label="'Pandega Belakang'" :col="6"/>
<div class="col-6">
    <img src="{{ $kta['dewasa']['depan']??'http://via.placeholder.com/150' }}" style="width: 50%; height:150px">
</div>
<div class="col-6">
    <img src="{{ $kta['dewasa']['belakang']??'http://via.placeholder.com/150' }}" style="width: 50%; height:150px">
</div>
<x-input :type="'file'" :name="'dewasa[]'" :label="'Dewasa Depan'" :col="6"/>
<x-input :type="'file'" :name="'dewasa[]'" :label="'Dewasa Belakang'" :col="6"/>

