<?php
namespace app\api\Model;

use think\Model;

//案件委托
class Contract_custom extends Model{

    public function addElement($data){
        return $this->insertGetId($data);
    }

    public function getList($filter=[],$is_user=false){
        foreach ($filter as $key=>$value){
            $this->where($key, $value);
        }
        $this->field(['contract_custom.id','content','type_id','title type_name','creator_id','create_time','status','email']);
        $this->join('contracts_types','type_id = contracts_types.id');
        if($is_user){
            $this->whereIn('status', [1,2]);
        }
        $page_size = isset($_POST['page_size']) ? $_POST['page_size'] : 50;
        return $this->order('create_time desc')->paginate($page_size);
    }

    public function setElement($id,$data,$userid=false){
        $this->where('id', $id);
        if($userid){
            $this->where('creator_id', $userid);
        }
        return $this->update($data);
    }

    public function delElement($id){
        return $this->destroy($id);
    }

    public function paySuccess($id){
        return $this->setElement($id,['status'=>1]);
    }
}