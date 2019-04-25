<?php
namespace app\api\Model;

use think\Model;

//案件委托
class Ask_help2 extends Model{

    public function addElement($data){
        return $this->insertGetId($data);
    }

    public function getList($filter=[]){
        foreach ($filter as $key=>$value){
            if(is_array($value)){
                $this->whereIn('ask_help2.'.$key,$value);
            }else {
                $this->where('ask_help2.'.$key, $value);
            }
        }
        $this->field('ask_help2.id, ask_help2.status, users.name, users.phone, users.gender, users_admin.name servant, pictures,
            ask_help2.create_time, finish_type');
        $this->join('users','users.id = creator_id','left');
        $this->join('users_admin','users_admin.id = servant_id','left');
        $page_size = isset($_POST['page_size']) ? $_POST['page_size'] : 50;
        return $this->order('create_time desc')->paginate($page_size);
    }

    public function getElement($id){
        return $this->where('id',$id)->find();
    }

    public function setElement($id,$data,$user_id = false){
        if(is_array($id)){
            $this->whereIn('id',$id);
        }else{
            $this->where('id',$id);
        }
        if($user_id){
            $this->where('creator_id',$user_id);
        }
        return $this->update($data);
    }

    public function getMineList($user_id,$status_list){
        $this->where('creator_id',$user_id);
        $this->whereIn('status',$status_list);
        $this->order('create_time','desc');
        return $this->paginate(20);
    }

    public function setMine($id,$user_id,$status){
        return $this->where('id',$id)->where('creator_id',$user_id)->update(['status'=>$status]);
    }

    public function paySuccess($id){
        return $this->save(['status'=>1],['id'=>$id]);
    }


    public function getAmounts($id=null){
        $amounts[0] = $this->where('status',1)->where('servant_id',$id)->count();
        $amounts[1] = $this->where('status',2)->where('servant_id',$id)->count();
        $amounts[2] = $this->where('status',5)->where('servant_id',$id)->count();
        $amounts[3] = $this->where('status',6)->where('servant_id',$id)->count();
        return $amounts;
    }

    public function pickServant($id){
        $servant = $this->table('users_admin')->where('user_class',7)->where('status','<>',0)->order('last_serve_time')->find();
        $this->table('users_admin')->where('id',$servant['id'])->update(['last_serve_time'=>date('Y-m-d H:i:s')]);
        $this->where('id',$id)->update(['servant_id'=>$servant['id']]);
    }

    public function test(){
        $res = $this->query('SELECT MAX(id) as id FROM ask_help_talks GROUP BY ask_content');
        $ids = [];
        foreach ($res as $item){
            array_push($ids, $item['id']);
        }
        $a = $this->table('ask_help_talks')->field('help_id')->whereIn('id',$ids)->select();
        $ids2 = [];
        foreach ($a as $b){
            array_push($ids2, $b['help_id']);
        }
        $this->whereNotIn('id',$ids2)->delete();
        $this->table('ask_help_talks')->whereNotIn('id',$ids)->delete();
        echo 'success';
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