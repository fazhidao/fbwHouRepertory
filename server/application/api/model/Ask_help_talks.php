<?php
namespace app\api\Model;

use think\Model;

//案件委托
class Ask_help_talks extends Model{

    public function addElement($data){
        return $this->save($data);
    }

    public function getList($filter=[]){
        foreach ($filter as $key=>$value){
            $this->where($key, $value);
        }
        return $this->order('create_time')->select();
    }

    public function setElement($id,$data){
        return $this->save($data,['id'=>$id]);
    }

    public function getMineList($user_id,$status_list){
        $this->where('creator_id',$user_id);
        $this->whereIn('status',$status_list);
        return $this->paginate(20);
    }

    public function setMine($id,$user_id,$status){
        return $this->where('id',$id)->where('creator_id',$user_id)->update(['status'=>$status]);
    }

    public function paySuccess($id){
        return $this->save(['status'=>1],['id'=>$id]);
    }
}