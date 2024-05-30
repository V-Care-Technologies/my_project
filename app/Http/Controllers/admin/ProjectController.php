<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\AssignTeam;
use Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result['data']=Project::all();

        return view('admin.project.project',$result);
    }

    public function manage_project(Request $request,$id='')
    {

        if($id>0){
            $arr=Project::where(['id'=>$id])->get();
// dd($arr->id);
            // $result['category_id']=$arr['0']->category_id;
            $result['project_name']=$arr['0']->project_name;
            $result['description']=$arr['0']->description;
            $result['deadline']=$arr['0']->deadline;
            $result['id']=$arr['0']->id;
            $productLableAttrArrs=AssignTeam::where(['project_id'=>$id])->get();
            // dd($productLableAttrArrs);
            $bAR=[];
            foreach ($productLableAttrArrs as $key => $value) {
                # code...
                $demo=$productLableAttrArrs[$key]->user_id;
                array_push($bAR,$demo);
            }
           $result['productLableAttrArr']=$bAR;
        }else{
            // $result['category_id']='';
            $result['project_name']='';
            $result['description']='';
            $result['deadline']='';
            $result['id']=0;


        }
        $result['user']=User::rightJoin('user_groups', 'user_groups.user_id', '=', 'users.id')
        ->select('users.*','user_groups.group_id as group_id')
        ->where('user_groups.group_id','!=','1')
        ->get();

        return view('admin.project.manage_project',$result);
    }

    public function manage_project_process(Request $request)
    {
        // dd($request->all());


        $validator = Validator::make($request->all(), [
            'project_name'=>'required',


        ]);

        if ($validator->fails()) {

            session()->flash('error',$validator->errors()->first());
            return redirect()->back();
        }
        // $label_idArr=$request->post('label_id');


        if($request->post('id')>0){
            $model=Project::find($request->post('id'));
             $model->updated_at=date('Y-m-d H:i:s');
            $msg="Product updated";
        }else{
            $model=new Project();
            $model->created_at=date('Y-m-d H:i:s');
            $msg="Product inserted";
        }

        $model->project_name=$request->post('project_name');
        $model->description=$request->post('description');
        $model->deadline=$request->post('deadline');

        $model->save();
        $pid=$model->id;

    //    $productCat=$request->post('user_id');

    //     foreach($productCat as $key=>$val){

    //         $cat=new AssignTeam();
    //         $cat->project_id=$pid;
    //         $cat->user_id=$val;
    //         $cat->created_at=date('Y-m-d H:i:s');
    //         $cat->save();
    //     }


        $productCat=$request->post('user_id');
       if($productCat){
           if($request->post('id')){
            AssignTeam::where('project_id',$request->post('id'))->delete();
           }
            foreach($productCat as $key=>$val){

                $cat=new AssignTeam();
            $cat->project_id=$pid;
            $cat->user_id=$val;
            $cat->created_at=date('Y-m-d H:i:s');
            $cat->save();
            }
        }

        $request->session()->flash('message',$msg);
        return redirect()->route('admin.project');

    }



    public function delete(Request $request){
         $id = $request->post('id');
        $model=Project::find($id);
        $model->delete();
        $team=AssignTeam::where('project_id',$id)->delete();
        echo json_encode(array('status'=>1,'message'=>'Data'));
    }

}
