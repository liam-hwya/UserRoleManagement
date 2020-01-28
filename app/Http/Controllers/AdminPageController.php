<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Material;

class AdminPageController extends Controller
{
    public function dashboard(){

        return view ('admin.dashboard');
    }

    public function material(){

        $materials = Material::orderBy('name','desc')->paginate(6);

        return view ('admin.material.index',[

            'materials' => $materials

        ]);
    }

    public function test(){
        return view('admin.material.edit');
    }
}
