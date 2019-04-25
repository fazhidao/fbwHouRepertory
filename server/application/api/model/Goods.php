<?php
namespace app\api\Model;

use think\Model;

//系统基础字段
class Goods extends Model
{

    public function getElement($id=false){
        if($id){
            if(is_array($id)){
                $this->where('id','in',$id);
                return $this->select();
            }
            $this->where('id',$id);
            return $this->find();
        }else{
            return $this->select();
        }
    }

    public function setElement($id, $value){
        return $this->where('id',$id)->update(['price'=>$value]);
    }

}