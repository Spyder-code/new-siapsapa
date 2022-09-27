@extends('layouts.admin')
@section('style')
<link rel="stylesheet" href="{{ asset('dashboard') }}/assets/libs/apexcharts/dist/apexcharts.css" />
@endsection
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => 'da'],
            ['name' => 'Kwartir', 'url' => route('kwartir.index', ['id_wilayah'=>$id_wilayah])],
        ]"

        :title="$kwartir.' '.ucfirst(strtolower($title))"
        :description="'Data statistik'.$kwartir.' '. ucfirst($title)"
    />
    <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
        <ul class="list-group list-group-horizontal">
            <li class="list-group-item">Total Anggota: <strong id="total-anggota">-</strong></li>
            @if($id_wilayah!='all')
                <li class="list-group-item">Total Admin: <strong id="total-admin">-</strong></li>
                <li class="list-group-item">
                    <a href="{{ route('kwartir.anggota',$id_wilayah) }}" style="font-size: .8rem" class="btn btn-sm btn-outline-success">
                        <i class="fa fa-plus-circle"></i> Tambah admin
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
@endsection
@section('content')
<style>
    td.table-pembina{
        background-color: #7f440860;
        vertical-align: middle;
    }
    td.table-pelatih{
        background-color: #2fb7cfab;
        vertical-align: middle;
    }
    td.table-siaga{
        background-color: #2fd94852;
        vertical-align: middle;
    }
    td.table-penggalang{
        background-color: #e21a1a8b;
        vertical-align: middle;
    }
    td.table-penegak{
        background-color: #e28b1a8b;
        vertical-align: middle;
    }
    td.table-pandega{
        background-color: #dbe21a8b;
        vertical-align: middle;
    }
    tr.td,tr{
        background-color: white;
    }
</style>
<div class="cards">
    <div class="row">
        <div class="col-8">

            {{-- Kwartir --}}
            <div class="card">
                <div class="card-body">
                    <h4>{{ $kwartir.' '.ucfirst(strtolower($title)) }}</h4>
                    <hr>
                    <div class="row row-cols-1 row-cols-md-4 row-cols-xl-4">
                        <div class="col">
                            <div class="card shadow">
                                <div class="card-header bg-success">
                                    <div class="rounded-circle mx-auto bg-light-light text-success text-white text-center"><strong id="total-siaga">-</strong>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <p>TOTAL ANGGOTA AKTIF</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow">
                                <div class="card-header bg-danger">
                                    <div class="text-white text-center"><strong id="total-penggalang">-</strong>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <p>KWARTIR CABANG</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow">
                                <div class="card-header bg-warning">
                                    <div class="text-white text-center"><strong id="total-penegak">-</strong>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <p>KWARTIR RANTING</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow">
                                <div class="card-header" style="background-color: #e67300;">
                                    <div class="text-white text-center"><strong id="total-pandega">-</strong>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <p>GUGUS DEPAN</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Anggota Muda --}}
            <div class="card accordion" id="accordionExample">
                <div class="accordion-item">
                    <h4 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Anggota Muda
                        </button>
                    </h4>

                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body table-responsive bg-white">
                            <table class="table text-center table-bordered text-dark" id="tableData">
                                <thead>
                                    <tr>
                                        <th class="table-secondary" scope="col" colspan="2">Golongan</th>
                                        <th class="table-secondary" scope="col">Laki-laki</th>
                                        <th class="table-secondary" scope="col">Perempuan</th>
                                        <th class="table-secondary" scope="col">Jumlah</th>
                                        <th class="table-secondary" scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $pramuka)
                                        @foreach ($pramuka->documentTypes as $item)
                                        <tr>
                                            @if ($loop->iteration==1)
                                            @php
                                                $lkk = $pramuka->anggotas()->where('jk','L')->count();
                                                $prr = $pramuka->anggotas()->where('jk','P')->count();
                                                $lk_count = 0;
                                                $pr_count = 0;
                                            @endphp
                                            <td scope="row" class="table-{{ strtolower($pramuka->name) }}" rowspan="{{ $pramuka->documentTypes->count() + 1 }}">
                                                {{ $pramuka->name }} <br><br>
                                                <span class="fw-normal" style="font-size: .7rem">L: {{ $lkk }}</span><br>
                                                <span class="fw-normal" style="font-size: .7rem">P: {{ $prr }}</span><br>
                                                <span class="fw-normal" style="font-size: .7rem">J: {{ $prr+$lkk }}</span>
                                            </td>
                                            @endif
                                            <td>{{ $item->name }}</td>
                                                @php
                                                    $lk = $item->documents()->whereHas('user', function($q){
                                                        $q->whereHas('anggota', function($q){
                                                            $q->where('jk', 'L');
                                                        });
                                                    })->count();
                                                    $pr = $item->documents()->whereHas('user', function($q){
                                                        $q->whereHas('anggota', function($q){
                                                            $q->where('jk', 'P');
                                                        });
                                                    })->count();
                                                    $lk_count += $lk;
                                                    $pr_count += $pr;
                                                @endphp
                                            <td>{{ $lk }}</td>
                                            <td>{{ $pr }}</td>
                                            <td>{{ $item->documents->count() }}</td>
                                            <td><a href="" class="btn btn-sm btn-info">Detail</a></td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td class="fw-bold">TOTAL</td>
                                            <td class="fw-bold">{{ $lk_count }}</td>
                                            <td class="fw-bold">{{ $pr_count }}</td>
                                            <td class="fw-bold">{{ $lk_count + $pr_count }}</td>
                                            <td class="fw-bold">#</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- Siaga --}}
                            {{-- <div class="row border border-success">
                                <div class="col-12 col-md-3 card-header bg-success">
                                    <div class="card shadow">
                                        <div class="card-header bg-success">
                                            <div class="rounded-circle mx-auto bg-light-light text-success text-white text-center">
                                                <strong id="total-siaga">2000</strong>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="text-center mt-2">
                                                <b>SIAGA</b><br>
                                                <span class="badge bg-secondary">P : 10</span>
                                                <span class="badge bg-secondary">L : 10</span>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-between">
                                            <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-9">
                                    <button class="w-100 btn btn-info btn-sm my-2">Load Data</button>
                                    <div class="d-flex gap-1 flex-wrap">
                                        <div class="card shadow justify-content-center mx-auto">
                                            <div class="card-header bg-success">
                                                <div class="rounded-circle mx-auto bg-light-light text-success text-white text-center">
                                                    <strong id="total-siaga" style="font-size: .8rem;">2000</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mt-2">
                                                    <b style="font-size: .7rem">MULA</b><br>
                                                    <span class="badge bg-secondary">P : 10</span>
                                                    <span class="badge bg-secondary">L : 10</span>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </div>
                                        <div class="card shadow justify-content-center mx-auto">
                                            <div class="card-header bg-success">
                                                <div class="rounded-circle mx-auto bg-light-light text-success text-white text-center">
                                                    <strong id="total-siaga" style="font-size: .8rem;">2000</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mt-2">
                                                    <b style="font-size: .7rem">MULA</b><br>
                                                    <span class="badge bg-secondary">P : 10</span>
                                                    <span class="badge bg-secondary">L : 10</span>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </div>
                                        <div class="card shadow justify-content-center mx-auto">
                                            <div class="card-header bg-success">
                                                <div class="rounded-circle mx-auto bg-light-light text-success text-white text-center">
                                                    <strong id="total-siaga" style="font-size: .8rem;">2000</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mt-2">
                                                    <b style="font-size: .7rem">MULA</b><br>
                                                    <span class="badge bg-secondary">P : 10</span>
                                                    <span class="badge bg-secondary">L : 10</span>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </div>
                                        <div class="card shadow justify-content-center mx-auto">
                                            <div class="card-header bg-success">
                                                <div class="rounded-circle mx-auto bg-light-light text-success text-white text-center">
                                                    <strong id="total-siaga" style="font-size: .8rem;">2000</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mt-2">
                                                    <b style="font-size: .7rem">MULA</b><br>
                                                    <span class="badge bg-secondary">P : 10</span>
                                                    <span class="badge bg-secondary">L : 10</span>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- Penggalang --}}
                            {{-- <div class="row border border-danger mt-1">
                                <div class="col-12 col-md-3 card-header bg-penggalang">
                                    <div class="card shadow">
                                        <div class="card-header bg-penggalang">
                                            <div class="rounded-circle mx-auto bg-light-light text-penggalang text-white text-center">
                                                <strong id="total-siaga">2000</strong>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="text-center mt-2">
                                                <b>SIAGA</b><br>
                                                <span class="badge bg-secondary">P : 10</span>
                                                <span class="badge bg-secondary">L : 10</span>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-between">
                                            <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-9">
                                    <button class="w-100 btn btn-info btn-sm my-2">Load Data</button>
                                    <div class="d-flex gap-1 flex-wrap">
                                        <div class="card shadow justify-content-center mx-auto">
                                            <div class="card-header bg-penggalang">
                                                <div class="rounded-circle mx-auto bg-light-light text-penggalang text-white text-center">
                                                    <strong id="total-siaga" style="font-size: .8rem;">2000</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mt-2">
                                                    <b style="font-size: .7rem">MULA</b><br>
                                                    <span class="badge bg-secondary">P : 10</span>
                                                    <span class="badge bg-secondary">L : 10</span>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </div>
                                        <div class="card shadow justify-content-center mx-auto">
                                            <div class="card-header bg-penggalang">
                                                <div class="rounded-circle mx-auto bg-light-light text-penggalang text-white text-center">
                                                    <strong id="total-siaga" style="font-size: .8rem;">2000</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mt-2">
                                                    <b style="font-size: .7rem">MULA</b><br>
                                                    <span class="badge bg-secondary">P : 10</span>
                                                    <span class="badge bg-secondary">L : 10</span>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </div>
                                        <div class="card shadow justify-content-center mx-auto">
                                            <div class="card-header bg-penggalang">
                                                <div class="rounded-circle mx-auto bg-light-light text-penggalang text-white text-center">
                                                    <strong id="total-siaga" style="font-size: .8rem;">2000</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mt-2">
                                                    <b style="font-size: .7rem">MULA</b><br>
                                                    <span class="badge bg-secondary">P : 10</span>
                                                    <span class="badge bg-secondary">L : 10</span>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </div>
                                        <div class="card shadow justify-content-center mx-auto">
                                            <div class="card-header bg-penggalang">
                                                <div class="rounded-circle mx-auto bg-light-light text-penggalang text-white text-center">
                                                    <strong id="total-siaga" style="font-size: .8rem;">2000</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mt-2">
                                                    <b style="font-size: .7rem">MULA</b><br>
                                                    <span class="badge bg-secondary">P : 10</span>
                                                    <span class="badge bg-secondary">L : 10</span>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- Penegak --}}
                            {{-- <div class="row border border-warning mt-1">
                                <div class="col-12 col-md-3 card-header bg-penegak">
                                    <div class="card shadow">
                                        <div class="card-header bg-penegak">
                                            <div class="rounded-circle mx-auto bg-light-light text-penegak text-white text-center">
                                                <strong id="total-siaga">2000</strong>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="text-center mt-2">
                                                <b>SIAGA</b><br>
                                                <span class="badge bg-secondary">P : 10</span>
                                                <span class="badge bg-secondary">L : 10</span>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-between">
                                            <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-9">
                                    <button class="w-100 btn btn-info btn-sm my-2">Load Data</button>
                                    <div class="d-flex gap-1 flex-wrap">
                                        <div class="card shadow justify-content-center mx-auto">
                                            <div class="card-header bg-penegak">
                                                <div class="rounded-circle mx-auto bg-light-light text-penegak text-white text-center">
                                                    <strong id="total-siaga" style="font-size: .8rem;">2000</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mt-2">
                                                    <b style="font-size: .7rem">MULA</b><br>
                                                    <span class="badge bg-secondary">P : 10</span>
                                                    <span class="badge bg-secondary">L : 10</span>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </div>
                                        <div class="card shadow justify-content-center mx-auto">
                                            <div class="card-header bg-penegak">
                                                <div class="rounded-circle mx-auto bg-light-light text-penegak text-white text-center">
                                                    <strong id="total-siaga" style="font-size: .8rem;">2000</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mt-2">
                                                    <b style="font-size: .7rem">MULA</b><br>
                                                    <span class="badge bg-secondary">P : 10</span>
                                                    <span class="badge bg-secondary">L : 10</span>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </div>
                                        <div class="card shadow justify-content-center mx-auto">
                                            <div class="card-header bg-penegak">
                                                <div class="rounded-circle mx-auto bg-light-light text-penegak text-white text-center">
                                                    <strong id="total-siaga" style="font-size: .8rem;">2000</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mt-2">
                                                    <b style="font-size: .7rem">MULA</b><br>
                                                    <span class="badge bg-secondary">P : 10</span>
                                                    <span class="badge bg-secondary">L : 10</span>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </div>
                                        <div class="card shadow justify-content-center mx-auto">
                                            <div class="card-header bg-penegak">
                                                <div class="rounded-circle mx-auto bg-light-light text-penegak text-white text-center">
                                                    <strong id="total-siaga" style="font-size: .8rem;">2000</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mt-2">
                                                    <b style="font-size: .7rem">MULA</b><br>
                                                    <span class="badge bg-secondary">P : 10</span>
                                                    <span class="badge bg-secondary">L : 10</span>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- Penegak --}}
                            {{-- <div class="row border border-warning mt-1">
                                <div class="col-12 col-md-3 card-header bg-pandega">
                                    <div class="card shadow">
                                        <div class="card-header bg-pandega">
                                            <div class="rounded-circle mx-auto bg-light-light text-pandega text-white text-center">
                                                <strong id="total-siaga">2000</strong>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="text-center mt-2">
                                                <b>SIAGA</b><br>
                                                <span class="badge bg-secondary">P : 10</span>
                                                <span class="badge bg-secondary">L : 10</span>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-between">
                                            <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-9">
                                    <button class="w-100 btn btn-info btn-sm my-2">Load Data</button>
                                    <div class="d-flex gap-1 flex-wrap">
                                        <div class="card shadow justify-content-center mx-auto">
                                            <div class="card-header bg-pandega">
                                                <div class="rounded-circle mx-auto bg-light-light text-pandega text-white text-center">
                                                    <strong id="total-siaga" style="font-size: .8rem;">2000</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mt-2">
                                                    <b style="font-size: .7rem">MULA</b><br>
                                                    <span class="badge bg-secondary">P : 10</span>
                                                    <span class="badge bg-secondary">L : 10</span>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </div>
                                        <div class="card shadow justify-content-center mx-auto">
                                            <div class="card-header bg-pandega">
                                                <div class="rounded-circle mx-auto bg-light-light text-pandega text-white text-center">
                                                    <strong id="total-siaga" style="font-size: .8rem;">2000</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mt-2">
                                                    <b style="font-size: .7rem">MULA</b><br>
                                                    <span class="badge bg-secondary">P : 10</span>
                                                    <span class="badge bg-secondary">L : 10</span>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </div>
                                        <div class="card shadow justify-content-center mx-auto">
                                            <div class="card-header bg-pandega">
                                                <div class="rounded-circle mx-auto bg-light-light text-pandega text-white text-center">
                                                    <strong id="total-siaga" style="font-size: .8rem;">2000</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mt-2">
                                                    <b style="font-size: .7rem">MULA</b><br>
                                                    <span class="badge bg-secondary">P : 10</span>
                                                    <span class="badge bg-secondary">L : 10</span>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </div>
                                        <div class="card shadow justify-content-center mx-auto">
                                            <div class="card-header bg-pandega">
                                                <div class="rounded-circle mx-auto bg-light-light text-pandega text-white text-center">
                                                    <strong id="total-siaga" style="font-size: .8rem;">2000</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mt-2">
                                                    <b style="font-size: .7rem">MULA</b><br>
                                                    <span class="badge bg-secondary">P : 10</span>
                                                    <span class="badge bg-secondary">L : 10</span>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Anggota Dewasa --}}
            <div class="card accordion" id="accordionDewasa">
                <div class="accordion-item">
                    <h4 class="accordion-header" id="headingTwo">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            Anggota Dewasa
                        </button>
                    </h4>

                    <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionDewasa">
                        <div class="accordion-body">
                            {{-- Pelatoh --}}
                            <div class="row border border-success">
                                <div class="col-12 col-md-3 card-header bg-pelatih">
                                    <div class="card shadow">
                                        <div class="card-header bg-pelatih">
                                            <div class="rounded-circle mx-auto bg-light-light text-success text-white text-center">
                                                <strong id="total-siaga">2000</strong>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="text-center mt-2">
                                                <b>PELATIH</b><br>
                                                <span class="badge bg-secondary">P : 10</span>
                                                <span class="badge bg-secondary">L : 10</span>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-between">
                                            <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-9">
                                    <button class="w-100 btn btn-info btn-sm my-2">Load Data</button>
                                    <div class="d-flex gap-1 flex-wrap">
                                        <div class="card shadow justify-content-center mx-auto">
                                            <div class="card-header bg-pelatih">
                                                <div class="rounded-circle mx-auto bg-light-light text-success text-white text-center">
                                                    <strong id="total-siaga" style="font-size: .8rem;">2000</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mt-2">
                                                    <b style="font-size: .7rem">MULA</b><br>
                                                    <span class="badge bg-secondary">P : 10</span>
                                                    <span class="badge bg-secondary">L : 10</span>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </div>
                                        <div class="card shadow justify-content-center mx-auto">
                                            <div class="card-header bg-pelatih">
                                                <div class="rounded-circle mx-auto bg-light-light text-success text-white text-center">
                                                    <strong id="total-siaga" style="font-size: .8rem;">2000</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mt-2">
                                                    <b style="font-size: .7rem">MULA</b><br>
                                                    <span class="badge bg-secondary">P : 10</span>
                                                    <span class="badge bg-secondary">L : 10</span>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </div>
                                        <div class="card shadow justify-content-center mx-auto">
                                            <div class="card-header bg-pelatih">
                                                <div class="rounded-circle mx-auto bg-light-light text-success text-white text-center">
                                                    <strong id="total-siaga" style="font-size: .8rem;">2000</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mt-2">
                                                    <b style="font-size: .7rem">MULA</b><br>
                                                    <span class="badge bg-secondary">P : 10</span>
                                                    <span class="badge bg-secondary">L : 10</span>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </div>
                                        <div class="card shadow justify-content-center mx-auto">
                                            <div class="card-header bg-pelatih">
                                                <div class="rounded-circle mx-auto bg-light-light text-success text-white text-center">
                                                    <strong id="total-siaga" style="font-size: .8rem;">2000</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mt-2">
                                                    <b style="font-size: .7rem">MULA</b><br>
                                                    <span class="badge bg-secondary">P : 10</span>
                                                    <span class="badge bg-secondary">L : 10</span>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Pembina --}}
                            <div class="row border border-danger mt-1">
                                <div class="col-12 col-md-3 card-header bg-pembina">
                                    <div class="card shadow">
                                        <div class="card-header bg-pembina">
                                            <div class="rounded-circle mx-auto bg-light-light text-penggalang text-white text-center">
                                                <strong id="total-siaga">2000</strong>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="text-center mt-2">
                                                <b>SIAGA</b><br>
                                                <span class="badge bg-secondary">P : 10</span>
                                                <span class="badge bg-secondary">L : 10</span>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-between">
                                            <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-9">
                                    <button class="w-100 btn btn-info btn-sm my-2">Load Data</button>
                                    <div class="d-flex gap-1 flex-wrap">
                                        <div class="card shadow justify-content-center mx-auto">
                                            <div class="card-header bg-pembina">
                                                <div class="rounded-circle mx-auto bg-light-light text-penggalang text-white text-center">
                                                    <strong id="total-siaga" style="font-size: .8rem;">2000</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mt-2">
                                                    <b style="font-size: .7rem">MULA</b><br>
                                                    <span class="badge bg-secondary">P : 10</span>
                                                    <span class="badge bg-secondary">L : 10</span>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </div>
                                        <div class="card shadow justify-content-center mx-auto">
                                            <div class="card-header bg-pembina">
                                                <div class="rounded-circle mx-auto bg-light-light text-penggalang text-white text-center">
                                                    <strong id="total-siaga" style="font-size: .8rem;">2000</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mt-2">
                                                    <b style="font-size: .7rem">MULA</b><br>
                                                    <span class="badge bg-secondary">P : 10</span>
                                                    <span class="badge bg-secondary">L : 10</span>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </div>
                                        <div class="card shadow justify-content-center mx-auto">
                                            <div class="card-header bg-pembina">
                                                <div class="rounded-circle mx-auto bg-light-light text-penggalang text-white text-center">
                                                    <strong id="total-siaga" style="font-size: .8rem;">2000</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mt-2">
                                                    <b style="font-size: .7rem">MULA</b><br>
                                                    <span class="badge bg-secondary">P : 10</span>
                                                    <span class="badge bg-secondary">L : 10</span>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </div>
                                        <div class="card shadow justify-content-center mx-auto">
                                            <div class="card-header bg-pembina">
                                                <div class="rounded-circle mx-auto bg-light-light text-penggalang text-white text-center">
                                                    <strong id="total-siaga" style="font-size: .8rem;">2000</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mt-2">
                                                    <b style="font-size: .7rem">MULA</b><br>
                                                    <span class="badge bg-secondary">P : 10</span>
                                                    <span class="badge bg-secondary">L : 10</span>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Pembantu --}}
                            <div class="row border border-warning mt-1">
                                <div class="col-12 col-md-3 card-header bg-pembantu">
                                    <div class="card shadow">
                                        <div class="card-header bg-pembantu">
                                            <div class="rounded-circle mx-auto bg-light-light text-penegak text-white text-center">
                                                <strong id="total-siaga">2000</strong>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="text-center mt-2">
                                                <b>SIAGA</b><br>
                                                <span class="badge bg-secondary">P : 10</span>
                                                <span class="badge bg-secondary">L : 10</span>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-between">
                                            <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-9">
                                    <button class="w-100 btn btn-info btn-sm my-2">Load Data</button>
                                    <div class="d-flex gap-1 flex-wrap">
                                        <div class="card shadow justify-content-center mx-auto">
                                            <div class="card-header bg-pembantu">
                                                <div class="rounded-circle mx-auto bg-light-light text-penegak text-white text-center">
                                                    <strong id="total-siaga" style="font-size: .8rem;">2000</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mt-2">
                                                    <b style="font-size: .7rem">MULA</b><br>
                                                    <span class="badge bg-secondary">P : 10</span>
                                                    <span class="badge bg-secondary">L : 10</span>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </div>
                                        <div class="card shadow justify-content-center mx-auto">
                                            <div class="card-header bg-pembantu">
                                                <div class="rounded-circle mx-auto bg-light-light text-penegak text-white text-center">
                                                    <strong id="total-siaga" style="font-size: .8rem;">2000</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mt-2">
                                                    <b style="font-size: .7rem">MULA</b><br>
                                                    <span class="badge bg-secondary">P : 10</span>
                                                    <span class="badge bg-secondary">L : 10</span>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </div>
                                        <div class="card shadow justify-content-center mx-auto">
                                            <div class="card-header bg-pembantu">
                                                <div class="rounded-circle mx-auto bg-light-light text-penegak text-white text-center">
                                                    <strong id="total-siaga" style="font-size: .8rem;">2000</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mt-2">
                                                    <b style="font-size: .7rem">MULA</b><br>
                                                    <span class="badge bg-secondary">P : 10</span>
                                                    <span class="badge bg-secondary">L : 10</span>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </div>
                                        <div class="card shadow justify-content-center mx-auto">
                                            <div class="card-header bg-pembantu">
                                                <div class="rounded-circle mx-auto bg-light-light text-penegak text-white text-center">
                                                    <strong id="total-siaga" style="font-size: .8rem;">2000</strong>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mt-2">
                                                    <b style="font-size: .7rem">MULA</b><br>
                                                    <span class="badge bg-secondary">P : 10</span>
                                                    <span class="badge bg-secondary">L : 10</span>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="" class="w-100 btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card p-3 my-3">
                <div class="card-header d-flex justify-content-between">
                    Fungsionaris Organisasi
                    <button type="button" class="btn btn-sm btn-info" onclick="statistikAnggota()"><i class="fas fa-redo"></i> Load Data</button>
                </div>
                <div id="organisasi" class="mt-2">
                    <div class="d-flex flex-wrap gap-2">
                        <ul class="list-group list-group-horizontal">
                            <li class="list-group-item">Test</li>
                            <li class="list-group-item">123</li>
                        </ul>
                        <ul class="list-group list-group-horizontal">
                            <li class="list-group-item">Test</li>
                            <li class="list-group-item">123</li>
                        </ul>
                        <ul class="list-group list-group-horizontal">
                            <li class="list-group-item">Test</li>
                            <li class="list-group-item">123</li>
                        </ul>
                        <ul class="list-group list-group-horizontal">
                            <li class="list-group-item">Test</li>
                            <li class="list-group-item">123</li>
                        </ul>
                        <ul class="list-group list-group-horizontal">
                            <li class="list-group-item">Test</li>
                            <li class="list-group-item">123</li>
                        </ul>
                        <ul class="list-group list-group-horizontal">
                            <li class="list-group-item">muhammad aziz almi</li>
                            <li class="list-group-item">123</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card p-3 my-3">
                <div class="card-header d-flex justify-content-between">
                    Statistik Anggota
                    <button type="button" class="btn btn-sm btn-info" onclick="statistikAnggota()"><i class="fas fa-redo"></i> Load Data</button>
                </div>
                <div id="total-laporan">
                </div>
            </div>
            <div class="card p-3 my-3">
                <div class="card-header d-flex justify-content-between">
                    Jumlah Anggota
                    <button type="button" class="btn btn-sm btn-info" onclick="jumlahAnggota()"><i class="fas fa-redo"></i> Load Data</button>
                </div>
                <div id="insert-data"></div>
            </div>
            <div class="card p-3 my-3">
                <div class="card-header d-flex justify-content-between">
                    Statistik Golongan Darah
                    <button type="button" class="btn btn-sm btn-info" onclick="statistikDarah()"><i class="fas fa-redo"></i> Load Data</button>
                </div>
                <div id="total-darah"></div>
            </div>
            <div class="card p-3 my-3">
                <div class="card-header d-flex justify-content-between">
                    Statistik Agama
                    <button type="button" class="btn btn-sm btn-info" onclick="statistikAgama()"><i class="fas fa-redo"></i> Load Data</button>
                </div>
                <div id="total-agama"></div>
            </div>
            <div class="card p-3 my-3">
                <div class="border-bottom title-part-padding">
                    <h4 class="card-title mb-0">List Anggota</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped file-export" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h4>Anggota Dewasa</h4>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <div class="card shadow">
                            <div class="card-header" style="background-color: #804000;">
                                <div class="text-white text-center"><strong id="total-pelatih">-</strong>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <p>PELATIH</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow">
                            <div class="card-header" style="background-color: #9900ff;">
                                <div class="text-white text-center"><strong id="total-pembina">-</strong>
                                </div>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <p>PEMBINA</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow">
                            <div class="card-header" style="background-color: #2fb7cf;">
                                <div class="text-white text-center"><strong id="total-dewasa">-</strong>
                                </div>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <p>PEMBANTU</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card my-3 p-3">
                <div class="card-header">
                    Siaga
                </div>
                <div id="siaga"></div>
                <div class="card-footer">
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item">Putra: <strong id="total-siaga-lk">-</strong></li>
                        <li class="list-group-item">Putri: <strong id="total-siaga-pr">-</strong></li>
                    </ul>
                </div>
            </div>
            <div class="card my-3 p-3">
                <div class="card-header">
                    Penggalang
                </div>
                <div id="penggalang"></div>
                <div class="card-footer">
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item">Putra: <strong id="total-penggalang-lk">-</strong></li>
                        <li class="list-group-item">Putri: <strong id="total-penggalang-pr">-</strong></li>
                    </ul>
                </div>
            </div>
            <div class="card my-3 p-3">
                <div class="card-header">
                    Penegak
                </div>
                <div id="penegak"></div>
                <div class="card-footer">
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item">Putra: <strong id="total-penegak-lk">-</strong></li>
                        <li class="list-group-item">Putri: <strong id="total-penegak-pr">-</strong></li>
                    </ul>
                </div>
            </div>
            <div class="card my-3 p-3">
                <div class="card-header">
                    Pandega
                </div>
                <div id="pandega"></div>
                <div class="card-footer">
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item">Putra: <strong id="total-pandega-lk">-</strong></li>
                        <li class="list-group-item">Putri: <strong id="total-pandega-pr">-</strong></li>
                    </ul>
                </div>
            </div>
            <div class="card my-3 p-3">
                <div class="card-header">
                    Pelatih
                </div>
                <div id="pelatih"></div>
                <div class="card-footer">
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item">Putra: <strong id="total-pelatih-lk">-</strong></li>
                        <li class="list-group-item">Putri: <strong id="total-pelatih-pr">-</strong></li>
                    </ul>
                </div>
            </div>
            <div class="card my-3 p-3">
                <div class="card-header">
                    Pembina
                </div>
                <div id="pembina"></div>
                <div class="card-footer">
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item">Putra: <strong id="total-pembina-lk">-</strong></li>
                        <li class="list-group-item">Putri: <strong id="total-pembina-pr">-</strong></li>
                    </ul>
                </div>
            </div>
            <div class="card my-3 p-3">
                <h4 class="card-title mb-0">List Admin</h4>
                <hr>
                <ol class="list-group list-group-numbered" id="list-admin"></ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    {{-- @include('components.dashboard',['id_wilayah' => $id_wilayah, 'gudep' => 0]) --}}
    <script src="{{ asset('js/excelexportjs.js') }}"></script>
    <script>
        // $("#tableData").excelexportjs({
        //     containerid: "tableData",
        //     datatype: 'table'
        // });
        var table = $(".file-export").DataTable({
            processing: true,
            serverSide: true,
            scrollY: '300px',
            ajax: {
            url: '{!! route('datatable.kwartir.anggota') !!}',
            type: 'GET',
            data: {
                    id_wilayah: {!! json_encode($id_wilayah) !!},
                },
            },
            columns: [
                {data: 'nama', name: 'nama'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action', searchable: false, orderable: false},
            ],
            dom: "Bfrtip",
            lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10 rows', '25 rows', '50 rows', 'Show all' ]
            ],
            buttons: ["pageLength","copy", "csv", "excel", "pdf", "print"],
            "bLengthChange": true,
        });

        $(".buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel, .buttons-collection ")
        .addClass("btn btn-primary");
        $(".buttons-collection ").addClass("btn btn-info m-1");

        let list_admin = () =>{
                $.ajax({
                    url: {!! json_encode(url('api/get-admin')) !!}+'/'+{!! json_encode($id_wilayah) !!},
                    type: 'GET',
                    success: function(data) {
                        var data = data.data;
                        $('#list-admin').html('');
                        $.each(data, function(index, value) {
                            $('#list-admin').append(
                                `<li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div div class="ms-2 me-auto">
                                        <div class="fw-bold">${value.nama}</div>
                                        ${value.email}
                                    </div>
                                    <button onclick="deleteAdmin(${value.id})" class="btn btn-sm btn-outline-danger rounded-pill"><i class="fas fa-trash-alt"></i></button>
                                </li>`
                            );
                        });
                    }
                });
        }

        let deleteAdmin = (anggota_id) => {
            $.ajax({
                url: {!! json_encode(url('api/delete-admin')) !!},
                type: 'PUT',
                data: {
                    anggota_id: anggota_id,
                },
                success: function(data) {
                    list_admin();
                    total_anggota();
                    table.ajax.reload();
                }
            });
        }

        let addAdmin = (anggota_id) => {
            $.ajax({
                url: {!! json_encode(url('api/add-admin')) !!},
                type: 'POST',
                data: {
                    id_wilayah: {!! json_encode($id_wilayah) !!},
                    anggota_id: anggota_id,
                },
                success: function(data) {
                    list_admin();
                    total_anggota();
                    table.ajax.reload();
                }
            });
        }
        list_admin();
    </script>
@endsection
