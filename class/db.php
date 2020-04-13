<?php
class DB{
    private $_host = '127.0.0.1';
    private $_dbname = 'ilkoom';
    private $_username = 'root';
    private $_password = '';

    private static $_instance = NULL;
    private $_pdo;
    private $_columnName = '*';
    private $_count = '0';

    private function __construct(){
        try {
            $this->_pdo = new PDO('mysql:host='.$this->_host.';dbname='.$this->_dbname,$this->_username,$this->_password);
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Koneksi bermasalah:'.$e->getMessage().$e->getCode());
        }
    } 

    // Singleton Pattern instansiasi Class DB
    public static function getInstance(){
        if(!isset(self::$_instance)){
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    // Method Runquery
    public function runQuery($query,$bindValue = []){
        try {
            $stmt = $this->_pdo->prepare($query);
            $stmt->execute($bindValue);
        } catch (PDOException $e) {
            die('Koneksi/Query bermasalah:'.$e->getMessage().":".$e->getCode());
        }
        return $stmt;
    }

    public function insert($tablename,$data){
        $datakeys = array_keys($data);
        $dataValues = array_values($data);
        $placeHolder = '('.str_repeat('?, ',count($datakeys)-1).'?)';
        $query = "INSERT INTO {$tablename} ".'('.implode(', ',$datakeys).')'." VALUES {$placeHolder}";
        $this->runQuery($query,$dataValues);
}

    public function select($columnName){
        $this->_columnName = $columnName;
}

    public function getQuery($query,$bindValue = []){
        return $this->runQuery($query,$bindValue)->fetchAll(PDO::FETCH_OBJ);
    }

    public function get($tablename,$condition = '',$bindValue =[]){
        $query = "SELECT {$this->_columnName} FROM {$tablename} {$condition} ";
        $this->_columnName = "*";
        return $this->getQuery($query,$bindValue); 
    }

    public function getLike($tablename,$columnName,$search){
        $queryLike = "WHERE $columnName LIKE ?";
        return $this->get($tablename,$queryLike,[$search]);
    }

    public function update($tablename,$data,$condition){
        $query = "UPDATE {$tablename} SET";
        foreach ($data as $key => $value) {
            $query .= " $key = ?, ";
        }
        $query = substr($query,0,-2);
        $query.= " WHERE {$condition[0]} {$condition[1]} ?";
        $dataValues = array_values($data);
        array_push($dataValues,$condition[2]);
        $this->runQuery($query,$dataValues);
    }

    public function check($tablename,$columnName,$dataValues){
        $query = "SELECT {$columnName} FROM {$tablename} WHERE {$columnName} = ?";
        return $this->runQuery($query,[$dataValues])->rowCount();
    }

    public function getWhere($tablename,$condition){
        $queryCondition = "WHERE $condition[0] $condition[1] ?";
        return $this->get($tablename,$queryCondition,[$condition[2]]);
    }

    public function getWhereOnce($tablename,$condition){
        $result = $this->getWhere($tablename,$condition);
        if (!empty($result)) {
            return $result[0];
        }else{
            return false;
        }
    }

    public function delete($tablename,$condition){
        $query = "DELETE FROM {$tablename} WHERE {$condition[0]} {$condition[1]} ?";
        $this->_count= $this->runQuery($query,[$condition[2]])->rowCount();
        return true;
    }

    public function count(){
        return $this->_count;
    }

}


