<?php namespace Jaber\Sewing\Models;

use Model;
// use Winter\Storm\Database\Builder;
// use BackendAuth;
/**
 * Model
 */
use Jacob\Logbook\Traits\LogChanges;
class Expense extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
    
       use LogChanges;
  public $logBookModelName = 'jaber.sewing::lang.plugin.categories';
  public static function changeLogBookDisplayColumn($column)
  {
    return 'jaber.sewing::lang.model.category.' . $column;
  }

    
    





    /**
     * @var string The database table used by the model.
     */
    public $table = 'jaber_sewing_expenses';

    /**
     * @var array Validation rules
     */
    public $rules = [
              'type_expense_id' => 'required|integer|exists:jaber_sewing_type_expenses,id',
        'amount'          => 'required|numeric|min:0.01|max:999999999',
        'expense_date'    => 'required|date|before_or_equal:today',
        'notes'           => 'nullable|string|max:1000',
    ];


        public $attachMany = [
        'photos' => 'System\Models\File'
    ];
        public $belongsTo = [
        'type_expense' => [
            \Jaber\Sewing\Models\TypeExpense::class,
            'key' => 'type_expense_id',
        ],
    ];

  



}
