<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use stdClass;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /** @var object */
    public $data = null;

    /**
     * Set global configuration.
     * 
     * @param void
     */
    public function __construct()
    {
        $this->data = new stdClass();
        $this->set_module_name();
    }

    /**
     * Set the module name in 
     * 
     * @param void
     */
    public function set_module_name(): void
    {
        $this->data->controller = preg_replace('/(App\\\\Http\\\\Controllers\\\\)|(Controller)/', '', get_called_class());
    }
}
