<?php

class barang{
    private $_db = null;
    private $_formItem = null;

    public function __construct(){
        $this->_db = DB::getInstance();
    }
    public function validasi($formMethod){
        $validate = new validate($formMethod);
        $this->_formItem['nama_barang'] = $validate->setRules('nama_barang','Nama Barang',[
            'sanitize'=>'string',
            'required'=>true,
            'min_char'=>5
        ] );
        $this->_formItem['harga_barang'] = $validate->setRules('harga_barang','Harga Barang',
        [   
            'sanitize'=>'int',
            'required'=>true,
        ]);
        $this->_formItem['jumlah_barang'] = $validate->setRules('jumlah_barang','Jumlah Barang',
        [
            'sanitize'=>'int',
            'required'=>true,
        ]);
        if (!$validate->passed()) {
            return $validate->getError();
        }   
    }
    public function getItem($item){
        return isset($this->_formItem[$item]) ? $this->_formItem[$item] : '';
    }
    public function insert(){
        $newBarang = 
        [
            'nama_barang' => $this->getItem('nama_barang'),
            'harga_barang' => $this->getItem('harga_barang'),
            'jumlah_barang' => $this->getItem('jumlah_barang')
        ];
        return $this->_db->insert('barang',$newBarang);
    }
    public function generate($idBarang){
        $result = $this->_db->getWhereOnce('barang',['id_barang','=',$idBarang]);
        foreach ($result as $key => $value) {
            $this->_formItem[$key] = $value;
        }
    }
    public function update($idBarang){
        $newBarang = [
            'nama_barang'=>$this->getItem('nama_barang'),
            'jumlah_barang'=>$this->getItem('jumlah_barang'),
            'harga_barang'=>$this->getItem('harga_barang')
        ];
        $this->_db->update('barang',$newBarang,['id_barang','=',$idBarang]);
    }
    public function delete($idBarang){
        $this->_db->delete('barang',['id_barang','=',$idBarang]);
    }
}

?>