(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-f36dca7c"],{"7f7f":function(t,e,i){var a=i("86cc").f,s=Function.prototype,n=/^\s*function ([^ (]*)/,c="name";c in s||i("9e1e")&&a(s,c,{configurable:!0,get:function(){try{return(""+this).match(n)[1]}catch(t){return""}}})},a07e:function(t,e,i){"use strict";i.r(e);var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{staticClass:"container"},[i("div",{staticClass:"search_bar"},[i("el-button",{attrs:{type:"primary"},on:{click:function(e){t.is_show_add=!0}}},[t._v("新增管理员")]),i("el-breadcrumb",{attrs:{"separator-class":"el-icon-arrow-right"}},[i("el-breadcrumb-item",{attrs:{to:{path:"/index"}}},[t._v("首页")]),i("el-breadcrumb-item",[t._v("用户数据管理")]),i("el-breadcrumb-item",[t._v("管理员管理")])],1)],1),i("el-alert",{attrs:{title:"注意：名称将作为用户登录名",type:"warning"}}),i("el-table",{directives:[{name:"loading",rawName:"v-loading",value:t.is_loading,expression:"is_loading"}],staticStyle:{width:"100%"},attrs:{data:t.table_data,border:""}},[i("el-table-column",{attrs:{type:"index",width:"45",align:"center"}}),i("el-table-column",{attrs:{label:"状态",width:"65"},scopedSlots:t._u([{key:"default",fn:function(e){return[0==e.row.status?i("el-tag",{attrs:{type:"danger"}},[t._v("禁用")]):t._e(),e.row.status>0?i("el-tag",[t._v("正常")]):t._e()]}}])}),i("el-table-column",{attrs:{prop:"name",label:"名称"}}),i("el-table-column",{attrs:{prop:"phone",label:"电话",width:"140"}}),i("el-table-column",{attrs:{prop:"note",label:"备注",width:"140"}}),i("el-table-column",{attrs:{label:"操作",width:"200"},scopedSlots:t._u([{key:"default",fn:function(e){return[i("el-button",{attrs:{type:"text"},on:{click:function(i){t.showEditForm(e.row)}}},[t._v("编辑")]),1==e.row.status?i("el-button",{attrs:{type:"text"},on:{click:function(i){t.submitForbid(e.row)}}},[t._v("禁用")]):t._e(),0==e.row.status?i("el-button",{attrs:{type:"text"},on:{click:function(i){t.submitCancelForbid(e.row)}}},[t._v("启用")]):t._e()]}}])})],1),i("el-dialog",{attrs:{title:"新增",visible:t.is_show_add,width:"600px"},on:{"update:visible":function(e){t.is_show_add=e}}},[i("el-form",{attrs:{"label-width":"80px"},nativeOn:{submit:function(t){t.preventDefault()}}},[i("el-form-item",{attrs:{label:"名称"}},[i("el-input",{model:{value:t.add_data.name,callback:function(e){t.$set(t.add_data,"name",e)},expression:"add_data.name"}})],1),i("el-form-item",{attrs:{label:"手机"}},[i("el-input",{model:{value:t.add_data.phone,callback:function(e){t.$set(t.add_data,"phone",e)},expression:"add_data.phone"}})],1),i("el-form-item",{attrs:{label:"登录密码"}},[i("el-input",{model:{value:t.add_data.password,callback:function(e){t.$set(t.add_data,"password",e)},expression:"add_data.password"}})],1),i("el-form-item",{attrs:{label:"备注"}},[i("el-input",{model:{value:t.add_data.note,callback:function(e){t.$set(t.add_data,"note",e)},expression:"add_data.note"}})],1)],1),i("el-checkbox",{attrs:{indeterminate:t.isIndeterminate1},on:{change:t.checkAllChange1},model:{value:t.checkAll1,callback:function(e){t.checkAll1=e},expression:"checkAll1"}},[t._v("文档管理")]),i("div",{staticStyle:{margin:"5px 0"}}),i("el-checkbox-group",{attrs:{size:"mini"},on:{change:t.checkedChange1},model:{value:t.checked1,callback:function(e){t.checked1=e},expression:"checked1"}},[i("el-row",t._l(t.authority_list1,function(e){return i("el-col",{staticStyle:{"margin-bottom":"4px"},attrs:{span:6}},[i("el-checkbox",{key:e,attrs:{label:e,border:""}},[t._v(t._s(e))])],1)}),1)],1),i("div",{staticStyle:{margin:"15px 0"}}),i("el-checkbox",{attrs:{indeterminate:t.isIndeterminate2},on:{change:t.checkAllChange2},model:{value:t.checkAll2,callback:function(e){t.checkAll2=e},expression:"checkAll2"}},[t._v("基础资料编辑")]),i("div",{staticStyle:{margin:"5px 0"}}),i("el-checkbox-group",{attrs:{size:"mini"},on:{change:t.checkedChange2},model:{value:t.checked2,callback:function(e){t.checked2=e},expression:"checked2"}},[i("el-row",t._l(t.authority_list2,function(e){return i("el-col",{staticStyle:{"margin-bottom":"4px"},attrs:{span:6}},[i("el-checkbox",{key:e,attrs:{label:e,border:""}},[t._v(t._s(e))])],1)}),1)],1),i("div",{staticStyle:{margin:"20px 0"}}),i("el-checkbox",{attrs:{indeterminate:t.isIndeterminate3},on:{change:t.checkAllChange3},model:{value:t.checkAll3,callback:function(e){t.checkAll3=e},expression:"checkAll3"}},[t._v("用户数据管理")]),i("div",{staticStyle:{margin:"5px 0"}}),i("el-checkbox-group",{attrs:{size:"mini"},on:{change:t.checkedChange3},model:{value:t.checked3,callback:function(e){t.checked3=e},expression:"checked3"}},[i("el-row",t._l(t.authority_list3,function(e){return i("el-col",{staticStyle:{"margin-bottom":"4px"},attrs:{span:6}},[i("el-checkbox",{key:e,attrs:{label:e,border:""}},[t._v(t._s(e))])],1)}),1)],1),i("span",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[i("el-button",{on:{click:function(e){t.is_show_add=!1}}},[t._v("取 消")]),i("el-button",{attrs:{type:"primary"},on:{click:function(e){t.submitAdd()}}},[t._v("确 定")])],1)],1),i("el-dialog",{attrs:{title:"编辑",visible:t.is_show_edit,width:"600px"},on:{"update:visible":function(e){t.is_show_edit=e}}},[i("el-form",{attrs:{"label-width":"80px"},nativeOn:{submit:function(t){t.preventDefault()}}},[i("el-form-item",{attrs:{label:"名称"}},[i("el-input",{model:{value:t.edit_data.name,callback:function(e){t.$set(t.edit_data,"name",e)},expression:"edit_data.name"}})],1),i("el-form-item",{attrs:{label:"手机"}},[i("el-input",{model:{value:t.edit_data.phone,callback:function(e){t.$set(t.edit_data,"phone",e)},expression:"edit_data.phone"}})],1),i("el-form-item",{attrs:{label:"重置密码"}},[i("el-input",{model:{value:t.add_data.password,callback:function(e){t.$set(t.add_data,"password",e)},expression:"add_data.password"}})],1),i("el-form-item",{attrs:{label:"备注"}},[i("el-input",{model:{value:t.edit_data.note,callback:function(e){t.$set(t.edit_data,"note",e)},expression:"edit_data.note"}})],1)],1),i("el-checkbox",{attrs:{indeterminate:t.isIndeterminate1},on:{change:t.checkAllChange1},model:{value:t.checkAll1,callback:function(e){t.checkAll1=e},expression:"checkAll1"}},[t._v("文档管理")]),i("div",{staticStyle:{margin:"5px 0"}}),i("el-checkbox-group",{attrs:{size:"mini"},on:{change:t.checkedChange1},model:{value:t.checked1,callback:function(e){t.checked1=e},expression:"checked1"}},[i("el-row",t._l(t.authority_list1,function(e){return i("el-col",{staticStyle:{"margin-bottom":"4px"},attrs:{span:6}},[i("el-checkbox",{key:e,attrs:{label:e,border:""}},[t._v(t._s(e))])],1)}),1)],1),i("div",{staticStyle:{margin:"15px 0"}}),i("el-checkbox",{attrs:{indeterminate:t.isIndeterminate2},on:{change:t.checkAllChange2},model:{value:t.checkAll2,callback:function(e){t.checkAll2=e},expression:"checkAll2"}},[t._v("基础资料编辑")]),i("div",{staticStyle:{margin:"5px 0"}}),i("el-checkbox-group",{attrs:{size:"mini"},on:{change:t.checkedChange2},model:{value:t.checked2,callback:function(e){t.checked2=e},expression:"checked2"}},[i("el-row",t._l(t.authority_list2,function(e){return i("el-col",{staticStyle:{"margin-bottom":"4px"},attrs:{span:6}},[i("el-checkbox",{key:e,attrs:{label:e,border:""}},[t._v(t._s(e))])],1)}),1)],1),i("div",{staticStyle:{margin:"20px 0"}}),i("el-checkbox",{attrs:{indeterminate:t.isIndeterminate3},on:{change:t.checkAllChange3},model:{value:t.checkAll3,callback:function(e){t.checkAll3=e},expression:"checkAll3"}},[t._v("用户数据管理")]),i("div",{staticStyle:{margin:"5px 0"}}),i("el-checkbox-group",{attrs:{size:"mini"},on:{change:t.checkedChange3},model:{value:t.checked3,callback:function(e){t.checked3=e},expression:"checked3"}},[i("el-row",t._l(t.authority_list3,function(e){return i("el-col",{staticStyle:{"margin-bottom":"4px"},attrs:{span:6}},[i("el-checkbox",{key:e,attrs:{label:e,border:""}},[t._v(t._s(e))])],1)}),1)],1),i("span",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[i("el-button",{on:{click:function(e){t.is_show_edit=!1}}},[t._v("取 消")]),i("el-button",{attrs:{type:"primary"},on:{click:function(e){t.submitEdit()}}},[t._v("确认编辑")])],1)],1)],1)},s=[],n=(i("ac6a"),i("28a5"),i("7f7f"),i("cadf"),i("551c"),i("097d"),{data:function(){return{is_loading:!1,is_show_add:!1,is_show_edit:!1,is_show_authority:!1,add_data:{},edit_data:{},table_data:[],isIndeterminate1:!1,checkAll1:!1,authority_list1:["首页轮播图管理","文章页轮播图管理","学法文章管理","合同管理","专业律师管理"],checked1:[],isIndeterminate2:!1,checkAll2:!1,authority_list2:["地域信息管理","基础信息管理","vip权益管理","案件委托类别管理"],checked2:[],isIndeterminate3:!1,checkAll3:!1,authority_list3:["管理员管理","代理商管理","代理商客户审核","用户列表","定制合同数据","法律咨询数据","案件委托数据","诉讼垫资数据"],checked3:[],chosed_authority_list:[]}},created:function(){this.getTableData()},methods:{getTableData:function(){var t=this;this.is_loading=!0,this.requestApi({url:"admins/getAdmins",success:function(e){t.table_data=e,t.is_loading=!1}})},submitForbid:function(t){var e=this;this.$confirm("确定禁用 "+t.name+"?","提示",{confirmButtonText:"确定",cancelButtonText:"取消",type:"warning"}).then(function(){e.requestApi({url:"admins/forbid",data:{id:t.id},success:function(){e.$message.success("禁用成功"),t.status=0}})}).catch(function(){})},submitCancelForbid:function(t){var e=this;this.$confirm("确定启用 "+t.name+"?","提示",{confirmButtonText:"确定",cancelButtonText:"取消",type:"warning"}).then(function(){e.requestApi({url:"admins/cancelForbid",data:{id:t.id},success:function(){e.$message.success("启用成功"),t.status=2}})}).catch(function(){})},submitAdd:function(){for(var t=this,e=this.authority_list1.length,i=0;i<e;i++)this.in_array(this.authority_list1[i],this.checked1)&&this.chosed_authority_list.push(100+i);for(var a=this.authority_list2.length,s=0;s<a;s++)this.in_array(this.authority_list2[s],this.checked2)&&this.chosed_authority_list.push(200+s);for(var n=this.authority_list3.length,c=0;c<n;c++)this.in_array(this.authority_list3[c],this.checked3)&&this.chosed_authority_list.push(300+c);this.add_data.authority=this.chosed_authority_list.join(","),this.requestApi({url:"admins/addAdmin",data:this.add_data,success:function(e){t.getTableData(),t.is_show_add=!1,t.$message.success("新增成功")}})},showEditForm:function(t){var e=this;this.checked1=[],this.checked2=[],this.checked3=[],this.checkAll1=!1,this.checkAll2=!1,this.checkAll3=!1,this.edit_data=JSON.parse(JSON.stringify(t));var i=""==this.edit_data.authority?[]:this.edit_data.authority.split(",");i.forEach(function(t){console.log(t),t<200?e.checked1.push(e.authority_list1[t%100]):t<300?e.checked2.push(e.authority_list2[t%200]):e.checked3.push(e.authority_list3[t%300])}),this.is_show_edit=!0},submitEdit:function(){for(var t=this,e=this.authority_list1.length,i=0;i<e;i++)this.in_array(this.authority_list1[i],this.checked1)&&this.chosed_authority_list.push(100+i);for(var a=this.authority_list2.length,s=0;s<a;s++)this.in_array(this.authority_list2[s],this.checked2)&&this.chosed_authority_list.push(200+s);for(var n=this.authority_list3.length,c=0;c<n;c++)this.in_array(this.authority_list3[c],this.checked3)&&this.chosed_authority_list.push(300+c);this.edit_data.authority=this.chosed_authority_list.join(","),this.requestApi({url:"admins/setAdmin",data:this.edit_data,success:function(e){t.getTableData(),t.is_show_edit=!1,t.$message.success("编辑成功")}})},checkAllChange1:function(t){this.checked1=t?this.authority_list1:[],this.isIndeterminate1=!1},checkedChange1:function(t){var e=t.length;this.checkAll1=e===this.authority_list1.length,this.isIndeterminate1=e>0&&e<this.authority_list1.length},checkAllChange2:function(t){this.checked2=t?this.authority_list2:[],this.isIndeterminate2=!1},checkedChange2:function(t){var e=t.length;this.checkAll2=e===this.authority_list2.length,this.isIndeterminate2=e>0&&e<this.authority_list2.length},checkAllChange3:function(t){this.checked3=t?this.authority_list3:[],this.isIndeterminate3=!1},checkedChange3:function(t){var e=t.length;this.checkAll3=e===this.authority_list3.length,this.isIndeterminate3=e>0&&e<this.authority_list3.length},in_array:function(t,e){for(var i in e)if(e[i]==t)return!0;return!1}}}),c=n,l=i("2877"),o=Object(l["a"])(c,a,s,!1,null,null,null);o.options.__file="admins.vue";e["default"]=o.exports},ac6a:function(t,e,i){for(var a=i("cadf"),s=i("0d58"),n=i("2aba"),c=i("7726"),l=i("32e9"),o=i("84f2"),r=i("2b4c"),h=r("iterator"),d=r("toStringTag"),u=o.Array,_={CSSRuleList:!0,CSSStyleDeclaration:!1,CSSValueList:!1,ClientRectList:!1,DOMRectList:!1,DOMStringList:!1,DOMTokenList:!0,DataTransferItemList:!1,FileList:!1,HTMLAllCollection:!1,HTMLCollection:!1,HTMLFormElement:!1,HTMLSelectElement:!1,MediaList:!0,MimeTypeArray:!1,NamedNodeMap:!1,NodeList:!0,PaintRequestList:!1,Plugin:!1,PluginArray:!1,SVGLengthList:!1,SVGNumberList:!1,SVGPathSegList:!1,SVGPointList:!1,SVGStringList:!1,SVGTransformList:!1,SourceBufferList:!1,StyleSheetList:!0,TextTrackCueList:!1,TextTrackList:!1,TouchList:!1},m=s(_),k=0;k<m.length;k++){var p,b=m[k],f=_[b],g=c[b],y=g&&g.prototype;if(y&&(y[h]||l(y,h,u),y[d]||l(y,d,b),o[b]=u,f))for(p in a)y[p]||n(y,p,a[p],!0)}}}]);