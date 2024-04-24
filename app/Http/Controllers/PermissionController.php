<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        return view('konfigurasi.permission.index');
    }

    public function data()
    {
        $query = Permission::all();

        return datatables($query)
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                return '
                    <button onclick="detailDataPermission(`' . route('permission.detail', $query->id) . '`)" class="btn btn-info"><i class="fas fa-eye"></i></button>
                    <button onclick="editDataPermission(`' . route('permission.edit', $query->id) . '`)" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></button>
                    <button onclick="deleteDataPermission(`' . route('permission.destroy', $query->id) . '`, `' . $query->name . '`)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
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

        $permissions = Permission::create($data);

        return response()->json(['message' => 'Permission berhasil ditambahkan', 'data' => $permissions], 200);
    }

    public function detail(Permission $permission)
    {
        return response()->json(['data' => $permission]);
    }

    public function edit(Permission $permission)
    {
        return response()->json(['data' => $permission]);
    }

    public function update(Request $request, Permission $permission)
    {
        $rules = [
            'name' => 'required|unique:Permissions,name,' . $permission->id, // Ubah menjadi $role->id
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Maaf, inputan yang Anda masukkan salah. Silakan periksa kembali dan coba lagi'], 422);
        }

        $data = [
            'name' => $request->name,
        ];

        $permission->update($data);

        return response()->json(['message' => 'Permission berhasil diupdate', 'data' => $permission], 200);
    }


    public function destroy(Permission $permission)
    {
        $permission->delete();

        return response()->json(['message' => 'Permission berhasil dihapus'], 200);
    }
}
