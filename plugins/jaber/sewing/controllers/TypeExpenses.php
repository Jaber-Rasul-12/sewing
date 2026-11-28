<?php namespace Jaber\Sewing\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class TypeExpenses extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'type_expenses' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Jaber.Sewing', 'sewing', 'type_expenses');
    }

                         public function formGetRedirectUrl($context = null, $model = null)
    {
        $url = post('url');


        if (($url == 'create') && !empty($url)) {
            return "jaber/sewing/typeexpenses/create";
        }else if (($url == 'preview') && !empty($url)) {
            return "jaber/sewing/typeexpenses/$url/$model->id";
        }else {
            if ((post("close") == 1) && !empty(post("close"))) {
                return "jaber/sewing/typeexpenses";
            } else {
                return "jaber/sewing/typeexpenses/update/$model->id";
            }
        }
    }
}
