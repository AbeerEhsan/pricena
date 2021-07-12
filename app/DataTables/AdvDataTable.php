<?php

namespace App\DataTables;

use App\Models\Adv;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class AdvDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'advs.datatables_actions')

        ->editColumn('media_link',function(Adv $adv){
            $url = asset('uploads/images/adv/'.$adv->media_link);
            $video= asset('uploads/images/adv/video.jpg');
            if ($adv->type == 'photo') {
                return '<a data-fancybox="gallery" href="'.$url.'">
                <img class="img-fluid img-resized rounded"src="'.$url.'"style="border-radius:30%;width:70px;height:70px"/>';          
                }
             else {
                 return '<a data-fancybox="gallery" href="'.$url.'">
                <img class="img-fluid img-resized rounded"src="'.$video.'"style="border-radius:30%;width:70px;height:70px"/>';  
            }
                
           
        })

        ->editColumn('is_active',function(Adv $adv){

            $a= $adv->is_active?"checked":"";
            return ' <input type="checkbox" disabled '.$a.' /> ';


        })

        ->rawColumns(['action','media_link','is_active']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Adv $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Adv $model)
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
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
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
            'media_link' => ['title'=>'الصورة/الفيديو'],
            'link' => ['title'=>'الرابط'],
            
            'description' => ['title'=>'الوصف'],
            'type' => ['title'=>'النوع'],
            'is_active' => ['title'=>'Active']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'advsdatatable_' . time();
    }
}
