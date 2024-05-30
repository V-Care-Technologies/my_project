<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileManagerController extends Controller
{

    public function index(Request $request)
    {
        return view('admin.file-manager.file_manager');
    }


}
