<?php
namespace app\api\Model;

use think\Model;

//后台用户表
class Users_admin extends Model
{
    //密码md5加密加盐
    private $salt = 'fabaowang2019';

    //用户身份验证
    public function authByAppid($appid){
        $this->where('appid',$appid);
        $this->where('status',1);
        return $this->find();
    }

    public function login($username,$password){
        $user = $this->where('name',$username)->find();
        if(!$user){
            return [0,'不存在此用户'];
        }
        if($user['status'] == 0){
            return [0,'此用户已被禁用'];
        }
        if(md5($password.$this->salt) == $user->password){
            $new_appid = $this->changeAppid($user['id']);
            $this->save(['appid'=>$new_appid], ['id'=>$user['id']]);
            return [1,[
                'token' => $new_appid,
                'user_class' => $user->user_class,
                'father_id' => $user->father_id,
                'authority' => $user->authority
            ]];
        }
        return [0,'登录密码错误'];
    }

    public function addUser($data)
    {
        $user = $this->where('name',$data['name'])->find();
        if($user){
            return false;
        }
        if(isset($data['password'])){
            $data['password'] = md5($data['password'].$this->salt);
        }
        return $this->save($data);
    }

    public function setUser($id,$data)
    {
        if(isset($data['password'])){
            $data['password'] = md5($data['password'].$this->salt);
            $data['appid'] = $this->changeAppid($id);
        }
        return $this->save($data,['id'=>$id]);
    }

    //禁用
    public function delElement($id)
    {
        return $this->where('id',$id)->update(['status'=>4]);
    }

    //删除代理商客服
    public function delSubagent($id,$father_id)
    {
        return $this->where('id',$id)->where('father_id',$father_id)->delete();
    }


    public function getAgencies($filter=[])
    {
        foreach ($filter as $key=>$value){
            if($key == 'name' || $key == 'phone') {
                $this->where('users_admin.'.$key,'like',"%$value%");
            }else{
                $this->where('users_admin.'.$key,$value);
            }
        }
        $this->field(['users_admin.id','phone','users_admin.name','create_time','note','province_id','city_id',
            'district_id','address','province.name province','city.name city','district.name district',
            'status','contactor','corporation','balance']);
        $this->join('areainfo province','province_id = province.id','left');
        $this->join('areainfo city','city_id = city.id','left');
        $this->join('areainfo district','district_id = district.id','left');
        $this->where('user_class',5);
        $page_size = isset($_POST['page_size']) ? $_POST['page_size'] : 50;
        return $this->order('create_time','desc')->paginate($page_size);
    }

    public function getUsers($filter){
        $this->field('id, name, phone, note, status, authority');
        foreach ($filter as $key=>$value){
            $this->where($key,$value);
        }
        return $this->select();
    }

    //change it when relogin, use for app identify
    //return appid
    public function changeAppid($id){
        //keep it unique
        return md5($id.time());
    }

    public function agencyCharge($id,$amount){
        return $this->where('id', $id)->setInc('balance', $amount);
    }

}