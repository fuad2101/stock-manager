<?php
require 'init.php';

class user{
    private $_db = null;
    private $_formItem = [];

    public function validasiInsert($_formMethod){
        $validasi = new validate($_formMethod);
        echo "<pre>";
        print_r(get_class_methods($validasi));
        var_dump($validasi);
        echo "</pre>";

        $this->_formItem['username'] = $validasi->setRules('username','Username',
        ['sanitize'=>'string','required'=>true,'min_char'=>4,'unique'=>'user,username','regexp'=>'/^[A-Za-z1-9]+$/']);
        $data[]= $this->_formItem['username'];


        $this->_formItem['password'] = $validasi->setRules('password','Password',
        [
            'sanitize'=>'string',
            'min-char'=>4,
            'regexp'=>'/^[A-Za-z]+[1-9]$|^[1-9]+[A-Za-z]$/'
        ]);
        $data[]= $this->_formItem['password'];


        $this->_formItem['repeat_pass'] = $validasi->setRules('repeat_pass','Repeat Pass',
        [
            'sanitize'=>'string',
            'required'=>true,
            'matches'=>'password'
        ]);
        $data[]= $this->_formItem['repeat_pass'];


        $this->_formItem['email'] = $validasi->setRules('email','email',
        [
            'sanitize'=>'string',
            'required'=>true,
            'email'=>true
        ]);
        $data[]= $this->_formItem['email'];

        print_r($data);

        if (!$validasi->passed()) {
         return $validasi->getError();
        }
    }

    public function getItem($item){
        if (isset($this->_formItem[$item])) {
            return $this->_formItem[$item];
        }
    }

    public function insert(){
        $this->_db = DB::getInstance();
        if (isset($this->_formItem)) {
            $newUser = [
                'username'=>$this->getItem('username'),
                'password'=>$this->getItem('password'),
                'email'=>$this->getItem('email')
                ];
            return $this->_db->insert('user',$newUser);
        }
    }

}
?>