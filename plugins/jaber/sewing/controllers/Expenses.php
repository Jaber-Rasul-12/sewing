<?php namespace Jaber\Sewing\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Expenses extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'expenses' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Jaber.Sewing', 'sewing', 'expenses');
    }

             public function formGetRedirectUrl($context = null, $model = null)
    {
        $url = post('url');


        if (($url == 'create') && !empty($url)) {
            return "jaber/sewing/expenses/create";
        }else if (($url == 'preview') && !empty($url)) {
            return "jaber/sewing/expenses/$url/$model->id";
        }else {
            if ((post("close") == 1) && !empty(post("close"))) {
                return "jaber/sewing/expenses";
            } else {
                return "jaber/sewing/expenses/update/$model->id";
            }
        }
    }
}
