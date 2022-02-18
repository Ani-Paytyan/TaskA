<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use phpDocumentor\Reflection\Types\Integer;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
//    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'active',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param Request $request
     */
    static public function create(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'role' => 'required',
            'password' => 'required'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = (string)$request->phone;
        $user->active = $request->active;
        $user->role =  $request->role;
        $user->password = $request->password;
        $user->save();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    static public function getUserList() {
        $users = DB::table('users')->orderBy('id','desc')->get();
        return $users;
    }

    /**
     * @param Request $request
     * @param $id
     */
    static public function updateUserData(Request $request, $id) {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = (string)$request->phone;
        $user->active = $request->active;
        $user->role =  $request->role;
        $user->password = $request->password;
        $user->update();
    }

}
