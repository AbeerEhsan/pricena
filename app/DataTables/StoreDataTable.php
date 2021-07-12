<?php

namespace App\DataTables;

use App\Models\Language;
use App\Models\Store;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;


class StoreDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'stores.datatables_actions')
                          ->editColumn('img',function(Store $store){
                            $url = asset('uploads/images/stores/'.$store->img);
                            return '<a data-fancybox="gallery" href="'.$url.'">
                            <img class="img-fluid img-resized rounded"src="'.$url.'"style="border-radius:30%;width:70px;height:70px"/>';  })
                          ->addColumn('name',function(Store $store){
                                if(request('lang')){
                                // $stores=Language::where('lang_id',request('lang'))->firstOrFail()->storeLangs;
                                return $store->storeLangs->where('lang_id','=',request('lang'))->first()->name;
                                  }
                                return $store->storeLangs->where('lang_id','=','2')->first()->name;
                                 })
                          ->editColumn('link',function(Store $store){
                                 return '<a href="'.$store->link.'">'.$store->link.'</a>'; })
                          ->editColumn('city_id',function(store $store){
                                 return $store->city->name;})
                          ->editColumn('user_id',function(store $store){
                                 return $store->user->name;})
                          ->rawColumns(['action','img','link','city_id','name','user_id']);
    }



    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Store $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Store $model)
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
            'img'=>['title'=>'الصورة','orderable'=>false],
            'name'=>['title'=>'اسم المتجر'],
            'city_id'=>['title'=>'المدينة'],
            'user_id'=>['title'=>'صاحب المتجر'],
            'link'=>['title'=>'رابط المتجر']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'storesdatatable_' . time();
    }
}
