<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function show()
    {
        $Students=Student::all();
        if(count($Students)>0){
            $response=[
                count($Students).' users found',
                'status'=>'1',
                'data'=> $Students
            ];
        }
        else{
            $response=[
                '0 '.'users found',
                'status'=>'0'
            ];
        }
        return response()->json($response,200);
        }
    }
