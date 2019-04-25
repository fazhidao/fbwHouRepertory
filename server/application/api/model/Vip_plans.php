<?php
namespace app\api\Model;

use think\Model;

//VIP套餐  先写死数据库  不弄增删改
class Vip_plans extends Model
{

    //[can_null, can_add_set]
    static $columns = [
        'initial_price' => [0,1],       //原价
        'renew_price' => [0,1],         //续费价格
        'new_price' => [0,1],           //现价
        'discount' => [0,1],            //统一折扣
        'detail' => [0,1],       //免费法务咨询次数
//        'law_ask_times' => [0,1],       //免费法务咨询次数
//        'contract_download_times' => [0,1], //免费文库合同下载次数
//        'contract_make_times' => [0,1],      //企业合同定制次数
    ];
    public function setElement($id,$data)
    {
        return $this->save($data,['id'=>$id]);
    }

    public function getElement($filter=null)
    {
        if(isset($filter['id'])){
            return $this->where('id',$filter['id'])->find();
        }else{
            return $this->select();
        }
    }

    public function getVipInfo($id,$other=false){
        $vip_info = $this->where('id', $id)->find();
        unset($vip_info->id);
        unset($vip_info->title);
        unset($vip_info->initial_price);
        unset($vip_info->renew_price);
        unset($vip_info->new_price);
        if(!$other) { //代理商时需要对比有没有余额
            unset($vip_info->agency_price);
        }
        return $vip_info;
    }

}