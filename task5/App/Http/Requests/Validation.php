<?php
namespace App\Http\Requests;

use App\Database\Config\Connection;
use App\Http\Requests\Error;

class Validation {
    private array $errors = [];
    private $valName;
    private $val;

    public function getErrors()
    {
        return $this->errors;
    }

 
    public function setvalName($valName)
    {
        $this->valName = $valName;

        return $this;
    }

 
    public function setval($val)
    {
        $this->val = $val;

        return $this;
    }

    public function required()
    {
       if(empty($this->val)){
            $this->errors[$this->valName][__FUNCTION__] = Error::Message("{$this->valName} is required");
       }
       return $this;
    }

    public function confirmed($comparedval)
    {
        if($this->val != $comparedval){
            $this->errors[$this->valName.'_confirmation'][__FUNCTION__] = Error::Message("{$this->valName} Confirmation is not confirmed With {$this->valName}");
        }
        return $this;
    }

    public function max($max)
    {
        if(strlen($this->val) > $max){
            $this->errors[$this->valName][__FUNCTION__] = Error::Message("{$this->valName} must be less than {$max} characters");
        }
        return $this;
    }

    public function regex($regularExpression,$message = "Invailed")
    {
        if(!preg_match($regularExpression,$this->val)){
            $this->errors[$this->valName][__FUNCTION__] = Error::Message("{$this->valName} {$message}");
        }
        return $this;
    }

    public function in($array)
    {
        if(!in_array($this->val,$array)){
            $this->errors[$this->valName][__FUNCTION__] = Error::Message("{$this->valName} must be ".implode(',',$array));
        }
        return $this;
    }

    public function unique(string $table,string $column = "")
    {
        if(!$column){
            $column = $this->valName;
        }
        $connection = new Connection;
        $stmt = $connection->con->prepare("SELECT * FROM `{$table}` WHERE {$column} = ?");
        $stmt->bind_param('s',$this->val);
        $stmt->execute();
        if($stmt->get_result()->num_rows == 1 ){
            $this->errors[$this->valName][__FUNCTION__] = Error::Message("{$this->valName} already exists");
        }
        return $this;
    }
   
    public function exists(string $table,string $column = "")
    {
        if(!$column){
            $column = $this->valName;
        }
        $connection = new Connection;
        $stmt = $connection->con->prepare("SELECT * FROM `{$table}` WHERE {$column} = ?");
        $stmt->bind_param('s',$this->val);
        $stmt->execute();
        if($stmt->get_result()->num_rows != 1 ){
            $this->errors[$this->valName][__FUNCTION__] = Error::Message("{$this->valName} not exists");
        }
        return $this;
    }

    public function integer()
    {
        if(!ctype_digit($this->val)){
            $this->errors[$this->valName][__FUNCTION__] = Error::Message("{$this->valName} must be ". __FUNCTION__);
        }
        return $this;
    }

    public function digits($digits)
    {
        if(strlen($this->val) != $digits){
            $this->errors[$this->valName][__FUNCTION__] = Error::Message("{$this->valName} must be {$digits} digits");
        }
        return $this;
    }
}

