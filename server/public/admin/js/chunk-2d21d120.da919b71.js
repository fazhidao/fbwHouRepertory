(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d21d120"],{d075:function(t,e,i){"use strict";i.r(e);var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{directives:[{name:"loading",rawName:"v-loading",value:t.loading,expression:"loading"}],staticStyle:{background:"#fff"}},[i("div",{staticClass:"search_bar"},[i("el-button",{attrs:{type:"primary"},on:{click:function(e){t.submit()}}},[t._v("保存修改")]),i("el-breadcrumb",{attrs:{"separator-class":"el-icon-arrow-right"}},[i("el-breadcrumb-item",{attrs:{to:{path:"/index"}}},[t._v("首页")]),i("el-breadcrumb-item",[t._v("基础资料管理")]),i("el-breadcrumb-item",[t._v("入驻律师管理办法编辑")])],1)],1),i("div",{ref:"editor"})])},o=[],n=(i("a481"),i("cadf"),i("551c"),i("097d"),i("1a0b")),r=i.n(n),s={data:function(){return{loading:!1}},created:function(){this.getContent()},mounted:function(){this.initEditor()},methods:{getContent:function(){var t=this;this.requestApi({url:"system_infos/getLawyerManage",data:{id:this.edit_id},success:function(e){t.add_data=e,t.editor?t.editor.txt.html(e.value):t.editor_init_callback=function(){t.editor.txt.html(e.value)}}})},submit:function(){var t=this;this.loading=!0;var e=this.editor.txt.html().replace(/<font[^>]*>/g,"");e=e.replace(/<\/font>/g,""),e=encodeURIComponent(e),this.requestApi({url:"system_infos/setLawyerManage",data:{data:e},success:function(e){t.loading=!1,t.$message.success("修改成功！")}})},initEditor:function(){this.editor=new r.a(this.$refs.editor),this.editor.customConfig.uploadImgServer="http://116.62.208.170/index.php/api/admin/articles/editor_pic",this.editor.customConfig.uploadImgParams={appid:localStorage.getItem("token")},this.editor.customConfig.uploadFileName="file",this.editor.customConfig.uploadImgMaxLength=1,this.editor.customConfig.zIndex=100,this.editor.customConfig.onchange=function(t){localStorage.setItem("editor_backup",t)},this.editor.create(),this.editor_init_callback&&this.editor_init_callback()}}},d=s,c=i("2877"),l=Object(c["a"])(d,a,o,!1,null,null,null);l.options.__file="lawyer_manage.vue";e["default"]=l.exports}}]);