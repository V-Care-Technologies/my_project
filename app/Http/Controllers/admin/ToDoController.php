<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\ToDoModel;
use Validator;

class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result['data']=ToDoModel::rightJoin('users', 'users.id', '=', 'todo.user_id')
        ->rightJoin('project', 'project.id', '=', 'todo.project_id')
        ->select('todo.*','users.name as user_name','project.project_name')->get();

        return view('admin.todo.todo',$result);
    }

    function project_todo() {
        $result['data'] = ToDoModel::rightJoin('users', 'users.id', '=', 'todo.user_id')
        ->rightJoin('project', 'project.id', '=', 'todo.project_id')
        ->select('todo.*', 'users.name as user_name', 'project.project_name')
        ->orderBy('project.project_name')
        ->get()
        ->groupBy('project_name');

        return view('admin.todo.project_todo',$result);
    }

    public function manage_todo(Request $request,$id='')
    {

        if($id>0){
            $arr=ToDoModel::where(['id'=>$id])->get();

            $result['project_id']=$arr['0']->project_id;
            $result['user_id']=$arr['0']->user_id;
            $result['priority']=$arr['0']->priority;
            $result['date']=$arr['0']->date;
            $result['title']=$arr['0']->title;
            $result['description']=$arr['0']->description;
            $result['status']=$arr['0']->status;
            $result['id']=$arr['0']->id;



        }else{
            // $result['category_id']='';
            $result['project_id']='';
            $result['user_id']='';
            $result['priority']='';
            $result['date']='';
            $result['title']='';
            $result['description']='';
            $result['status']='';
            $result['id']=0;


        }
        $result['user']=User::rightJoin('user_groups', 'user_groups.user_id', '=', 'users.id')
        ->select('users.*','user_groups.group_id as group_id')
        ->where('user_groups.group_id','!=','1')
        ->get();

        $result['project']=Project::where('status','=','0')->get();


        return view('admin.todo.manage_todo',$result);
    }

    public function manage_todo_process(Request $request)
    {
        // dd($request->all());


        $validator = Validator::make($request->all(), [
            'title'=>'required',


        ]);

        if ($validator->fails()) {

            session()->flash('error',$validator->errors()->first());
            return redirect()->back();
        }
        // $label_idArr=$request->post('label_id');


        if($request->post('id')>0){
            $model=ToDoModel::find($request->post('id'));
             $model->updated_at=date('Y-m-d H:i:s');
            $msg="Product updated";
        }else{
            $model=new ToDoModel();
            $model->created_at=date('Y-m-d H:i:s');
            $msg="Product inserted";
        }

        $model->project_id=$request->post('project_id');
        $model->user_id=$request->post('user_id');
        $model->priority=$request->post('priority');
        $model->date=$request->post('date');
        $model->title=$request->post('title');
        $model->description=$request->post('description');
        $model->status=$request->post('status');

        $model->save();






        $request->session()->flash('message',$msg);
        return redirect()->route('admin.todo');

    }



    public function delete(Request $request){
         $id = $request->post('id');
        $model=ToDoModel::find($id);
        $model->delete();

        echo json_encode(array('status'=>1,'message'=>'Data'));
    }
}
