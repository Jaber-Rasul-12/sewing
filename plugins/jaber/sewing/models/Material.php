<?php namespace Jaber\Sewing\Models;

use Model;
// use Winter\Storm\Database\Builder;
// use BackendAuth;
/**
 * Model
 */
use Jacob\Logbook\Traits\LogChanges;
class Material extends Model
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
    public $table = 'jaber_sewing_materials';
    public $rules = [
        'name'          => 'required|string|min:2|max:150',
        'supplier_id'   => 'required|integer|exists:jaber_sewing_suppliers,id',
    ];

        public $belongsTo = [
        'supplier' => [
            \Jaber\Sewing\Models\Supplier::class,
            'key' => 'supplier_id',
        ],
    ];


        public $belongsToMany = [
        'units' => ['Jaber\Sewing\Models\Unit', 'table' => 'jaber_sewing_units_materials']
        ];

        public $hasMany = [
        'purchases' => [
            \Jaber\Sewing\Models\Purchase::class,
            'key' => 'material_id',
        ],
    ];

}
