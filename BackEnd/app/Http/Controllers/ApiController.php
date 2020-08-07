<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ApiController extends Controller
{
    use ResponseTrait;
    use ModuleTrait;
    protected $module_name;
    protected   $model;

    public  function storeContact(Request $request)
    {
        $v  = Validator::make($request->all(),[
            'name'  =>  'required|min:2|max:50',
            'email' =>  'required|min:2|max:50|email',
            'mobile'    =>  'required|min:2|max:20',
            'message'   =>  'required|min:2|max:500'  
        ]);

        if($v->fails()){
            return $this->res($v->errors(),false,'we get an error');
        }
        Contact::create($request->all());
        return $this->res([],true,'Thanks for send your message we will back soon ');
    }

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

   
    
}
