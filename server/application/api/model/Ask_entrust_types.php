<?php
namespace app\api\Model;

use think\Model;

//案件委托类型
class Ask_entrust_types extends Model{

    public function getList(){
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