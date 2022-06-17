<div id="tab-1">
    <div class="my-2">
        <div class="text-center justify-content-center">
            <button class="rounded-circle btn btn-primary">1</button>
            <p>Upload File Excel</p>
        </div>
        <div class="alert alert-light">
            <ol>
                <li class=" fs-2"><a href="{{ asset('berkas/data_anggota.xlsx') }}">Download Template Excel</a></li>
                <li class=" fs-2">Upload pada form dibawah</li>
                <li class=" fs-2">Jika ada <i>error</i>, harap check pesan <i>error</i> dan perbaiki data</li>
                <li class=" fs-2">Jika tidak ada <i>error</i>, maka akan ke langkah selanjutnya</li>
            </ol>
        </div>
    </div>
    <div class="dropzone" id="my-dropzone-excel"></div>
</div>
<div id="tab-2">
    <div class="my-2">
        <div class="text-center justify-content-center">
            <button class="rounded-circle btn btn-primary">2</button>
            <p>Upload File Foto</p>
        </div>
        <div class="alert alert-light">
            <ol>
                <li class="fs-2">Import foto otomatis menyesuaikan data anggota, diurutkan berdasarkan baris file .csv/.xlxs </li>
                <li class="fs-2">Pastikan foto sesuai dengan urutan data CSV/EXCEL, Maksimum 100 Foto</li>
                <li class="fs-2">Urutan nama file adalah A-Z > a-z</li>
                <li class="fs-2">contoh: a.jpg, b.jpg, c.jpg ...</li>
            </ol>
        </div>
    </div>
    <div class="dropzone" id="my-dropzone-foto"></div>
</div>

