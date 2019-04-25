<?php
namespace app\api\Model;

use think\Model;

//案件委托
class Sign_records extends Model{

    public function addSign($user_id,$credit){
        $data = [
            "user_id" => $user_id,
            "credit" => $credit,
            "sign_time" => date('Ymd')
        ];
        return $this->save($data);
    }

    public function getList($user_id){
        return $this->where('user_id',$user_id)->limit(31)->select();
    }

    public function getSign($user_id,$date){
        return $this->where('user_id',$user_id)->where('sign_time',$date)->find();
    }
}