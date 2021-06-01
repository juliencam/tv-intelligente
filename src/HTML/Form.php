<?php
namespace App\HTML;

class Form{

    private $errors;
    private $data;

    public function __construct($data, ?array $errors = null)
    {
        $this->errors = $errors;
        $this->data = $data;
    }

    public function input($key, $label): string
    {   
        $value =$this->getValue($key);
        $type = $key === "password" ? "password" : "text";  
        return <<<HTML
        <div class = 'form-group'>
            <label for="field{$key}">{$label}</label>
            <input type="{$type}" class="{$this->getInputClass($key)}" id="field{$key}" name="{$key}" value="{$value}" required >
            {$this->getErrorFeedback($key)}
        </div>    
HTML;
    }
    public function selected($key, $label, array $options = [])
    {
        $value =$this->getValue($key);
       
        $optionsHTML = [];
        foreach($options as $k => $v){
            $selected = in_array($k,$value) ? " selected" : "";
            $optionsHTML [] = "<option value=\"$k\"$selected>$v</option>";
        }
        $optionsHTML = implode('',$optionsHTML);
        return <<<HTML
        <div class = 'form-group'>
            <label for="field{$key}">{$label}</label>
            <select class="{$this->getInputClass($key)}" id="field{$key}" name="{$key}[]" required multiple> {$optionsHTML} </select>
            {$this->getErrorFeedback($key)}
        </div>    
HTML;

    }

    public function inputHTML($key, $label): string
    {   
        $value = htmlentities($this->getValue($key)) ;
        return <<<HTML
        <div class = 'form-group'>
            <label for="field{$key}">{$label}</label>
            <input type="text" class="{$this->getInputClass($key)}" id="field{$key}" name="{$key}" value="{$value}" required >
            {$this->getErrorFeedback($key)}
        </div>    
HTML;
    }

    public function textarea($key, $label): string
    {   
        $value =$this->getValue($key);

        return <<<HTML
        <div class = 'form-group'>
            <label for="field{$key}">{$label}</label>
            <textarea type="text" class="{$this->getInputClass($key)}" id="field{$key}" name="{$key}" value="{$value}" required >{$value} </textarea>
            {$this->getErrorFeedback($key)}
        </div>    
HTML;
    }

    public function file($key, $label): string
    {   
        return <<<HTML
        <div class = 'form-group'>
            <label for="field{$key}">{$label}</label>
            <input type="file" class="{$this->getInputClass($key)}" id="field{$key}" name="{$key}" >
            {$this->getErrorFeedback($key)}
        </div>    
HTML;
    }

    private function  getValue($key) 
    {
        if(is_array($this->data)){
            return $this->data[$key]?? null;
        }
        $method =  'get'.ucfirst($key);
        $value = $this->data->$method();
        if($value instanceof \DateTimeInterface){
            return $value->format('Y-m-d H:i:s');
        }
        return $value;
    }

    private function getInputClass(string $key):string
    {
        $inputClass = 'form-control';
        if(isset($this->errors[$key])){
            $inputClass .= ' is-invalid';
        }
        return $inputClass;
    }

    private function getErrorFeedback(string $key) :string
    {
        if(isset($this->errors[$key])){
            if(is_array($this->errors[$key])){
                $error = implode('<br>',$this->errors[$key]);
            }else{
                $error = $this->errors[$key];
            }
           return'<div class = "invalid-feedback">' . $error. '</div>';
        }
        return'';
       
    }

}