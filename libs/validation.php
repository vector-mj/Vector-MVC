<?php
class Validation{
    private $data;
    private $len;
    private $defaultError;
    private $Errors = [];
    private $IsValid = true;
    private $Digit   = false;
    private $Empty   = false;
    private $LenTrue = false;
    private $Email   = false;
    private $Phone   = false;
    private $Nulll   = false;
    private $sstring = false;
    public function __construct($Data,$len=7,$defaultError="ورودی نامعتبر"){
        $this->data = $Data;
        $this->len = $len;
        $this->defaultError = $defaultError;
    }
    public function fieldValidation(){
        if(empty($this->data)){
            $this->setError('Empty',$this->defaultError);
            $this->IsValid = false;
            $this->Empty = true;
        }elseif($this->data == null){
            $this->setError('Null',$this->defaultError);
            $this->IsValid = false;
            $this->Nulll = true;
        }else{
            if(preg_match('/^[\d]+$/',$this->data)){
                $this->Digit=true;
            }
            if(strlen(strval($this->data))<=$this->len){
                $this->LenTrue = true;
            }else{
                $this->setError('Length',$this->defaultError);
                $this->IsValid = false;
            }
            if(preg_match('/^[\w\.]+@([\w-]+\.)+[\w-]{2,4}$/',$this->data)){
                $this->Email= true;
            }
            if(preg_match('/^(?=0)[\d]{10,11}$/',$this->data)){
                $this->Phone = true;
            }
            if(preg_match('/^[a-zA-Z]+$/',$this->data)){
                $this->sstring = true;
            }
        }
        return $this;
    }
    // check methods
    public function isValid(){return $this->IsValid;}
    public function isDigit(){return $this->Digit;}
    public function isEmpty(){return $this->Empty;}
    public function isEmail(){return $this->Email;}
    public function isLenTrue(){return $this->LenTrue;}
    public function isPhone(){return $this->Phone;}
    public function isNull(){return $this->Nulll;}
    /////////////////////////////////////////////////
    public function showAllProp(){
        var_dump(array('isValid'=>$this->IsValid,
                       'isDigit'=>$this->Digit,
                       'isEmpty'=>$this->Empty,
                       'isLenTrue'=>$this->LenTrue,
                       'isEmail'=>$this->Email,
                       'isPhone'=>$this->Phone,
                       'isJustStr'=>$this->sstring,
                       'isNull'=>$this->Nulll
                        ));
    }
    public function getErrors(){
        return $this->Errors;
    }
    public function setError($field,$inf){
        $this->Errors[$field]=$inf;
    }
    public function showError(){
        var_dump($this->Errors);
    }
}