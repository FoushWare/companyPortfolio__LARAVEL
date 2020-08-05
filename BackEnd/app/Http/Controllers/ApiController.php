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
                return $this->youCantAccess();
            }
            $data = $this->model->paginate(10);
            return $this->successWithData($data);
        }catch(\Exception $e){
            $this->ResponseError($e->getMessage());
        }
    }


    public function getById($module_name,$id){
        try{
            $this->setModuleName($module_name);
            $check = $this->initModel();
            if($check === false){
                return $this->youCantAccess();
            }
            $data = $this->model->find($id);
            if($data){
                return $this->successWithData($data);
            }
            return $this->res([],false,"We can not find this id");

        }catch(\Exception $e){
            $this->ResponseError($e->getMessage());
        }
    }

    protected function ResponseError($e){
        return $this->res([],false,$e);
    }

    protected function successWithData($data){
        return $this->res($data,true,'Here what we found in '.$this->module_name);
    }
    protected function youCantAccess(){
        return $this->res([],false,"you can not access this module");

    }
    protected function res($data=[],$status = true, $message =''){
        $data =[
            'payload'   =>  $data,
            'status'    =>  $status,
            'message'   =>  $message  
        ];
        return \response()->json($data);
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
