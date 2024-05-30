<?php

namespace App\Http\Controllers\Admin;

use App\Models\CustomerReviews;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Storage;
use Validator;

class CustomerReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result['reviews']=CustomerReviews::all();
        return view('admin.customer_reviews.reviews',$result);
    }

    public function manage_reviews(Request $request,$id='')
    {
        if($id>0){
            $arr=CustomerReviews::where(['id'=>$id])->first(); 

             $result['name']=$arr->name;
            $result['description']=$arr->description;
            $result['rating']=$arr->rating;
            $result['image']=$arr->image;
            $result['id']=$arr->id;
            $result['product_id']=$arr->product_id;
            $result['products']=Product::where('status','=','0')->get();
           
        }else{
            $result['name']='';
            $result['description']='';
            $result['rating']='';
            $result['image']='';
            $result['id']=0;
            $result['product_id']='';
           $result['products']=Product::where('status','=','0')->get();
        }

        return view('admin.customer_reviews.manage_reviews',$result);
    }

    public function manage_reviews_process(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'name'=>'required',
            'image'=>'mimes:jpeg,jpg,png',
            'description'=>'required',
            'rating'=>'required',   
        ]);

        if ($validator->fails()) {
            
            session()->flash('error',$validator->errors()->first());
            return redirect()->back(); 
        }

        if($request->post('id')>0){
            $model=CustomerReviews::find($request->post('id'));
            $model->updated_at=date('Y-m-d H:i:s');
            $msg="Customer Review Updated";
        }else{
            $model=new CustomerReviews();
            $model->created_at=date('Y-m-d H:i:s');
            $msg="Customer Review Inserted";
        }

        if($request->hasfile('image')){

            if($request->post('id')>0){
                $arrImage=CustomerReviews::where(['id'=>$request->post('id')])->get();
                if(Storage::exists('/public/media/product_reviews/'.$arrImage[0]->image)){
                    Storage::delete('/public/media/product_reviews/'.$arrImage[0]->image);
                }
            }

            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media/product_reviews',$image_name);
            $model->image=$image_name;
        }
        $model->name=$request->post('name');
        $model->product_id=$request->post('product_id');
        $model->description=$request->post('description');
        $model->rating=$request->post('rating');
        $model->save();
        
        $request->session()->flash('message',$msg);
        return redirect()->route('admin.reviews');
        
    }

    public function delete(Request $request){
        $id = $request->post('id');
        $model=CustomerReviews::find($id);
        $model->delete();
         echo json_encode(array('status'=>1,'message'=>'Data'));
    }

   
}
