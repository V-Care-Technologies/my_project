<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Storage;
use Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result['contacts']=Contact::all();
        return view('admin.contact',$result);
    }

    public function delete(Request $request){
        $id = $request->post('id');
        $model=Contact::find($id);
        $model->delete();
          echo json_encode(array('status'=>1,'message'=>'Data'));
    }

   
}
