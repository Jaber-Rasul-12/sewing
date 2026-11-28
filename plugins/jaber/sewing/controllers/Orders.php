<?php namespace Jaber\Sewing\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Orders extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

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
}
