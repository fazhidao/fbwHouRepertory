<?php
namespace app\api\Model;

use think\Model;

//合同
class Contracts extends Model
{

    //[can_null, can_add_set]
//    private $columns = [
//        'type_id' => [0,1],
//        'industry_id' => [0,1],
//        'keywords' => [0,1],
//        'file_path' => [0,1],
//        'picture' => [0,1],
//        'price' => [0,1],
//        'downloads' => [1,1],
//    ];
    public function addElement($data)
    {
        return $this->save($data);
    }
    public function setElement($id,$data)
    {
        return $this->save($data,['id'=>$id]);
    }
    public function delElement($id)
    {
        return $this->where('id',$id)->delete();
    }

    public function getElement($filter=[])
    {
        $this->field(['contracts.id','type_id','industry_id','keywords','file_path','picture',
            'price','downloads','i.title industry_name','t.title type_name']);
        $this->join('contracts_industries i','industry_id = i.id');
        $this->join('contracts_types t','type_id = t.id');
        $this->order('create_time desc');
        if(isset($filter['id'])){
            return $this->where('contracts.id',$filter['id'])->find();
        }else{
            if ($filter != []) {
                foreach ($filter as $key => $value) {
                    if($key == 'keywords'){
                        $this->where($key,'like', "%$value%");
                    }else {
                        $this->where($key, $value);
                    }
                }
            }
            $page_size = isset($filter['page_size'])?$filter['page_size']:50;
            return $this->paginate($page_size);
        }
    }

    public function getInfoForOrder($id){
        return $this->field('id,price')->where('id',$id)->find();
    }

    //app 存在子查询情况
    public function appGetList($filter){
        $this->field(['contracts.id','picture','price','downloads','keywords','i.title industry_name','t.title type_name']);
        $this->join('contracts_industries i','industry_id = i.id');
        $this->join('contracts_types t','type_id = t.id');
        $this->order('create_time desc');
        if(isset($filter['keywords'])){
            if(isset($filter['type_id']) || isset($filter['industry_id'])){
                if(isset($filter['type_id'])){
                    $this->where('type_id','in',$filter['type_id']);
                    if(isset($filter['industry_id'])){
                        $this->whereOr('industry_id','in',$filter['industry_id']);
                    }
                }elseif (isset($filter['industry_id'])){
                    $this->where('industry_id','in',$filter['industry_id']);
                }
                $subQuery = $this->buildSql();
                $this->table($subQuery.' a')->where('a.keywords', 'like', "%{$filter['keywords']}%");
            }else {
                $this->where('keywords', 'like', "%{$filter['keywords']}%");
            }
            $page_size = isset($_POST['page_size'])?$_POST['page_size']:50;
            return $this->paginate($page_size);
        }else{
            if(isset($filter['type_id'])){
                $this->where('type_id','in',$filter['type_id']);
                if(isset($filter['industry_id'])){
                    $this->whereOr('industry_id','in',$filter['industry_id']);
                }
            }elseif (isset($filter['industry_id'])){
                $this->where('industry_id','in',$filter['industry_id']);
            }
            $page_size = isset($_POST['page_size'])?$_POST['page_size']:50;
            return $this->paginate($page_size);
        }
    }

    //app不获取file_path,vip或付费后获取
    public function appGetDetail($id){
        $this->field(['contracts.id','picture','price','downloads','keywords','i.title industry_name','t.title type_name','create_time']);
        $this->join('contracts_industries i','industry_id = i.id');
        $this->join('contracts_types t','type_id = t.id');
        return $this->where('contracts.id',$id)->find();
    }

    public function appGetFilepath($id){
        return $this->field('file_path')->where('id',$id)->find();
    }

    public function addDownloads($id){
        return $this->where('id',$id)->setInc('downloads');
    }

}