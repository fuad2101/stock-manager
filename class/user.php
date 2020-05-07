<?php
class user{
    private $_db = null;
    private $_formItem = [];
    public function validasiInsert($_formMethod){
        $validasi = new validate($_formMethod);
        $this->_formItem['username'] = $validasi->setRules('username','Username',
        [
            'sanitize'=>'string',
            'required'=>true,
            'min_char'=>4,
            'unique'=>['user','username'],
            'regexp'=>'/^[A-Za-z1-9]+$/'
        ]);
        $this->_formItem['password'] = $validasi->setRules('password','Password',
        [
            'sanitize'=>'string',
            'required'=>true,
            'min-char'=>6,
            'regexp'=>'/[A-Za-z]+[1-9]|[1-9]+[A-Za-z]/'
        ]);
        $this->_formItem['repeat_pass'] = $validasi->setRules('repeat_pass','Ulangi Password',
        [
            'sanitize'=>'string',
            'required'=>true,
            'matches'=>'password'
        ]);
        $this->_formItem['email'] = $validasi->setRules('email','Email',
        [
            'sanitize'=>'string',
            'required'=>true,
            'email'=>true
        ]);
        if (!$validasi->passed()) {
         return $validasi->getError();
        }
    }
    public function getItem($item){
        return isset($this->_formItem[$item]) ? $this->_formItem[$item] : '';
    }
    public function insert(){
        $this->_db = DB::getInstance();
        $newUser = [
                'username'=>$this->getItem('username'),
                'password'=> password_hash($this->getItem('password'),PASSWORD_DEFAULT) ,
                'email'=>$this->getItem('email')
                ];
            return $this->_db->insert('user',$newUser);
    }
    public function validasiLogin($_formMethod){
        $validasi = new Validate($_formMethod);
        $this->_formItem['username'] = $validasi->setRules('username','Username',
        [
            'sanitize'=>'string',
            'required'=>true,
        ]);
        $this->_formItem['password'] = $validasi->setRules('password','Password',
        [
            'sanitize'=>'string',
            'required'=>true,
        ]);
        if (!$validasi->passed()) {
            return $validasi->getError();
        }else {
            $this->_db = DB::getInstance();
            $this->_db->select('password');
            $result = $this->_db->getWhereOnce('user',['username','=',$this->_formItem['username']]);
            if (empty($result) || !password_verify($this->_formItem['password'],$result->password)) {
                $pesanError[] = "Username atau password tidak sesuai";
                return $pesanError;
            }
        }
    }
    public function login(){
        $_SESSION['username'] = $this->_formItem['username'];
        header('Location: tampil_barang.php');
    }
    public function logout(){
        unset($_SESSION['username']);
    }
    public function cekUserSession(){
        if (!isset($_SESSION['username'])) {
            header('Location:login.php');
        }
    }
    public function validasiUbahPassword($username){
            $validasi = new Validate($_POST);
            $this->_formItem['pass1'] = $validasi->setRules('pass1','Password lama',
            [
                'sanitize'=>'string',
                'required'=>true,
            ]);
            $this->_formItem['pass2'] = $validasi->setRules('pass2','Password Baru',
            [
                'sanitize'=>'string',
                'required'=>true,
                'min-char'=>6,
                'regexp'=>'/[A-Za-z]+[1-9]|[1-9]+[A-Za-z]/'
            ]);
            $this->_formItem['pass3'] = $validasi->setRules('pass3','Konfirmasi Password Baru',
            [
                'sanitize'=>'string',
                'required'=>true,
                'matches'=>'pass2',
            ]);
            if (!$validasi->passed()) {
                $pesanError = $validasi->getError();
                return $pesanError;
            }else {
                $this->_db = DB::getInstance();
                $this->_db->select('password');
                $result = $this->_db->getWhereOnce('user',['username','=',$username]);
                if (empty($result) || !password_verify($this->_formItem['pass1'],$result->password)) {
                    $pesanError[] = "Password Lama Salah";
                    return $pesanError;
                }
            }
    }
    public function generate($username){
        $this->_db = DB::getInstance();
        $result = $this->_db->getWhereOnce('user',['username','=',$username]);
        if (!empty($result)) {
            foreach ($result as $key => $value) {
                $this->_formItem[$key] = $value;
            }
        }
    }
    public function ubahPassword($username){
        $this->_db = DB::getInstance();
        $newUser = ['password'=>password_hash($this->_formItem['pass2'],PASSWORD_DEFAULT)];
        $result = $this->_db->update('user',$newUser,['username','=',"$username"]);
        echo "<pre>";
        var_dump($result);
        echo "</pre>";
        header('Location:ubahPasswordBerhasil.php');
    }
}
?>