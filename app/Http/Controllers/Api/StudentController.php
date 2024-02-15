<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        if($students->isEmpty()){
            return response()->json([
                'message' => 'No students found',
                'status' => 404,
            ]);
        }

        return response()->json([
            'data' => $students,
            'status' => 200,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students',
            'password' => 'required',
        ]);

        $student = Student::create($request->all());

        return response()->json([
            'data' => $student,
            'status' => 201,
        ]);
    }

    public function show(int $id)
    {
        $student = Student::find($id);

        if(!$student){
            return response()->json([
                'message' => 'Student not found',
                'status' => 404,
            ]);
        }

        return response()->json([
            'data' => $student,
            'status' => 200,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $student = Student::find($id);

        if(!$student){
            return response()->json([
                'message' => 'Student not found',
                'status' => 404,
            ]);
        }

        if(!$student->update($request->all())){
            return response()->json([
                'message' => 'Error updating student',
                'status' => 500,
            ]);
        };

        return response()->json([
            'data' => $student,
            'status' => 200,
        ]);
    }

    public function destroy(int $id)
    {
        $student = Student::find($id);

        if(!$student){
            return response()->json([
                'message' => 'Student not found',
                'status' => 404,
            ]);
        }

        if(!$student->delete()){
            return response()->json([
                'message' => 'Error deleting student',
                'status' => 500,
            ]);
        };

        return response()->json([
            'message' => 'Student deleted',
            'status' => 200,
        ]);
    }
}
