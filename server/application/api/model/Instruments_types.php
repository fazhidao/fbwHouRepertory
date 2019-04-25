<?php
namespace app\api\Model;

use think\Model;

class Instruments_types extends Model
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