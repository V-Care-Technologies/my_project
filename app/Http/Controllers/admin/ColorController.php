<?php

namespace App\Http\Controllers\Admin;

use App\Models\Colors;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Storage;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result['color']=Colors::all();
        return view('admin.color.color',$result);
    }

    
    public function manage_color(Request $request,$id='')
    {
        if($id>0){
            $arr=Colors::where(['id'=>$id])->first(); 

            $result['color']=$arr->color;
            $result['color_image']=$arr->color_image;
            $result['status']=$arr->status;
            $result['id']=$arr->id;
        }else{
            $result['color']='';
            $result['status']='';
            $result['color_image']='';
            $result['id']=0;
            
        }
        return view('admin.color.manage_color',$result);
    }

    public function manage_color_process(Request $request)
    {
        //return $request->post();
        
        $validator = Validator::make($request->all(), [
            'color'=>'required|unique:colors,color,'.$request->post('id'),  
            'color_image'=>'mimes:jpeg,jpg,png',
        ]);

        if ($validator->fails()) {
            
            session()->flash('error',$validator->errors()->first());
            return redirect()->back(); 
        }

        if($request->post('id')>0){
            $model=Colors::find($request->post('id'));
            $model->updated_at=date('Y-m-d H:i:s');
            $msg="Color updated";
        }else{
            $model=new Colors();
            $model->created_at=date('Y-m-d H:i:s');
            $msg="Color inserted";
        }
        if($request->hasfile('color_image')){

            if($request->post('id')>0){
                $arrImage=Colors::where(['id'=>$request->post('id')])->get();
                if(Storage::exists('/public/media/color/'.$arrImage[0]->color_image)){
                    Storage::delete('/public/media/color/'.$arrImage[0]->color_image);
                }
            }

            $image=$request->file('color_image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media/color',$image_name);
            $model->color_image=$image_name;
        }
        $model->color=$request->post('color');
        $model->status=$request->post('status');
        $model->save();
        $request->session()->flash('message',$msg);
        return redirect()->route('admin.color');
        
    }

    public function delete(Request $request){
         $id = $request->post('id');
        $model=Colors::find($id);
        $model->delete();
        echo json_encode(array('status'=>1,'message'=>'Data'));
    }

    public function status(Request $request,$status,$id){
        $model=Colors::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Color status updated');
        return redirect('admin/color');
    }
}
