<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->session()->has('ADMIN_LOGIN')){
            return redirect('admin/dashboard');
        }else{
            return view('admin.login');
        }
        return view('admin.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function auth(Request $request)
    {
        $email=$request->post('email');
        $password=$request->post('password');

        // $result=Admin::where(['email'=>$email,'password'=>$password])->get();
        // $result=Admin::where(['email'=>$email])->first();
        $result=User::rightJoin('user_groups', 'user_groups.user_id', '=', 'users.id')
        ->select('users.*','user_groups.group_id as group_id')
        ->where('user_groups.group_id','=','1')
        ->where(['users.email'=>$email])->first();
        if($result){
            if(Hash::check($request->post('password'),$result->password)){
                $request->session()->put('ADMIN_LOGIN',true);
                $request->session()->put('ADMIN_ID',$result->id);
                return redirect('admin/dashboard')->with('message','Login Successfully');
            }else{
                // $request->session()->flash('error','Please enter correct password');
                return redirect('admin')->with('error','Please enter correct password');
            }
        }else{
            // $request->session()->flash('error','Please enter valid login details');
            return redirect('admin')->with('error','Please enter valid login details');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function dashboard()
    {

        $result['users']=User::count();
        
        return view('admin.dashboard',$result);
    }


}
