<?php namespace Jaber\Sewing\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Suppliers extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'suppliers' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Jaber.Sewing', 'sewing', 'suppliers');
    }

         public function formGetRedirectUrl($context = null, $model = null)
    {
        $url = post('url');


        if (($url == 'create') && !empty($url)) {
            return "jaber/sewing/suppliers/create";
        }else if (($url == 'preview') && !empty($url)) {
            return "jaber/sewing/suppliers/$url/$model->id";
        }else {
            if ((post("close") == 1) && !empty(post("close"))) {
                return "jaber/sewing/suppliers";
            } else {
                return "jaber/sewing/suppliers/update/$model->id";
            }
        }
    }
}
