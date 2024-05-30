<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;
use Validator;
use App\Models\Video;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result['video']=Video::all();
        return view('admin.video.video',$result);
    }

    public function manage_video(Request $request,$id='')
    {
        if($id>0){
            $arr=Video::where(['id'=>$id])->first();

            $result['title']=$arr->title;
            $result['video_url']=$arr->video_url;
            $result['status']=$arr->status;
            $result['id']=$arr->id;

            $result['video']=Video::where(['status'=>1])->where('id','!=',$id)->get();
        }else{
            $result['title']='';
            $result['video_url']='';

            $result['status']="";
            $result['id']=0;

            $result['video']=Video::where(['status'=>1])->get();

        }

        return view('admin.video.manage_video',$result);
    }

    public function manage_video_process(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'title'=>'required',
            'video_url'=>'required',
        ]);

        if ($validator->fails()) {

            session()->flash('error',$validator->errors()->first());
            return redirect()->back();
        }

        if($request->post('id')>0){
            $model=Video::find($request->post('id'));
            $model->updated_at=date('Y-m-d H:i:s');
            $msg="Video updated";
        }else{
            $model=new Video();
            $model->created_at=date('Y-m-d H:i:s');
            $msg="Video inserted";
        }


        $model->title=$request->post('title');
        $model->video_url=$request->post('video_url');
        $model->status=$request->post('status');
        $model->save();

        $request->session()->flash('message',$msg);
        return redirect()->route('admin.video');

    }

    public function delete(Request $request){
         $id = $request->post('id');
        $model=Video::find($id);
        $model->delete();
        echo json_encode(array('status'=>1,'message'=>'Data'));
    }


}
