<?php namespace Jaber\Sewing\Models;

use Model;
// use Winter\Storm\Database\Builder;
// use BackendAuth;
/**
 * Model
 */
use Jacob\Logbook\Traits\LogChanges;
use Ramsey\Uuid\Guid\Guid;
class Purchase extends Model
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
    public $table = 'jaber_sewing_purchases';

     public $rules = [
        'material_id'   => 'required|integer|exists:jaber_sewing_materials,id',
        'unit_id'       => 'required|integer|exists:jaber_sewing_units,id',
        'supplier_id'   => 'required|integer|exists:jaber_sewing_suppliers,id',
        'purchase_date' => 'required|date|before_or_equal:today',
        'quantity'      => 'required|numeric|min:0.001|max:999999999',
        'unit_price'    => 'required|numeric|min:0|max:999999999',
        'total_price'   => 'nullable|numeric|min:0',
        'uuid'          => 'nullable|string|max:36|unique:jaber_sewing_purchases,uuid',
    ];

      public function getFullQualityNameAttribute()
  {
    $this->load('material');
    $this->load('unit');
    $this->load('supplier');

    return $this->material->name  . ' - '. $this->unit->name . ' - ' . $this->supplier->name . ' - (' .  $this->quantity . ' ) ( ' . $this->total_price .  ')';
  }

      public $belongsTo = [
        'material' => [
            \Jaber\Sewing\Models\Material::class,
            'key' => 'material_id',
        ],
        'unit' => [
            \Jaber\Sewing\Models\Unit::class,
            'key' => 'unit_id',
        ],
        'supplier' => [
            \Jaber\Sewing\Models\Supplier::class,
            'key' => 'supplier_id',
        ],
    ];

    public $attachMany = [
        'photos' => 'System\Models\File'
    ];


     /**
   * Filter and set options for form fields based on certain conditions.
   *
   * @param object $fields   The form fields.
   * @param mixed  $context  Additional context information if needed.
   *
   */
public function filterFields($fields, $context = null)
{
    if (
        (isset($fields->quantity) && !empty($fields->quantity->value)) &&
        (isset($fields->unit_price) && !empty($fields->unit_price->value))
    ) {
        $fields->total_price->value = $fields->quantity->value * $fields->unit_price->value;
    } else {
        $fields->total_price->value = 0;
    }
}

  public function getUnitIdOptions()
  {
    if ( isset($this->material->id) && !empty($this->material->id)) {
      return Unit::whereHas('materials',function ($query) {
          $query->where('material_id', $this->material->id);
      })->get()->lists('name', 'id');
    } else {
      return [];
    }
  }

    public function beforeValidate()
  {
    if (empty($this->uuid)) {
      $this->uuid = Guid::uuid4()->toString();
    }
  }

  


    /**
     * @var array Relations
     */
    public $hasMany = [
        'orderItems' => [
            \Jaber\Sewing\Models\OrderItem::class,
            'key' => 'purchase_id',
        ],
    ];


}
