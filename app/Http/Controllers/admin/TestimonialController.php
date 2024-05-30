<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Storage;
use Validator;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result['testimonial']=Testimonial::all();
        return view('admin.testimonial.testimonial',$result);
    }

    public function manage_testimonial(Request $request,$id='')
    {
        if($id>0){
            $arr=Testimonial::where(['id'=>$id])->first(); 

            $result['title']=$arr->title;
            $result['desc']=$arr->desc;
            $result['rate']=$arr->rate;
            $result['image']=$arr->image;
            $result['status']=$arr->status;
            $result['id']=$arr->id;
           
        }else{
            $result['title']='';
            $result['desc']='';
            $result['rate']='';
            $result['image']='';
            $result['id']=0;
            $result['status']='';
           
            $result['testimonial']=Testimonial::where('status','=','0')->get();
            
        }

        return view('admin.testimonial.manage_testimonial',$result);
    }

    public function manage_testimonial_process(Request $request)
    {
       
        
        $validator = Validator::make($request->all(), [
            'title'=>'required',
            'image'=>'mimes:jpeg,jpg,png',
            'desc'=>'required',
            'rate'=>'required',   
        ]);

        if ($validator->fails()) {
            
            session()->flash('error',$validator->errors()->first());
            return redirect()->back(); 
        }

        if($request->post('id')>0){
            $model=Testimonial::find($request->post('id'));
            $model->updated_at=date('Y-m-d H:i:s');
            $msg="testimonial updated";
        }else{
            $model=new Testimonial();
            $model->created_at=date('Y-m-d H:i:s');
            $msg="testimonial inserted";
        }

        if($request->hasfile('image')){

            if($request->post('id')>0){
                $arrImage=Testimonial::where(['id'=>$request->post('id')])->get();
                if(Storage::exists('/public/media/testimonial/'.$arrImage[0]->image)){
                    Storage::delete('/public/media/testimonial/'.$arrImage[0]->image);
                }
            }

            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media/testimonial',$image_name);
            $model->image=$image_name;
        }
        $model->title=$request->post('title');
        $model->desc=$request->post('desc');
        $model->rate=$request->post('rate');
        $model->status=$request->post('status');
        $model->save();
        
        $request->session()->flash('message',$msg);
        return redirect()->route('admin.testimonial');
        
    }

    public function delete(Request $request){
        $id = $request->post('id');
        $model=Testimonial::find($id);
        $model->delete();
          echo json_encode(array('status'=>1,'message'=>'Data'));
    }

    public function status(Request $request,$status,$id){
        $model=Testimonial::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','testimonial status updated');
        return redirect('admin/testimonial');
    }
}
