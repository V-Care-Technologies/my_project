<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result['size']=Size::all();
        return view('admin.size.size',$result);
    }

    
    public function manage_size(Request $request,$id='')
    {
        if($id>0){
            $arr=Size::where(['id'=>$id])->first(); 

            $result['size']=$arr->size;
            $result['status']=$arr->status;
            $result['id']=$arr->id;
        }else{
            $result['size']='';
            $result['status']='';
            $result['id']=0;
            
        }
        return view('admin.size.manage_size',$result);
    }

    public function manage_size_process(Request $request)
    {
        //return $request->post();
        
        $validator = Validator::make($request->all(), [
            'size'=>'required|unique:sizes,size,'.$request->post('id'),   
        ]);

        if ($validator->fails()) {
            
            session()->flash('error',$validator->errors()->first());
            return redirect()->back(); 
        }

        if($request->post('id')>0){
            $model=Size::find($request->post('id'));
            $msg="Size updated";
        }else{
            $model=new Size();
            $msg="Size inserted";
        }
        $model->size=$request->post('size');
        $model->status=1;
        $model->save();
        $request->session()->flash('message',$msg);
        return redirect()->route('admin.size');
        
    }

    public function delete(Request $request,$id){
        $model=Size::find($id);
        $model->delete();
        $request->session()->flash('message','Size deleted');
        return redirect()->back();
    }

    public function status(Request $request,$status,$id){
        $model=Size::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Size status updated');
        return redirect('admin/size');
    }
}
