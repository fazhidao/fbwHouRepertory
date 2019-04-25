<?php
namespace app\api\Model;

use think\Model;

//案件委托
class Coupons extends Model{

    public function addCoupon($user_id,$type_id,$detail=null){
        $data = [
            'user_id' => $user_id,
            'type_id' => $type_id,
            'detail' => $detail,
        ];
        return $this->save($data);
    }

    public function useCoupon($id){
        return $this->save(['status'=>0],['id'=>$id]);
    }

    public function getTotal($type_id){
        return $this->where('type_id',$type_id)->count();
    }
}