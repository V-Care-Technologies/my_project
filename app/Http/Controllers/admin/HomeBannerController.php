<?php

namespace App\Http\Controllers\Admin;

use App\Models\HomeBanner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Storage;

class HomeBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result['banner']=HomeBanner::all();
        return view('admin.home_banner.home_banner',$result);
    }

    
    public function manage_home_banner(Request $request,$id='')
    {
        if($id>0){
            $arr=HomeBanner::where(['id'=>$id])->first(); 
            $result['image']=$arr->image;
            $result['image1']=$arr->image1;
           $result['status']=$arr->status;
            $result['id']=$arr->id;
        }else{
            $result['image']='';
            $result['image1']='';
           $result['status']='';
            $result['id']="";
        }

        return view('admin.home_banner.manage_home_banner',$result);
    }

    public function manage_home_banner_process(Request $request)
    {
        // dd($request->all());
         if($request->post('id')>0){
            $image_validation="mimes:jpeg,jpg,png";
        }else{
            $image_validation="required|mimes:jpeg,jpg,png";
        }
        $validator = Validator::make($request->all(), [
            'image'=>$image_validation 
        ]);

        if ($validator->fails()) {
            
            session()->flash('error',$validator->errors()->first());
            return redirect()->back(); 
        }

        if($request->post('id')>0){
            $model=HomeBanner::find($request->post('id'));
            $model->updated_at=date('Y-m-d H:i:s');
            $msg="Banner updated";
        }else{
            $model=new HomeBanner();
            $model->created_at=date('Y-m-d H:i:s');
            $msg="Banner inserted";
        }

        if($request->hasfile('image')){

            if($request->post('id')>0){
                $arrImage=HomeBanner::where(['id'=>$request->post('id')])->get();
                if(Storage::exists('/public/media/banner/'.$arrImage[0]->image)){
                    Storage::delete('/public/media/banner/'.$arrImage[0]->image);
                }
            }

            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media/banner',$image_name);
            $model->image=$image_name;

        }
        
        if($request->hasfile('images')){

            if($request->post('id')>0){
                $arrImage=HomeBanner::where(['id'=>$request->post('id')])->get();
                if(Storage::exists('/public/media/banner/'.$arrImage[0]->image1)){
                    Storage::delete('/public/media/banner/'.$arrImage[0]->image1);
                }
            }

            $image1=$request->file('images');
            $ext=$image1->extension();
            $image_name1=time().'.'.$ext;
            $image1->storeAs('/public/media/banner',$image_name1);
            $model->image1=$image_name1;

        }
        
      
        $model->status=$request->post('status');
        $model->save();
        $request->session()->flash('message',$msg);
        return redirect()->route('admin.home-banner');
        
    }

    
    public function delete(Request $request){
        $id = $request->post('id');
        $model=HomeBanner::find($id);
        $model->delete();
        echo json_encode(array('status'=>1,'message'=>'Data'));
    }

    public function status(Request $request,$status,$id){
        $model=HomeBanner::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Banner status updated');
        return redirect('admin/home_banner');
    }
}
