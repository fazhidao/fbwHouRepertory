<?php
namespace app\api\Model;

use think\Model;

//案件委托
class Ask_entrust extends Model{

    public function addElement($data){
        return $this->insertGetId($data);
    }

    public function getList($filter=[],$is_with_userinfo=false){
        foreach ($filter as $key=>$value){
            if($key == 'content'){
                $this->where($key,'like', "%$value%");
            }else {
                $this->where($key, $value);
            }
        }
        $field = ['ask_entrust.id','title type_name','ask_entrust.create_time','ask_entrust.status','ask_entrust.name','ask_entrust.phone',
            'creator_id','handler_id','ask_entrust.province_id','ask_entrust.city_id','ask_entrust.district_id',
            'offer_min','offer_max','province.name province','city.name city','content','type_id','contract_file'];
        if($is_with_userinfo){
            array_push($field,'users.name app_name','users.phone app_phone');
            $this->join('users','users.id = creator_id','left');
        }
        $this->join('ask_entrust_types','type_id = ask_entrust_types.id','left');
        $this->join('areainfo province','ask_entrust.province_id = province.id','left');
        $this->join('areainfo city','ask_entrust.city_id = city.id','left');
        $this->field($field);
        $page_size = isset($_POST['page_size']) ? $_POST['page_size'] : 50;
        return $this->order('create_time desc')->paginate($page_size);
    }

    public function getMineList($user_id,$status_list){
        $this->field('ask_entrust.id, title type_name, province.name province_name, city.name city_name, district.name district_name, 
            offer_min, offer_max, create_time, content, status, contract_file');
        $this->where('creator_id',$user_id);
        $this->whereIn('status',$status_list);
        $this->join('ask_entrust_types','type_id = ask_entrust_types.id');
        $this->join('areainfo province','province_id = province.id','left');
        $this->join('areainfo city','city_id = city.id','left');
        $this->join('areainfo district','district_id = district.id','left');
        return $this->paginate(20);
    }

    public function setElement($id,$data){
        return $this->save($data,['id'=>$id]);
    }

    public function getElement($id){
        return $this->where('id',$id)->find();
    }

    public function setMine($id,$user_id,$status){
        return $this->where('id',$id)->where('creator_id',$user_id)->update(['status'=>$status]);
    }

    public function delElement($id){
        return $this->destroy($id);
    }

    public function paySuccess($id){
        return $this->save(['status'=>1],['id'=>$id]);
    }

    public function getReports($old_report_time,$new_report_time){
        $this->field('count(id) amount');
        $this->where('status','>',0);
        $this->where('create_time','>',$old_report_time);
        $this->where('create_time','<=',$new_report_time);
        $res = $this->find();
        return $res->amount;
    }
}