<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function list(){
        $users = DB::table('users')
        ->orderBy('id','desc')
        ->get();

            return view('/users/list', compact('users'));
       }

      public function form(){
        $id = null;
        $name = null;
        $email = null;
        $password = null;

        return view('/users.form', compact('id','name','email','password'));
      }

      public function create(Request $request){
        $users = DB::table('users')->insert([
            'name' =>$request->name,
            'email' =>$request->email,
            'password' =>$request->password,
        ]);
                return redirect('/users/list');
      }
        public function edit($id){
            $user = DB::table('users')->where('id',$id)->first();

            if (isset($user)) {
                $id = $user->id;
                $name = $user->name;
                $email = $user->email;
                $password = $user->password;
            }
            
            return view('/users/form', compact('id','name','email','password'));
        }

        public function update(Request $request,$id){
            DB::table('users')->where('id',$id)->update([
                'name' =>$request->name,
                'email' =>$request->email,
                'password' =>$request->password,
            ]);
            return redirect('/users/list');
            
        }
        public function remove($id){
            DB::table('users')->where('id',$id)->delete();

            return redirect('/users/list');
        }
        
}