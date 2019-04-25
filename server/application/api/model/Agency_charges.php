<?php
namespace app\api\Model;

use think\Model;

//案件委托类型
class Agency_charges extends Model{

    public function getList($filter=[]){
        foreach ($filter as $key=>$value){
            $this->where($key,$value);
        }
        return $this->order('create_time','desc')->paginate(50);
    }

    public function addElement($data)
    {
        return $this->save($data);
    }

}