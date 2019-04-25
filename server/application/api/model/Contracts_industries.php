<?php
namespace app\api\Model;

use think\Model;

//合同行业类别
class Contracts_industries extends Model
{

    public function getElement()
    {
        return $this->select();
    }
    public function addElement($data)
    {
        $save_data = [
            'title' => $data['title']
        ];
        return $this->save($save_data);
    }
    public function setElement($data)
    {
        $save_data = [
            'title' => $data['title']
        ];
        return $this->save($save_data,['id'=>$data['id']]);
    }
    public function delElement($id)
    {
        return $this->where('id',$id)->delete();
    }

}