<?php

namespace App\Http\Controllers;

use App\DataTables\ExamMastersDataTable;
use App\DataTables\QuestionsDataTable;
use App\Http\Requests\ExamRequest;
use App\Models\Category;
use App\Models\ExamMaster;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ExamMastersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ExamMaster $examMaster)
    {
        if (request()->ajax()) {
            $exams = ExamMaster::with('category');
            return DataTables::eloquent($exams)
                ->addColumn('category', function ($row) {
                    return $row->category?->name ?? '';
                })
                ->addColumn('actions', function ($row) {
                    $action = '<div class="btn-group">';
                    $action .= '<a href="' . route('exam-questions.index', $row->id) . '" class="btn btn-primary btn-sm action mr-2"><i class="fas fa-plus"></i></a>';
                    $action .= '<a href="' . route('exam-masters.show', $row->id) . '" class="btn btn-primary btn-sm action mr-2"><i class="fas fa-eye"></i></a>';
                    $action .= '<button type="button" data-id=' . $row->id . ' button-type="edit" class="btn btn-info btn-sm action btn-edit mr-2"><i class="fas fa-edit"></i></button>';
                    $action .= '<button type="button" data-id=' . $row->id . ' button-type="delete" class="btn btn-danger btn-sm action mr-2"><i class="fas fa-trash"></i></button>';
                    $action .= '<a href="' . route('register-exam', $row->exam_id) . '" target="_blank" class="btn btn-success btn-sm action"><i class="nav-icon fas fa-book"></i></a>';
                    return $action .= '</div>';
                })
                ->addColumn('total', function ($row) {
                    return $row->questions()->count();
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('master.exam.index', compact('examMaster'));
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
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'abbreviation' => 'required|string|max:3',
            'name' => 'required|string|max:255',
            'exam_date' => 'required|date',
            'exam_duration' => 'required|string',
            'is_active' => 'required|boolean',
        ]);

        $examId = 'EXAM.' . Carbon::now()->format('m.Y');
        $count = ExamMaster::where('exam_id', 'LIKE', $examId . '%')->count();
        $examId .= '.' . ($count + 1);

        $exam = new ExamMaster();
        $exam->exam_id = $examId;
        $exam->category_id = $request->category_id;
        $exam->abbreviation = $request->abbreviation;
        $exam->name = $request->name;
        $exam->exam_date = $request->exam_date;
        $exam->exam_duration = $request->exam_duration;
        $exam->is_active = $request->input('is_active', 0);
        $exam->save();

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
        return view('master.exam.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamMaster $examMaster)
    {
        $categories = Category::pluck('name', 'id');
        return view('master.exam.exam-action', compact('examMaster', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExamRequest $request, ExamMaster $examMaster)
    {
        $examMaster->category_id = $request->category_id;
        $examMaster->name = $request->name;
        $examMaster->abbreviation = $request->abbreviation;
        $examMaster->exam_date = $request->exam_date;
        $examMaster->exam_duration = $request->exam_duration;
        $examMaster->is_active = $request->input('is_active', 0);
        $examMaster->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Update data succesfully'
        ]);
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
