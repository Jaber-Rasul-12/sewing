<?php namespace Jaber\Sewing\Models;

use Model;
// use Winter\Storm\Database\Builder;
// use BackendAuth;
/**
 * Model
 */
use Jacob\Logbook\Traits\LogChanges;
class Order extends Model
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
    public $table = 'jaber_sewing_orders';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'customer_id'  => 'required|integer|exists:jaber_sewing_customers,id',
        'model_id'     => 'nullable|integer|exists:jaber_sewing_models,id',
        'order_date'   => 'required|date',
        'due_date'     => 'nullable|date|after_or_equal:order_date',
        'status'       => 'required|in:new,in_progress,ready,delivered,cancelled',
        'total'        => 'nullable|numeric|min:0|max:999999999',
    ];


    public function getStatusListsAttribute()
  {
    return trans('jaber.sewing::lang.model.order.' . $this->attributes['status']);
  }
    public $hasMany = [
    'orderItems' => [
        \Jaber\Sewing\Models\OrderItem::class,
        'key' => 'order_id',
    ],
];

  public $belongsTo = [
        'customer' => [
            \Jaber\Sewing\Models\Customer::class,
            'key' => 'customer_id',
        ],
        'model' => [
            \Jaber\Sewing\Models\SewingModel::class,
            'key' => 'model_id',
        ],
    ];

}
