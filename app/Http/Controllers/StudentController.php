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

        public function studentDetails($id)
        {
            $student=Student::find($id);
            return $student;
        }

        public function getMail($id)
        {
            $user=Student::find($id);
            if($user)
            {
                $email= $user->email;
                $response=[
                    'status'=>'1',
                    'data'=> $email,
                ];
            }
            else
            {
                $response=[
                    'status'=>'0',
                    'data'=> 'No data foound',
                ];
            }
            return response()->json($response,200);
        }

        public function storeData(Request $request)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'age' => 'required|integer',
                'phone' => 'required|string|max:11|',
                'email' => 'required|email|max:255',
            ]);

            $temp=Student::create($validatedData);

            if($temp)
            {
                $response=[
                    'status'=>'1',
                    'data'=>'Student added successfully',
                ];
            }
            else
            {
                $response=[
                    'status'=>'0',
                    'data'=>'Failed to add data'
                ];
            }
            return response()->json($response,200);
        }

        public function updateData(Request $request, $id)
        {
            $request ->validate([
                'name' => 'required|string|max:255',
                'age' => 'required|integer',
                'phone' => 'required|string|max:11|',
                'email' => 'required|email|max:255',
            ]);
    
            $temp=Student::find($id);
            if($temp)
           { 
            $temp->name= $request->name;
            $temp->age= $request->age;
            $temp->phone=$request->phone;
            $temp->email=$request->email;
            $temp->update();
            $response=['status'=>'1',
             'mesaage'=>'Data updated successfully'];
    }
    else
    {
        $response=['status'=>'1',
    'message'=>'Couldnt update data'];
    }
    return response()->json($response,200);
        }
    }
