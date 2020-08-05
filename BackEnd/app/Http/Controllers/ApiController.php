<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected $module_name;
    protected   $model;
    //
    public function index($module_name){
        try{
            $this->setModuleName($module_name);
            $check =$this->initModel();
            if($check === false){
                return response()->json("you can not access this module");
            }
            $data = $this->model->paginate(10);
            return \response()->json($data);
        }catch(\Exception $e){
            dd($e);
        }
    }


    public function getById($module_name,$id){
        try{
            $this->setModuleName($module_name);
            $check = $this->initModel();
            if($check === false){
                return response()->json("you can not access this module");
            }
            $data = $this->model->find($id);
            if($data){
                return \response()->json($data);
            }
            return \response()->json();

        }catch(\Exception $e){
            dd($e);
        }
    }

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
