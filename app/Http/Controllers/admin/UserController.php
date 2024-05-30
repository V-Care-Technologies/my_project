<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserGroup;
use Storage;
use Validator;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $result['data']=User::all();
        $result['data']=User::rightJoin('user_groups', 'user_groups.user_id', '=', 'users.id')
        ->select('users.*','user_groups.group_id as group_id')
        ->where('user_groups.group_id','!=','1')
        ->get();
        return view('admin.customer.customer',$result);
    }


    public function manage_customer(Request $request,$id='')
    {
        if($id>0){
            $arr=User::where(['id'=>$id])->first();

            $result['name']=$arr->name;
            $result['designation']=$arr->designation;
            $result['email']=$arr->email;
            $result['mobile']=$arr->mobile;
            $result['address']=$arr->address;
            $result['status']=$arr->status;
            $result['id']=$arr->id;

            $result['user']=User::where(['status'=>1])->where('id','!=',$id)->get();
        }else{
            $result['name']='';
            $result['designation']='';
            $result['email']='';
            $result['mobile']='';
            $result['address']="";
            $result['status']="";
            $result['id']=0;

            $result['user']=User::where(['status'=>1])->get();

        }

        return view('admin.customer.manage_customer',$result);
    }

    public function manage_customer_process(Request $request)
    {

        if($request->post('id')>0){
            $password="confirmed";
        }else{
            $password="required";
        }


        $validator = Validator::make($request->all(), [
            'name'=>'required',

            'email'=>'unique:users,email,'.$request->post('id'),
            'password' => $password,
        ]);

        if ($validator->fails()) {

            session()->flash('error',$validator->errors()->first());
            return redirect()->back();
        }

        if($request->post('id')>0){
            $model=User::find($request->post('id'));
            $model->updated_at=date('Y-m-d H:i:s');
            $msg="User updated";
        }else{
            $model=new User();
            $model->created_at=date('Y-m-d H:i:s');
            $msg="User inserted";
        }



        $model->name=$request->post('name');
        $model->designation=$request->post('designation');
        $model->email=$request->post('email');
        $model->mobile=$request->post('mobile');
        $model->address=$request->post('address');
        $model->password=Hash::make($request->post('password'));
        $model->status=$request->post('status');
        $model->save();

        // dd($request->post('id'));
        if($request->post('id')==0){
            $group=new UserGroup();
            $group->user_id=$model->id;
            $group->group_id=2;
            $group->save();
        }

        $request->session()->flash('message',$msg);
        return redirect()->route('admin.customer');

    }
    public function delete(Request $request){
        $id = $request->post('id');
       $model=User::find($id);
       $model->delete();
       $group=UserGroup::where('user_id',$id)->delete();

       echo json_encode(array('status'=>1,'message'=>'Data'));
   }

    public function show(Request $request,$id='')
    {
        $arr=User::where(['id'=>$id])->get();
        $result['customer_list']=$arr['0'];
        return view('admin.customer.show_customer',$result);
    }

    public function status(Request $request,$status,$id){
        $model=User::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Customer status updated');
        return redirect('admin/customer');
    }
}
