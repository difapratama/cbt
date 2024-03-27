<?php

namespace App\Http\Controllers;

use App\DataTables\CategoriesDataTable;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoriesDataTable $dataTable)
    {
        if (request()->ajax()) {
            $exams = Category::query();
            return DataTables::eloquent($exams)
                ->addColumn('actions', function ($row) {
                    $action = '<div class="btn-group">';
                    $action .= '<button type="button" data-id=' . $row->id . ' button-type="edit" class="btn btn-info btn-sm action btn-edit mr-2"><i class="fas fa-edit"></i></button>';
                    $action .= '<button type="button" data-id=' . $row->id . ' button-type="delete" class="btn btn-danger btn-sm action mr-2"><i class="fas fa-trash"></i></button>';
                    return $action .= '</div>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('master.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.category.category-action', ['category' => new Category()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        Category::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Create category succesfully'
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
    public function edit(Category $category)
    {
        return view('master.category.category-action', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->name = $request->name;
        $category->description = $request->description;
        $category->is_active = $request->input('is_active', 0);

        $category->save();

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
