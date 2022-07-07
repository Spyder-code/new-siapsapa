<x-input :type="'number'" :name="'harga'" :label="'Harga KTA'" :value="$harga" :attr="['required']" />
<div class="col-6">
    <img src="{{ asset('berkas/kta') }}/{{ $kta['siaga']['depan']??'blank.png' }}" style="width: 50%; height:150px">
</div>
<div class="col-6">
    <img src="{{ asset('berkas/kta') }}/{{ $kta['siaga']['belakang']??'blank.png' }}" style="width: 50%; height:150px">
</div>
<x-input :type="'file'" :name="'siaga[]'" :label="'Siaga Depan'" :col="6"/>
<x-input :type="'file'" :name="'siaga[]'" :label="'Siaga Belakang'" :col="6"/>
<div class="col-6">
    <img src="{{ asset('berkas/kta') }}/{{ $kta['penggalang']['depan']??'blank.png' }}" style="width: 50%; height:150px">
</div>
<div class="col-6">
    <img src="{{ asset('berkas/kta') }}/{{ $kta['penggalang']['belakang']??'blank.png' }}" style="width: 50%; height:150px">
</div>
<x-input :type="'file'" :name="'penggalang[]'" :label="'Penggalang Depan'" :col="6"/>
<x-input :type="'file'" :name="'penggalang[]'" :label="'Penggalang Belakang'" :col="6"/>
<div class="col-6">
    <img src="{{ asset('berkas/kta') }}/{{ $kta['penegak']['depan']??'blank.png' }}" style="width: 50%; height:150px">
</div>
<div class="col-6">
    <img src="{{ asset('berkas/kta') }}/{{ $kta['penegak']['belakang']??'blank.png' }}" style="width: 50%; height:150px">
</div>
<x-input :type="'file'" :name="'penegak[]'" :label="'Penegak Depan'" :col="6"/>
<x-input :type="'file'" :name="'penegak[]'" :label="'Penegak Belakang'" :col="6"/>
<div class="col-6">
    <img src="{{ asset('berkas/kta') }}/{{ $kta['pandega']['depan']??'blank.png' }}" style="width: 50%; height:150px">
</div>
<div class="col-6">
    <img src="{{ asset('berkas/kta') }}/{{ $kta['pandega']['belakang']??'blank.png' }}" style="width: 50%; height:150px">
</div>
<x-input :type="'file'" :name="'pandega[]'" :label="'Pandega Depan'" :col="6"/>
<x-input :type="'file'" :name="'pandega[]'" :label="'Pandega Belakang'" :col="6"/>
<div class="col-6">
    <img src="{{ asset('berkas/kta') }}/{{ $kta['dewasa']['depan']??'blank.png' }}" style="width: 50%; height:150px">
</div>
<div class="col-6">
    <img src="{{ asset('berkas/kta') }}/{{ $kta['dewasa']['belakang']??'blank.png' }}" style="width: 50%; height:150px">
</div>
<x-input :type="'file'" :name="'dewasa[]'" :label="'Dewasa Depan'" :col="6"/>
<x-input :type="'file'" :name="'dewasa[]'" :label="'Dewasa Belakang'" :col="6"/>

