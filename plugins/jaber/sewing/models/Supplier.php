<?php namespace Jaber\Sewing\Models;

use Model;
// use Winter\Storm\Database\Builder;
// use BackendAuth;
/**
 * Model
 */
use Jacob\Logbook\Traits\LogChanges;
class Supplier extends Model
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
    public $table = 'jaber_sewing_suppliers';

    /**
     * @var array Validation rules
     */
      public $rules = [
        'name'    => 'required|string|min:3|max:150',
        'phone'   => 'required|string|min:7|max:30|unique:jaber_sewing_suppliers,phone',
        'address' => 'nullable|string|max:255',
        'notes'   => 'nullable|string|max:1000',
    ];


    public $hasMany = [
        'materials' => [
            \Jaber\Sewing\Models\Material::class,
            'key' => 'supplier_id',
        ],
        'purchases' => [
            \Jaber\Sewing\Models\Purchase::class,
            'key' => 'supplier_id',
        ],
    ];
   

}
