<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Storage;
use Validator;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result['category']=Category::all();
        return view('admin.category.category',$result);
    }

    public function manage_category(Request $request,$id='')
    {
        if($id>0){
            $arr=Category::where(['id'=>$id])->first();

            $result['category_name']=$arr->category_name;
            $result['category_slug']=$arr->category_slug;
            $result['parent_category_id']=$arr->parent_category_id;
            $result['category_image']=$arr->category_image;
            $result['is_home']=$arr->is_home;
            $result['status']=$arr->status;
            $result['is_home_selected']="";
            if($arr->is_home==1){
                $result['is_home_selected']="checked";
            }
            $result['id']=$arr->id;

            $result['category']=Category::where(['status'=>1])->where('id','!=',$id)->get();
        }else{
            $result['category_name']='';
            $result['category_slug']='';
            $result['parent_category_id']='';
            $result['category_image']='';
            $result['is_home']="";
            $result['is_home_selected']="";
            $result['status']="";
            $result['id']=0;

            $result['category']=Category::where(['status'=>1])->get();

        }

        return view('admin.category.manage_category',$result);
    }

    public function manage_category_process(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'category_name'=>'required',
            'category_image'=>'mimes:jpeg,jpg,png,svg',
            'category_slug'=>'unique:categories,category_slug,'.$request->post('id'),
        ]);

        if ($validator->fails()) {

            session()->flash('error',$validator->errors()->first());
            return redirect()->back();
        }

        if($request->post('id')>0){
            $model=Category::find($request->post('id'));
            $model->updated_at=date('Y-m-d H:i:s');
            $msg="Category updated";
        }else{
            $model=new Category();
            $model->created_at=date('Y-m-d H:i:s');
            $msg="Category inserted";
        }

        if($request->hasfile('category_image')){

            if($request->post('id')>0){
                $arrImage=Category::where(['id'=>$request->post('id')])->get();
                if(Storage::exists('/public/media/category/'.$arrImage[0]->category_image)){
                    Storage::delete('/public/media/category/'.$arrImage[0]->category_image);
                }
            }

            $image=$request->file('category_image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media/category',$image_name);
            $model->category_image=$image_name;
        }
        $model->category_name=$request->post('category_name');
        $model->category_slug=$request->post('category_slug');

        if(empty($request->post('category_slug'))){

            $slug = Str::slug($request->post('category_name'), '-');
            $count = Category::whereRaw("category_slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $model->category_slug = $count ? "{$slug}-{$count}" : $slug;

           // $model->category_slug=Str::slug($request->post('category_name'), '-');
        }
        $model->parent_category_id=$request->post('parent_category_id');
        $model->is_home=0;
        if($request->post('is_home')!=null){
            $model->is_home=1;
        }
        $model->status=$request->post('status');
        $model->save();

        $request->session()->flash('message',$msg);
        return redirect()->route('admin.category');

    }

    public function delete(Request $request){
         $id = $request->post('id');
        $model=Category::find($id);
        $model->delete();
        echo json_encode(array('status'=>1,'message'=>'Data'));
    }

    public function status(Request $request,$status,$id){
        $model=Category::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Category status updated');
        return redirect('admin/category');
    }
}
