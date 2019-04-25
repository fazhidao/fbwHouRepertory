<?php
namespace app\api\Model;

use think\Model;

//服务记录
class Service_records extends Model
{

    public function getElement()
    {
        $this->order('create_time desc');
        $this->limit(10);
        return $this->select();
    }
    public function addElement($data)
    {
        $save_data = [
            'title' => $data
        ];
        return $this->save($save_data);
    }
    public function setElement($data)
    {
        $save_data = [
            'title' => $data
        ];
        return $this->save($save_data,['id'=>$data['id']]);
    }
    public function delElement($id)
    {
        return $this->where('id',$id)->delete();
    }

}