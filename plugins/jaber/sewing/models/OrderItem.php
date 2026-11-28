<?php namespace Jaber\Sewing\Models;

use Model;
// use Winter\Storm\Database\Builder;
// use BackendAuth;
/**
 * Model
 */
use \Winter\Storm\Database\Traits\Purgeable;

use Jacob\Logbook\Traits\LogChanges;
class OrderItem extends Model
{
    use \Winter\Storm\Database\Traits\Validation;
        use LogChanges;

        protected $purgeable = ['avilable_quantity'];

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

      public function getDropdownOptions($fieldName, $value, $formData)
  {
    return [];
  }




    public function getPurchaseIdOptions()
  {
    if (isset($this->material) && !empty($this->material->id)) {
      return Purchase::where('material_id', $this->material->id)->get()->lists('FullQualityName', 'id');
    } else {
      return [];
    }
  }

      public function getUnitIdOptions()
  {
    if (isset($this->material) && !empty($this->material->id) && isset($this->purchase_id) && !empty($this->purchase_id)) {
      return Purchase::where('id', $this->purchase_id)->get()->lists('unit.name', 'unit.id');
    } else {
      return [];
    }
  }
    public function filterFields($fields, $context = null)
  {

    if (isset($fields->material) && !empty($fields->material->value) && isset($fields->purchase_id) && !empty($fields->purchase_id->value) && isset($fields->unit_id) && !empty($fields->unit_id->value)) {
        $fields->avilable_quantity->value = Purchase::where('id', $fields->purchase_id->value)->first()->quantity;
        $fields->unit_price->value = Purchase::where('id', $fields->purchase_id->value)->first()->unit_price;

        
    }else{
        $fields->avilable_quantity->value = 0;


    }

    if (isset($fields->unit_price) && !empty($fields->unit_price->value) && isset($fields->quantity) && !empty($fields->quantity->value)) {
        $fields->total->value = $fields->unit_price->value * $fields->quantity->value;

        
    }else{
        $fields->total->value = 0;


    }
  }

  public function beforeValidate()
  {
    
    $this->model_id = $this->order->model_id;
  }

}


