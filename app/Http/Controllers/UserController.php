<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getUsers()
    {
        return User::with(['municipality.department.country'])->get();
    }

    public function saveUser(Request $request)
    {
        $success = false;
        $data = '';

        $error = '';
        DB::beginTransaction();
        try {
            $data = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'email_verified_at' => now(),
                'password' => Hash::make($request->password), // password
                'remember_token' => Str::random(10),
                'municipality_id' => $request->municipality['id']
            ]);
            DB::commit();
            $success = true;
        } catch (\Throwable $th) {
            $success = false;
            $error = $th->getMessage();
            DB::rollBack();
        }
        if ($success) {
            return [
                'status' => true,
                'payload' => $data
            ];
        } else {
            return [
                'status' => false,
                'error' => $error
            ];
        }
    }


    public function editUser(Request $request)
    {
        $success = false;
        $data = '';

        $error = '';
        DB::beginTransaction();
        try {
            $data = User::where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'email_verified_at' => now(),
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(10),
                'municipality_id' => $request->municipality['id']
            ]);
            DB::commit();
            $success = true;
        } catch (\Throwable $th) {
            $success = false;
            $error = $th->getMessage();
            DB::rollBack();
        }
        if ($success) {
            return [
                'status' => true,
                'payload' => $data
            ];
        } else {
            return [
                'status' => false,
                'error' => $error
            ];
        }
    }

    public function deleteUser(Request $request)
    {
        $success = false;
        $data = '';

        $error = '';
        DB::beginTransaction();
        try {
            User::where('id', $request->id)->delete();
            DB::commit();
            $success = true;
        } catch (\Throwable $th) {
            $success = false;
            $error = $th->getMessage();
            DB::rollBack();
        }
        if ($success) {
            return [
                'status' => true,
                'payload' => $data
            ];
        } else {
            return [
                'status' => false,
                'error' => $error
            ];
        }
    }
}
