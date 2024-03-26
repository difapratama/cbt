<?php

namespace App\Http\Controllers;

use App\DataTables\ExamMastersDataTable;
use App\DataTables\QuestionsDataTable;
use App\Http\Requests\ExamRequest;
use App\Models\Category;
use App\Models\ExamMaster;
use App\Models\Question;
use Illuminate\Http\Request;

class ExamMastersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ExamMastersDataTable $dataTable)
    {
        $exams = ExamMaster::with('category')->get();
        return $dataTable->with('exams', $exams)->render('master.exam.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        return view('master.exam.exam-action', ['examMaster' => new ExamMaster(), 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamRequest $request)
    {
        $data = $request->all();
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        ExamMaster::create($data);
        return response()->json([
            'status' => 'success',
            'message' => 'Create exam succesfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, QuestionsDataTable $dataTable)
    {
        // dd($questions);
        return $dataTable->render('master.exam.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamMaster $examMaster)
    {
        $categories = Category::where('name', $examMaster->id)->get();
        return view('master.exam.exam-action', compact('examMaster','categories'));
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
