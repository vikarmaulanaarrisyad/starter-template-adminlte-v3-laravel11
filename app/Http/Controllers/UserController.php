<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return view('konfigurasi.user.index');
    }

    public function data()
    {
        $query = User::all();

        return datatables($query)
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                $aksi = '';

                if (Auth::user()->hasPermissionTo("User Show")) {
                    $aksi .= '
                        <button onclick="detailForm(`' . route('users.detail', $query->id) . '`)" class="btn btn-info"><i class="fas fa-eye"></i></button>
                    ';
                }
                if (Auth::user()->hasPermissionTo("User Edit")) {
                    $aksi .= '
                        <button onclick="editForm(`' . route('users.edit', $query->id) . '`)" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></button>

                    ';
                }
                if (Auth::user()->hasPermissionTo("User Delete")) {
                    $aksi .= '
                        <button onclick="deleteData(`' . route('users.destroy', $query->id) . '`, `' . $query->name . '`)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                    ';
                }

                return $aksi;
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'roles' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Maaf inputan yang anda masukan salah, silahkan periksa kembali dan coba lagi'
            ], 422);
        }

        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $roles = Role::find($request->roles);
            if ($roles->isEmpty()) {
                DB::rollback();
                return response()->json([
                    'message' => 'One or more roles not found',
                    'error' => 'Invalid roles provided'
                ], 404);
            }

            $user->assignRole($roles);

            DB::commit();

            return response()->json([
                'message' => 'User berhasil disimpan',
                'data' => $user
            ], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function detail(Request $request, User $users)
    {
        $users->load(['roles']);
        return response()->json([
            'data' => $users
        ]);
    }


    public function roleSearch(Request $request)
    {
        $keyword = request()->get('q');

        $result = Role::where('name', "LIKE", "%$keyword%")
            ->get();

        return $result;
    }
}
