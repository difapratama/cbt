<?php

namespace App\DataTables;

use App\Models\ExamMaster;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ExamMastersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('d-m-Y H:i:s');
            })
            ->editColumn('updated_at', function ($row) {
                return $row->updated_at->format('d-m-Y H:i:s');
            })
            ->addColumn('category', function(ExamMaster $examMaster) {
                return $examMaster->category?->name;
            })
            ->addColumn('action', function ($row) {
                $action = '<div class="btn-group">';
                $action .= '<a href="' . route('exam-questions.index', $row->id) . '" class="btn btn-success action mr-2"><i class="fas fa-eye"></i></a>';
                $action .= '<button type="button" data-id=' . $row->id . ' button-type="edit" class="btn btn-info action mr-2"><i class="fas fa-edit"></i></button>';
                $action .= '<button type="button" data-id=' . $row->id . ' button-type="delete" class="btn btn-danger action"><i class="fas fa-trash"></i></button>';

                return $action .= '</div>';
            })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ExamMaster $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ExamMaster $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('exammasters-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false),
            Column::make('category')->title('Category'),
            Column::make('name'),
            Column::make('exam_date'),
            Column::make('exam_duration'),
            Column::make('is_active')->title('Status'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'ExamMasters_' . date('YmdHis');
    }
}
