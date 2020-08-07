<?php
namespace App\Http\Controllers;

trait ModuleTrait{
    protected function setModuleName($module_name){
        $this->module_name = $module_name;
    }
    protected function initModel(){
        // I want to make sure about somethings like module 
        /**
         * lowercase
         * singler
         * camelcase And first char is Capital 
         */ 
        $module = \Str::lower($this->module_name);
        $module = \Str::singular($module);
        $module =   \Str::camel($module);
        $module =   \Str::ucfirst($module);
        if(\in_array($module,$this->expectModules())){
            return false;
        }
        $nameSpace  =   'App\\' . $module;
        // Make object of the Model 
        $this->model = new $nameSpace;
        // dd($module);
    }
    protected function expectModules()
    {
        return ['Contact'];
    }
}