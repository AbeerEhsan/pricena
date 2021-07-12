<?php

namespace App\DataTables;

use App\Models\TipAppSlider;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class TipAppSliderDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'tip_app_sliders.datatables_actions')

        ->editColumn('image',function(TipAppSlider $tip){
            $url = asset('uploads/images/app-tip-sliders/'.$tip->image);
            return '<a data-fancybox="gallery" href="'.$url.'">
            <img class="img-fluid img-resized rounded"src="'.$url.'"style="border-radius:30%;width:70px;height:70px"/>';  })

            ->editColumn('description',function(TipAppSlider $tip){

            return substr($tip->description, 0, 200) .'...';

            })
        ->rawColumns(['action','image','description']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\TipAppSlider $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TipAppSlider $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $url ="//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json";

        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false,'title'=>'الاجراءات'])
            ->parameters([
                'language' =>[
                    'url' => $url,
                ],
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    // ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'image' => ['title'=>'الصورة'],
            'description' => ['title'=>'الوصف']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'tip_app_slidersdatatable_' . time();
    }
}
