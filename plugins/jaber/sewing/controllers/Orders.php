<?php namespace Jaber\Sewing\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Jaber\Sewing\Models\SewingModel;

class Orders extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController' , \Backend\Behaviors\RelationController::class,   ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $relationConfig = 'relation_config.yaml';

    public $requiredPermissions = [
        'orders' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Jaber.Sewing', 'sewing', 'orders');
    }
                 public function formGetRedirectUrl($context = null, $model = null)
    {
        $url = post('url');


        if (($url == 'create') && !empty($url)) {
            return "jaber/sewing/orders/create";
        }else if (($url == 'preview') && !empty($url)) {
            return "jaber/sewing/orders/$url/$model->id";
        }else {
            if ((post("close") == 1) && !empty(post("close"))) {
                return "jaber/sewing/orders";
            } else {
                return "jaber/sewing/orders/update/$model->id";
            }
        }
    }

        /**
     * Extend the manage widget for relations.
     *
     * @param \Backend\Widgets\Form $widget The form widget instance.
     * @param string $field The field name being processed.
     * @param \Model $model The model instance associated with the form.
     * @return void
     */
    public function relationExtendManageWidget($widget, $field, $order)
    {
        if ($field == 'orderItems') {
            // $widget->fields['model_id']['options'] = SewingModel::where('id', $order->model->id)->get()->lists('name', 'id');

        }
    }
}
