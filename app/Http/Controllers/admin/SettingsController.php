<?php

namespace App\Http\Controllers\Admin;

use App\Models\SiteSettings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result['settings']=SiteSettings::where(['id'=>'1'])->first(); 
        //print_r($result['settings']);exit;
        return view('admin.settings',$result);
    }


    public function manage_settings_process(Request $request)
    {
        //return $request->post();
        
        $validator = Validator::make($request->all(), [
            'title'=>'required',
            'logo'=>'mimes:jpeg,jpg,png',
        ]);

        if ($validator->fails()) {
            
            session()->flash('error',$validator->errors()->first());
            return redirect()->back(); 
        }

        $id='1';
        $model=SiteSettings::find($id);
        $model->updated_at=date('Y-m-d H:i:s');
        $msg="Site Settings Updated";
        if($request->hasfile('logo')){

            if($id>0){
                $arrImage=SiteSettings::where(['id'=>'1'])->get();
                if(Storage::exists('public/front/images/'.$arrImage[0]->logo)){
                    Storage::delete('public/front/images/'.$arrImage[0]->logo);
                }
            }

            $image=$request->file('logo');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('public/front/images/',$image_name);
            $model->logo=$image_name;
        }
        $model->title=$request->post('title');
        $model->mobile_no=$request->post('mobile_no');
        $model->email=$request->post('email');
        $model->address=$request->post('address');
        $model->insta_link=$request->post('insta_link');
        $model->facebook_link=$request->post('facebook_link');
        $model->linked_link=$request->post('linked_link');
        $model->pinterest_link=$request->post('pinterest_link');
        $model->flipkart_link=$request->post('flipkart_link');
        $model->amazon_link=$request->post('amazon_link');
        $model->top_line=$request->post('top_line');
        $model->shopnow_link=$request->post('shopnow_link');
        $model->brand_registry=$request->post('brand_registry');
        
        $model->save();
        
        $request->session()->flash('message',$msg);
        return redirect()->route('admin.settings');
        
    }

   
}
