@extends('layouts.admin')
@section('breadcrumb')
    <x-breadcrumb
        :links="[
            ['name' => 'Dashboard', 'url' => 'da'],
            ['name' => 'Kwartir', 'url' => 'sa'],
        ]"

        :title="'Wilayah '.$title"
        :description="'Data statistik wilayah'. $title"
    />
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">List Wilayah</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered display file-export" style="width: 100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pelapor</th>
                                <th>Content</th>
                                <th>Privasi</th>
                                <th></th>
                                <th>#</th>
                                <th>Tipe</th>
                                <th>Kategori</th>
                                <th>Tujuan Divisi</th>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Dibuat Tanggal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        var table = $(".file-export").DataTable({
        columnDefs: [{
            targets: [0,1,2,3,12],
            className: 'text-danger',
            visible: false
        }],
        dom: "Bfrtip",
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        buttons: ["pageLength","copy", "csv", "excel", "pdf", "print"],
        "bLengthChange": true,
    });

    $(".buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel, .buttons-collection "
    ).addClass("btn btn-primary m-1");
    $(".buttons-collection ").addClass("btn btn-info m-1");
    </script>
@endsection
