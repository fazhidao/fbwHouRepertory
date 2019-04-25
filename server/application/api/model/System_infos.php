<?php
namespace app\api\Model;

use think\Model;

//系统基础字段
class System_infos extends Model
{
    public function getElement($id=false)
    {
        if($id){
            if(is_array($id)){
                $this->whereIn('id',$id);
            }else {
                $this->where('id', $id);
                return $this->find();
            }
        }else{
            $this->whereNotIn('id',['register_agreement','lawyer_manage']);
        }
        return $this->order('sort_index')->select();
    }
    public function setElement($data)
    {
        $save_data = [
            'value' => $data['value']
        ];
        return $this->save($save_data,['id'=>$data['id']]);
    }

}