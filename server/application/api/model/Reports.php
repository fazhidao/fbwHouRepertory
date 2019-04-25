<?php
namespace app\api\Model;

use think\Model;

//案件委托
class Reports extends Model{

    public function setElement($data){
        $this->where('id',1);
        return $this->update($data);
    }

    public function getElement(){
        $this->where('id',1);
        return $this->find();
    }


}