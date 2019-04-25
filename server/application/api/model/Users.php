<?php
namespace app\api\Model;

use think\Model;
use app\api\model\Phone_code;
use app\api\model\Vip_plans;

class Users extends Model{ 
    //密码md5加密加盐
    private $salt = 'fabaowang2019';

    //用户身份验证
    public function authByAppid($appid){
        $this->where('appid',$appid);
        $this->where('status','<>',3);
        $this->field(['id','user_class','name','gender','vip_id','vip_info','status','phone']);
        return $this->find();
    }

    public function getInfoByAppid($appid){
        $this->field('users.id,name,user_class,avatar,gender,credit,vip_id,title vip_title,coupon_amount,appid,vip_info,email,phone');
        $this->where('appid',$appid);
        $this->join('vip_plans','vip_id = vip_plans.id','left');
        return $this->find();
    }

    public function getUserByOpenid($openid){
        $this->field('name,user_class,avatar,credit,title vip_title,coupon_amount,appid');
        $this->where('openid',$openid);
        $this->join('vip_plans','vip_id = vip_plans.id','left');
        return $this->find();
    }

    //获取VIP信息
    public function getVipInfo($id){
        $this->field(['vip_info']);
        $this->where('id',$id);
        $res = $this->find();
        return json_decode($res->vip_info);
    }

    //获取供应商列表
    public function getAgencies($filter=[]){
        $this->field(['users.id','phone','users.name','create_time','note','province_id','city_id','district_id','address',
            'province.name province','city.name city','district.name district','status']);
        $this->join('areainfo province','province_id = province.id','left');
        $this->join('areainfo city','city_id = city.id','left');
        $this->join('areainfo district','district_id = district.id','left');
        $this->where('user_class','5');
        if ($filter != []) {
            foreach ($filter as $key => $value) {
                if($key=='phone' || $key=='name') {
                    $this->where($key, 'like', "%$value%");
                }else{
                    $this->where($key, $value);
                }
            }
        }
        $page_size = isset($filter['page_size'])?$filter['page_size']:50;
        return $this->paginate($page_size);
    }

    //获取客户列表
    public function getClients($filter=[],$agency_id=null){
        $fields = ['users.id','users.phone','users.name','users.create_time','users.status','users.credit',
            'users.total_consume','users.note','users.province_id','users.city_id','users.district_id',
            'users.vip_id','users.address','users.user_class'];
        foreach ($filter as $key => $value) {
            if($key=='phone' || $key=='name') {
                $this->where($key, 'like', "%$value%");
            }else{
                $this->where($key, $value);
            }
        }
        if($agency_id){
            $this->where('agency_id',$agency_id);
            $this->join('vip_plans','vip_id = vip_plans.id','left');
            array_push($fields,'title vip_name');
        }else{
            $this->join('vip_plans','vip_id = vip_plans.id','left');
            $this->join('users_admin agency','agency_id = agency.id','left');
            array_push($fields,'agency.name agency_name','title vip_name');
        }
        $this->field($fields);
        $this->whereNotNull('users.agency_id');
        $this->order('users.status');
        $page_size = isset($filter['page_size'])?$filter['page_size']:50;
        return $this->paginate($page_size);
    }
    //2019-4-19 获取客户列表 包含代理商客服的
    public function getClients2($filter=[],$agency_id=null){
        if($agency_id){
            $subagents = $this->table('users_admin')->where('father_id',$agency_id)->select();
            $id_list = [$agency_id];
            if(count($subagents)){
                foreach ($subagents as $subagent){
                    array_push($id_list,$subagent['id']);
                }
            }
        }
        $fields = ['users.id','users.phone','users.name','users.create_time','users.status','users.credit',
            'users.total_consume','users.note','users.province_id','users.city_id','users.district_id',
            'users.vip_id','users.address','users.user_class'];
        foreach ($filter as $key => $value) {
            if($key=='phone' || $key=='name') {
                $this->where($key, 'like', "%$value%");
            }else{
                $this->where($key, $value);
            }
        }
        $this->join('vip_plans','vip_id = vip_plans.id','left');
        $this->join('users_admin agency','agency_id = agency.id','left');
        array_push($fields,'title vip_name','agency.name agency_name');
        if($agency_id){
            $this->whereIn('agency_id',$id_list);
        }
        $this->field($fields);
        $this->whereNotNull('users.agency_id');
        $this->order('users.status');
        $page_size = isset($filter['page_size'])?$filter['page_size']:50;
        return $this->paginate($page_size);
    }

    //获取用户列表
    public function getUserList($filter=[]){
        $this->field(['users.id','phone','users.name','create_time','title vip_name','status','credit','total_consume','note',
            'province_id','city_id','district_id','vip_id','address','user_class','avatar']);
        $this->join('vip_plans','vip_id = vip_plans.id','left');
        foreach ($filter as $key => $value) {
            if($key=='phone' || $key=='name') {
                $this->where($key, 'like', "%$value%");
            }else{
                $this->where($key, $value);
            }
        }
        $page_size = isset($filter['page_size'])?$filter['page_size']:50;
        return $this->paginate($page_size);
    }

    //密码登录  短信登录  微信登录  注意删除id和password信息
    public function getInfoForLogin($filter){
        $this->field('users.id,password,  name,user_class,avatar,credit,vip_id,title vip_title,coupon_amount,appid,vip_info,email');
        foreach ($filter as $key=>$value){
            $this->where($key,$value);
        }
        $this->join('vip_plans','vip_id = vip_plans.id','left');
        return $this->where('status','<>',3)->find();
    }
    //不带联查的
    public function getSimpleUser($id){
        $this->field('name,gender,phone,total_consume,clientid');
        $this->where('id',$id);
        return $this->find();
    }
    //获取详细信息
    public function getUser($id){
        $this->where('users.id',$id);
        $this->field(['users.name','users.credit','users.gender','users.user_class','users.avatar','users.email','users.phone',
            'title vip_name','province.name province_name','city.name city_name','district.name district_name','users.other_info',
            'users.province_id','users.city_id','users.district_id','agency.name agency_name','users.total_consume',
            'users.note','users.last_login_time','users.create_time']);
        $this->join('vip_plans','vip_id = vip_plans.id','left');
        $this->join('areainfo province','province_id = province.id','left');
        $this->join('areainfo city','city_id = city.id','left');
        $this->join('areainfo district','district_id = district.id','left');
        $this->join('users agency','users.agency_id = agency.id','left');
        return $this->find();
    }
    public function addUser($data){
        if(isset($data['password'])){
            $data['password'] = md5($data['password'].$this->salt);
        }
        return $this->save($data);
    }
    public function setUser($id,$data){
        if(isset($data['password'])){
            $data['password'] = md5($data['password'].$this->salt);
        }
        return $this->save($data,['id'=>$id]);
    }
    public function delUser($id){
        return $this->where('id',$id)->delete();
    }

    //登录
    //$password: password or validate_code
    //return : [status,message|appid]
    public function login($type,$phone,$password=null)
    {
        if($type == 'login_by_password'){
            $new_password = md5($password.$this->salt);
            $user_data = $this->getInfoForLogin(['phone'=>$phone]);
            if(!$user_data) {
                return [0,'账号不存在'];
            }
            if ($new_password === $user_data['password']) {
                $new_appid = $this->changeAppid($user_data['id']);
                $this->save(['appid'=>$new_appid,'last_login_time'=>date("Y-m-d H:i:s")], ['phone'=>$phone]);
                $user_data['appid'] = $new_appid;
                unset($user_data['id']);
                unset($user_data['password']);
                return [1, $user_data];
            }
            return [0, '密码错误'];
        }else if($type == 'login_by_code'){
            $phone_code_model = new Phone_code();
            if($phone_code_model->validateCode($phone,$password)){
                $user_data = $this->getInfoForLogin(['phone'=>$phone]);
                if(!$user_data) {
                    $user_data = $this->register(['phone'=>$phone]);
                    $user_data = $user_data[1];
                }else {
                    $new_appid = $this->changeAppid($user_data['id']);
                    $this->save(['appid' => $new_appid, 'last_login_time' => date("Y-m-d H:i:s")], ['phone' => $phone]);
                    $user_data['appid'] = $new_appid;
                }
                unset($user_data['id']);
                unset($user_data['password']);
                return [1, $user_data];
            }
            return [0,'验证码错误'];
        }else if($type == 'login_by_wx'){
            $user_data = $this->getInfoForLogin(['openid'=>$phone]);
            if($user_data) {
                $new_appid = $this->changeAppid($user_data['id']);
                $this->save(['appid'=>$new_appid,'last_login_time'=>date("Y-m-d H:i:s")], ['openid'=>$phone]);
                $user_data['appid'] = $new_appid;
                unset($user_data['id']);
                unset($user_data['password']);
                return [1, $user_data];
            }
            return [1, null];   //需要绑定手机  新增用户信息
        }else if($type == 'login_by_appid'){
            $user_data = $this->getInfoForLogin(['appid'=>$phone]);
            if($user_data) {
                $this->save(['last_login_time'=>date("Y-m-d H:i:s")], ['appid'=>$phone]);
                unset($user_data['id']);
                unset($user_data['password']);
                return [1, $user_data];
            }
            return [1, null];   //需要绑定手机  新增用户信息
        }else{
            return [0,'type错误'];
        }
    }

    //注册 注册完应是登录一样的返回信息
    public function register($data){
        $has_phone = $this->where('phone',$data['phone'])->find();
        if($has_phone){
            if(isset($data['openid'])) {
                $this->setUser($has_phone['id'],['openid'=>$data['openid']]);
                $appid = $this->changeAppid($has_phone['id']);
                $this->save(['appid' => $appid], ['phone' => $data['phone']]);
                $user_info = $this->getInfoForLogin(['appid'=>$appid]);
                return [1,$user_info];
            }
            return [0, '该手机已注册'];
        }
        if(isset($data['password'])) {
            $data['password'] = md5($data['password'] . $this->salt);
        }
        $vip_model = new Vip_plans();
        $vip_info = $vip_model->getVipInfo(0);
        $vip_info = json_encode($vip_info);
        $data['vip_info'] = $vip_info;
        $userid = $this->insertGetId($data);
        $appid = $this->changeAppid($userid);
        $this->save(['appid' => $appid], ['phone' => $data['phone']]);
        $user_info = $this->getInfoForLogin(['appid'=>$appid]);
        return [1,$user_info];
    }

    //修改密码
    //$id: appid or phone
    //$old_password: old_password or validate_code
    //return : [status,message]
    public function changePassword($type,$id,$old_password,$new_password){
        if($type == 'change_by_password'){
            $user_data = $this->where('id',$id)->find();
            $old_password_in_db = $user_data['password'];
            $old_password = md5($old_password.$this->salt);
            if($old_password === $old_password_in_db){
                $new_password = md5($new_password.$this->salt);
                $this->save(['password'=>$new_password],['id'=>$id]);
                return true;
            }
            return [false,'密码错误'];
        }elseif ($type == 'change_by_code'){
            $phone_code_mode = new Phone_code();
            if($phone_code_mode->validateCode($id,$old_password)){
                $new_password = md5($new_password.$this->salt);
                $this->save(['password'=>$new_password],['phone'=>$id]);
                return true;
            }
            return [false,'验证码错误'];
        }
        return [false,'type错误'];
    }

    //change it when relogin, use for app identify
    //return appid
    public function changeAppid($id){
        //keep it unique
        return md5($id.time());
    }

    //签到
    public function signIn($id,$sign_in_score){
        $res = $this->where('id',$id)->setInc('credit', $sign_in_score);
        return $res;
    }

    //获取总积分
    public function getCredit($id){
        return $this->field('credit,coupon_amount')->where('id',$id)->find();
    }

    //更新过期会员
    public function checkVip($vip0){
        $this->where('vip_id','<>',0)
            ->where('vip_end_time','<',date('Y-m-d H:i:s'))
            ->update([
                'vip_id' => 0,
                'vip_info' => $vip0,
            ]);
    }

    public function getReports($old_report_time,$new_report_time){
        $this->where('create_time','>',$old_report_time);
        $this->where('create_time','<=',$new_report_time);
        $data[0] = $this->where('user_class',1)->count();
        $this->where('create_time','>',$old_report_time);
        $this->where('create_time','<=',$new_report_time);
        $data[1] = $this->where('user_class',2)->count();
        $this->where('create_time','>',$old_report_time);
        $this->where('create_time','<=',$new_report_time);
        $data[2] = $this->where('user_class',3)->count();
        return $data;
    }

}