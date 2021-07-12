<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class UserDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'users.datatables_actions')
            ->editColumn('img', function (User $user) {
                $url = asset('uploads/images/users/' . $user->img);
                return '<a data-fancybox="gallery" href="' . $url . '">
                                <img class="img-fluid img-resized rounded"src="' . $url . '"style="border-radius:30%;width:70px;height:70px"/>';
            })
            // })->editColumn('type',function(User $user){
            //     if($user->type == 'admin'){
            //         return '<div style="background-color:#a3f7bf;color:#fff;width:100px;height:40px;text-align:center;padding-top:10px"> أدمن</div>';
            //     }elseif($user->type == 'store'){
            //         return '<div style="background-color:#05dfd7;color:#fff;width:100px;height:40px;text-align:center;padding-top:10px">صاحب شركة</div>';
            //     }else{
            //         return '<div style="background-color:#f35588;color:#fff;width:100px;height:40px;text-align:center;padding-top:10px">مستخدم</div>';
            //     }
            // })
            ->editColumn('type', function (User $user) {
                switch ($user->type) {
                    case 'admin':
                        $class = 'type-admin';
                        $type = 'الادارة';
                        $style = 'background-color:#a3f7bf;color:#fff;width:100px;height:40px;text-align:center;padding-top:10px';
                        break;
                    case 'user':
                        $class = 'type-client';
                        $type = 'الزبائن';
                        $style = 'background-color:#05dfd7;color:#fff;width:100px;height:40px;text-align:center;padding-top:10px';
                        break;
                    case 'store':
                        $class = 'type-store';
                        $type = 'اصحاب المتاجر';
                        $style = 'background-color:#f35588;color:#fff;width:100px;height:40px;text-align:center;padding-top:10px';
                        break;
                }
                return "<div class='$class'style='$style'>$type</div>";
            })
            ->rawColumns(['action', 'img', 'type']);
    }
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        // return $model->newQuery();
        if ($this->type) {
            return User::orderBy('created_at', 'DESC')->where('type', $this->type);
        }
        return User::orderBy('created_at', 'DESC');
    }
    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $url = "//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json";

        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false, 'title' => 'الاجراءات'])
            ->parameters([
                'language' => [
                    'url' => $url,
                ],
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    // ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    // ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    // ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    // ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    // ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
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
            'img' => ['title' => 'الصورة الشخصية', 'orderable' => false],
            'name' => ['title' => 'اسم المستخدم'],
            'email' => ['title' => 'الايميل'],
            // 'email_verified_at',
            // 'password',
            'type' => ['title' => 'نوع المستخدم'],
            // 'remember_token'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'usersdatatable_' . time();
    }
}
