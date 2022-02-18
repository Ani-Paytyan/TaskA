<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $data['userList'] = User::getUserList();

        return view('index',$data);
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        if (!empty($request)){
            User::create($request);
        }
    }

    public function edit($userId)
    {
        $data['user'] = User::find($userId);
        return view('edit', $data);
    }

    /**
     * @param Request $request
     * @param $userId
     */
    public function update(Request $request, $userId)
    {
        if (!empty($request)){
            User::updateUserData($request, $userId);
        }
    }

    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
    }
}
