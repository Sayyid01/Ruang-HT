<?php

namespace App\Http\Controllers\Main;

use App\Admin;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function getAdminData()
    {
        $admins = DB::table('admins')->get();

        return view('auth.admin.dataAdmin', ['admins' => $admins]);
    }

    public function addAdminData(Request $request)
    {
        $comparison = strcmp($request->password, $request->confirmPassword);

        $validator = Validator::make($request->all(), [
            'password' => [
                'required', 'string', 'min:6', 'regex:/[a-z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/'
            ]
        ]);


        if ($comparison == 0 && $validator->fails() == false) {
            User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
        }

        return redirect('/dataAdmin');
    }

    public function deleteAdminData($id_user)
    {
        DB::table('admins')
            ->where('id', $id_user)
            ->delete();
    }

    public function updateAdminData(Request $request)
    {
        DB::table('admins')
            ->where('id', $request->id_user)
            ->update([
                'name' => $request->updatenama,
                'email' => $request->updateemail
            ]);

        $comparison = strcmp($request->password, $request->confirmPassword);

        $validator = Validator::make($request->all(), [
            'password' => [
                'required', 'string', 'min:6', 'regex:/[a-z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/'
            ]
        ]);

        if ($comparison == 0 && $validator->fails() == false) {
            DB::table('admins')
                ->update([
                    'password' => bcrypt($request->password)
                ]);
        }

        return redirect('/dataAdmin');
    }

    public function getUserData()
    {
        $users = DB::table('users')->get();

        return view('auth.admin.dataUser', ['users' => $users]);
    }

    public function addUserData(Request $request)
    {
        $comparison = strcmp($request->password, $request->confirmPassword);

        $validator = Validator::make($request->all(), [
            'password' => [
                'required', 'string', 'min:6', 'regex:/[a-z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/'
            ]
        ]);


        if ($comparison == 0 && $validator->fails() == false) {
            User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
        }

        return redirect('/dataUser');
    }

    public function updateUserData(Request $request)
    {
        DB::table('users')
            ->where('id', $request->id_user)
            ->update([
                'name' => $request->updatenama,
                'email' => $request->updateemail
            ]);

        $comparison = strcmp($request->password, $request->confirmPassword);

        $validator = Validator::make($request->all(), [
            'password' => [
                'required', 'string', 'min:6', 'regex:/[a-z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/'
            ]
        ]);

        if ($comparison == 0 && $validator->fails() == false) {
            DB::table('users')
                ->update([
                    'password' => bcrypt($request->password)
                ]);
        }

        return redirect('/dataUser');
    }

    public function deleteUserData($id_user)
    {
        DB::table('users')
            ->where('id', $id_user)
            ->delete();
    }
}
