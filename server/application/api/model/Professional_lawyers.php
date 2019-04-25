<?php
namespace app\api\Model;

use think\Model;

//合同行业类别
class Professional_lawyers extends Model
{

    public function getElement($is_limit=false)
    {
        if($is_limit){
            $this->limit(20);
        }
        return $this->order('show_index desc')->select();
    }
    public function addElement($data)
    {
        return $this->save($data);
    }
    public function setElement($id,$data)
    {
        return $this->save($data,['id'=>$id]);
    }
    public function delElement($id)
    {
        return $this->where('id',$id)->delete();
    }

}