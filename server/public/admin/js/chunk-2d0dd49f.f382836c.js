(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0dd49f"],{"816f":function(t,e,a){"use strict";a.r(e);var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"container"},[a("div",{staticClass:"search_bar"},[a("el-button",{attrs:{type:"primary"},on:{click:function(e){t.is_show_add=!0}}},[t._v("新增文章页轮播图")]),a("el-breadcrumb",{attrs:{"separator-class":"el-icon-arrow-right"}},[a("el-breadcrumb-item",{attrs:{to:{path:"/index"}}},[t._v("首页")]),a("el-breadcrumb-item",[t._v("文档管理")]),a("el-breadcrumb-item",[t._v("文章页轮播图管理")])],1)],1),a("el-table",{directives:[{name:"loading",rawName:"v-loading",value:t.is_loading,expression:"is_loading"}],staticStyle:{width:"1000px"},attrs:{height:t.table_height,data:t.table_data,border:""}},[a("el-table-column",{attrs:{type:"index",width:"45",align:"center"}}),a("el-table-column",{attrs:{prop:"picture",label:"图片"},scopedSlots:t._u([{key:"default",fn:function(e){return[a("img",{staticClass:"upload-picture",attrs:{src:t.ImgUrl+e.row.picture}})]}}])}),a("el-table-column",{attrs:{label:"链接文章",width:"120"},scopedSlots:t._u([{key:"default",fn:function(e){return[e.row.title?a("el-button",{attrs:{type:"text"},on:{click:function(a){t.goArticle(e.row.article_id)}}},[t._v(t._s(e.row.title.slice(0,5)+"..."))]):t._e()]}}])}),a("el-table-column",{attrs:{label:"显示优先级",width:"90"},scopedSlots:t._u([{key:"default",fn:function(e){return[a("el-input",{on:{change:function(a){t.changeShowindex(e.row)}},model:{value:e.row.show_index,callback:function(a){t.$set(e.row,"show_index",a)},expression:"scope.row.show_index"}})]}}])}),a("el-table-column",{attrs:{label:"是否显示",width:"90"},scopedSlots:t._u([{key:"default",fn:function(e){return[a("el-switch",{attrs:{"active-value":1,"inactive-value":0},on:{change:function(a){t.changeShowindex(e.row)}},model:{value:e.row.is_show,callback:function(a){t.$set(e.row,"is_show",a)},expression:"scope.row.is_show"}})]}}])}),a("el-table-column",{attrs:{label:"操作",width:"150"},scopedSlots:t._u([{key:"default",fn:function(e){return[a("el-button",{attrs:{type:"text"},on:{click:function(a){t.showEditForm(e.row)}}},[t._v("编辑")]),a("el-button",{attrs:{type:"text"},on:{click:function(a){t.submitDel(e.row)}}},[t._v("删除")]),a("el-button",{attrs:{type:"text"},on:{click:function(a){t.showSearch(e.row)}}},[t._v("指定文章")])]}}])})],1),a("el-dialog",{attrs:{title:"新增",visible:t.is_show_add,width:"800px"},on:{"update:visible":function(e){t.is_show_add=e}}},[a("el-form",{attrs:{"label-width":"90px"},nativeOn:{submit:function(t){t.preventDefault()}}},[a("el-form-item",{attrs:{label:"图片"}},[a("el-upload",{staticClass:"avatar-uploader",attrs:{action:t.ServerUrl+"banners/upload","show-file-list":!1,"on-success":t.addAvatarSuccess}},[t.add_data.picture?a("img",{staticClass:"upload-picture",attrs:{src:t.ImgUrl+t.add_data.picture}}):a("i",{staticClass:"el-icon-plus avatar-uploader-icon"})])],1),a("el-form-item",{attrs:{label:"显示优先级"}},[a("el-input",{model:{value:t.add_data.show_index,callback:function(e){t.$set(t.add_data,"show_index",e)},expression:"add_data.show_index"}})],1),a("el-form-item",{attrs:{label:"是否显示"}},[a("el-switch",{attrs:{"active-value":1,"inactive-value":0},model:{value:t.add_data.is_show,callback:function(e){t.$set(t.add_data,"is_show",e)},expression:"add_data.is_show"}})],1),a("el-alert",{attrs:{title:"显示优先级数值越高，排名越靠前。",type:"warning",closable:!1}})],1),a("span",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[a("el-button",{on:{click:function(e){t.is_show_add=!1}}},[t._v("取 消")]),a("el-button",{attrs:{type:"primary"},on:{click:function(e){t.submitAdd()}}},[t._v("确 定")])],1)],1),a("el-dialog",{attrs:{title:"编辑",visible:t.is_show_edit,width:"800px"},on:{"update:visible":function(e){t.is_show_edit=e}}},[a("el-form",{attrs:{"label-width":"90px"},nativeOn:{submit:function(t){t.preventDefault()}}},[a("el-form-item",{attrs:{label:"图片"}},[a("el-upload",{staticClass:"avatar-uploader",attrs:{action:t.ServerUrl+"banners/upload","show-file-list":!1,"on-success":t.setAvatarSuccess}},[t.edit_data.picture?a("img",{staticClass:"upload-picture",attrs:{src:t.ImgUrl+t.edit_data.picture}}):a("i",{staticClass:"el-icon-plus avatar-uploader-icon"})])],1),a("el-form-item",{attrs:{label:"显示优先级"}},[a("el-input",{model:{value:t.edit_data.show_index,callback:function(e){t.$set(t.edit_data,"show_index",e)},expression:"edit_data.show_index"}})],1),a("el-form-item",{attrs:{label:"是否显示"}},[a("el-switch",{attrs:{"active-value":1,"inactive-value":0},model:{value:t.edit_data.is_show,callback:function(e){t.$set(t.edit_data,"is_show",e)},expression:"edit_data.is_show"}})],1),a("el-alert",{attrs:{title:"显示优先级数值越高，排名越靠前。",type:"warning",closable:!1}})],1),a("span",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[a("el-button",{on:{click:function(e){t.is_show_edit=!1}}},[t._v("取 消")]),a("el-button",{attrs:{type:"primary"},on:{click:function(e){t.submitEdit()}}},[t._v("确 定")])],1)],1),a("el-dialog",{attrs:{title:"选择文章",visible:t.is_show_search,width:"800px"},on:{"update:visible":function(e){t.is_show_search=e}}},[a("div",{staticClass:"search_bar"},[a("el-input",{staticClass:"main_input",attrs:{placeholder:"输入文章名称搜索",clearable:""},model:{value:t.search_text,callback:function(e){t.search_text=e},expression:"search_text"}}),a("el-button",{attrs:{type:"primary"},on:{click:function(e){t.getArticleList()}}},[t._v("搜 索")])],1),a("el-table",{staticStyle:{width:"100%"},attrs:{data:t.article_list}},[a("el-table-column",{attrs:{type:"index",width:"45",align:"center"}}),a("el-table-column",{attrs:{prop:"title",label:"文章标题"}}),a("el-table-column",{attrs:{label:"操作",width:"150"},scopedSlots:t._u([{key:"default",fn:function(e){return[a("el-button",{attrs:{type:"text"},on:{click:function(a){t.choseArticle(e.row)}}},[t._v("选择")])]}}])})],1)],1)],1)},s=[],l=(a("cadf"),a("551c"),a("097d"),{data:function(){return{is_loading:!1,is_show_add:!1,is_show_edit:!1,is_show_search:!1,add_data:{picture:null,is_show:1,show_index:0},edit_data:{},table_height:100,table_data:[],article_list:[],search_text:""}},created:function(){this.table_height=window.innerHeight-150,this.getTableData(),sessionStorage.getItem("article_banner_tag")||(this.$notify.info({title:"提示",message:"显示优先级数值越高，排名越靠前。",duration:6e3,offset:100}),sessionStorage.setItem("article_banner_tag",1))},methods:{getTableData:function(){var t=this;this.is_loading=!0,this.requestApi({url:"article_banners/get",success:function(e){t.table_data=e,t.initial_table_data=e,t.is_loading=!1}})},submitDel:function(t){var e=this;this.$confirm("确定删除?","再次确认",{confirmButtonText:"确定",cancelButtonText:"取消",type:"warning"}).then(function(){e.requestApi({url:"article_banners/del",data:{id:t.id},success:function(){e.$message.success("删除成功"),e.getTableData()}})}).catch(function(){})},submitAdd:function(){var t=this;this.requestApi({url:"article_banners/add",data:this.add_data,success:function(e){t.getTableData(),t.is_show_add=!1,t.$message.success("新增成功")}})},showEditForm:function(t){this.edit_data=JSON.parse(JSON.stringify(t)),this.is_show_edit=!0},submitEdit:function(){var t=this;this.requestApi({url:"article_banners/set",data:this.edit_data,success:function(e){t.getTableData(),t.is_show_edit=!1,t.$message.success("编辑成功")}})},addAvatarSuccess:function(t){1==t.status?this.add_data.picture=t.data:this.$message.error("服务器错误")},setAvatarSuccess:function(t){1==t.status?this.edit_data.picture=t.data:this.$message.error("服务器错误")},changeShowindex:function(t){this.edit_data=t,this.submitEdit()},showSearch:function(t){this.chosed_item=t,this.is_show_search=!0},getArticleList:function(){var t=this;this.requestApi({url:"articles/get",data:{title:this.search_text},success:function(e){t.article_list=e.data}})},choseArticle:function(t){var e=this;this.$confirm("确定选择 "+t.title+"?","再次确认",{confirmButtonText:"确定",cancelButtonText:"取消",type:"warning"}).then(function(){e.requestApi({url:"article_banners/setArticle",data:{id:e.chosed_item.id,article_id:t.id},success:function(){e.$message.success("操作成功"),e.getTableData()}})}).catch(function(){})},goArticle:function(t){this.$router.push("/docs_articles/edit/"+t)}}}),n=l,o=a("2877"),c=Object(o["a"])(n,i,s,!1,null,null,null);c.options.__file="article_banners.vue";e["default"]=c.exports}}]);