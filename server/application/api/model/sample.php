<?php
namespace app\api\Model;

use think\Model;

//样例模型
class sample extends Model
{

    //[can_null, can_add_set]
    static $columns = [
        'column' => [1,1],
    ];
    public function addElement($Element)
    {
        $save_Element = [];
        foreach(self::$columns as $col=>$able){
            if($able[1]){
                if(isset($Element[$col])){
                    $save_Element[$col] = $Element[$col];
                }else if(!isset($Element[$col]) && !$able[0]){
                    exit('缺少必要字段！');
                }
            }
        }
        return $this->save($save_Element);
    }
    public function setElement($Element)
    {
        $save_Element = [];
        foreach($Element as $col=>$value){
            if(isset(self::$columns[$col]) && self::$columns[$col][1]){
                $save_Element[$col] = $value;
            }
        }
        return $this->save($save_Element,['id'=>$Element['id']]);
    }
    public function delElement($id)
    {
        return $this->destory($id);
    }

    public function getElement($filter)
    {
        if(isset($filter['id'])){
            return $this->where('id',$filter['id'])->find();
        }elseif(isset($_POST['page'])){
            $page_size = isset($filter['page_size'])?$filter['page_size']:10;
            return $this->paginate($page_size);
        }else{
            return $this->select();
        }
    }

}