<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Distrik;
use App\Models\OrganizationUser;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizationUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;
        if (request('id_wilayah')) {
            $id_wilayah = request('id_wilayah');
        }else{
            if($role=='admin'){
                $id_wilayah = 'all';
            }
            if($role=='kwarda'){
                $id_wilayah = $user->anggota->provinsi;
                $anggota = OrganizationUser::whereHas('anggota', function($q) use ($id_wilayah){
                    $q->where('provinsi', $id_wilayah);
                })->get();
            }
            if($role=='kwarcab'){
                $id_wilayah = $user->anggota->kabupaten;
                $anggota = OrganizationUser::whereHas('anggota', function($q) use ($id_wilayah){
                    $q->where('kabupaten', $id_wilayah);
                })->get();
            }
            if($role=='kwaran'){
                $id_wilayah = $user->anggota->kecamatan;
                $anggota = OrganizationUser::whereHas('anggota', function($q) use ($id_wilayah){
                    $q->where('kecamatan', $id_wilayah);
                })->get();
            }
        }
        // dd($role);

        $data = $this->getData($id_wilayah);
        $title = $data[0]->name ?? 'Kwartir Nasional';
        $kwartir = $data[1];

        return view('admin.organisasi.index', compact('id_wilayah', 'title', 'kwartir','anggota'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'anggota_id' => 'required',
            'organization_id' => 'required'
        ]);

        $role = Auth::user()->role;
        $data['type'] = $role;
        if($role=='anggota' || $role=='admin'){
            return back()->with('danger','Maaf anda tidak memiliki akses ini');
        }

        OrganizationUser::create($data);
        return back()->with('success','Data berhasil tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrganizationUser  $organizationUser
     * @return \Illuminate\Http\Response
     */
    public function show(OrganizationUser $organizationUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrganizationUser  $organizationUser
     * @return \Illuminate\Http\Response
     */
    public function edit(OrganizationUser $organizationUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrganizationUser  $organizationUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrganizationUser $organizationUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrganizationUser  $organizationUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrganizationUser $organization_user)
    {
        $organization_user->delete();
        return back()->with('success','data berhasil di hapus');
    }

    public function getData($id_wilayah)
    {
        if ($id_wilayah=='all') {
            return [null,null];
        }
        $len = strlen($id_wilayah);
        if ($len==2) {
            $data = Provinsi::find($id_wilayah, ['name', 'id', 'no_prov as code', 'id as prev']);
            $kwartir = 'Kwartir Daerah';
        }elseif($len==4){
            $data = City::find($id_wilayah, ['name', 'id', 'no_kab as code', 'province_id as prev']);
            $kwartir = 'Kwartir Cabang';
        }else{
            $data = Distrik::find($id_wilayah, ['name', 'id', 'no_kec as code', 'regency_id as prev']);
            $kwartir = 'Kwartir Ranting';
        }

        return [$data, $kwartir];
    }
}
