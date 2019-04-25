<?php
namespace app\api\Model;

use think\Model;

//案件委托
class Ask_help extends Model{

    public function addElement($data){
        return $this->insertGetId($data);
    }

    public function getList($filter=[]){
        foreach ($filter as $key=>$value){
            if(is_array($value)){
                $this->whereIn($key,$value);
            }else {
                $this->where($key, $value);
            }
        }
        $page_size = isset($_POST['page_size']) ? $_POST['page_size'] : 50;
        return $this->order('create_time desc')->paginate($page_size);
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

    public function getAmounts(){
        $amounts = [];
        $res = $this->where('status',1)->field('count(*) c')->select();
        $amounts[0] = $res['c'];
        $res = $this->where('status',2)->field('count(*) c')->select();
        $amounts[1] = $res['c'];
        $res = $this->where('status',4)->field('count(*) c')->select();
        $amounts[2] = $res['c'];
        $res = $this->where('status',5)->field('count(*) c')->select();
        $amounts[3] = $res['c'];
        return $amounts;
    }
}