<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
                return '
                    <button onclick="detailDataUser(`' . route('users.detail', $query->id) . '`)" class="btn btn-info"><i class="fas fa-eye"></i></button>
                    <button onclick="editDataUser(`' . route('users.edit', $query->id) . '`)" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></button>
                    <button onclick="deleteDataUser(`' . route('users.destroy', $query->id) . '`, `' . $query->name . '`)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                ';
            })
            ->escapeColumns([])
            ->make(true);
    }
}
