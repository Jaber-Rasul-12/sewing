<?php namespace Jaber\Sewing\Models;

use Model;
// use Winter\Storm\Database\Builder;
// use BackendAuth;
/**
 * Model
 */
use Jacob\Logbook\Traits\LogChanges;
class Unit extends Model
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
    public $table = 'jaber_sewing_units';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name'           => 'required|string|min:2|max:80',
        'short_name'     => 'required|string|min:1|max:20|unique:jaber_sewing_units,short_name',
    ];

   

      /**
     * @var array Relations
     */
    public $hasMany = [
        'purchases' => [
            \Jaber\Sewing\Models\Purchase::class,
            'key' => 'unit_id',
        ]
    ];

    public $belongsToMany = [
        'materials' => ['Jaber\Sewing\Models\Material', 'table' => 'jaber_sewing_units_materials']
    ];



}
