<?php

namespace App\DataTables;

use App\Models\Product;
use App\Models\ProductStore;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ProductStoreDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'product_stores.datatables_actions')
            ->editColumn('store_id', function (ProductStore $productStore) {

                if (request('lang')) {
                    return  $productStore->store->storeLangs->where('lang_id', '=', request('lang'))->first()->name;
                }
                return $productStore->store->storeLangs->where('lang_id', '=', '2')->first()->name;
            })

            // ->editColumn('deliveryPrice', function (ProductStore $productStore) {

            //     return $productStore->price - $productStore->discount ; 
            // })

            ->editColumn('discount', function (ProductStore $productStore) {

                return $productStore->discount."%" ; 
            })


            ->rawColumns(['action', 'store_id' ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ProductStore $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $product_stories = ProductStore::where('product_id', request('id'));
        return $product_stories->newQuery();
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
            // 'product_id',
            'store_id' => ['title'=>'الشركة'],
            'price' => ['title' => 'السعر'],
            'currency' => ['title' => 'العملة'],
            'discount' => ['title' => 'الخصم'],
            'deliveryPrice' => ['title' => 'السعر بعد الخصم ']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'product_storesdatatable_' . time();
    }
}
