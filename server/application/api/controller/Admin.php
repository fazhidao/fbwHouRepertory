<?php
namespace app\api\controller;
header('Access-Control-Allow-Origin:*');

use think\Controller;
use app\api\model\Articles;
use app\api\model\Article_banners;
use app\api\model\Areainfo;
use app\api\model\Ask_entrust;
use app\api\model\Ask_entrust_types;
use app\api\model\Ask_help;
use app\api\model\Ask_help2;
use app\api\model\Ask_help_talks;
use app\api\model\Ask_advance;
use app\api\model\Agency_charges;
use app\api\model\Banners;
use app\api\model\Contracts;
use app\api\model\Contracts_industries;
use app\api\model\Contracts_types;
use app\api\model\Contract_custom;
use app\api\model\Goods;
use app\api\model\Orders;
use app\api\model\Professional_lawyers;
use app\api\model\Reports;
use app\api\model\System_infos;
use app\api\model\Services;
use app\api\model\Users;
use app\api\model\Users_admin;
use app\api\model\Vip_plans;

class Admin extends Controller
{
    private $user;
    //$class: 权限数组 5代理商 6管理员 7客服 8超级管理员
    //res: 2 登录失效
    protected function auth($class=null){
        $user_model = new Users_admin();
        if($class == 'test'){
            $this->user = (object)[
                'id' => 1
            ];
            return $user_model;
        }
        if(!isset($_POST['appid'])){
            exit(Common_jsonRes(2));
        }
        $user = $user_model->authByAppid($_POST['appid']);
        if(!$user){
            exit(Common_jsonRes(2));
        }
        if($class){
            if(!in_array($user->user_class, $class)){
                exit(Common_jsonRes(2,'越权操作!'));
            }
        }
        $this->user = $user;
        return $user_model;
    }

    public function index()
    {
        return "Admin Api";
    }

    public function loginV2(){
        $model = new Users_admin();
        $res = $model->login($_POST['username'],$_POST['password']);
        echo Common_jsonRes($res);
    }

    public function getInfoByAppid(){
        $model = new Users_admin();
        $res = $model->authByAppid($_POST['appid']);
        unset($res['id']);
        unset($res['password']);
        echo Common_jsonRes(1,$res);
    }

    // 省市区管理
    public function areainfos($action){
        $this->auth();
        $area_model = new Areainfo();
        switch ($action){
            case 'get':
                $filter = [];
                if(isset($_POST['parent_id'])){
                    $filter['parent_id'] = $_POST['parent_id'];
                }
                $res = $area_model->getElement($filter);
                echo Common_jsonRes(1,$res);
                break;
            case 'set':
                $res = $area_model->setElement($_POST);
                echo Common_jsonRes($res?1:0);
                break;
            case 'add':
                $res = $area_model->addElement($_POST);
                echo Common_jsonRes($res);
                break;
        }
    }

    // 价格管理
    public function goods($action){
        $this->auth([6]);
        $model = new Goods();
        switch ($action){
            case 'get':
                $res = $model->getElement();
                echo Common_jsonRes(1,$res);
                break;
            case 'set':
                if($_POST['id'] != 10){
                    $_POST['price'] = $_POST['price'] * 100;
                }
                $res = $model->setElement($_POST['id'],$_POST['price']);
                echo Common_jsonRes($res?1:0);
                break;
        }
    }

    //文章管理
    public function articles($action){
        $articles_model = new Articles();
        switch ($action){
            case 'get':
                $this->auth([6]);
                $filter = [];
                if(isset($_POST['id'])){
                    $filter['id'] = $_POST['id'];
                }
                if(isset($_POST['title'])&&$_POST['title']!=''){
                    $filter['title'] = $_POST['title'];
                }
                if(isset($_POST['type'])&&$_POST['type']!=''){
                    $filter['type'] = $_POST['type'];
                }
                if(isset($_POST['is_show'])&&$_POST['is_show']!=''){
                    $filter['is_show'] = $_POST['is_show'];
                }
                $res = $articles_model->getElement($filter);
                echo Common_jsonRes(1,$res);
                break;
            case 'del':
                $this->auth([6]);
                $res = $articles_model->delElement($_POST['id']);
                echo Common_jsonRes($res?1:0);
                break;
            case 'set':case 'add':
                $this->auth([6]);
                $data = [
                    'type'=>$_POST['type'],
                    'title'=>$_POST['title'],
                    'abstract'=>isset($_POST['abstract'])?$_POST['abstract']:'',
                    'views'=>$_POST['views'] ?? 0,
                    'content'=>$_POST['content'],
                    'is_show'=>$_POST['is_show'],
                    'tag'=>$_POST['tag'] ?? '',
                    'tag_color'=>$_POST['tag_color'] ?? '',
                ];
                if(isset($_POST['title_picture'])){
                    $data['title_picture'] = $_POST['title_picture'];
                }
                if($action == 'set') {
                    $res = $articles_model->setElement($_POST['id'],$data);
                }else{
                    $res = $articles_model->addElement($data);
                }
                echo Common_jsonRes($res?1:0,'无修改');
                break;
            case 'upload':
                $res = Common_uploadFile('article_pic');
                echo Common_jsonRes($res?1:0,$res);
                break;
            case 'editor_pic':
                $res = Common_uploadFile('editor_pic');
                echo json_encode([
                    "errno" => 0,
                    "data" => ['http://116.62.208.170/uploads/'.$res]
                ]);
                break;
            case 'push':
                $this->auth([6]);
                $title = $articles_model->getTitle($_POST['id']);
                $this->push('push_all',["title"=>$title['title'], "url"=>"/pages/learn_law/detail_webview?id=".$_POST['id']]);
                $articles_model->addPush($_POST['id']);
                echo Common_jsonRes(1);
                break;
        }
    }

    //ueditor上传
    public function ueditor(){
        $config = [
            "imageActionName"=>"uploadimage",
            "imageFieldName"=>"upfile",
            "imageMaxSize"=>2048000,
            "imageAllowFiles"=>[".png", ".jpg", ".jpeg", ".gif", ".bmp"],
            "imageCompressEnable"=>true,
            "imageCompressBorder"=>1600,
            "imageInsertAlign"=>"none",
            "imageUrlPrefix"=>"",
            "imagePathFormat"=>"/ueditor/php/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}",
            "scrawlActionName"=>"uploadscrawl",
            "scrawlFieldName"=>"upfile",
            "scrawlPathFormat"=>"/ueditor/php/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}",
            "scrawlMaxSize"=>2048000,
            "scrawlUrlPrefix"=>"",
            "scrawlInsertAlign"=>"none",
            "snapscreenActionName"=>"uploadimage",
            "snapscreenPathFormat"=>"/ueditor/php/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}",
            "snapscreenUrlPrefix"=>"",
            "snapscreenInsertAlign"=>"none",
            "catcherLocalDomain"=>["127.0.0.1", "localhost", "img.baidu.com"],
            "catcherActionName"=>"catchimage",
            "catcherFieldName"=>"source",
            "catcherPathFormat"=>"/ueditor/php/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}",
            "catcherUrlPrefix"=>"",
            "catcherMaxSize"=>2048000,
            "catcherAllowFiles"=>[".png", ".jpg", ".jpeg", ".gif", ".bmp"],
            "videoActionName"=>"uploadvideo",
            "videoFieldName"=>"upfile",
            "videoPathFormat"=>"/ueditor/php/upload/video/{yyyy}{mm}{dd}/{time}{rand:6}",
            "videoUrlPrefix"=>"",
            "videoMaxSize"=>102400000,
            "videoAllowFiles"=>[
                ".flv", ".swf", ".mkv", ".avi", ".rm", ".rmvb", ".mpeg", ".mpg",
                ".ogg", ".ogv", ".mov", ".wmv", ".mp4", ".webm", ".mp3", ".wav", ".mid"],
            "fileActionName"=>"uploadfile",
            "fileFieldName"=>"upfile",
            "filePathFormat"=>"/ueditor/php/upload/file/{yyyy}{mm}{dd}/{time}{rand:6}",
            "fileUrlPrefix"=>"",
            "fileMaxSize"=>51200000,
            "fileAllowFiles"=>[
                ".png", ".jpg", ".jpeg", ".gif", ".bmp",
                ".flv", ".swf", ".mkv", ".avi", ".rm", ".rmvb", ".mpeg", ".mpg",
                ".ogg", ".ogv", ".mov", ".wmv", ".mp4", ".webm", ".mp3", ".wav", ".mid",
                ".rar", ".zip", ".tar", ".gz", ".7z", ".bz2", ".cab", ".iso",
                ".doc", ".docx", ".xls", ".xlsx", ".ppt", ".pptx", ".pdf", ".txt", ".md", ".xml"
            ],
            "imageManagerActionName"=>"listimage",
            "imageManagerListPath"=>"/ueditor/php/upload/image/",
            "imageManagerListSize"=>20,
            "imageManagerUrlPrefix"=>"",
            "imageManagerInsertAlign"=>"none",
            "imageManagerAllowFiles"=>[".png", ".jpg", ".jpeg", ".gif", ".bmp"],
            "fileManagerActionName"=>"listfile",
            "fileManagerListPath"=>"/ueditor/php/upload/file/",
            "fileManagerUrlPrefix"=>"",
            "fileManagerListSize"=>20,
            "fileManagerAllowFiles"=>[
                ".png", ".jpg", ".jpeg", ".gif", ".bmp",
                ".flv", ".swf", ".mkv", ".avi", ".rm", ".rmvb", ".mpeg", ".mpg",
                ".ogg", ".ogv", ".mov", ".wmv", ".mp4", ".webm", ".mp3", ".wav", ".mid",
                ".rar", ".zip", ".tar", ".gz", ".7z", ".bz2", ".cab", ".iso",
                ".doc", ".docx", ".xls", ".xlsx", ".ppt", ".pptx", ".pdf", ".txt", ".md", ".xml"
            ]
        ];
        echo json_encode($config);
    }

    //vip管理
    public function vip_plans($action){
        $this->auth();
        $model = new Vip_plans();
        switch ($action){
            case 'get':
                $res = $model->getElement();
                echo Common_jsonRes(1,$res);
                break;
            case 'set':
                $data = [
                    'title'=>$_POST['title'],
                    'initial_price'=>$_POST['initial_price'],
                    'new_price'=>$_POST['new_price'],
                    'renew_price'=>$_POST['renew_price'],
                    'agency_price'=>$_POST['agency_price'],
                    'ask_help_times'=>$_POST['ask_help_times'],
                    'ask_help_discount'=>$_POST['ask_help_discount'],
                    'ask_entrust_times'=>$_POST['ask_entrust_times'],
                    'ask_entrust_discount'=>$_POST['ask_entrust_discount'],
                    'ask_advance_times'=>$_POST['ask_advance_times'],
                    'ask_advance_discount'=>$_POST['ask_advance_discount'],
                    'contract_download_times'=>$_POST['contract_download_times'],
                    'contract_download_discount'=>$_POST['contract_download_discount'],
                    'contract_make_times'=>$_POST['contract_make_times'],
                    'contract_make_discount'=>$_POST['contract_make_discount'],
                ];
                $model->setElement($_POST['id'],$data);
                echo Common_jsonRes(1);
                break;
        }
    }

    //crontab每天2点检查所有会员是否过期
    public function checkVip(){
        $vip_model = new Vip_plans();
        $user_model = new Users();
        $vip_info = $vip_model->getVipInfo(0);
        $user_model->checkVip(json_encode($vip_info));
    }

    //合同管理
    public function contracts($action){
        $model = new Contracts();
        switch ($action){
            case 'get':
                $this->auth([6]);
                $filter = [];
                if(isset($_POST['id'])){
                    $filter['id'] = $_POST['id'];
                }
                if(isset($_POST['keywords'])&&$_POST['keywords']!=''){
                    $filter['keywords'] = $_POST['keywords'];
                }
                if(isset($_POST['type_id'])&&$_POST['type_id']!=''){
                    $filter['type_id'] = $_POST['type_id'];
                }
                if(isset($_POST['industry_id'])&&$_POST['industry_id']!=''){
                    $filter['industry_id'] = $_POST['industry_id'];
                }
                $res = $model->getElement($filter);
                echo Common_jsonRes($res?1:0,$res);
                break;
            case 'set':case 'add':
                $this->auth([6]);
                $data = [
                    'type_id' => $_POST['type_id'],
                    'industry_id' => $_POST['industry_id'],
                    'keywords' => $_POST['keywords'] ?? '',
                    'file_path' => $_POST['file_path'],
                    'picture' => $_POST['picture'],
                    'price' => $_POST['price'] * 100,
                    'downloads' => $_POST['downloads'] ?? ''
                ];
                if($action == 'set') {
                    $res = $model->setElement($_POST['id'], $data);
                }else{
                    $res = $model->addElement($data);
                }
                echo Common_jsonRes(1);
                break;
            case 'del':
                $this->auth([6]);
                $res = $model->delElement($_POST['id']);
                echo Common_jsonRes($res?1:0);
                break;
            case 'upload_contract':
                $res = Common_uploadFile('contract');
                echo Common_jsonRes($res?1:0,$res);
                break;
            case 'upload_contract_pic':
                $res = Common_uploadFile('contract_pic');
                echo Common_jsonRes($res?1:0,$res);
                break;
        }
    }
    public function contracts_industries($action){
        $this->auth([6]);
        $model = new Contracts_industries();
        switch ($action){
            case 'get':
                $res = $model->getElement();
                echo Common_jsonRes(1,$res);
                break;
            case 'set':
                $res = $model->setElement($_POST);
                echo Common_jsonRes($res?1:0);
                break;
            case 'add':
                $res = $model->addElement($_POST);
                echo Common_jsonRes($res?1:0);
                break;
            case 'del':
                $res = $model->delElement($_POST['id']);
                echo Common_jsonRes($res);
                break;
        }
    }
    public function contracts_types($action){
        $this->auth([6]);
        $model = new Contracts_types();
        switch ($action){
            case 'get':
                $res = $model->getElement();
                echo Common_jsonRes(1,$res);
                break;
            case 'set':
                $res = $model->setElement($_POST);
                echo Common_jsonRes($res?1:0);
                break;
            case 'add':
                $res = $model->addElement($_POST);
                echo Common_jsonRes($res?1:0);
                break;
            case 'del':
                $res = $model->delElement($_POST['id']);
                echo Common_jsonRes($res);
                break;
        }
    }

    public function orders($action){
        $this->auth();
        $model = new Orders();
        switch ($action){
            case 'getList':
                $filter = [];
                if(isset($_POST['user_id'])){
                    $filter['user_id'] = $_POST['user_id'];
                }
                $res = $model->getList($filter);
                echo Common_jsonRes(1,$res);
                break;
        }
    }

    //管理端用户管理
    public function admins($action){
        $model = $this->auth();
        switch ($action) {
            case 'getAgencies':
                $filter = [
                    'father_id' => null
                ];
                if (isset($_POST['phone'])) {
                    $filter['phone'] = $_POST['phone'];
                }
                if (isset($_POST['name'])) {
                    $filter['name'] = $_POST['name'];
                }
                if (isset($_POST['province_id'])) {
                    $filter['province_id'] = $_POST['province_id'];
                }
                if (isset($_POST['city_id'])) {
                    $filter['city_id'] = $_POST['city_id'];
                }
                if (isset($_POST['district_id'])) {
                    $filter['district_id'] = $_POST['district_id'];
                }
                $res = $model->getAgencies($filter);
                echo Common_jsonRes(1, $res);
                break;
            case 'setAgency': case 'addAgency':
                $data = [
                    'name' => $_POST['name'],
                    'balance' => $_POST['balance']*100,
                    'phone' => $_POST['phone'] ?? '',
                    'contactor' => $_POST['contactor'] ?? '',
                    'corporation' => $_POST['corporation'] ?? '',
                    'province_id' => $_POST['province_id'] ?? '',
                    'city_id' => $_POST['city_id'] ?? '',
                    'district_id' => $_POST['district_id'] ?? '',
                    'address' => $_POST['address'] ?? '',
                    'note' => $_POST['note']  ?? '',
                    'user_class' => '5',
                    'authority' => '',
                ];
                if(isset($_POST['password'])){
                    $data['password'] = $_POST['password'];
                }
                if($action == 'setAgency') {
                    $model->setUser($_POST['id'], $data);
                }else{
                    $model->addUser($data);
                }
                echo Common_jsonRes(1);
                break;
            case 'forbid':
                $res = $model->setUser($_POST['id'],['status'=>0]);
                echo Common_jsonRes($res?1:0);
                break;
            case 'cancelForbid':
                $res = $model->setUser($_POST['id'],['status'=>1]);
                echo Common_jsonRes($res?1:0);
                break;
            case 'getAdmins':
                $res = $model->getUsers(['user_class'=>6]);
                echo Common_jsonRes(1, $res);
                break;
            case 'addAdmin': case 'setAdmin':
                $data = [
                    'name' => $_POST['name'],
                    'phone' => $_POST['phone'],
                    'authority' => $_POST['authority'],
                    'note' => isset($_POST['note']) ? $_POST['note'] :'',
                    'user_class' => '6',
                ];
                if(isset($_POST['password'])){
                    $data['password'] = $_POST['password'];
                }
                if($action == 'setAdmin') {
                    $model->setUser($_POST['id'], $data);
                }else{
                    $model->addUser($data);
                }
                echo Common_jsonRes(1);
                break;
            case 'getServants':
                $res = $model->getUsers(['user_class'=>7]);
                echo Common_jsonRes(1, $res);
                break;
            case 'addServants': case 'setServants':
                $data = [
                    'name' => $_POST['name'],
                    'phone' => $_POST['phone'],
                    'authority' => '',
                    'note' => isset($_POST['note']) ? $_POST['note'] :'',
                    'user_class' => '7',
                ];
                if(isset($_POST['password'])){
                    $data['password'] = $_POST['password'];
                }
                if($action == 'setServants') {
                    $model->setUser($_POST['id'], $data);
                }else{
                    $model->addUser($data);
                }
                echo Common_jsonRes(1);
                break;
        }
    }

    //2019-4-19新增，获取代理商客服
    public function subagents($action){
        $model = $this->auth([5]);
        switch ($action) {
            case 'get':
                $filter = [
                    'father_id' => $this->user->id
                ];
                if (isset($_POST['phone'])) {
                    $filter['phone'] = $_POST['phone'];
                }
                if (isset($_POST['name'])) {
                    $filter['name'] = $_POST['name'];
                }
                if (isset($_POST['province_id'])) {
                    $filter['province_id'] = $_POST['province_id'];
                }
                if (isset($_POST['city_id'])) {
                    $filter['city_id'] = $_POST['city_id'];
                }
                if (isset($_POST['district_id'])) {
                    $filter['district_id'] = $_POST['district_id'];
                }
                $res = $model->getAgencies($filter);
                echo Common_jsonRes(1, $res);
                break;
            case 'set':
            case 'add':
                $data = [
                    'father_id' => $this->user->id,
                    'name' => $_POST['name'] ?? '',
                    'balance' => 0,
                    'phone' => $_POST['phone'] ?? '',
                    'contactor' => $_POST['contactor'] ?? '',
                    'corporation' => $_POST['corporation'] ?? '',
                    'province_id' => $_POST['province_id'] ?? '',
                    'city_id' => $_POST['city_id'] ?? '',
                    'district_id' => $_POST['district_id'] ?? '',
                    'address' => $_POST['address'] ?? '',
                    'note' => $_POST['note'] ?? '',
                    'user_class' => '5',
                    'authority' => '',
                ];
                if (isset($_POST['password'])) {
                    $data['password'] = $_POST['password'];
                }
                if ($action == 'set') {
                    $model->setUser($_POST['id'], $data);
                } else {
                    $res = $model->addUser($data);
                    if(!$res){
                        return Common_jsonRes(0,'登录用户名重复');
                    }
                }
                echo Common_jsonRes(1);
                break;
            case 'del':
                $res = $model->delSubagent($_POST['id'],$this->user->id);
                echo Common_jsonRes($res?1:0);
        }
    }

    public function agency_charge($action){
        $this->auth([6]);
        $model = new Agency_charges();
        switch ($action){
            case 'getList':
                $filter = [
                    'agency_id' => $_POST['agency_id']
                ];
                $res = $model->getList($filter);
                return Common_jsonRes(1,$res);
                break;
            case 'add':
                $charge_amount = $_POST['charge_amount']*100;
                $data = [
                    'agency_id' => $_POST['agency_id'],
                    'charge_amount' => $charge_amount,
                    'note' => $_POST['note'],
                ];
                $res = $model->addElement($data);
                if(!$res){
                    exit(Common_jsonRes(0,'插入数据库失败'));
                }
                $admin_model = new Users_admin();
                $admin_model->agencyCharge($_POST['agency_id'], $charge_amount);
                return Common_jsonRes($res?1:0);
                break;
        }
    }

    //APP用户管理
    public function users($action){
        $this->auth([6]);
        $model = new Users();
        switch ($action){
            case 'get':
                $filter = [];
                if(isset($_POST['phone'])){
                    $filter['phone'] = $_POST['phone'];
                }
                if(isset($_POST['name'])){
                    $filter['name'] = $_POST['name'];
                }
                if(isset($_POST['user_class'])){
                    $filter['user_class'] = $_POST['user_class'];
                }
                if(isset($_POST['vip_id'])){
                    $filter['vip_id'] = $_POST['vip_id'];
                }
                $res = $model->getUserList($filter);
                echo Common_jsonRes(1,$res);
                break;
            case 'setVip':
                $vip_model = new Vip_plans();
                $vip_info = $vip_model->getVipInfo($_POST['vip_id']);
                $vip_info = json_encode($vip_info);
                $data = [
                    'vip_id' => $_POST['vip_id'],
                    'vip_info' => $vip_info,
                    'vip_end_time' => date('Y-m-d 00:00:00',strtotime('+1 year')),
                ];
                $res = $model->setUser($_POST['id'], $data);
                echo Common_jsonRes($res?1:0);
                break;
            case 'add':
                $res = $model->register([
                    'username' => $_POST['username'],
                    'phone' => $_POST['phone'],
                    'password' => $_POST['password'],
                    'type' => 4,
                ]);
                echo Common_jsonRes($res?1:0);
                break;
            case 'del':
                $res = $model->delUser($_POST['id']);
                echo Common_jsonRes($res?1:0);
                break;
            case 'getSingle':
                $id = $_POST['id'];
                $res = $model->getUser($id);
                $res['total_consume'] = ($res['total_consume']/100).'元';
                echo Common_jsonRes(1,$res);
                break;
            case 'approve':
                $id = $_POST['id'];
                $res = $model->setUser($id,['status'=>2]);
                echo Common_jsonRes($res?1:0);
                break;
            case 'forbid':
                $id = $_POST['id'];
                $res = $model->setUser($id,['status'=>3]);
                echo Common_jsonRes($res?1:0);
                break;
            case 'cancel_forbid':
                $id = $_POST['id'];
                $res = $model->setUser($id,['status'=>2]);
                echo Common_jsonRes($res?1:0);
                break;
        }
    }

    public function getAgencyId(){
        $this->auth([5,6]);
        return Common_jsonRes(1,$this->user->id);
    }

    //代理商的客户管理
    public function clients($action){
        $model = new Users(); //不能直接用auth返回的model。类不一样
        switch ($action){
            case 'get':
                $this->auth();
                $filter = [];
                if (isset($_POST['phone'])) {
                    $filter['phone'] = $_POST['phone'];
                }
                if (isset($_POST['name'])) {
                    $filter['name'] = $_POST['name'];
                }
                if (isset($_POST['province_id'])) {
                    $filter['province_id'] = $_POST['province_id'];
                }
                if (isset($_POST['city_id'])) {
                    $filter['city_id'] = $_POST['city_id'];
                }
                if (isset($_POST['district_id'])) {
                    $filter['district_id'] = $_POST['district_id'];
                }
                //不传agency_id则获取当前代理商的客户
                $agency_id = $_POST['agency_id'] ?? $this->user->id;
                $res = $model->getClients2($filter,$agency_id);
                $res = $res->toArray();//tp5 必须toArray才能新加对象
                $res['balance'] = $this->user->balance;
                echo Common_jsonRes(1,$res);
                break;
            case 'getAudit':
                $this->auth();
                $filter = [];
                if (isset($_POST['phone'])) {
                    $filter['phone'] = $_POST['phone'];
                }
                if (isset($_POST['name'])) {
                    $filter['name'] = $_POST['name'];
                }
                if (isset($_POST['province_id'])) {
                    $filter['province_id'] = $_POST['province_id'];
                }
                if (isset($_POST['city_id'])) {
                    $filter['city_id'] = $_POST['city_id'];
                }
                if (isset($_POST['district_id'])) {
                    $filter['district_id'] = $_POST['district_id'];
                }
                //获取所有代理商的客户供审核
                $res = $model->getClients($filter);
                echo Common_jsonRes(1,$res);
                break;
            case 'agree':
                $this->auth([6]);
                //审核通过
                $user_id = $_POST['user_id'];
                $res = $model->setUser($user_id,['status'=>2]);
                echo Common_jsonRes($res?1:0);
                break;
            case 'disagree':
                $this->auth([6]);
                //审核不通过
                $user_id = $_POST['user_id'];
                $res = $model->setUser($user_id,['status'=>1]);
                echo Common_jsonRes($res?1:0);
                break;
            case 'add':case 'set':
                $this->auth([5]);
                $vip_model = new Vip_plans();
                $vip_info = $vip_model->getVipInfo($_POST['vip_id'],1);
                if($vip_info->agency_price > $this->user->balance){
                    exit(Common_jsonRes(0,'余额不足！'));
                }else{
                    $admin_model = new Users_admin();
                    $admin_model->setUser($this->user->id,[
                        'balance' => $this->user->balance - $vip_info->agency_price
                    ]);
                    unset($vip_info['agency_price']);
                }
                $data = [
                    'name' => $_POST['name'],
                    'phone' => $_POST['phone'],
                    'province_id' => isset($_POST['province_id']) ? $_POST['province_id'] : '',
                    'city_id' => isset($_POST['city_id']) ? $_POST['city_id'] : '',
                    'district_id' => isset($_POST['district_id']) ? $_POST['district_id'] : '',
                    'address' => isset($_POST['address']) ? $_POST['address'] : '',
                    'note' => isset($_POST['note']) ? $_POST['note'] : '',
                    'user_class' => $_POST['user_class'],
                    'vip_id' => $_POST['vip_id'],
                    'status' => ($_POST['vip_id'] == 0) ? 2 : 0,
                    'agency_id' => $this->user->id,
                    'vip_info' => json_encode($vip_info),
                ];
                if(isset($_POST['password'])){
                    $data['password'] = $_POST['password'];
                }
                if($action == 'set') {
                    $res = $model->setUser($_POST['id'], $data);
                }else{
                    $res = $model->addUser($data);
                }
                echo Common_jsonRes(1);
                break;
            case 'del':
                $this->auth([5]);
                $res = $model->delUser($_POST['id']);
                echo Common_jsonRes($res?1:0);
                break;
        }
    }

    //专业律师管理
    public function professions($action){
        $model = new Professional_lawyers();
        switch ($action){
            case 'get':
                $this->auth([6]);
                $res = $model->getElement();
                echo Common_jsonRes(1,$res); 
                break;
            case 'set':case 'add':
                $this->auth([6]);
                $data = [
                    'avatar' => $_POST['avatar'],
                    'name' => $_POST['name'],
                    'sub_name' => $_POST['sub_name'] ?? '',
                    'keywords' => $_POST['keywords'] ?? '',
                    'abstract' => $_POST['abstract'] ?? '',
                    'show_index' => $_POST['show_index'],
                    'license_no' => $_POST['license_no'] ?? '',
                ];
                if($action == 'set') {
                    $res = $model->setElement($_POST['id'], $data);
                }else{
                    $res = $model->addElement($data);
                }
                echo Common_jsonRes($res?1:0);
                break;
            case 'del':
                $this->auth([6]);
                $res = $model->delElement($_POST['id']);
                echo Common_jsonRes($res?1:0);
                break;
            case 'upload':
                $res = Common_uploadFile('professional_lawyers');
                echo Common_jsonRes($res?1:0,$res);
                break;
        }
    }

    //首页banner管理
    public function banners($action){
        $model = new Banners();
        switch ($action){
            case 'get':
                $this->auth([6]);
                $res = $model->getElement();
                echo Common_jsonRes(1,$res);
                break;
            case 'set':case 'add':
                $this->auth([6]);
                $data = [
                    'picture' => $_POST['picture'],
                    'show_index' => $_POST['show_index'],
                    'is_show' => $_POST['is_show'],
                ];
                if($action == 'set') {
                    $res = $model->setElement($_POST['id'], $data);
                }else{
                    $res = $model->addElement($data);
                }
                echo Common_jsonRes($res?1:0);
                break;
            case 'del':
                $this->auth([6]);
                $res = $model->delElement($_POST['id']);
                echo Common_jsonRes($res?1:0);
                break;
            case 'upload':
                $res = Common_uploadFile('banners');
                echo Common_jsonRes($res?1:0,$res);
                break;
        }
    }

    //文章列表页banner管理
    public function article_banners($action){
        $model = new Article_banners();
        switch ($action){
            case 'get':
                $this->auth([6]);
                $res = $model->getElement();
                echo Common_jsonRes(1,$res);
                break;
            case 'set':case 'add':
                $this->auth([6]);
                $data = [
                    'picture' => $_POST['picture'],
                    'show_index' => $_POST['show_index'],
                    'is_show' => $_POST['is_show'],
                ];
                if($action == 'set') {
                    $res = $model->setElement($_POST['id'], $data);
                }else{
                    $res = $model->addElement($data);
                }
                echo Common_jsonRes($res?1:0);
                break;
            case 'setArticle':
                $this->auth([6]);
                $data = [
                    'article_id' => $_POST['article_id'],
                ];
                $res = $model->setElement($_POST['id'], $data);
                echo Common_jsonRes($res?1:0);
                break;
            case 'del':
                $this->auth([6]);
                $res = $model->delElement($_POST['id']);
                echo Common_jsonRes($res?1:0);
                break;
            case 'upload':
                $res = Common_uploadFile('article_banners');
                echo Common_jsonRes($res?1:0,$res);
                break;
        }
    }

    //企业服务
    public function services($action){
        $this->auth([6]);
        $services_model = new Services();
        switch ($action){
            case 'get':
                $filter = [];
                if(isset($_POST['status'])){
                    $filter['status'] = $_POST['status'];
                }
                if(isset($_POST['type'])){
                    $filter['type'] = $_POST['type'];
                }
                $res = $services_model->getElement($filter);
                echo Common_jsonRes(1,$res);
                break;
            case 'finish':
                $res = $services_model->setElement([
                    'id' => $_POST['id']
                ],[
                    'status' => 2
                ]);
                echo Common_jsonRes(1,$res);
                break;
            case 'handle':
                $res = $services_model->setElement([
                    'id' => $_POST['id']
                ],[
                    'status' => 1
                ]);
                echo Common_jsonRes(1,$res);
                break;
        }
    }

    //系统基础信息管理
    public function system_infos($action){
        $this->auth([6]);
        $model = new System_infos();
        switch ($action){
            case 'get':
                $res = $model->getElement();
                echo Common_jsonRes(1,$res);
                break;
            case 'set':
                //如果是上传热更新包的修改
                if(isset($_POST['upload_file'])){
                    $model->setElement([
                        'id' => 'app_path_widget',
                        'value' => $_POST['upload_file'],
                    ]);
                    unset($_POST['upload_file']);
                }
                $res = $model->setElement($_POST);
                echo Common_jsonRes(1);
                break;
            case 'getRegisterAgreement':
                $res = $model->getElement('register_agreement');
                echo Common_jsonRes(1,$res);
                break;
            case 'setRegisterAgreement':
                $res = $model->setElement(['id'=>'register_agreement','value'=>$_POST['data']]);
                echo Common_jsonRes(1,$res);
                break;
            case 'getLawyerManage':
                $res = $model->getElement('lawyer_manage');
                echo Common_jsonRes(1,$res);
                break;
            case 'setLawyerManage':
                $res = $model->setElement(['id'=>'lawyer_manage','value'=>$_POST['data']]);
                echo Common_jsonRes(1,$res);
                break;
        }
    }

    //案件委托管理
    public function ask_entrust($action){
        $model = new Ask_entrust();
        switch ($action){
            case 'get':
                $this->auth([6]);
                $filter = [];
                if(isset($_POST['content'])){
                    $filter['content'] = $_POST['content'];
                }
                if(isset($_POST['status'])){
                    $filter['status'] = $_POST['status'];
                }
                if(isset($_POST['type'])){
                    $filter['type_id'] = $_POST['type'];
                }
                if(isset($_POST['province_id'])){
                    $filter['province_id'] = $_POST['province_id'];
                }
                if(isset($_POST['city_id'])){
                    $filter['city_id'] = $_POST['city_id'];
                }
                if(isset($_POST['handler_id'])){
                    $filter['handler_id'] = $_POST['handler_id'];
                }
                $data = $model->getList($filter);
                echo Common_jsonRes(1,$data);
                break;
            case 'del':
                $this->auth([6]);
                $id = $_POST['id'];
                $res = $model->delElement($id);
                echo Common_jsonRes($res?1:0);
                break;
            case 'add':case 'set':
                $this->auth([6]);
                $data = [
                    'creator_id' => 0,
                    'name' => $_POST['name'],
                    'phone' => $_POST['phone'] ?? '',
                    'province_id' => $_POST['province_id'],
                    'city_id' => $_POST['city_id'],
                    'district_id' => $_POST['district_id'] ?? '',
                    'type_id' => $_POST['type_id'],
                    'content' => $_POST['content'],
                    'offer_min' => $_POST['offer_min'] ?? '',
                    'offer_max' => $_POST['offer_max'] ?? '',
                    'status' => 1,
                    'created_by_admin' => 1,
                    'contract_file' => $_POST['contract_file'],
                ];
                if($action == 'set') {
                    $res = $model->setElement($_POST['id'], $data);
                }else{
                    $res = $model->addElement($data);
                }
                echo Common_jsonRes($res?1:0);
                break;
            case 'setHandler':
                $this->auth([6]);
                $id = $_POST['id'];
                $data = [
                    'status' => 2,
                    'handler_id' => $_POST['handler_id'],
                ];
                $res = $model->setElement($id,$data);
                echo Common_jsonRes($res?1:0);
                break;
            case 'upload_contract':
                $res = Common_uploadFile('entrust_contracts');
                echo Common_jsonRes($res?1:0,$res);
                break;
        }
    }
    public function ask_entrust_types($action){
        $this->auth([6]);
        $model = new Ask_entrust_types();
        switch ($action){
            case 'get':
                $data = $model->getList();
                echo Common_jsonRes(1,$data);
                break;
            case 'set':
                $res = $model->setElement($_POST);
                echo Common_jsonRes($res?1:0);
                break;
            case 'add':
                $res = $model->addElement($_POST);
                echo Common_jsonRes($res?1:0);
                break;
            case 'del':
                $res = $model->delElement($_POST['id']);
                echo Common_jsonRes($res);
                break;
        }
    }

    //法律咨询数据管理
    public function ask_help($action){
        $this->auth([6]);
        $model = new Ask_help();
        switch ($action){
            case 'getList':
                if($_POST['type'] == 'w'){
                    $res = $model->getList(['status'=>[1,2]]);
                }else{
                    $res = $model->getList(['status'=>[3]]);
                }
                echo Common_jsonRes(1,$res);
                break;
            case 'reply':
                $res = $model->setElement($_POST['id'],[
                    'reply'=>$_POST['reply'],
                    'reply_time'=>date('Y-m-d H:i:s'),
                    'status'=>2
                ]);
                echo Common_jsonRes($res?1:0);
                break;
        }
    }

    public function ask_help2($action){
        $this->auth();
        $model = new Ask_help2();
        $talk_model = new Ask_help_talks();
        switch ($action){
            case 'getList':
                if($_POST['type'] == 'w'){
                    switch ($_POST['tab']){
                        case 'a':
                            $res = $model->getList(['status'=>[1],'servant_id'=>$this->user->id]);
                            break;
                        case 'b':
                            $res = $model->getList(['status'=>[2],'servant_id'=>$this->user->id]);
                            break;
                        case 'c':
                            $res = $model->getList(['status'=>[5],'servant_id'=>$this->user->id]);
                            break;
                        case 'd':
                            $res = $model->getList(['status'=>[6],'servant_id'=>$this->user->id]);
                            break;
                    }
                }else if($_POST['type'] == 'f'){
                    $res = $model->getList(['status'=>[3],'servant_id'=>$this->user->id]);
                }else{
                    $res = $model->getList(['status'=>[1,2,3,4,5,6]],true);
                }
                foreach ($res as &$item){
                    $item['talks'] = $talk_model->getList(['help_id'=>$item['id']]);
                }
                echo Common_jsonRes(1,$res);
                break;
            case 'getAmounts':
                $res = $model->getAmounts($this->user->id);
                echo Common_jsonRes(1,$res);
                break;
            case 'reply':
                $res = $talk_model->setElement($_POST['talk_id'],[
                    'reply_content'=>$_POST['reply'],
                    'reply_time'=>date('Y-m-d H:i:s'),
                ]);
                $model->setElement($_POST['help_id'],[
                    'status'=>$_POST['status'],
                ]);
                $info = $model->getElement($_POST['help_id']);
                $user_model = new Users();
                $user = $user_model->getSimpleUser($info['creator_id']);
                $this->push('push_single',
                    [
                        "title"=>"您的法律咨询有新的回复啦",
                        "url"=>"/pages/mine/my_ask_help",
                        "clientid"=>$user['clientid']
                    ]
                );
                echo Common_jsonRes($res?1:0);
                break;
            case 'finish':
                $res = $model->setElement($_POST['id'],[
                    'status'=>3,
                    'finish_type'=>1,
                ]);
                echo Common_jsonRes($res?1:0);
                break;
            case 'changeServant':
                if(isset($_POST['id_list'])) {
                    $id_list = json_decode($_POST['id_list']);
                }else{
                    $id_list = $_POST['id'];
                }
                $res = $model->setElement($id_list,[
                    'servant_id' => $_POST['servant_id']
                ]);
                echo Common_jsonRes($res?1:0);
                break;
        }
    }

    //诉讼垫资
    public function ask_advance($action){
        $this->auth([6]);
        $model = new Ask_advance();
        switch ($action){
            case 'getList':
                $res = $model->getList();
                echo Common_jsonRes(1,$res);
                break;
            case 'finish':
                $res = $model->setElement($_POST['id'],['status'=>2]);
                echo Common_jsonRes($res?1:0);
                break;
            case 'cancel_finish':
                $res = $model->setElement($_POST['id'],['status'=>1]);
                echo Common_jsonRes($res?1:0);
                break;
        }
    }

    //合同定制
    public function contract_custom($action)
    {
        $this->auth([6]);
        $model = new Contract_custom();
        switch ($action) {
            case 'getList':
                $res = $model->getList();
                echo Common_jsonRes(1, $res);
                break;
            case 'set':
                $data = [];
                if(isset($_POST['email'])){
                    $data['email'] = $_POST['email'];
                }
                $res = $model->setElement($_POST['id'],$data);
                echo Common_jsonRes($res ? 1 : 0);
                break;
            case 'finish':
                $res = $model->setElement($_POST['id'], ['status' => 2]);
                echo Common_jsonRes($res ? 1 : 0);
                break;
            case 'cancel_finish':
                $res = $model->setElement($_POST['id'], ['status' => 1]);
                echo Common_jsonRes($res ? 1 : 0);
                break;
        }
    }

    public function test(){
        $user_model = new Users();
        $data['users'] = $user_model->getReports('2018-10-10 00:00:00',date('Y-m-d H:i:s'));
        dump($data['users']);
    }

    //crontab 定时更新
    public function caculateReports(){
//        {
//            users[3] - 数组, 表示已注册用户数 个人 律师  企业
//            ask_entrusts - 案件委托数
//            ask_help - 法律咨询数
//            orders - 已付款订单金额统计
//        }
        $report_model = new Reports();
        $old_data = $report_model->getElement();

        $old_report_time = $old_data['report_time'];
        $new_report_time = date('Y-m-d H:i:s');
        $user_model = new Users();
        $data['users'] = $user_model->getReports('2018-10-10 00:00:00',date('Y-m-d H:i:s'));
        $order_model = new Orders();
        $data['orders'] = $order_model->getReports($old_report_time,$new_report_time);
        $ask_help_model = new Ask_help2();
        $data['ask_helps'] = $ask_help_model->getReports($old_report_time,$new_report_time);
        $ask_entrust_model = new Ask_entrust();
        $data['ask_entrusts'] = $ask_entrust_model->getReports($old_report_time,$new_report_time);

        $old_data = json_decode($old_data['json_content'],true);
        $new_data = [
            'users' => [
                $data['users'][0],
                $data['users'][1],
                $data['users'][2],
            ],
            'orders' => $old_data['orders'] + $data['orders'],
            'ask_helps' => $old_data['ask_helps'] + $data['ask_helps'],
            'ask_entrusts' => $old_data['ask_entrusts'] + $data['ask_entrusts'],
        ];
        $save_db = [
            'json_content' => json_encode($new_data),
            'report_time' => $new_report_time,
        ];
        $report_model->setElement($save_db);
        echo 'success';
    }

    //首页统计数据
    public function getIndexData(){
        $report_model = new Reports();
        $data = $report_model->getElement();
        $data = json_decode($data['json_content'],true);
        return Common_jsonRes(1,$data);
    }

    //app热更新包上传
    public function app_upload(){
        $res = Common_uploadFile('app_updates');
        return Common_jsonRes($res?1:0, $res);
    }

    //推送相关
    //$message json: { title: 推送显示标题 , url: 推送点击后打开的链接 }
    private function push($action,$data){
        require_once(dirname(__FILE__) . '/../sdk/getui/IGt.Push.php');
        require_once(dirname(__FILE__) . '/../sdk/getui/igetui/template/IGt.TransmissionTemplate.php');
        require_once(dirname(__FILE__) . '/../sdk/getui/igetui/IGt.AppMessage.php');

        $HOST = 'http://sdk.open.api.igexin.com/apiex.htm';
        $APPKEY = 'CQyPcJNUfZ7r07vDRL7lw3';
        $APPID = 'tRSJt40K9JARvApEoOY7W3';
        $MASTERSECRET = 'NdoW9VWw6D8wKuAYmb1UQ1';

        $template =  new \IGtTransmissionTemplate();
        $template->set_appId($APPID);                   //应用appid
        $template->set_appkey($APPKEY);                 //应用appkey
        $template->set_transmissionType(2);             //透传消息类型
        $template->set_transmissionContent(json_encode($data,320));     //透传内容

        $apn = new \IGtAPNPayload();
        $alertmsg=new \SimpleAlertMsg();
        $alertmsg->alertMsg = $data['title'];
        $apn->alertMsg=$alertmsg;
        $apn->badge = 1;
        $apn->actionLocKey = "打开";
        $apn->add_customMsg("url",$data['url']);

        $template->set_apnInfo($apn);

        $message = new \IGtAppMessage();
        $message->set_isOffline(true);
        $message->set_offlineExpireTime(10 * 60 * 1000);//离线时间单位为毫秒，例，两个小时离线为3600*1000*2
        $message->set_data($template);

        $igt = new \IGeTui($HOST,$APPKEY,$MASTERSECRET);

        switch ($action){
            case 'push_all':
                $appIdList=array($APPID);
                $message->set_appIdList($appIdList);
                $igt->pushMessageToApp($message);
//                var_dump($rep);
                break;
            case 'push_single':
                $target = new \IGtTarget();
                $target->set_appId($APPID);
                $target->set_clientId($data['clientid']);
//                $target->set_clientId('4f48ce957d70a057bc85021721a29a14');
//                $target->set_clientId('bee85f5c541a00392def4db9674fe03a');
                $rep = $igt->pushMessageToSingle($message, $target);
//                var_dump($rep);
                break;
        }
    }
}