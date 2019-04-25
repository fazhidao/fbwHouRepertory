<?php
namespace app\api\Model;

use think\Model;

//合同
class Contract_owner extends Model{
    public function getElement($filter){
        $this->where($filter);
        return $this->find();
    }

    public function addElement($data){
        return $this->save($data);
    }

    public function checkOwner($user_id,$contract_id){
        $this->where('user_id',$user_id);
        $this->where('contract_id',$contract_id);
        $res = $this->find();
        return $res ? true : false;
    }

    public function getMineList($user_id){
        $this->field('contracts.id,keywords,file_path,picture,buy_price,buy_time');
        $this->join('contracts','contract_id = contracts.id');
        $this->where('user_id',$user_id);
        $this->order('buy_time desc');
        $page_size = isset($filter['page_size'])?$filter['page_size']:50;
        return $this->paginate($page_size);
    }
}