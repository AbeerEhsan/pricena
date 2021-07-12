<?php

namespace App\DataTables;

use App\Models\QuestionRateAnswer;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class QuestionRateAnswerDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'question_rate_answers.datatables_actions')
        
        ->addColumn('question',function(QuestionRateAnswer $questionRateAnswer){
            if(request('lang')){
            return $questionRateAnswer->question->qusetionRateLangs->where('lang_id','=',request('lang'))->first()->question;;    
            }
            return $questionRateAnswer->question->qusetionRateLangs->where('lang_id','=','2')->first()->question;
            })

            ->addColumn('answer',function(QuestionRateAnswer $questionRateAnswer){
                if(request('lang')){
                return $questionRateAnswer->question->qusetionRateLangs->where('lang_id','=',request('lang'))->first()->question;;    
                }
                return $questionRateAnswer->question->qusetionRateLangs->where('lang_id','=','2')->first()->question;
                })
      
        ->rawColumns(['action','question','answer']);
    

        
        ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\QuestionRateAnswer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(QuestionRateAnswer $model)
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
            'question' =>['title' => 'السؤال']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'question_rate_answersdatatable_' . time();
    }
}
