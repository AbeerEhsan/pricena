<?php

namespace App\DataTables;

use App\Models\Offer;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class OfferDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'offers.datatables_actions')

        ->editColumn('product_id',function(Offer $offer){

            if(request('lang')){
                return $offer->product->productLangs->where('lang_id','=',request('lang'))->first()->name;
                  }
                return $offer->product->productLangs->where('lang_id','=','2')->first()->name;
                 })

        ->editColumn('store_id',function(Offer $offer){

            if(request('lang')){
                return  $offer->store->storeLangs->where('lang_id','=',request('lang'))->first()->name;
                  }
                return $offer->store->storeLangs->where('lang_id','=','2')->first()->name;
                 })

        ->addColumn('is_star',function(Offer $offer){

            $a= $offer->is_star?"checked":"";
            return ' <input type="checkbox" disabled '.$a.' /> ';


        })

            ->rawColumns(['action','product_id','store_id','is_star']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Offer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Offer $model)
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
            'product_id' => ['title'=>'المنتج'],
            'store_id'  => ['title'=>'المتجر'] ,
            // 'link'  => ['title'=>'رابط العرض'] ,
            'discount'  => ['title'=>'الخصم'],
            'is_star'  => ['title'=>'عرضه في السلايدر']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'offersdatatable_' . time();
    }
}
