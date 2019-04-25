<?php
namespace app\api\Model;

use think\Model;

//案件委托
class Ask_advance extends Model{

    public function addElement($data){
        return $this->insertGetId($data);
    }

    public function getList($filter=[]){
        if(isset($filter['status'])){
            $this->where('status',$filter['status']);
        }
        $page_size = isset($_POST['page_size']) ? $_POST['page_size'] : 50;
        return $this->order('create_time desc')->paginate($page_size);
    }

    public function getMineList($user_id,$status_list){
        $this->where('creator_id',$user_id);
        $this->whereIn('status',$status_list);
        return $this->paginate(20);
    }

    public function setElement($id,$data){
        return $this->save($data,['id'=>$id]);
    }

    public function delElement($id){
        return $this->save([],['id'=>$id]);
    }

    public function setMine($id,$user_id,$status){
        return $this->where('id',$id)->where('creator_id',$user_id)->update(['status'=>$status]);
    }

    public function paySuccess($id){
        return $this->save(['status'=>1],['id'=>$id]);
    }
}