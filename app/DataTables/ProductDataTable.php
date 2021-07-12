<?php

namespace App\DataTables;

use App\Models\Product;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ProductDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'products.datatables_actions')

        ->editColumn('img',function(Product $product){
                $url = asset('uploads/images/'.$product->img);
                return '<a data-fancybox="gallery" href="'.$url.'">
                <img class="img-fluid img-resized rounded"src="'.$url.'"style="border-radius:30%;width:70px;height:70px"/>';  })
        ->addColumn('name',function(Product $product){
                       
                if(request('lang')){
                    // if ($product->productLangs->where('lang_id', '=', request('lang'))->first()->name == null) {

                    // }
                    return $product->productLangs->where('lang_id','=',request('lang'))->first()->name;
                  }
                return $product->productLangs->where('lang_id','=','2')->first()->name;
                 })

        ->editColumn('category_id',function(Product $product){
                 return $product->category->categoryLangs->first()->name;})

        ->addColumn('best_price', function (Product $product) {
        if ($product->productStores->count()>0 ) {
           
            foreach ($product->productStores as $store) {
                    // $prices[] =  $store->price;
                    $prices[] =  $store->deliveryPrice;
            }
            return min($prices) ;
        }
            return 0;

    })
        ->rawColumns(['action','img','name']);


    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
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
            'sku',
            'name'=>['title'=>'اسم المنتج'],
            'category_id' =>['title'=>'القسم التابع له'],
            'Barcode' =>['title'=>'  الكود'],
            'link' =>['title'=>'رابط المنتج  '],
            'visits' => ['title' => 'عدد الزيارات '],
            'best_price'=> ['title'=>' أقل سعر']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'productsdatatable_' . time();
    }
}
