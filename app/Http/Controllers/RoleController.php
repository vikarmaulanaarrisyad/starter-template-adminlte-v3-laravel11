<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('konfigurasi.role.index');
    }

    public function data()
    {
        $query = Role::all();

        return datatables($query)
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                return '
                    <button onclick="detailDataRole(`' . route('role.detail', $query->id) . '`)" class="btn btn-info"><i class="fas fa-eye"></i></button>
                    <button onclick="editDataRole(`' . route('role.edit', $query->id) . '`)" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></button>
                    <button onclick="deleteDataRole(`' . route('role.destroy', $query->id) . '`, `' . $query->name . '`)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                ';
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:roles',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Maaf inputan yang anda masukan salah, silahkan periksa kembali dan coba lagi'], 422);
        }

        $data = [
            'name' => $request->name,
        ];

        $role = Role::create($data);

        return response()->json(['message' => 'Role berhasil ditambahkan', 'data' => $role], 200);
    }

    public function detail(Role $role)
    {
        return response()->json(['data' => $role]);
    }

    public function edit(Role $role)
    {
        return response()->json(['data' => $role]);
    }

    public function update(Request $request, Role $role)
    {
        $rules = [
            'name' => 'required|unique:roles,name,' . $role->id, // Ubah menjadi $role->id
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Maaf, inputan yang Anda masukkan salah. Silakan periksa kembali dan coba lagi'], 422);
        }

        $data = [
            'name' => $request->name,
        ];

        $role->update($data);

        return response()->json(['message' => 'Role berhasil diupdate', 'data' => $role], 200);
    }


    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json(['message' => 'Role berhasil dihapus'], 200);
    }
}
