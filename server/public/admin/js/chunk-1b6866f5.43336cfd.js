(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-1b6866f5"],{1323:function(t,e,a){},"772b":function(t,e,a){"use strict";a.r(e);var s=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("div",{staticClass:"search_bar"},[a("el-input",{staticClass:"main_input",attrs:{placeholder:"输入标题内容检索",clearable:""},nativeOn:{keyup:function(e){if(!("button"in e)&&t._k(e.keyCode,"enter",13,e.key,"Enter"))return null;t.getTableData()}},model:{value:t.main_input.title,callback:function(e){t.$set(t.main_input,"title",e)},expression:"main_input.title"}}),a("el-button",{staticStyle:{"margin-right":"10px"},attrs:{type:"primary"},on:{click:function(e){t.getTableData()}}},[t._v("搜 索")]),a("el-breadcrumb",{attrs:{"separator-class":"el-icon-arrow-right"}},[a("el-breadcrumb-item",{attrs:{to:{path:"/index"}}},[t._v("首页")]),a("el-breadcrumb-item",[t._v("用户数据管理")]),a("el-breadcrumb-item",[t._v("法律咨询数据")]),a("el-breadcrumb-item",[t._v("已完成列表")])],1)],1),a("el-table",{directives:[{name:"loading",rawName:"v-loading",value:t.is_loading,expression:"is_loading"}],staticStyle:{width:"100%"},attrs:{height:t.table_height,data:t.table_data,border:""}},[a("el-table-column",{attrs:{type:"index",width:"45",align:"center"}}),a("el-table-column",{attrs:{label:"状态",width:"100"},scopedSlots:t._u([{key:"default",fn:function(e){return[0==e.row.status?a("el-tag",{attrs:{type:"info"}},[t._v("待付款")]):t._e(),1==e.row.status?a("el-tag",{attrs:{type:"warning"}},[t._v("待回复")]):t._e(),4==e.row.status?a("el-tag",{attrs:{type:"warning"}},[t._v("追问中")]):t._e(),2==e.row.status?a("el-tag",[t._v("已回复")]):t._e(),5==e.row.status?a("el-tag",[t._v("已回复追问")]):t._e(),3==e.row.status?a("el-tag",{attrs:{type:"success"}},[t._v("处理完成")]):t._e(),1==e.row.is_deleted?a("el-tag",{attrs:{type:"danger"}},[t._v("用户删除")]):t._e()]}}])}),a("el-table-column",{attrs:{prop:"name",label:"名称",width:"120"}}),a("el-table-column",{attrs:{label:"性别",width:"65"},scopedSlots:t._u([{key:"default",fn:function(e){return[a("div",[t._v(t._s(0==e.row.gender?"男":"女"))])]}}])}),a("el-table-column",{attrs:{prop:"phone",label:"电话",width:"100"}}),a("el-table-column",{attrs:{label:"相关图片",width:"100"},scopedSlots:t._u([{key:"default",fn:function(e){return[""==e.row.pictures?a("div",[t._v("无")]):a("el-button",{attrs:{type:"text"},on:{click:function(a){t.showPictures(e.row.pictures)}}},[t._v("查看图片")])]}}])}),a("el-table-column",{attrs:{prop:"create_time",label:"发布时间",width:"140"}}),a("el-table-column",{attrs:{label:"操作",width:"160"},scopedSlots:t._u([{key:"default",fn:function(e){return[e.row.status>0?a("el-button",{attrs:{type:"text"},on:{click:function(a){t.showReply(e.row)}}},[t._v("查看回复内容")]):t._e()]}}])})],1),a("el-pagination",{staticStyle:{"text-align":"center"},attrs:{"current-page":t.page.current_page,"page-sizes":[50],"page-size":t.page.size,layout:"total,sizes, prev, pager, next, jumper",total:t.page.total},on:{"current-change":t.handleCurrentChange}}),a("el-dialog",{attrs:{title:"回复内容",visible:t.is_show_reply,width:"700px"},on:{"update:visible":function(e){t.is_show_reply=e},close:function(e){t.edit_reply=""}}},t._l(t.chosed_help.talks,function(e){return a("block",[a("div",{staticClass:"user_title"},[t._v(t._s(t.chosed_help.name)+" "+t._s(e.create_time)+"：")]),a("div",{staticClass:"user_content"},[t._v(t._s(e.ask_content))]),a("div",{staticClass:"servant_title"},[t._v("客服回复 "+t._s(e.reply_time)+"：")]),a("div",{staticClass:"servant_content"},[t._v(t._s(e.reply_content))]),a("div",{staticStyle:{height:"1px",background:"#eee",margin:"10px 0"}})])}),1),a("el-dialog",{attrs:{title:"浏览图片",visible:t.is_show_pictures,width:"700px"},on:{"update:visible":function(e){t.is_show_pictures=e}}},[a("el-carousel",t._l(t.pictures.split(","),function(e,s){return a("el-carousel-item",{key:s},[a("img",{staticStyle:{display:"block",width:"100%"},attrs:{src:t.ImgUrl+e,alt:""}})])}),1)],1)],1)},i=[],l=(a("cadf"),a("551c"),a("097d"),{data:function(){return{main_input:{title:""},page:{current_page:1,size:50},is_show_user_info:!1,is_show_reply:!1,is_show_pictures:!1,is_loading:!1,table_height:500,status_list:["待付款","待处理","处理中","处理完成"],table_data:[],user_info:{},edit_reply:"",chosed_help:{},pictures:"",active_tab:"a",tab_amounts:[0,0,0,0]}},created:function(){this.table_height=window.innerHeight-150,this.getTableData()},methods:{getTableData:function(){var t=this;this.is_loading=!0;var e={page_size:this.page.size,page:this.page.current_page,type:"f"};this.requestApi({url:"ask_help2/getList",data:e,success:function(e){t.table_data=e.data,t.page.total=parseInt(e.total),t.is_loading=!1}})},showReply:function(t){this.chosed_help=t,this.is_show_reply=!0},submitReply:function(){var t=this;this.requestApi({url:"ask_help/reply",data:{id:this.edit_id,reply:this.edit_reply},success:function(){t.getTableData(),t.is_show_reply=!1,t.$message.success("回复成功")}})},handleCurrentChange:function(t){this.page.current_page=t,this.getTableData()},showPictures:function(t){this.pictures=t,this.is_show_pictures=!0},showUserInfo:function(t){var e=this;this.requestApi({url:"users/getSingle",data:{id:t},success:function(t){e.user_info=t,e.is_show_user_info=!0}})},goView:function(){this.$router.push("/system_ask_entrust_types")}}}),n=l,r=(a("8f70"),a("2877")),o=Object(r["a"])(n,s,i,!1,null,null,null);o.options.__file="ask_help_finish.vue";e["default"]=o.exports},"8f70":function(t,e,a){"use strict";var s=a("1323"),i=a.n(s);i.a}}]);