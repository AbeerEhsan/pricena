<?php

namespace App\DataTables;

use App\Models\Slider;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class SliderDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'sliders.datatables_actions')
        
        ->editColumn('img',function(Slider $slider){
            $url = asset('storage/uploads/images/sliders/'.$slider->img);
            return '<a data-fancybox="gallery" href="'.$url.'">
            <img class="img-fluid img-resized rounded"src="'.$url.'"style="border-radius:30%;width:70px;height:70px"/>';  })

        ->editColumn('offer_id',function(Slider $slider){
         
            if(request('lang')){
                return $slider->offer->product->productLangs->where('lang_id','=',request('lang'))->first()->name;    
                  }
                return $slider->offer->product->productLangs->where('lang_id','=','2')->first()->name;
                 })
 
        ->addColumn('store',function(Slider $slider){
           
            if(request('lang')){
                return  $slider->offer->store->storeLangs->where('lang_id','=',request('lang'))->first()->name;    
                  }
                return $slider->offer->store->storeLangs->where('lang_id','=','2')->first()->name;
                 })

            ->rawColumns(['action','img','store','offer_id']);
 
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Slider $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Slider $model)
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
            'img'=>['title'=>'الصورة'],
            'link'=>['title'=>'رابط السلايدر'],
            'offer_id'=>['title'=>'منتج العرض'],
            'store'=>['title'=>'المتجر']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'slidersdatatable_' . time();
    }
}
