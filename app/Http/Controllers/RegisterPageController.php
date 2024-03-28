<?php

namespace App\Http\Controllers;

use App\Models\ExamMaster;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $examId, Request $request)
    {
        if ($request->post()) {
            $exam = ExamMaster::findOrFail($examId);
            $email = $request->email;
            $user = User::where('email', $email)->first();
            if ($user) {
                // Check if user is already registered for the exam
                if ($exam->users()->where('user_id', $user->id)->exists()) {
                    return response()->json(['message' => 'User is already registered for this exam'], 400);
                } else {
                    $exam->users()->attach($user->id, ['is_approved' => false]);
                    return response()->json(['message' => 'Student registered successfully']);
                }
            } else {
                return response()->json(['message' => 'User not found'], 404);
            }

            return response()->json(['message' => 'Students registered successfully']);
        }
        
        $examMaster = ExamMaster::where('exam_id', $examId)->firstOrFail();
        return view('register-exam', compact('examMaster'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id 
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
