<?php namespace Jaber\Sewing\Models;

use Model;
use Jacob\Logbook\Traits\LogChanges;
class Category extends Model
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
    public $table = 'jaber_sewing_categories';

    /**
     * @var array Validation rules
     */
        public $rules = [
        'name' => 'required|string|min:2|max:150|unique:jaber_sewing_categories,name',
    ];

}
