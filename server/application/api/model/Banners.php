<?php
namespace app\api\Model;

use think\Model;

//合同行业类别
class Banners extends Model
{

    public function getElement()
    {
        return $this->select();
    }
    public function getAppList()
    {
        return $this->order('show_index desc')->where('is_show',1)->select();
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