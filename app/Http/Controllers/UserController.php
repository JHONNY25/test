<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    private $user = null;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function index(){
        $users = $this->getUsersByStatus();
        return view('welcome',compact('users'));
    }

    public function getUsersByStatus($status = null){
        try {

            return is_null($status) ? $this->user->all() : $this->user->where('status',$status)->get() ;
        } catch (\Exception $e) {
            return response()->json($e->getMessage(),500);
        }
    }

    public function create($name,$email,$password,$status){
        try {
            DB::beginTransaction();

            $this->user->create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'status' => $status
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(),500);
        }
    }

    public function updateStatus(Request $request){
        try {
            DB::beginTransaction();

            $this->user->where('id',$request->id)->update([
                'status' => $request->status
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(),500);
        }
    }

}
