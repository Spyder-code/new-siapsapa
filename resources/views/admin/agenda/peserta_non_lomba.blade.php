<div class="col-12 col-md-8 mt-2">
    <div class="card">
        <div class="border-bottom title-part-padding">
            <h4 class="card-title mb-0">List Peserta {{ $agenda->nama }}</h4>
        </div>
        <div class="card-body">
            if
        </div>
    </div>
</div>
@if (Auth::id()==$agenda->created_by)
<div class="col-12 col-md-4 mt-2">
    <div class="card">
        <div class="border-bottom title-part-padding">
            <h4 class="card-title mb-0">Daftarkan Peserta</h4>
        </div>
        <div class="card-body">
            <div class="alert alert-danger" id="message-danger">
                <p id="message"></p>
            </div>
            <x-input :name="'nik'" :type="'text'" :id="'nik'" :label="'NIK atau Email'" :col="12" :attr="['required']"/>
            <div class="mb-3">
                <button type="button" class="btn btn-success" id="daftar">Daftarkan</button>
            </div>
        </div>
    </div>
</div>
@endif
