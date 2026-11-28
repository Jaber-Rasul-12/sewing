<?php namespace Jaber\Sewing\Models;

use Model;
// use Winter\Storm\Database\Builder;
// use BackendAuth;
/**
 * Model
 */
use Jacob\Logbook\Traits\LogChanges;
class OrderItem extends Model
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
    public $table = 'jaber_sewing_order_items';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'order_id'    => 'required|integer|exists:jaber_sewing_orders,id',
        'model_id'    => 'required|integer|exists:jaber_sewing_models,id',
        'material_id' => 'nullable|integer|exists:jaber_sewing_materials,id',
        'unit_id'     => 'nullable|integer|exists:jaber_sewing_units,id',
        'purchase_id' => 'nullable|integer|exists:jaber_sewing_purchases,id',
        'quantity'    => 'required|integer|min:1|max:100000',
        'unit_price'  => 'required|numeric|min:0|max:999999999',
        'total'       => 'nullable|numeric|min:0|max:999999999',
    ];

   

       public $belongsTo = [
        'order'    => [\Jaber\Sewing\Models\Order::class,        'key' => 'order_id'],
        'model'    => [\Jaber\Sewing\Models\SewingModel::class,  'key' => 'model_id'],
        'material' => [\Jaber\Sewing\Models\Material::class,     'key' => 'material_id'],
        'unit'     => [\Jaber\Sewing\Models\Unit::class,         'key' => 'unit_id'],
        'purchase' => [\Jaber\Sewing\Models\Purchase::class,     'key' => 'purchase_id'],
    ];

}
