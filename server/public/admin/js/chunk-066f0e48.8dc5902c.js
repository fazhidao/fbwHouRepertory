(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-066f0e48"],{"02f4":function(t,e,i){var a=i("4588"),s=i("be13");t.exports=function(t){return function(e,i){var n,l,r=String(s(e)),d=a(i),o=r.length;return d<0||d>=o?t?"":void 0:(n=r.charCodeAt(d),n<55296||n>56319||d+1===o||(l=r.charCodeAt(d+1))<56320||l>57343?t?r.charAt(d):n:t?r.slice(d,d+2):l-56320+(n-55296<<10)+65536)}}},"0390":function(t,e,i){"use strict";var a=i("02f4")(!0);t.exports=function(t,e,i){return e+(i?a(t,e).length:1)}},4917:function(t,e,i){"use strict";var a=i("cb7c"),s=i("9def"),n=i("0390"),l=i("5f1b");i("214f")("match",1,function(t,e,i,r){return[function(i){var a=t(this),s=void 0==i?void 0:i[e];return void 0!==s?s.call(i,a):new RegExp(i)[e](String(a))},function(t){var e=r(i,t,this);if(e.done)return e.value;var d=a(t),o=String(this);if(!d.global)return l(d,o);var c=d.unicode;d.lastIndex=0;var _,u=[],p=0;while(null!==(_=l(d,o))){var f=String(_[0]);u[p]=f,""===f&&(d.lastIndex=n(o,s(d.lastIndex),c)),p++}return 0===p?null:u}]})},cace:function(t,e,i){"use strict";i.r(e);var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",[i("div",{staticClass:"search_bar"},[i("el-input",{staticClass:"main_input",attrs:{placeholder:"输入标题内容检索",clearable:""},nativeOn:{keyup:function(e){if(!("button"in e)&&t._k(e.keyCode,"enter",13,e.key,"Enter"))return null;t.getTableData()}},model:{value:t.main_input.title,callback:function(e){t.$set(t.main_input,"title",e)},expression:"main_input.title"}}),i("el-button",{staticStyle:{"margin-right":"10px"},attrs:{type:"primary"},on:{click:function(e){t.getTableData()}}},[t._v("搜 索")]),i("el-button-group",{staticStyle:{"margin-right":"10px"}},[i("el-button",{on:{click:function(e){t.showAdd()}}},[t._v("新增案件委托")])],1),i("el-breadcrumb",{attrs:{"separator-class":"el-icon-arrow-right"}},[i("el-breadcrumb-item",{attrs:{to:{path:"/index"}}},[t._v("首页")]),i("el-breadcrumb-item",[t._v("用户数据管理")]),i("el-breadcrumb-item",[t._v("案件委托数据")])],1)],1),i("el-table",{directives:[{name:"loading",rawName:"v-loading",value:t.is_loading,expression:"is_loading"}],staticStyle:{width:"100%"},attrs:{height:t.table_height,data:t.table_data,border:""}},[i("el-table-column",{attrs:{type:"index",width:"45",align:"center"}}),i("el-table-column",{attrs:{label:"状态",width:"100"},scopedSlots:t._u([{key:"default",fn:function(e){return[0==e.row.status?i("el-tag",{attrs:{type:"info"}},[t._v("待付款")]):t._e(),1==e.row.status?i("el-tag",{attrs:{type:"warning"}},[t._v("待处理")]):t._e(),2==e.row.status?i("el-tag",[t._v("处理中")]):t._e(),3==e.row.status?i("el-tag",{attrs:{type:"success"}},[t._v("处理完成")]):t._e(),1==e.row.is_deleted?i("el-tag",{attrs:{type:"danger"}},[t._v("用户删除")]):t._e()]}}])}),i("el-table-column",{attrs:{label:"提交者",width:"140"},scopedSlots:t._u([{key:"default",fn:function(e){return[i("el-button",{attrs:{type:"text"},on:{click:function(i){t.showUserInfo(e.row.creator_id)}}},[t._v("查看详情")])]}}])}),i("el-table-column",{attrs:{label:"处理人",width:"140"},scopedSlots:t._u([{key:"default",fn:function(e){return[null!=e.row.handler_id?i("el-button",{attrs:{type:"text"},on:{click:function(i){t.showUserInfo(e.row.handler_id)}}},[t._v("查看详情")]):t._e(),null!=e.row.handler_id?i("el-button",{attrs:{type:"text"},on:{click:function(i){t.showChoseUser(e.row.id)}}},[t._v("修改")]):t._e(),null==e.row.handler_id?i("el-button",{attrs:{type:"text"},on:{click:function(i){t.showChoseUser(e.row.id)}}},[t._v("指定处理人")]):t._e()]}}])}),i("el-table-column",{attrs:{prop:"type_name",label:"委托类型",width:"90"}}),i("el-table-column",{attrs:{prop:"content",label:"委托内容"}}),i("el-table-column",{attrs:{label:"委托地点",width:"140"},scopedSlots:t._u([{key:"default",fn:function(e){return[t._v("\r\n                "+t._s(e.row.province)+" "+t._s(e.row.city)+"\r\n            ")]}}])}),i("el-table-column",{attrs:{label:"委托报价",width:"140"},scopedSlots:t._u([{key:"default",fn:function(e){return[t._v("\r\n                ￥"+t._s(e.row.offer_min)+" ~ ￥"+t._s(e.row.offer_max)+"\r\n            ")]}}])}),i("el-table-column",{attrs:{label:"合同文件"},scopedSlots:t._u([{key:"default",fn:function(e){return[e.row.contract_file&&"undefined"!=e.row.contract_file?i("a",{attrs:{href:t.ImgUrl+e.row.contract_file,target:"_Blank"}},[t._v("点击下载原文件")]):t._e()]}}])}),i("el-table-column",{attrs:{prop:"create_time",label:"发布时间"}}),i("el-table-column",{attrs:{label:"操作",width:"160"},scopedSlots:t._u([{key:"default",fn:function(e){return[i("el-button",{attrs:{type:"text"},on:{click:function(i){t.showEdit(e.row)}}},[t._v("编辑")]),i("el-button",{attrs:{type:"text"},on:{click:function(i){t.submitDel(e.row)}}},[t._v("删除")])]}}])})],1),i("el-pagination",{staticStyle:{"text-align":"center"},attrs:{"current-page":t.page.current_page,"page-sizes":[50],"page-size":t.page.size,layout:"total,sizes, prev, pager, next, jumper",total:t.page.total},on:{"current-change":t.handleCurrentChange}}),i("el-dialog",{attrs:{title:"新增",visible:t.is_show_add,width:"700px"},on:{"update:visible":function(e){t.is_show_add=e}}},[i("el-form",{attrs:{"label-width":"80px"}},[i("el-form-item",{attrs:{label:"委托类型"}},[i("el-select",{attrs:{filterable:"",placeholder:"选择类型"},model:{value:t.add_data.type_id,callback:function(e){t.$set(t.add_data,"type_id",e)},expression:"add_data.type_id"}},t._l(t.type_list,function(t){return i("el-option",{key:t.id,attrs:{label:t.title,value:t.id}})}),1),i("el-button",{attrs:{type:"text"},on:{click:function(e){t.goView()}}},[t._v("前往管理类别")])],1),i("el-form-item",{attrs:{label:"委托地点"}},[i("el-select",{staticStyle:{width:"120px","margin-right":"6px"},attrs:{filterable:"",placeholder:"省"},on:{change:t.changeProvince},model:{value:t.add_data.province_id,callback:function(e){t.$set(t.add_data,"province_id",e)},expression:"add_data.province_id"}},t._l(t.province_list,function(t){return i("el-option",{key:t.id,attrs:{label:t.name,value:t.id}})}),1),i("el-select",{staticStyle:{width:"120px","margin-right":"6px"},attrs:{filterable:"",placeholder:"市"},on:{change:t.changeCity},model:{value:t.add_data.city_id,callback:function(e){t.$set(t.add_data,"city_id",e)},expression:"add_data.city_id"}},t._l(t.city_list,function(t){return i("el-option",{key:t.id,attrs:{label:t.name,value:t.id}})}),1),i("el-select",{staticStyle:{width:"120px"},attrs:{filterable:"",placeholder:"区"},model:{value:t.add_data.district_id,callback:function(e){t.$set(t.add_data,"district_id",e)},expression:"add_data.district_id"}},t._l(t.district_list,function(t){return i("el-option",{key:t.id,attrs:{label:t.name,value:t.id}})}),1)],1),i("el-form-item",{attrs:{label:"委托内容"}},[i("el-input",{attrs:{type:"textarea",rows:3},model:{value:t.add_data.content,callback:function(e){t.$set(t.add_data,"content",e)},expression:"add_data.content"}})],1),i("el-form-item",{attrs:{label:"委托报价"}},[i("el-input",{staticStyle:{width:"120px"},attrs:{placeholder:"最低价"},model:{value:t.add_data.offer_min,callback:function(e){t.$set(t.add_data,"offer_min",e)},expression:"add_data.offer_min"}}),t._v("\r\n                ~\r\n                "),i("el-input",{staticStyle:{width:"120px"},attrs:{placeholder:"最高价"},model:{value:t.add_data.offer_max,callback:function(e){t.$set(t.add_data,"offer_max",e)},expression:"add_data.offer_max"}})],1),i("el-form-item",{attrs:{label:"合同文件"}},[i("el-upload",{attrs:{action:t.ServerUrl+"ask_entrust/upload_contract","file-list":t.addfileList,"on-success":t.upFileSuccess}},[i("el-button",{attrs:{size:"small",type:"primary"}},[t._v("点击上传")]),i("div",{staticClass:"el-upload__tip",attrs:{slot:"tip"},slot:"tip"},[t._v("文件大小不超过8M")])],1)],1)],1),i("span",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[i("el-button",{on:{click:function(e){t.is_show_add=!1}}},[t._v("取 消")]),i("el-button",{attrs:{type:"primary"},on:{click:function(e){t.submitAdd()}}},[t._v("确 定")])],1)],1),i("el-dialog",{attrs:{title:"编辑",visible:t.is_show_set,width:"700px"},on:{"update:visible":function(e){t.is_show_set=e}}},[i("el-form",{attrs:{"label-width":"80px"}},[i("el-form-item",{attrs:{label:"委托类型"}},[i("el-select",{attrs:{filterable:"",placeholder:"选择类型"},model:{value:t.edit_data.type_id,callback:function(e){t.$set(t.edit_data,"type_id",e)},expression:"edit_data.type_id"}},t._l(t.type_list,function(t){return i("el-option",{key:t.id,attrs:{label:t.title,value:t.id}})}),1),i("el-button",{attrs:{type:"text"},on:{click:function(e){t.goView()}}},[t._v("前往管理类别")])],1),i("el-form-item",{attrs:{label:"委托地点"}},[i("el-select",{staticStyle:{width:"120px","margin-right":"6px"},attrs:{filterable:"",placeholder:"省"},on:{change:t.changeProvince},model:{value:t.edit_data.province_id,callback:function(e){t.$set(t.edit_data,"province_id",e)},expression:"edit_data.province_id"}},t._l(t.province_list,function(t){return i("el-option",{key:t.id,attrs:{label:t.name,value:t.id}})}),1),i("el-select",{staticStyle:{width:"120px","margin-right":"6px"},attrs:{filterable:"",placeholder:"市"},on:{change:t.changeCity},model:{value:t.edit_data.city_id,callback:function(e){t.$set(t.edit_data,"city_id",e)},expression:"edit_data.city_id"}},t._l(t.city_list,function(t){return i("el-option",{key:t.id,attrs:{label:t.name,value:t.id}})}),1),i("el-select",{staticStyle:{width:"120px"},attrs:{filterable:"",placeholder:"区"},model:{value:t.edit_data.district_id,callback:function(e){t.$set(t.edit_data,"district_id",e)},expression:"edit_data.district_id"}},t._l(t.district_list,function(t){return i("el-option",{key:t.id,attrs:{label:t.name,value:t.id}})}),1)],1),i("el-form-item",{attrs:{label:"委托内容"}},[i("el-input",{attrs:{type:"textarea",rows:3},model:{value:t.edit_data.content,callback:function(e){t.$set(t.edit_data,"content",e)},expression:"edit_data.content"}})],1),i("el-form-item",{attrs:{label:"委托报价"}},[i("el-input",{staticStyle:{width:"120px"},attrs:{placeholder:"最低价"},model:{value:t.edit_data.offer_min,callback:function(e){t.$set(t.edit_data,"offer_min",e)},expression:"edit_data.offer_min"}}),t._v("\r\n                ~\r\n                "),i("el-input",{staticStyle:{width:"120px"},attrs:{placeholder:"最高价"},model:{value:t.edit_data.offer_max,callback:function(e){t.$set(t.edit_data,"offer_max",e)},expression:"edit_data.offer_max"}})],1),i("el-form-item",{attrs:{label:"合同文件"}},[i("el-upload",{attrs:{action:t.ServerUrl+"ask_entrust/upload_contract","file-list":t.editfileList,"on-success":t.upFileSuccessSet}},[i("el-button",{attrs:{size:"small",type:"primary"}},[t._v("点击上传")]),i("div",{staticClass:"el-upload__tip",attrs:{slot:"tip"},slot:"tip"},[t._v("文件大小不超过8M")])],1)],1)],1),i("span",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[i("el-button",{on:{click:function(e){t.is_show_add=!1}}},[t._v("取 消")]),i("el-button",{attrs:{type:"primary"},on:{click:function(e){t.submitEdit()}}},[t._v("确 定")])],1)],1),i("el-dialog",{attrs:{title:"搜索律师",visible:t.is_show_search_user,width:"700px"},on:{"update:visible":function(e){t.is_show_search_user=e}}},[i("div",{staticClass:"search_bar"},[i("el-input",{staticClass:"main_input",attrs:{placeholder:"输入手机或名称检索",clearable:""},nativeOn:{keyup:function(e){if(!("button"in e)&&t._k(e.keyCode,"enter",13,e.key,"Enter"))return null;t.searchUser()}},model:{value:t.search_user_input,callback:function(e){t.search_user_input=e},expression:"search_user_input"}}),i("el-button",{staticStyle:{"margin-right":"10px"},attrs:{type:"primary"},on:{click:function(e){t.searchUser()}}},[t._v("搜 索")])],1),i("el-table",{staticStyle:{width:"100%"},attrs:{data:t.user_list}},[i("el-table-column",{attrs:{type:"index",width:"45",align:"center"}}),i("el-table-column",{attrs:{prop:"name",label:"用户名"}}),i("el-table-column",{attrs:{prop:"phone",label:"手机号"}}),i("el-table-column",{attrs:{label:"操作",width:"160"},scopedSlots:t._u([{key:"default",fn:function(e){return[i("el-button",{attrs:{type:"text"},on:{click:function(i){t.submitChoseUser(e.row.id)}}},[t._v("指定此律师")])]}}])})],1)],1),i("el-dialog",{attrs:{title:"用户详情",visible:t.is_show_user_info,width:"700px"},on:{"update:visible":function(e){t.is_show_user_info=e}}},[i("div",[t._v("用户名："+t._s(this.user_info.name))]),i("div",[t._v("手机号："+t._s(this.user_info.phone))])])],1)},s=[],n=(i("4917"),i("cadf"),i("551c"),i("097d"),{data:function(){return{main_input:{title:""},page:{current_page:1,size:50},is_show_add:!1,is_show_set:!1,is_show_search_user:!1,is_show_user_info:!1,is_loading:!1,table_height:500,status_list:["待付款","待处理","处理中","处理完成"],province_list:[],city_list:[],district_list:[],type_list:[],table_data:[],add_data:{type_id:"",province_id:"",city_id:"",district_id:""},edit_data:{type_id:"",province_id:"",city_id:"",district_id:""},user_list:[],search_user_input:"",user_info:{},addfileList:[],editfileList:[]}},created:function(){this.table_height=window.innerHeight-150,this.getTypeList(),this.getTableData(),this.getAreaList(1)},methods:{getTypeList:function(){var t=this;this.requestApi({url:"ask_entrust_types/get",success:function(e){t.type_list=e}})},getTableData:function(){var t=this;this.is_loading=!0;var e={page_size:this.page.size,page:this.page.current_page};this.requestApi({url:"ask_entrust/get",data:e,success:function(e){t.table_data=e.data,t.page.total=parseInt(e.total),t.is_loading=!1}})},showAdd:function(){this.is_show_add=!0},upFileSuccess:function(t){1==t.status?this.add_data.contract_file=t.data:this.$message.error("服务器错误")},upFileSuccessSet:function(t){1==t.status?this.edit_data.contract_file=t.data:this.$message.error("服务器错误")},showEdit:function(t){this.getAreaList(2,t.province_id),this.getAreaList(3,t.city_id),this.edit_data=JSON.parse(JSON.stringify(t)),this.is_show_set=!0},submitEdit:function(){var t=this,e={id:this.edit_data.id,province_id:this.edit_data.province_id,city_id:this.edit_data.city_id,district_id:this.edit_data.district_id||"",type_id:this.edit_data.type_id,content:this.edit_data.content,offer_min:this.edit_data.offer_min,offer_max:this.edit_data.offer_max,contract_file:this.edit_data.contract_file};this.requestApi({url:"ask_entrust/set",data:e,success:function(e){t.getTableData(),t.is_show_set=!1,t.editfileList=[],t.$message.success("编辑成功")}})},handleCurrentChange:function(t){this.page.current_page=t,this.getTableData()},submitDel:function(t){var e=this;this.$confirm("确定删除此 "+t.type_name+"?","再次确认",{confirmButtonText:"确定",cancelButtonText:"取消",type:"warning"}).then(function(){e.requestApi({url:"ask_entrust/del",data:{id:t.id},success:function(){e.$message.success("删除成功"),e.getTableData()}})}).catch(function(){})},getAreaList:function(t){var e=this,i=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null,a={area_level:t};i&&(a.parent_id=i),this.requestApi({url:"areainfos/get",data:a,success:function(i){1==t?e.province_list=i:2==t?e.city_list=i:e.district_list=i}})},changeProvince:function(t){this.add_data.city_id="",this.add_data.district_id="",this.getAreaList(2,t)},changeCity:function(t){this.add_data.district_id="",this.getAreaList(3,t)},submitAdd:function(){var t=this,e={province_id:this.add_data.province_id,city_id:this.add_data.city_id,district_id:this.add_data.district_id,type_id:this.add_data.type_id,content:this.add_data.content,offer_min:this.add_data.offer_min,offer_max:this.add_data.offer_max,contract_file:this.add_data.contract_file};this.requestApi({url:"ask_entrust/add",data:e,success:function(e){t.getTableData(),t.is_show_add=!1,t.addfileList=[],t.add_data={type_id:"",province_id:"",city_id:"",district_id:""},t.$message.success("新增成功")}})},showChoseUser:function(t){this.chosed_row_id=t,this.is_show_search_user=!0},searchUser:function(){var t=this,e={user_class:3};this.search_user_input.match(/\d+/)?e.phone=this.search_user_input:e.name=this.search_user_input,this.requestApi({url:"users/get",data:e,success:function(e){t.user_list=e.data}})},submitChoseUser:function(t){var e=this;this.requestApi({url:"ask_entrust/setHandler",data:{id:this.chosed_row_id,handler_id:t},success:function(t){e.getTableData(),e.is_show_search_user=!1,e.$message.success("操作成功")}})},showUserInfo:function(t){var e=this;this.requestApi({url:"users/getSingle",data:{id:t},success:function(t){e.user_info=t,e.is_show_user_info=!0}})},goView:function(){this.$router.push("/system_ask_entrust_types")}}}),l=n,r=i("2877"),d=Object(r["a"])(l,a,s,!1,null,null,null);d.options.__file="ask_entrust.vue";e["default"]=d.exports}}]);