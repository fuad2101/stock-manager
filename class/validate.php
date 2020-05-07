<?php
class validate{
    private $_error = [];
    private $_formMethod = NULL;

    public function __construct($_formMethod){
        $this->_formMethod = $_formMethod;
    }
    
    public function setRules($item,$itemLabel,$rules){
        if (isset($this->_formMethod[$item])) {
            $formValue = trim($this->_formMethod[$item]);
        }else {
            $formValue = "";
        }
        if (array_key_exists('sanitize',$rules)) {
            $formValue  = input::runSanitize($formValue,$rules['sanitize']);
        }
        foreach ($rules as $rule => $ruleValue) {
            switch ($rule) {
                case 'required':
                    if ($ruleValue == true && empty($formValue)) {
                        $this->_error[$item]="$itemLabel tidak boleh kosong";
                    }
                    break;
                case 'numeric':
                    if ($ruleValue == true && !is_numeric($formValue)) {
                        $this->_error[$item]="$itemLabel harus berisi angka";
                    }
                    break;
                case 'min_char':
                    if ($ruleValue == true && strlen($formValue) < $ruleValue) {
                        $this->_error[$item]="$itemLabel minimal $ruleValue karakter";
                    }
                    break;
                case 'max_char':
                    if ($ruleValue == true && strlen($formValue) > $ruleValue) {
                        $this->_error[$item]="$itemLabel maksimal $ruleValue karakter";
                    }
                    break;
                case 'min_value':
                    if ($formValue < $ruleValue ) {
                        $this->_error[$item]="$itemLabel minimal $ruleValue ";
                    }
                    break;
                case 'max_value':
                    if ($formValue > $ruleValue ) {
                        $this->_error[$item]="$itemLabel maksimal $ruleValue ";
                    }
                    break;
                case 'matches':
                    if ($formValue != $this->_formMethod[$ruleValue]) { 
                        $this->_error[$item]="$itemLabel tidak sama";
                    }
                    break;
                case 'email':
                    if ( $ruleValue === TRUE && !filter_var($formValue,FILTER_VALIDATE_EMAIL)) {
                        $this->_error[$item]="Format $itemLabel tidak sesuai";
                    }
                    break;
                case 'url':
                    if ( $ruleValue === TRUE && !filter_var($formValue,FILTER_VALIDATE_URL)) {
                        $this->_error[$item]="Format $itemLabel tidak sesuai";
                    }
                    break;
                case 'regexp':
                    if (!preg_match($ruleValue,$formValue)) {
                        $this->_error[$item]="Format $itemLabel tidak sesuai";
                    }
                    break;
                case 'unique':
                    require_once ('db.php');
                    $db = DB::getInstance();
                    if ($db->check($ruleValue[0],$ruleValue[1],$formValue)) {
                        $this->_error[$item]= "Username sudah ada. Silahkan pilih username lain";
                    }
                    break;
                }

            if (!empty($this->_error[$item])) {
                    break;
                }
            }
            return $formValue;
            }

    public function getError(){
        return $this->_error;
    }
    public function passed(){
        return empty($this->_error) ? true : false ;
    }
}    
?>