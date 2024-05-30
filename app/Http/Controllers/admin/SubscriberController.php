<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscribers;
use Storage;
use Validator;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result['subscribers']=Subscribers::all();
        return view('admin.subscribers',$result);
    }

    public function delete(Request $request){
        $id = $request->post('id');
        $model=Subscribers::find($id);
        $model->delete();
          echo json_encode(array('status'=>1,'message'=>'Data'));
    }

   
}
