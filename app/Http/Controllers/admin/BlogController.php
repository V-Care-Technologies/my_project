<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Storage;
use Validator;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result['blog']=Blog::all();
        return view('admin.blog.blog',$result);
    }

    public function manage_blog(Request $request,$id='')
    {
        if($id>0){
            $arr=Blog::where(['id'=>$id])->first(); 

            $result['title']=$arr->title;
            $result['desc']=$arr->desc;
           
            $result['image']=$arr->image;
            
            $result['id']=$arr->id;
             $result['status']=$arr->status;
            $result['alias']=$arr->alias;
            $result['main_image']=$arr->main_image;
            $result['long_desc']=$arr->long_desc;

           
        }else{
            $result['title']='';
            $result['desc']='';
            
            $result['image']='';
            $result['id']=0;
            $result['status']='';
            $result['alias']='';
            $result['main_image']='';
            $result['long_desc']='';
            $result['blog']=Blog::where('status','=','0')->get();
            
        }

        return view('admin.blog.manage_blog',$result);
    }

    public function manage_blog_process(Request $request)
    {
       
        
        $validator = Validator::make($request->all(), [
            'title'=>'required',
            'image'=>'mimes:jpeg,jpg,png',
            'main_image'=>'mimes:jpeg,jpg,png',
            'desc'=>'required',
           
        ]);
        if ($validator->fails()) {
            
            session()->flash('error',$validator->errors()->first());
            return redirect()->back(); 
        }
        if($request->post('id')>0){
            $model=Blog::find($request->post('id'));
            $model->updated_at=date('Y-m-d H:i:s');
            $msg="blog updated";
        }else{
            $model=new Blog();
            $model->created_at=date('Y-m-d H:i:s');
            $msg="blog inserted";
        }

        if($request->hasfile('image')){

            if($request->post('id')>0){
                $arrImage=Blog::where(['id'=>$request->post('id')])->get();
                if(Storage::exists('/public/media/blog/'.$arrImage[0]->image)){
                    Storage::delete('/public/media/blog/'.$arrImage[0]->image);
                }
            }

            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media/blog',$image_name);
            $model->image=$image_name;
        }
        if($request->hasfile('main_image')){

            if($request->post('id')>0){
                $arrImage=Blog::where(['id'=>$request->post('id')])->get();
                if(Storage::exists('/public/media/blog/'.$arrImage[0]->main_image)){
                    Storage::delete('/public/media/blog/'.$arrImage[0]->main_image);
                }
            }

            $main_image=$request->file('main_image');
            $ext1=$main_image->extension();
            $main_image_name=time().'.'.$ext1;
            $main_image->storeAs('/public/media/blog',$main_image_name);
            $model->main_image=$main_image_name;
        }
        $model->title=$request->post('title');
         $model->alias=$request->post('alias');
        if(empty($request->post('alias'))){
            $slug = Str::slug($request->post('title'), '-');
            $count = Blog::whereRaw("alias RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $model->alias = $count ? "{$slug}-{$count}" : $slug;
        }
        $model->desc=$request->post('desc');
         $model->long_desc=$request->post('long_desc');
        $model->status=$request->post('status');
       
        $model->save();
        
        $request->session()->flash('message',$msg);
        return redirect()->route('admin.blog');
        
    }

    public function delete(Request $request){
         $id = $request->post('id');
        $model=Blog::find($id);
        $model->delete();
        echo json_encode(array('status'=>1,'message'=>'Data'));
    }

    public function status(Request $request,$status,$id){
        $model=Blog::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','blog status updated');
        return redirect('admin/blog');
    }
}
