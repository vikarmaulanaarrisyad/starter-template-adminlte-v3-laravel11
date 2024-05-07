<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionGroupController extends Controller
{
    public function index()
    {
        return view('konfigurasi.permissiongroup.index');
    }

    public function data()
    {
        $query = PermissionGroup::all();

        return datatables($query)
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                return '
                    <button onclick="detailDataPermissionGroups(`' . route('permissiongroups.detail', $query->id) . '`)" class="btn btn-info"><i class="fas fa-eye"></i></button>
                    <button onclick="editDataPermissionGroups(`' . route('permissiongroups.edit', $query->id) . '`)" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></button>
                    <button onclick="deleteDataPermissionGroups(`' . route('permissiongroups.destroy', $query->id) . '`, `' . $query->name . '`)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                ';
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:permissions',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Maaf inputan yang anda masukan salah, silahkan periksa kembali dan coba lagi'], 422);
        }

        $data = [
            'name' => $request->name,
        ];

        $permissionGroups = PermissionGroup::create($data);

        return response()->json(['message' => 'Permission Group berhasil ditambahkan', 'data' => $permissionGroups], 200);
    }

    public function detail(PermissionGroup $permissionGroup)
    {
        return response()->json(['data' => $permissionGroup]);
    }

    public function edit(PermissionGroup $permissionGroup)
    {
        return response()->json(['data' => $permissionGroup]);
    }

    public function update(Request $request, PermissionGroup $permissionGroup)
    {
        $rules = [
            'name' => 'required|unique:Permission_groups,name,' . $permissionGroup->id, // Ubah menjadi $role->id
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Maaf, inputan yang Anda masukkan salah. Silakan periksa kembali dan coba lagi'], 422);
        }

        $data = [
            'name' => $request->name,
        ];

        $permissionGroup->update($data);

        return response()->json(['message' => 'Permission Group berhasil diupdate', 'data' => $permissionGroup], 200);
    }


    public function destroy(PermissionGroup $permissionGroup)
    {
        $permissionGroup->delete();

        return response()->json(['message' => 'Permission Group berhasil dihapus'], 200);
    }
}
