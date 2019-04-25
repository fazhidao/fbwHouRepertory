<?php
namespace app\api\controller;
header('Access-Control-Allow-Origin: *');
header('content-type:text/html;charset=utf-8');

use think\Controller;
use app\api\model\Banners;
use app\api\model\Articles;
use app\api\model\Article_banners;
use app\api\model\Areainfo;
use app\api\model\Goods;
use app\api\model\Users;
use app\api\model\Contract_custom;
use app\api\model\Contract_owner;
use app\api\model\Contracts;
use app\api\model\Contracts_industries;
use app\api\model\Contracts_types;
use app\api\model\Service_records;
use app\api\model\Services;
use app\api\model\Phone_code;
use app\api\model\System_infos;
use app\api\model\Orders;
use app\api\model\Ask_entrust;
use app\api\model\Ask_entrust_types;
use app\api\model\Ask_advance;
use app\api\model\Ask_help2;
use app\api\model\Ask_help_talks;
use app\api\model\Vip_plans;
use app\api\model\Coupons;
use app\api\model\Sign_records;
use app\api\model\Professional_lawyers;
use app\api\model\Contract_audit;
use app\api\model\Instruments_written;
use app\api\model\Culvert_lawyer;
use app\api\model\Instruments_types;
class App extends Controller
{

    private $user;
    //$class: 权限数组 0未认证 1个人 2企业 3律师 4律所 6管理员
    protected function auth($class=null){
        if(!isset($_POST['appid'])){
            exit(Common_jsonRes(2));
        }
        $user_model = new Users();
        $user = $user_model->authByAppid($_POST['appid']);
        if($user){
            if($class){
                if(!in_array($user->user_class, $class)){
                    exit('越权操作!');
                }
            }
            $this->user = $user;
            return $user_model;
        }else{
            //登录身份失效
            exit(Common_jsonRes(2));
        }
    }

    public function index()
    {
        return "APP Api";
    }

    public function login(){
        $user_model = new Users();
        if(isset($_POST['password'])) {
            //密码登录
            $username = $_POST['phone'];
            $password = $_POST['password'];
            $res = $user_model->login('login_by_password', $username, $password);
        }elseif (isset($_POST['phone_code'])){
            //验证码登录
            $username = $_POST['phone'];
            $phone_code = $_POST['phone_code'];
            $res = $user_model->login('login_by_code', $username, $phone_code);
        }elseif (isset($_POST['openid'])){
            //微信登录
            $openid = $_POST['openid'];
            $res = $user_model->login('login_by_wx', $openid);
        }elseif (isset($_POST['appid'])){
            //appid静默登录
            $appid = $_POST['appid'];
            $res = $user_model->login('login_by_appid', $appid);
        }else{
            return Common_jsonRes(0,'参数错误');
        }
        return Common_jsonRes($res);
    }

    public function getPhone(){
        $this->auth();
        return Common_jsonRes(1,$this->user->phone);
    }

    public function register(){
        $phone = $_POST['phone'];
        $code = $_POST['code'];
        $code_model = new Phone_code();
        $res = $code_model->validateCode($phone,$code);
        if($res) {
            $user_model = new Users();
            $data = [
                'phone' => $_POST['phone'],
                'password' => $_POST['password'],
                'status' => 2,
            ];
            if(isset($_POST['agency_id'])){
                $data['agency_id'] = $_POST['agency_id'];
                $data['note'] = '来源：扫码注册';
            }
            $res = $user_model->register($data);
            if($res[0] == 1) {
                $res[1] = $res[1]['appid'];  //-------------------------
            }
            echo Common_jsonRes($res);
        }else{
            echo Common_jsonRes(0,'无效的验证码');
        }
    }

    public function bindPhone(){
        $phone = $_POST['phone'];
        $code = $_POST['code'];
        $code_model = new Phone_code();
        $res = $code_model->validateCode($phone,$code);
        if($res) {
            $data = [
                'phone' => $_POST['phone'],
                'openid' => $_POST['openid'],
                'status' => 2,
            ];
            $user_model = new Users();
            $res = $user_model->register($data);
            $res[1] = $res[1]['appid'];  //-------------------------
            echo Common_jsonRes($res);
        }else{
            echo Common_jsonRes(0,'无效的验证码');
        }
    }

    public function users($action){
        switch ($action){
            case 'changePassword':
                $user_model = $this->auth();
                if(isset($_POST['old_password'])){
                    $res = $user_model->changePassword(
                        'change_by_password',
                        $this->user->id,
                        $_POST['old_password'],
                        $_POST['new_password']
                    );
                }else if(isset($_POST['phone_code'])){
                    $res = $user_model->changePassword(
                        'change_by_code',
                        $this->user->phone,
                        $_POST['phone_code'],
                        $_POST['new_password']
                    );
                }
                echo Common_jsonRes($res);
                break;
            case 'getUserInfo':
                $user_model = new Users();
                $appid = $_POST['appid'];
                $res = $user_model->getInfoByAppid($appid);
                unset($res['id']);
                echo Common_jsonRes(1,$res);
                break;
            case 'getDetailInfo':
                $user_model = $this->auth();
                $res = $user_model->getUser($this->user->id);
                echo Common_jsonRes(1,$res);
                break;
            case 'loginByOpenid':  //微信登录
                $user_model = new Users();
                $res = $user_model->getUserByOpenid($_POST['openid']);
                echo Common_jsonRes(1,$res);
                break;
            case 'bindWeixin':  //绑定微信
                $user_model = $this->auth();
                $id = $this->user->id;
                $data = ['openid'=>$_POST['openid']];
                $res = $user_model->setUser($id,$data);
                echo Common_jsonRes($res?1:0,$res?'':'绑定失败，可能此微信已绑定账号');
                break;
            case 'editInfo':    //修改个人信息
                $user_model = $this->auth();
                $id = $this->user->id;
                $data = [
                    'name' => $_POST['name'],
                    'gender' => $_POST['gender'],
                    'email' => $_POST['email'],
                    'province_id' => $_POST['province_id'],
                    'city_id' => $_POST['city_id'],
                ];
                if(isset($_POST['avatar'])){
                    $data['avatar'] = $_POST['avatar'];
                }
                $res = $user_model->setUser($id,$data);
                echo Common_jsonRes(1);
                break;
            case 'saveInfo':  //保存认证信息
                $user_model = $this->auth();
                $id = $this->user->id;
                $data = [
                    'name' => $_POST['name'],
                    'status' => 0,
                    'gender' => isset($_POST['gender'])?$_POST['gender']:0,
                    'province_id' => $_POST['province_id'],
                    'city_id' => $_POST['city_id'],
                    'avatar' => isset($_POST['avatar'])?$_POST['avatar']:null,
                ];
                if($_POST['user_class'] == 'lawyer'){
                    $data['user_class'] = 3;
                    $data['other_info'] = json_encode([
                        'good_at'=> $_POST['good_at'],
                        'years'=> $_POST['years'],
                        'license'=> $_POST['license'],
                    ],320);
                }elseif($_POST['user_class'] == 'company'){
                    $data['user_class'] = 2;
                    $data['other_info'] = json_encode([
                        'scale'=> $_POST['scale'],
                        'license'=> $_POST['license'],
                    ],320);
                }else{
                    $data['user_class'] = 1;
                    $data['status'] = 2;
                }
                $res = $user_model->setUser($id,$data);
                echo Common_jsonRes($res?1:0);
                break;
            case 'avatar':  //上传头像
                $res = Common_uploadFile('avatar');
                echo $res;
                break;
            case 'lawyer_license':
                $res = Common_uploadFile('lawyer_license');
                echo $res;
                break;
            case 'company_license':
                $res = Common_uploadFile('company_license');
                echo $res;
                break;
            case 'sign':
                $user_model = $this->auth();
                $sign_model = new Sign_records();
                $now = date('Ymd');
                $res = $sign_model->getSign($this->user->id,$now);
                if($res){
                    return Common_jsonRes(0,'今日已签到');
                }else {
                    $system_model = new System_infos();
                    $sign_in_score = $system_model->getElement('sign_credit');
                    $sign_in_score = $sign_in_score['value'];
                    $sign_model->addSign($this->user->id, $sign_in_score);
                    $user_model->signIn($this->user->id, $sign_in_score);
                    return Common_jsonRes(1,$sign_in_score);
                }
                break;
            case 'isSign':  //是否已签到
                $this->auth();
                $sign_model = new Sign_records();
                $now = date('Ymd');
                $res = $sign_model->getSign($this->user->id,$now);
                if($res){
                    return Common_jsonRes(1,['is_sign'=>1]);
                }else {
                    return Common_jsonRes(1);
                }
                break;
            case 'getCredit':  //获取所有积分
                $user_model = $this->auth();
                $res = $user_model->getCredit($this->user->id);
                echo Common_jsonRes(1,$res);
                break;
            case 'saveClientid': //保存个推id
                $user_model = $this->auth();
                $user_model->setUser($this->user->id,['clientid'=>$_POST['clientid']]);
                echo Common_jsonRes(1);
                break;
            default:
                echo 'undeinfed action';
        }
    }

    public function articles($action){
        $model = new Articles();
        switch ($action){
            case 'getList':
                $filter = [
                    'type' => $_POST['type'],
                    'is_show' => 1,
                ];
                $res = $model->getElement($filter);
                echo Common_jsonRes(1,$res);
                break;
            case 'getTitle':
                $res = $model->getTitle($_POST['id']);
                echo Common_jsonRes(1,$res);
                break;
            case 'getBanners':
                $banner_model = new Article_banners();
                $res = $banner_model->getAppList();
                echo Common_jsonRes(1,$res);
                break;
        }
    }

    //问法相关
    public function ask_law($action){
        switch ($action){
            case 'getPrices':
                $model = new Goods();
                $res = $model->getElement([12,13,14]);
                echo Common_jsonRes(1,$res);
                break;
            case 'getTypeList':
                $model = new Ask_entrust_types();
                $res = $model->getList();
                echo Common_jsonRes(1,$res);
                break;
            case 'save_entrust':
                $user_model = $this->auth();
                $vip_info = $user_model->getVipInfo($this->user->id);
                if($vip_info->ask_entrust_times > 0){
                    $status = 1;
                    if($vip_info->ask_entrust_times < 999) {
                        $vip_info->ask_entrust_times -= 1;
                        $new_vip_info = json_encode($vip_info);
                        $res = $user_model->setUser($this->user->id, ['vip_info' => $new_vip_info]);
                        if (!$res) {
                            exit('更新用户案件委托免费次数失败');
                        }
                    }
                }else{
                    $status = 0;
                }
                $model = new Ask_entrust();
                $data = [
                    'creator_id' => $this->user->id,
                    'status' => $status,
                    'province_id' => $_POST['province_id'],
                    'city_id' => $_POST['city_id'],
                    'type_id' => $_POST['type_id'],
                    'content' => $_POST['content'],
                    'offer_min' => $_POST['offer_min'],
                    'offer_max' => $_POST['offer_max'],
                    'contract_file' => $_POST['pictures'],
                ];
                $res = $model->addElement($data);
                echo Common_jsonRes($res?1:0,[
                    'has_free_time' => $status,
                    'ask_entrust_id' => $res,
                ]);
                break;
            case 'save_advance':
                $user_model = $this->auth();
                $vip_info = $user_model->getVipInfo($this->user->id);
                if($vip_info->ask_advance_times > 0){
                    $status = 1;
                    if($vip_info->ask_entrust_times < 999) {
                        $vip_info->ask_advance_times -= 1;
                        $new_vip_info = json_encode($vip_info);
                        $res = $user_model->setUser($this->user->id, ['vip_info' => $new_vip_info]);
                    }
                    if(!$res){ exit('更新用户诉讼垫资免费次数失败'); }
                }else{
                    $status = 0;
                }
                $model = new Ask_advance();
                $data = [
                    'creator_id' => $this->user->id,
                    'status' => $status,
                    'content' => $_POST['content'],
                ];
                $res = $model->addElement($data);
                echo Common_jsonRes($res?1:0,[
                    'has_free_time' => $status,
                    'ask_advance_id' => $res,
                ]);
                break;
            case 'save_help':
                $user_model = $this->auth();
                $vip_info = $user_model->getVipInfo($this->user->id);
                if($vip_info->ask_help_times > 0){
                    $status = 1;
                    if($vip_info->ask_entrust_times < 999) {
                        $vip_info->ask_help_times -= 1;
                        $new_vip_info = json_encode($vip_info);
                        $res = $user_model->setUser($this->user->id, ['vip_info' => $new_vip_info]);
                        if (!$res) {
                            exit('更新用户法律咨询免费次数失败');
                        }
                    }
                }else{
                    $status = 0;
                }
                $model = new Ask_help2();
                $talk_model = new Ask_help_talks();
                $data = [
                    'creator_id' => $this->user->id,
                    'status' => $status,
                    'pictures' => $_POST['pictures'],
                ];
                $id = $model->addElement($data);
                $talk_data = [
                    'help_id' => $id,
                    'ask_content' => $_POST['content'],
                ];
                $talk_model->addElement($talk_data);
                if($status == 1){
                    $model->pickServant($id);
                }
                echo Common_jsonRes(1, [
                    'has_free_time' => $status,
                    'ask_help_id' => $id,
                ]);
                break;
            case 'save_help_again':
                $this->auth();
                $model = new Ask_help2();
                $talk_model = new Ask_help_talks();
                $data = [ 'status' => 5, ];
                $model->setElement($_POST['id'],$data,$this->user->id);
                $talk_data = [
                    'help_id' => $_POST['id'],
                    'ask_content' => $_POST['content'],
                ];
                $res = $talk_model->addElement($talk_data);
                echo Common_jsonRes($res?1:0);
                break;
            case 'ask_help_picture':
                $res = Common_uploadFile('ask_help_picture');
                echo $res;
                break;
            case 'entrust_contracts':
                $res = Common_uploadFile('entrust_contracts');
                echo $res;
                break;
            case 'mine_ask_help_w': //我的法律咨询 正在提问
                $this->auth();
                $model = new Ask_help2();
                $talk_model = new Ask_help_talks();
                $res = $model->getMineList($this->user->id,[1,2,5,6]);
                foreach ($res as &$item){
                    $item['talks'] = $talk_model->getList(['help_id'=>$item['id']]);
                }
                echo Common_jsonRes(1,$res);
                break;
            case 'mine_ask_help_f': //我的法律咨询 已完成
                $this->auth();
                $model = new Ask_help2();
                $talk_model = new Ask_help_talks();
                $res = $model->getMineList($this->user->id,[3]);
                foreach ($res as &$item){
                    $item['talks'] = $talk_model->getList(['help_id'=>$item['id']]);
                }
                echo Common_jsonRes(1,$res);
                break;
            case 'mine_ask_entrust_w': //我的法律咨询 正在提问
                $this->auth();
                $model = new Ask_entrust();
                $res = $model->getMineList($this->user->id,[1,2]);
                echo Common_jsonRes(1,$res);
                break;
            case 'mine_ask_entrust_f': //我的法律咨询 已完成
                $this->auth();
                $model = new Ask_entrust();
                $res = $model->getMineList($this->user->id,[3]);
                echo Common_jsonRes(1,$res);
                break;
            case 'mine_ask_advance_w': //我的诉讼垫资 正在提问
                $this->auth();
                $model = new Ask_advance();
                $res = $model->getMineList($this->user->id,[1,2]);
                echo Common_jsonRes(1,$res);
                break;
            case 'mine_ask_advance_f': //我的诉讼垫资 已完成
                $this->auth();
                $model = new Ask_advance();
                $res = $model->getMineList($this->user->id,[3]);
                echo Common_jsonRes(1,$res);
                break;
            case 'get_entrustList':
                $this->auth([3]);
                $model = new Ask_entrust();
                $filter = ['status'=>1];
                if(isset($_POST['city_id'])){
                    $filter['city_id'] = $_POST['city_id'];
                }
                if(isset($_POST['type_id'])){
                    $filter['type_id'] = $_POST['type_id'];
                }
                $res = $model->getList($filter);
                echo Common_jsonRes(1,$res);
                break;
            case 'get_my_entrustList':
                $this->auth([3]);
                $model = new Ask_entrust();
//                echo $this->user->id;
                $res = $model->getList(['handler_id'=>$this->user->id], true);
                echo Common_jsonRes(1,$res);
                break;
            case 'take_entrust':
                $this->auth([3]);
                if($this->user->status < 2){
                    return Common_jsonRes(0,'当前账号尚未审核通过');
                }
                $model = new Ask_entrust();
                $info = $model->getElement($_POST['id']);
                if($info['handler_id'] == null) {
                    $res = $model->setElement($_POST['id'], ['handler_id'=>$this->user->id,'status'=>2]);
                    echo Common_jsonRes($res?1:0);
                }else{
                    echo Common_jsonRes(0,'此委托已有代理律师');
                }
                break;
            case 'cancel_take_entrust':
                $this->auth([3]);
                $model = new Ask_entrust();
                $info = $model->getElement($_POST['id']);
                if($info['handler_id'] == $this->user->id) {
                    $res = $model->setElement($_POST['id'], ['handler_id'=>null,'status'=>1]);
                    echo Common_jsonRes($res?1:0);
                }else{
                    echo Common_jsonRes(0,'非本人案件');
                }
                break;
            case 'delete_ask_help': //删除我的法律咨询,只是改状态
                $this->auth();
                $model = new Ask_help2();
                $res = $model->setMine($_POST['id'],$this->user->id,4);
                echo Common_jsonRes($res?1:0);
                break;
            case 'finish_ask_help': //设为完成 我的法律咨询
                $this->auth();
                $model = new Ask_help2();
                $res = $model->setMine($_POST['id'],$this->user->id,3);
                echo Common_jsonRes($res?1:0);
                break;
            case 'delete_ask_entrust':
                $this->auth();
                $model = new Ask_entrust();
                $res = $model->setMine($_POST['id'],$this->user->id,4);
                echo Common_jsonRes($res?1:0);
                break;
            case 'finish_ask_entrust':
                $this->auth();
                $model = new Ask_entrust();
                $res = $model->setMine($_POST['id'],$this->user->id,3);
                echo Common_jsonRes($res?1:0);
                break;
            case 'delete_ask_advance':
                $this->auth();
                $model = new Ask_advance();
                $res = $model->setMine($_POST['id'],$this->user->id,4);
                echo Common_jsonRes($res?1:0);
                break;
            case 'finish_ask_advance':
                $this->auth();
                $model = new Ask_advance();
                $res = $model->setMine($_POST['id'],$this->user->id,3);
                echo Common_jsonRes($res?1:0);
                break;
        }
    }

    public function vip($action){
        $model = new Vip_plans();
        switch ($action){
            case 'getList':
                $res = $model->getElement();
                echo Common_jsonRes(1,$res);
                break;
        }
    }
//合同定制  
    public function make_contract($action){
		
        $model = new Contract_custom();
        switch ($action){
            case 'getPrice':
                $goods_model = new Goods();
                $res = $goods_model->getElement(11);
                echo Common_jsonRes(1,$res);
                break;
            case 'save':
                $user_model = $this->auth();
                $vip_info = $user_model->getVipInfo($this->user->id);
                if($vip_info->contract_make_times > 0){
                    $status = 1;
                    if($vip_info->ask_entrust_times < 999) {
                        $vip_info->contract_make_times -= 1;
                        $new_vip_info = json_encode($vip_info);
                        $res = $user_model->setUser($this->user->id, ['vip_info' => $new_vip_info]);
                        if (!$res) {
                            exit('更新用户定制合同免费次数失败');
                        }
                    }
                }else{
                    $status = 0;
                }
                $data = [
                    'creator_id' => $this->user->id,
                    'status' => $status,
                    'content' => $_POST['content'],
                    'type_id' => $_POST['type_id'],
                    'email' => $_POST['email'],
					'phone' => $_POST['phone'],
					
                ];
				if(isset($_POST['price'])){ 
                   $data['price'] = $_POST['price'];
                }
                $res = $model->addElement($data);
                if(isset($_POST['set_email'])){ //更新用户email
                    $user_model->setUser($this->user->id,[
                        'email' => $_POST['email'],
                    ]);
                }
                echo Common_jsonRes($res?1:0,[
                    'has_free_time' => $status,
                    'contract_custom_id' => $res,
                ]);
                break;
            case 'mine_make_contract_w': //我的合同定制
                $this->auth();
                $res = $model->getList([
                    'creator_id' => $this->user->id,
                    'status' => 1
                ],true);
                echo Common_jsonRes(1,$res);
                break;
            case 'mine_make_contract_f':
                $this->auth();
                $res = $model->getList([
                    'creator_id' => $this->user->id,
                    'status' => 2
                ],true);
                echo Common_jsonRes(1,$res);
                break;
            case 'finish_make_contract':
                $this->auth();
                $res = $model->setElement($_POST['id'],[
                    'status' => 2
                ],$this->user->id);
                echo Common_jsonRes($res?1:0);
                break;
            case 'delete_make_contract':
                $this->auth();
                $res = $model->setElement($_POST['id'],[
                    'status' => 4
                ],$this->user->id);
                echo Common_jsonRes($res?1:0);
                break;

        }
    }
	
	
	//审核合同
	public function audit_contract($action)
	{
        $model = new Contract_audit();
        switch ($action){
            case 'getPrice':
                $goods_model = new Goods();
                $res = $goods_model->getElement(11);
                echo Common_jsonRes(1,$res);
                break;
            case 'save':
                $user_model = $this->auth();
                $vip_info = $user_model->getVipInfo($this->user->id);
                if($vip_info->contract_make_times > 0){
                    $status = 1;
                    if($vip_info->ask_entrust_times < 999) {
                        $vip_info->contract_make_times -= 1;
                        $new_vip_info = json_encode($vip_info);
                        $res = $user_model->setUser($this->user->id, ['vip_info' => $new_vip_info]);
                        if (!$res) {
                            exit('更新用户定制合同免费次数失败');
                        }
                    }
                }else{
                    $status = 0;
                }
                $data = [
                    'creator_id' => $this->user->id,
                    'status' => $status,
                    //'content' => $_POST['content'],
                    //'type_id' => $_POST['type_id'],
                    'phone' => $_POST['phone'],
					'email' => $_POST['email'],
					//'accept_email' => $_POST['accept_email'],
                ];
				if(isset($_POST['price'])){ 
                   $data['price'] = $_POST['price'];
                }
                $res = $model->addElement($data);
                if(isset($_POST['set_email'])){ //更新用户email
                    $user_model->setUser($this->user->id,[
                        'email' => $_POST['email']
                    ]);
                }
                echo Common_jsonRes($res?1:0,[
                    'has_free_time' => $status,
                    'contract_custom_id' => $res,
                ]);
                break;
            case 'mine_make_contract_w': 
                $this->auth();
                $res = $model->getList([
                    'creator_id' => $this->user->id,
                    'status' => 1
                ],true);
                echo Common_jsonRes(1,$res);
                break;
            case 'mine_make_contract_f':
                $this->auth();
                $res = $model->getList([
                    'creator_id' => $this->user->id,
                    'status' => 2
                ],true);
                echo Common_jsonRes(1,$res);
                break;
            case 'finish_make_contract':
                $this->auth();
                $res = $model->setElement($_POST['id'],[
                    'status' => 2
                ],$this->user->id);
                echo Common_jsonRes($res?1:0);
                break;
            case 'delete_make_contract':
                $this->auth();
                $res = $model->setElement($_POST['id'],[
                    'status' => 4
                ],$this->user->id);
                echo Common_jsonRes($res?1:0);
                break;

        }
    }
	
	
	
	
	

    //合同相关
    public function contracts($action){
        $model = new Contracts();
        switch ($action) {
            case 'getList':
                $filter = [];
                if(isset($_POST['keywords'])){
                    $filter['keywords'] = $_POST['keywords'];
                }
                if(isset($_POST['type_id'])){
                    $filter['type_id'] = $_POST['type_id'];
                }
                if(isset($_POST['industry_id'])){
                    $filter['industry_id'] = $_POST['industry_id'];
                }
                $res = $model->appGetList($filter);
                echo Common_jsonRes(1,$res);
                break;
            case 'getMineList':
                $this->auth();
                $owner_model = new Contract_owner();
                $res = $owner_model->getMineList($this->user->id);
                echo Common_jsonRes(1,$res);
                break;
            case 'getDetail':
                $id = $_POST['id'];
                $res = $model->appGetDetail($id);
                $owner_model = new Contract_owner();
                if(isset($_POST['appid'])) {
                    $this->auth();
                    $res['is_owned'] = $owner_model->checkOwner($this->user->id, $id);
                }else{
                    $res['is_owned'] = false;
                }
                echo Common_jsonRes(1,$res);
                break;
            case 'checkOwner':
                $this->auth();
                $owner_model = new Contract_owner();
                $contract_id = $_POST['contract_id'];
                $res = $owner_model->checkOwner($this->user->id, $contract_id);
                if(!$res){
                    if($this->user->vip_id == 3) {  //前端因为vip3默认显示打开按钮，所以此处特殊设置一下
                        $owner_model->addElement([
                            'user_id' => $this->user->id,
                            'contract_id' => $_POST['contract_id'],
                            'buy_price' => '会员免费下载'
                        ]);
                    }else {
                        return Common_jsonRes(1, $res);
                    }
                }
                $res = $model->appGetFilepath($contract_id);
                echo Common_jsonRes(1,$res);
                break;
            case 'addDownloads':
                $contract_id = $_POST['contract_id'];
                $res = $model->addDownloads($contract_id);
                echo Common_jsonRes($res?1:0);
                break;
            case 'VipPayment':
                $user_model = $this->auth();
                $vip_info = $user_model->getVipInfo($this->user->id);
                if($vip_info->contract_download_times > 0){
                    $status = 1;
                    if($vip_info->ask_entrust_times < 999) {
                        $vip_info->contract_download_times -= 1;
                        $new_vip_info = json_encode($vip_info);
                        $res = $user_model->setUser($this->user->id, ['vip_info' => $new_vip_info]);
                        if (!$res) {
                            exit('更新用户法律咨询免费次数失败');
                        }
                    }
                    $owner_model = new Contract_owner();
                    $owner_model->addElement([
                        'user_id' => $this->user->id,
                        'contract_id' => $_POST['contract_id'],
                        'buy_price' => '会员免费下载'
                    ]);
                }else{
                    $status = 0;
                }
                echo Common_jsonRes($status);
                break;
        }
    }
    //获取合同类型和行业分类
    public function getTypeAndIndustry()
    {
        $model1 = new Contracts_industries();
        $res1 = $model1->getElement();
        $model2 = new Contracts_types();
        $res2 = $model2->getElement();
        echo Common_jsonRes(1,[
            'type_list' => $res2,
            'industry_list' => $res1,
        ]);
    }

	
	//获取代写文书分类
    public function getTypeInstruments()
    {
        $model = new Instruments_types();
        $res = $model->getElement();
        echo Common_jsonRes(1,[
            'type_list' => $res,  
        ]);
    }
	
	
	//代写文书
	public function written_instruments($action){
        $model = new Instruments_written();
        switch ($action){
            case 'getPrice':
                $goods_model = new Goods();
                $res = $goods_model->getElement(11);
                echo Common_jsonRes(1,$res);
                break;
            case 'save':
                $user_model = $this->auth();
                $vip_info = $user_model->getVipInfo($this->user->id);
                if($vip_info->contract_make_times > 0){
                    $status = 1;
                    if($vip_info->ask_entrust_times < 999) {
                        $vip_info->contract_make_times -= 1;
                        $new_vip_info = json_encode($vip_info);
                        $res = $user_model->setUser($this->user->id, ['vip_info' => $new_vip_info]);
                        if (!$res) {
                            exit('更新用户定制合同免费次数失败');
                        }
                    }
                }else{
                    $status = 0;
                }
                $data = [
                    'creator_id' => $this->user->id,
                    'status' => $status,
                    'content' => $_POST['content'],
                    'type_id' => $_POST['type_id'],
                    'email' => $_POST['email'],
					'phone' => $_POST['phone'],
					//'price' => $_POST['price'],
					
                ];
				if(isset($_POST['price'])){ 
                   $data['price'] = $_POST['price'];
                }
                $res = $model->addElement($data);
                if(isset($_POST['set_email'])){ //更新用户email
                    $user_model->setUser($this->user->id,[
                        'email' => $_POST['email'],
                    ]);
                }
                echo Common_jsonRes($res?1:0,[
                    'has_free_time' => $status,
                    'contract_custom_id' => $res,
                ]);
                break;
            case 'mine_make_contract_w': //我的合同定制
                $this->auth();
                $res = $model->getList([
                    'creator_id' => $this->user->id,
                    'status' => 1
                ],true);
                echo Common_jsonRes(1,$res);
                break;
            case 'mine_make_contract_f':
                $this->auth();
                $res = $model->getList([
                    'creator_id' => $this->user->id,
                    'status' => 2
                ],true);
                echo Common_jsonRes(1,$res);
                break;
            case 'finish_make_contract':
                $this->auth();
                $res = $model->setElement($_POST['id'],[
                    'status' => 2
                ],$this->user->id);
                echo Common_jsonRes($res?1:0);
                break;
            case 'delete_make_contract':
                $this->auth();
                $res = $model->setElement($_POST['id'],[
                    'status' => 4
                ],$this->user->id);
                echo Common_jsonRes($res?1:0);
                break;

        }
    }
	
	//律师涵
	public function lawyer_culvert($action)
	{
        $model = new Culvert_lawyer();
        switch ($action){
            case 'getPrice':
                $goods_model = new Goods();
                $res = $goods_model->getElement(11);
                echo Common_jsonRes(1,$res);
                break;
            case 'save':
                $user_model = $this->auth();
                $vip_info = $user_model->getVipInfo($this->user->id);
                if($vip_info->contract_make_times > 0){
                    $status = 1;
                    if($vip_info->ask_entrust_times < 999) {
                        $vip_info->contract_make_times -= 1;
                        $new_vip_info = json_encode($vip_info);
                        $res = $user_model->setUser($this->user->id, ['vip_info' => $new_vip_info]);
                        if (!$res) {
                            exit('更新用户定制合同免费次数失败');
                        }
                    }
                }else{
                    $status = 0;
                }
                $data = [
                    'creator_id' => $this->user->id,
                    'status' => $status,
                    'content' => $_POST['content'],
					'phone' => $_POST['phone'],
                    'email' => $_POST['email'],
                ];
				if(isset($_POST['price'])){ 
                   $data['price'] = $_POST['price'];
                }
                $res = $model->addElement($data);
                if(isset($_POST['set_email'])){ //更新用户email
                    $user_model->setUser($this->user->id,[
                        'email' => $_POST['email']
                    ]);
                }
                echo Common_jsonRes($res?1:0,[
                    'has_free_time' => $status,
                    'contract_custom_id' => $res,
                ]);
                break;
            case 'mine_make_contract_w': 
                $this->auth();
                $res = $model->getList([
                    'creator_id' => $this->user->id,
                    'status' => 1
                ],true);
                echo Common_jsonRes(1,$res);
                break;
            case 'mine_make_contract_f':
                $this->auth();
                $res = $model->getList([
                    'creator_id' => $this->user->id,
                    'status' => 2
                ],true);
                echo Common_jsonRes(1,$res);
                break;
            case 'finish_make_contract':
                $this->auth();
                $res = $model->setElement($_POST['id'],[
                    'status' => 2
                ],$this->user->id);
                echo Common_jsonRes($res?1:0);
                break;
            case 'delete_make_contract':
                $this->auth();
                $res = $model->setElement($_POST['id'],[
                    'status' => 4
                ],$this->user->id);
                echo Common_jsonRes($res?1:0);
                break;

        }
    }
	
	
	
	
	
	
	
    public function getLawyers(){
        $model = new Professional_lawyers();
        $res = $model->getElement(true);
        return Common_jsonRes(1,$res);
    }
    public function getLawyers2(){
        $model = new Professional_lawyers();
        $res = $model->getElement();
        return Common_jsonRes(1,$res);
    }

    public function coupons($action){
        $model = new Coupons();
        switch ($action){
            case 'convert':
                $user_model = $this->auth();
                $goods_model = new Goods();
                $credit_info = $user_model->getCredit($this->user->id);
                $credit = $credit_info->credit;
                $need_credit = $goods_model->getElement(10);
                $need_credit = $need_credit->price;
                if($credit < $need_credit){
                    return Common_jsonRes(0,'剩余积分不足');
                }else{
                    $credit = $credit - $need_credit;
                    $res = $user_model->setUser(
                        $this->user->id,
                        ['credit'=>$credit, 'coupon_amount'=>$credit_info->coupon_amount+1]
                    );
                    if($res){
                        $res = $model->addCoupon($this->user->id,1);
                        if($res){
                            return Common_jsonRes(1);
                        }
                    }
                    exit('数据库更新失败');
                }
                break;
            case 'getTotal':
                $res = $model->getTotal(1);
                return Common_jsonRes(1,$res);
                break;
        }
    }

    //企业服务
    public function services($action){
        $this->auth();
        $services_model = new Services();
        switch ($action){
            case 'add':
                $data = [
                    'name' => $_POST['name'],
                    'contactor' => $_POST['name'],
                    'phone' => $_POST['phone'],
                    'type' => $_POST['type'],
                    'creator_id' => $this->user->id,
                ];
                $res = $services_model->addElement($data);
                echo Common_jsonRes($res?1:0);
                break;
            case 'get':
                $res = $services_model->getElement([
                    'creator_id' => $this->user->id,
                    'status' => $_POST['status']
                ], true);
                echo Common_jsonRes(1,$res);
                break;
            case 'finish':
                $res = $services_model->setElement([
                    'creator_id' => $this->user->id,
                    'id' => $_POST['id']
                ],[
                    'status' => 2
                ]);
                echo Common_jsonRes(1,$res);
                break;
        }
    }

    //创建支付订单
    public function createOrder(){
        $user_model = $this->auth();
        $order_model = new Orders();
        if(isset($_POST['goods_id'])) {
            //问法等
            $goods_model = new Goods();
            $goods_id = $_POST['goods_id'];
            $goods_info = $goods_model->getElement($goods_id);
            if($this->user->vip_id>0){
                $discount = json_decode($this->user->vip_info);
                switch ($_POST['goods_id']){
                    case 12:
                        $goods_info['price'] = $goods_info['price'] * $discount->ask_help_discount / 10;
                        break;
                    case 13:
                        $goods_info['price'] = $goods_info['price'] * $discount->ask_entrust_discount / 10;
                        break;
                    case 14:
                        $goods_info['price'] = $goods_info['price'] * $discount->ask_advance_discount / 10;
                        break;
                    case 11:
                        $goods_info['price'] = $goods_info['price'] * $discount->contract_make_discount / 10;
                        break;
                }
            }
        }elseif (isset($_POST['vip_id'])){
            //购买VIP
            $goods_model = new Vip_plans();
            $vip_id = $_POST['vip_id'];
            $goods_info = $goods_model->getElement(['id'=>$vip_id]);
            $goods_info['price'] = $goods_info['new_price'];
        }elseif (isset($_POST['contract_id'])){
            //购买合同
            $contract_model = new Contracts();
            $contract_id = $_POST['contract_id'];
            $goods_info = $contract_model->getInfoForOrder($contract_id);
            $goods_info['title'] = '购买合同';
            if($this->user->vip_id>0){
                $discount = json_decode($this->user->vip_info);
                $goods_info['price'] = $goods_info['price'] * $discount->contract_download_discount / 10;
            }
        }else{exit('缺少goods_id字段');}

        $type = $_POST['pay_type'];
        switch ($type){
            case 'alipay':
                $goods_info['passback_params'] = $_POST['passback_params'];
                $order_str = $order_model->createAlipayOrder($this->user->id,$goods_info);
                echo Common_jsonRes(1,$order_str);
                break;
            case 'wxpay':
                $goods_info['attach'] = $_POST['passback_params'];
                $order_str = $order_model->createWxpayOrder($this->user->id,$goods_info);
                echo Common_jsonRes(1,$order_str);
                break;
            case 'coupon': //合同下载券
                $credit_info = $user_model->getCredit($this->user->id);
                $coupon_amount = $credit_info['coupon_amount'];
                $service_model = new Service_records();
                if($coupon_amount > 0){
                    $res = $user_model->setUser($this->user->id,['coupon_amount'=>$coupon_amount-1]);
                    if(!$res){exit('更新用户下载券数量失败');}
                    $owner_model = new Contract_owner();
                    $owner_model->addElement([
                        'user_id' => $this->user->id,
                        'contract_id' => $contract_id,
                        'buy_price' => '合同下载券'
                    ]);
                    $user_name = mb_substr( $this->user->name, 0, 1 ).($this->user->gender?'女士':'先生');
                    $service_model->addElement($user_name.'用合同下载券购买了合同');
                    echo Common_jsonRes(1);
                }else{
                    echo Common_jsonRes(0,'没有下载券剩余了');
                }
                break;
        }
    }

    //支付异步回调验证
    public function notify($type){
        $model = new Orders();
        switch ($type){
            case 'alipay':
                $passback_params = json_decode($_POST['passback_params']);
                $res = $model->checkAlipayOrder($_POST);
                if($res && $_POST['trade_status']=='TRADE_SUCCESS'){
                    $order_id = $_POST['out_trade_no'];
                    $order_info = $model->getOrder($order_id);
                    if($order_info['total_amount'] != $_POST['receipt_amount'] * 100){
                        exit('金额不正确');
                    }
                    $data_to_save = [
                        'trade_no' => $_POST['trade_no'],
                        'buyer_logon_id' => $_POST['buyer_logon_id'], //卖家支付宝账号
                        'pay_amount' => $_POST['receipt_amount'] * 100,
                        'fund_bill_list' => $_POST['fund_bill_list'],
                        'pay_time' => $_POST['gmt_payment'],
                        'status' => 1,
                    ];
                    $res = $model->updateOrder($order_id,$data_to_save);
                    if(!$res){
                        exit('更新订单数据库错误');
                    }
                }else{
                    exit('非法支付消息');
                }
                echo 'success';
                break;
            case 'wxpay':
                $postXml = file_get_contents("php://input"); //接收微信参数
                if (empty($postXml)) {
                    exit('empty request');
                }
                $xmlstring = simplexml_load_string($postXml, 'SimpleXMLElement', LIBXML_NOCDATA);
                $attr = json_decode(json_encode($xmlstring), true);
                $passback_params = json_decode($attr['attach']);
                $check_sign = $model->checkWeixinOrder($attr);
                if(!$check_sign){
                    exit('签名不合法');
                }
                $order_id = $attr['out_trade_no'];
                $order_info = $model->getOrder($order_id);
                if($order_info['total_amount'] != $attr['total_fee']){
                    exit('金额不正确');
                }
                $data_to_save = [
                    'trade_no' => $attr['transaction_id'],
                    'buyer_logon_id' => $attr['openid'], //微信openid
                    'pay_amount' => $attr['total_fee'],
                    'pay_time' => $attr['time_end'],
                    'status' => 1,
                ];
                $res = $model->updateOrder($order_id,$data_to_save);
                if(!$res){
                    exit('更新订单数据库错误');
                }
                echo '<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';
                break;
            default:
                exit('不存在的支付方式');
        }
        //异步回调通过后更新操作
        $service_model = new Service_records();
        $order_model = new Orders();
        $order_info = $order_model->getOrder($order_id);
        $user_model = new Users();
        $user_info = $user_model->getSimpleUser($order_info->user_id);
        $user_name = mb_substr( $user_info['name'], 0, 1 ).($user_info['gender']?'女士':'先生');
        //增加消费总额
        $user_model->setUser($order_info->user_id, ['total_consume'=>$user_info['total_consume']+$order_info['total_amount']]);
        if(isset($passback_params->ask_type)){
            switch ($passback_params->ask_type){
                case 'entrust':
                    $ask_model = new Ask_entrust();
                    $ask_model->paySuccess($passback_params->ask_id);
                    $service_model->addElement($user_name.'发布了案件委托');
                    break;
                case 'advance':
                    $ask_model = new Ask_advance();
                    $ask_model->paySuccess($passback_params->ask_id);
                    $service_model->addElement($user_name.'发布了诉讼垫资');
                    break;
                case 'help':
                    $ask_model = new Ask_help2();
                    $ask_model->paySuccess($passback_params->ask_id);
                    $ask_model->pickServant($passback_params->ask_id);
                    $service_model->addElement($user_name.'发布了法律咨询');
                    break;
            }
        }elseif (isset($passback_params->buy_contract)){
            $owner_model = new Contract_owner();
            $owner_model->addElement([
                'user_id' => $order_info->user_id,
                'contract_id' => $order_info->goods_id,
                'buy_price' => '￥'.$order_info->pay_amount
            ]);
            $service_model->addElement($user_name.'购买了合同');
        }elseif (isset($passback_params->make_contract)){
            $make_model = new Contract_custom();
            $make_model->paySuccess($passback_params->id);
            $service_model->addElement($user_name.'申请了定制合同');
        }elseif (isset($passback_params->buy_vip)){
            $vip_model = new Vip_plans();
            $vip_info = $vip_model->getVipInfo($order_info->goods_id);
            $vip_info = json_encode($vip_info);
            $data = [
                'vip_id' => $order_info->goods_id,
                'vip_info' => $vip_info,
                'vip_end_time' => date('Y-m-d 00:00:00',strtotime('+1 year')),
            ];
            $user_model->setUser($order_info->user_id,$data);
            $service_model->addElement($user_name.'开通了'.$vip_info['title']);
        }
    }

    //首页相关数据
    public function getIndexData(){
        $model1 = new Service_records();
        $res['services'] = $model1->getElement();
        $model2 = new Articles();
        $res['toutiaos'] = $model2->appGetData(1,5);
        $res['anlis'] = $model2->appGetData(2,5);
        $model3 = new Banners();
        $res['banners'] = $model3->getAppList();
        echo Common_jsonRes(1,$res);
    }

    //查询城市
    public function areas($actions){
        $model = new Areainfo();
        switch ($actions){
            case 'getList':
                $name = $_POST['name'];
                $res = $model->getListByName($name);
                echo Common_jsonRes(1,$res);
                break;
        }
    }

    //计算诉讼费等
    public function calculate_susong($type){
        switch ($type){
            case "财产案件":
                //受理费收费标准
                $law_list = [
                    [10000, 50],
                    [100000, 0.01 * 2.5],
                    [200000, 0.01 * 2],
                    [500000, 0.01 * 1.5],
                    [1000000, 0.01 * 1],
                    [2000000, 0.01 * 0.9],
                    [5000000, 0.01 * 0.8],
                    [10000000, 0.01 * 0.7],
                    [20000000, 0.01 * 0.6],
                    [0, 0.01 * 0.5],
                ];
                $res1 = $this->calc($law_list);
                //执行费收费标准
                $law_list = [
                    [10000, 50],
                    [500000, 0.01 * 1.5],
                    [5000000, 0.01 * 1],
                    [10000000, 0.01 * 0.5],
                    [0, 0.01 * 0.1],
                ];
                $res2 = $this->calc($law_list);
                //保全费收费标准
                $law_list = [
                    [1000, 30],
                    [100000, 0.01 * 1],
                    [0, 0.01 * 0.5],
                ];
                $res3 = $this->calc($law_list);
                if($res3 > 5000){ $res3 = 5000; }
                $data = [
                    ['受理费',$res1],
                    ['执行费',$res2],
                    ['保全费',$res3],
                ];
                echo Common_jsonRes(1,$data);
                break;
        }
    }
    private function calc($rule){
        //    $law_list = [
        //        [10000, 50],
        //        [500000, 0.01 * 1.5],
        //        [5000000, 0.01 * 1],
        //        [10000000, 0.01 * 0.5],
        //        [0, 0.01 * 0.1],
        //    ];
        //如上为费用规则，[规则额度,费率]
        $res = 0;
        $len = count($rule);
        for($i=0; $i<$len; $i++){
            if($_POST['money'] <= $rule[$i][0] || $rule[$i][0] == 0){
                if($i == 0) {
                    $res += $rule[$i][1];
                }else{
                    $res += ($_POST['money'] - $rule[$i-1][0]) * $rule[$i][1];
                }
                break;
            }else{
                if($i == 0) {
                    $res += $rule[0][1];
                }else{
                    $res += ($rule[$i][0] - $rule[$i-1][0]) * $rule[$i][1];
                }
            }
        }
        return $res;
    }

    //根据经纬度获取城市
    public function getCityByLocation(){
        $location = $_POST['location'];
        $res = file_get_contents('http://api.map.baidu.com/cloudrgc/v1?location='.$location.'&geotable_id=199266&coord_type=bd09ll&ak=7X7EUnaw1kiASdrFHvOE5vmGHdspXb4h');
        $info = json_decode($res);
        if($info->status == 0) {
            $city_name = $info->address_component->city;
            echo Common_jsonRes(1, ['city_name' => $city_name]);
        }else{
            echo Common_jsonRes(1, ['fail' => 1]);
        }
    }

    //检测APP版本信息  兼容老版
    public function checkAppVersion(){
        $app_version = $_POST['version'];
        $model = new System_infos();

        if(!isset($_POST['platform'])){
            $path = $model->getElement(['app_update_text','app_path','app_path_ios','app_force_update']);
            return Common_jsonRes(1, [
                'status' => 1,
                'url' => $path[1]['value'],
                'url_ios' => $path[2]['value'],
                'force_update' => $path[3]['value'],
                'update_text' => $path[0]['value'],
            ]);
        }

        $now_version = $_POST['platform'] == 'android' ? $model->getElement('app_version') : $model->getElement('app_version_ios');
        $now_version = $now_version['value'];
        if($now_version != $app_version) {
            $path = $model->getElement(['app_update_text','app_path','app_path_ios','app_force_update']);
            return Common_jsonRes(1, [
                'status' => 1,
                'url' => $_POST['platform'] == 'android' ? $path[1]['value'] : $path[2]['value'],
                'force_update' => $path[3]['value'],
                'update_text' => $path[0]['value'],
            ]);
        }else{
            return Common_jsonRes(1, [
                'status' => 0,
            ]);
        }
    }
    //新版 热更新
    public function checkUpdate(){
        $model = new System_infos();
        $app_version = $_POST['app_version'];
        $wdg_version = $_POST['wdg_version'];
        $platform = $_POST['platform'];

        $version_info = $model->getElement(['app_update_text','app_version','app_path',
            'app_version_ios','app_path_ios','app_force_update','widget_version','app_path_widget']);

        $now_app_version = $platform == 'ios' ? $version_info[3]['value'] : $version_info[1]['value'];
        $app_path = $platform == 'ios' ? $version_info[4]['value'] : $version_info[2]['value'];

        $app_version_num = explode('.',$app_version);
        $app_version_num = $app_version_num[0]*100 + $app_version_num[1]*10 + $app_version_num[2];
        $now_app_version_num = explode('.',$now_app_version);
        $now_app_version_num = $now_app_version_num[0]*100 + $now_app_version_num[1]*10 + $now_app_version_num[2];

        $wdg_version_num = explode('.',$wdg_version);
        $wdg_version_num = $wdg_version_num[0]*100 + $wdg_version_num[1]*10 + $wdg_version_num[2];
        $now_wdg_version_num = explode('.',$version_info[6]['value']);
        $now_wdg_version_num = $now_wdg_version_num[0]*100 + $now_wdg_version_num[1]*10 + $now_wdg_version_num[2];
        if($app_version_num < $now_app_version_num) { //需要整包更新
            return Common_jsonRes(1, [
                'status' => 2,
                'url' => $app_path,
                'force_update' => $version_info[5]['value'],
                'update_text' => $version_info[0]['value'],
            ]);
        }elseif($wdg_version_num < $now_wdg_version_num){ //热更新
            return Common_jsonRes(1, [
                'status' => 1,
                'url' => $version_info[7]['value'],
            ]);
        }else{
            return Common_jsonRes(1, [
                'status' => 0,
            ]);
        }
    }

    //返回新闻详情页
    public function articleWeb($id){
        $model = new Articles();
        $model->addReader($id);
        $article = $model->getElement(['id'=>$id]);
        if(!$article){
            return $this->fetch('./404.html');
        }
        $article = $article->toArray();
        $article['inapp'] = isset($_GET['inapp']);
        return $this->fetch('article_detail',$article);
    }

    //返回客服聊天页
    public function chatWeb($appid){
        $model = new Users();
        $user_info = $model->getInfoByAppid($appid);
        if(!$user_info){
            return $this->fetch('./404.html');
        }
        $from = isset($_GET['from']) ? $_GET['from'] : 2;
        $url = $from == 1 ? '/pages/ask_law/ask_law' : '/pages/mine/mine';
        $user_id = md5($user_info['id']);
        return $this->fetch('chat',[
            'user_id' => $user_id,
            'url' => $url,
            'vip' => $user_info['vip_title'],
            'name' => $user_info['name'],
            'gender' => $user_info['gender'] ? '女' : '男',
        ]);
    }

    //注册协议
    public function resgiterAgreement(){
        $model = new System_infos();
        $content = $model->getElement('register_agreement');
        return $this->fetch('register_agreement',['content'=>$content['value']]);
    }

    //代理商单独注册页面
    public function agencyRegister(){
        if(isset($_GET['share'])) {
            $agency_id = $_GET['share'];
            return $this->fetch('register', ['agency_id' => $agency_id]);
        }
        return $this->fetch('./404.html');
    }

    //入驻律师管理办法
    public function lawyerManage(){
        $model = new System_infos();
        $content = $model->getElement('lawyer_manage');
        return $this->fetch('lawyer_manage',['content'=>$content['value']]);
    }

    public function getShareData(){
        $model = new System_infos();
        $res = $model->getElement(['share_url','share_img','share_title','web_url']);
        return Common_jsonRes(1,$res);
    }
}