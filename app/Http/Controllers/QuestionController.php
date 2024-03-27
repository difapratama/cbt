<?php

namespace App\Http\Controllers;

use App\DataTables\QuestionsDataTable;
use App\Models\Choice;
use App\Models\ExamMaster;
use App\Models\Question;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ExamMaster $examMaster)
    {
        // $questions = Question::with('choices')->where('exam_id', $examMaster->id)->get();
        // dd($questions);
        if (request()->ajax()) {
            $questions = Question::with('choices')->where('exam_id', $examMaster->id);
            return DataTables::eloquent($questions)
                ->addColumn('answer', function ($row) {
                    return $row->choices()?->where('is_correct', true)->first()?->choice_text ?? '';
                })
                ->addColumn('actions', function ($row) {
                    $action = '<div class="btn-group">';
                    $action .= '<button type="button" data-id=' . $row->id . ' button-type="edit" class="btn btn-info btn-sm action btn-edit mr-2"><i class="fas fa-edit"></i></button>';
                    $action .= '<button type="button" data-id=' . $row->id . ' button-type="delete" class="btn btn-danger btn-sm action"><i class="fas fa-trash"></i></button>';

                    return $action .= '</div>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('master.question.index', compact('examMaster'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ExamMaster $examMaster)
    {
        return view('master.question.question-action', ['question' => new Question(), 'examMaster' => $examMaster]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamMaster $examMaster, Request $request)
    {
        // dd($request->all());
        $request->validate([
            'question_text' => 'required|string',
            'choices' => 'required|array',
            'is_correct' => 'required',
        ]);

        $question = Question::create([
            'exam_id' => $examMaster->id,
            'question_text' => $request->question_text
        ]);

        foreach ($request->input('choices') as $key => $choice_text) {
            Choice::create([
                'question_id' => $question->id,
                'choice_text' => $choice_text,
                'is_correct' => ($key == $request->input('choice_text')) ? true : false
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Create Question Succesfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
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
