<?php

namespace App\Http\Controllers\Admin;

use App\Models\Partners;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Storage;
use Validator;
use Log;

class PartnersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result['partners']=Partners::all();
        return view('admin.partners.partners',$result);
    }

    public function manage_partners(Request $request,$id='')
    {
        if($id>0){
            $arr=Partners::where(['id'=>$id])->first(); 
 
            $result['image']=$arr->image;
            $result['id']=$arr->id;
        }else{
            
            $result['image']='';
            $result['id']=0;
           
        }

        return view('admin.partners.manage_partners',$result);
    }

    public function manage_partners_process(Request $request)
    {
       
        
        $validator = Validator::make($request->all(), [
            
            'image'=>'mimes:jpeg,jpg,png',
            
        ]);
        if ($validator->fails()) {
            
            session()->flash('error',$validator->errors()->first());
            return redirect()->back(); 
        }
        if($request->post('id')>0){
            $model=Partners::find($request->post('id'));
            $model->updated_at=date('Y-m-d H:i:s');
            $msg="Partner Updated";
        }else{
            $model=new Partners();
            $model->created_at=date('Y-m-d H:i:s');
            $msg="Partner Inserted";
        }

        if($request->hasfile('image')){

            if($request->post('id')>0){
                $arrImage=Partners::where(['id'=>$request->post('id')])->get();
                if(Storage::exists('/public/media/partners/'.$arrImage[0]->image)){
                    Storage::delete('/public/media/partners/'.$arrImage[0]->image);
                }
            }

            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media/partners',$image_name);
            $model->image=$image_name;
        }
        
        $model->save();
        
        $request->session()->flash('message',$msg);
        return redirect()->route('admin.partners');
        
    }

    public function delete(Request $request){
        $id = $request->post('id');
        $model=Partners::find($id);
        $model->delete();
      echo json_encode(array('status'=>1,'message'=>'Data'));
    }

   
}
