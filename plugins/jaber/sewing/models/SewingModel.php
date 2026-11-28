<?php namespace Jaber\Sewing\Models;

use Model;
// use Winter\Storm\Database\Builder;
// use BackendAuth;
/**
 * Model
 */
use Jacob\Logbook\Traits\LogChanges;
class SewingModel extends Model
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
    public $table = 'jaber_sewing_models';

    /**
     * @var array Validation rules
     */
   public $rules = [
        'name'          => 'required|string|min:2|max:150',
        'code'          => 'required|string|min:2|max:40|unique:jaber_sewing_models,code',
        'category_id'   => 'required|integer|exists:jaber_sewing_categories,id',
        'description'   => 'nullable|string|max:1000',
        'is_active'     => 'boolean',
    ];

     /**
     * @var array Relations
     */
    public $belongsTo = [
        'category' => [
            \Jaber\Sewing\Models\Category::class,
            'key' => 'category_id',
        ],
    ];

    public $hasMany = [
        'materials' => [
            \Jaber\Sewing\Models\Material::class,
            'key' => 'model_id',
        ],
        
        'orderItems' => [
            \Jaber\Sewing\Models\OrderItem::class,
            'key' => 'model_id',
        ],
    ];

            public $attachMany = [
        'photos' => 'System\Models\File'
    ];


}
