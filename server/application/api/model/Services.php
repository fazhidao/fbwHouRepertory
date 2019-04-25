<?php
namespace app\api\Model;

use think\Model;

//·şÎñ¼ÇÂ¼
class Services extends Model
{

    public function getElement($filter=[],$user_mode=false)
    {
        foreach ($filter as $key=>$value){
            if($key == 'status' && $user_mode){
                if($value == 2){
                    $this->where('status',2);
                }else{
                    $this->where('status','<>',2);
                }
            }else {
                $this->where($key, $value);
            }
        }
        $page_size = isset($_POST['page_size']) ? $_POST['page_size'] : 50;
        return $this->order('create_time','desc')->paginate($page_size);
    }
    public function setElement($filter,$data)
    {
        foreach ($filter as $key=>$value){
            $this->where($key, $value);
        }
        return $this->update($data);
    }
    public function addElement($data)
    {
        return $this->save($data);
    }

}