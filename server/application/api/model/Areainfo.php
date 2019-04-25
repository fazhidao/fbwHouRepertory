<?php
namespace app\api\Model;

use think\Model;

//省市区
class Areainfo extends Model{

    //[can_null, can_add_set]
    static $columns = [
        'name' => [0,1],
        'arealevel' => [0,1],
        'parent_id' => [1,1],
    ];
    public function addElement($data)
    {
        $has_same_id = $this->where('id',$data['id'])->find();
        if($has_same_id){
            return [0,'已有相同id，请尝试换一个id'];
        }
        $save_data = [
            'id' => $data['id'],
            'name' => $data['name'],
            'arealevel' => $data['arealevel'],
            'parent_id' => $data['parent_id'] == 'null' ? null : $data['parent_id'],
        ];
        $res = $this->save($save_data);
        return $res?1:0;
    }
    public function setElement($data)
    {
        $save_data = [
            'name' => $data['name']
        ];
        return $this->save($save_data,['id'=>$data['id']]);
    }
    public function delElement($id)
    {
        return $this->destory($id);
    }

    public function getElement($filter)
    {
        if(empty($filter)){
            return $this->where('arealevel',1)->select();
        }
        return $this->where($filter)->select();
    }

    public function getListByName($name){
        $this->field(['areainfo.id','areainfo.name city_name','province.id province_id',
            'province.name province_name']);
        $this->where('areainfo.name','like',"%$name%");
        $this->where('areainfo.arealevel',2);
        $this->join('areainfo province','province.id = areainfo.parent_id','left');
        $areas = $this->select();
        return $areas;
    }
}