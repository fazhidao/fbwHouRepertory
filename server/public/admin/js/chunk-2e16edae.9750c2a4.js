(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2e16edae"],{"05e9":function(t,i,a){},"7f7f":function(t,i,a){var e=a("86cc").f,s=Function.prototype,n=/^\s*function ([^ (]*)/,l="name";l in s||a("9e1e")&&e(s,l,{configurable:!0,get:function(){try{return(""+this).match(n)[1]}catch(t){return""}}})},8939:function(t,i,a){"use strict";var e=a("05e9"),s=a.n(e);s.a},ac6a:function(t,i,a){for(var e=a("cadf"),s=a("0d58"),n=a("2aba"),l=a("7726"),d=a("32e9"),o=a("84f2"),c=a("2b4c"),r=c("iterator"),h=c("toStringTag"),u=o.Array,_={CSSRuleList:!0,CSSStyleDeclaration:!1,CSSValueList:!1,ClientRectList:!1,DOMRectList:!1,DOMStringList:!1,DOMTokenList:!0,DataTransferItemList:!1,FileList:!1,HTMLAllCollection:!1,HTMLCollection:!1,HTMLFormElement:!1,HTMLSelectElement:!1,MediaList:!0,MimeTypeArray:!1,NamedNodeMap:!1,NodeList:!0,PaintRequestList:!1,Plugin:!1,PluginArray:!1,SVGLengthList:!1,SVGNumberList:!1,SVGPathSegList:!1,SVGPointList:!1,SVGStringList:!1,SVGTransformList:!1,SourceBufferList:!1,StyleSheetList:!0,TextTrackCueList:!1,TextTrackList:!1,TouchList:!1},p=s(_),b=0;b<p.length;b++){var f,g=p[b],v=_[g],m=l[g],y=m&&m.prototype;if(y&&(y[r]||d(y,r,u),y[h]||d(y,h,g),o[g]=u,v))for(f in e)y[f]||n(y,f,e[f],!0)}},b096:function(t,i,a){"use strict";a.r(i);var e=function(){var t=this,i=t.$createElement,a=t._self._c||i;return a("div",{directives:[{name:"loading",rawName:"v-loading.body",value:t.loading.body,expression:"loading.body",modifiers:{body:!0}}],staticClass:"view_box container"},[a("div",{staticClass:"table_box"},[a("div",{staticClass:"table_title"},[a("el-input",{staticStyle:{width:"200px"},attrs:{clearable:"",placeholder:"输入关键字搜索"},model:{value:t.search_data.province,callback:function(i){t.$set(t.search_data,"province",i)},expression:"search_data.province"}}),a("el-button",{staticStyle:{"margin-left":"10px"},attrs:{type:"primary"},on:{click:function(i){t.showAdd(1)}}},[t._v("添加省")])],1),a("el-table",{directives:[{name:"loading",rawName:"v-loading",value:t.loading.province,expression:"loading.province"}],attrs:{height:t.table_height,data:t.table_data.province,"highlight-current-row":"",border:""},on:{"row-click":t.choseProvince}},[a("el-table-column",{attrs:{type:"index",width:"45",align:"center"}}),a("el-table-column",{attrs:{prop:"id",label:"id",align:"center"}}),a("el-table-column",{attrs:{prop:"name",label:"省",align:"center"}}),a("el-table-column",{attrs:{label:"操作",width:"160",align:"center"},scopedSlots:t._u([{key:"default",fn:function(i){return[a("el-button",{attrs:{type:"text"},on:{click:function(a){t.showEdit(i.row)}}},[t._v("编辑")])]}}])})],1)],1),a("div",{staticClass:"table_box"},[a("div",{staticClass:"table_title"},[a("el-input",{staticStyle:{width:"200px"},attrs:{clearable:"",placeholder:"输入关键字搜索"},model:{value:t.search_data.city,callback:function(i){t.$set(t.search_data,"city",i)},expression:"search_data.city"}}),a("el-button",{staticStyle:{"margin-left":"10px"},attrs:{type:"primary"},on:{click:function(i){t.showAdd(2)}}},[t._v("添加市")])],1),a("el-table",{directives:[{name:"loading",rawName:"v-loading",value:t.loading.city,expression:"loading.city"}],attrs:{height:t.table_height,data:t.table_data.city,"highlight-current-row":"","empty-text":"请先选择省",border:""},on:{"row-click":t.choseCity}},[a("el-table-column",{attrs:{type:"index",width:"45",align:"center"}}),a("el-table-column",{attrs:{prop:"id",label:"id",align:"center"}}),a("el-table-column",{attrs:{prop:"name",label:"市",align:"center"}}),a("el-table-column",{attrs:{label:"操作",width:"160",align:"center"},scopedSlots:t._u([{key:"default",fn:function(i){return[a("el-button",{attrs:{type:"text"},on:{click:function(a){t.showEdit(i.row)}}},[t._v("编辑")])]}}])})],1)],1),a("div",{staticClass:"table_box"},[a("div",{staticClass:"table_title"},[a("el-input",{staticStyle:{width:"200px"},attrs:{clearable:"",placeholder:"输入关键字搜索"},model:{value:t.search_data.district,callback:function(i){t.$set(t.search_data,"district",i)},expression:"search_data.district"}}),a("el-button",{staticStyle:{"margin-left":"10px"},attrs:{type:"primary"},on:{click:function(i){t.showAdd(3)}}},[t._v("添加区")])],1),a("el-table",{directives:[{name:"loading",rawName:"v-loading",value:t.loading.district,expression:"loading.district"}],attrs:{height:t.table_height,data:t.table_data.district,"empty-text":"请先选择市",border:""}},[a("el-table-column",{attrs:{type:"index",width:"45",align:"center"}}),a("el-table-column",{attrs:{prop:"id",label:"id",align:"center"}}),a("el-table-column",{attrs:{prop:"name",label:"区",align:"center"}}),a("el-table-column",{attrs:{label:"操作",width:"160",align:"center"},scopedSlots:t._u([{key:"default",fn:function(i){return[a("el-button",{attrs:{type:"text"},on:{click:function(a){t.showEdit(i.row)}}},[t._v("编辑")])]}}])})],1)],1),a("el-dialog",{attrs:{title:"编辑",visible:t.is_show_edit,width:"600px"},on:{"update:visible":function(i){t.is_show_edit=i}}},[a("el-input",{staticStyle:{width:"200px"},model:{value:t.edit_data.name,callback:function(i){t.$set(t.edit_data,"name",i)},expression:"edit_data.name"}}),a("span",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[a("el-button",{on:{click:function(i){t.is_show_edit=!1}}},[t._v("取 消")]),a("el-button",{attrs:{type:"primary"},on:{click:function(i){t.submitEdit()}}},[t._v("确 定")])],1)],1),a("el-dialog",{attrs:{title:"新增",visible:t.is_show_add,width:"600px"},on:{"update:visible":function(i){t.is_show_add=i}}},[a("el-form",{attrs:{"label-width":"80px"}},[a("el-form-item",{attrs:{label:"id"}},[a("el-input",{model:{value:t.add_data.id,callback:function(i){t.$set(t.add_data,"id",i)},expression:"add_data.id"}})],1),a("el-form-item",{attrs:{label:"名称"}},[a("el-input",{model:{value:t.add_data.name,callback:function(i){t.$set(t.add_data,"name",i)},expression:"add_data.name"}})],1)],1),a("span",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[a("el-button",{on:{click:function(i){t.is_show_add=!1}}},[t._v("取 消")]),a("el-button",{attrs:{type:"primary"},on:{click:function(i){t.submitAdd()}}},[t._v("确 定")])],1)],1)],1)},s=[],n=(a("386d"),a("7f7f"),a("ac6a"),{data:function(){return{table_height:100,is_show_edit:!1,edit_data:{},is_show_add:!1,add_data:{},loading:{province:!1,city:!1,district:!1,body:!1},search_data:{province:"",city:"",district:""},initial_data:{province:[],city:[],district:[]},table_data:{province:[],city:[],district:[]}}},created:function(){this.table_height=window.innerHeight-140,this.getAreaList({})},methods:{getAreaList:function(t){var i=this;this.loading.body=!0;var a={};t.arealevel&&(a.parent_id=t.id),this.requestApi({url:"areainfos/get",data:a,success:function(a){i.loading.body=!1,1==t.arealevel?(i.initial_data.city=a,i.table_data.city=a,i.initial_data.district=[],i.table_data.district=[],i.loading.city=!1):2==t.arealevel?(i.initial_data.district=a,i.table_data.district=a,i.loading.district=!1):(i.initial_data.province=a,i.table_data.province=a,i.loading.province=!1)}})},search:function(t,i){if(""==i)this.table_data[t]=this.initial_data[t];else{var a=[];this.initial_data[t].forEach(function(t){t.name.indexOf(i)>-1&&a.push(t)}),this.table_data[t]=a}},choseProvince:function(t){this.loading.city=!0,this.chosed_province_id=t.id,this.getAreaList(t)},choseCity:function(t){this.loading.district=!0,this.chosed_city_id=t.id,this.getAreaList(t)},showEdit:function(t){this.edit_data=t,this.temp_edit_data=JSON.parse(JSON.stringify(t)),this.is_show_edit=!0},submitEdit:function(){var t=this;this.loading.body=!0,this.requestApi({url:"areainfos/set",data:this.edit_data,success:function(){t.loading.body=!1,t.is_show_edit=!1,t.$message.success("修改成功")}})},showAdd:function(t){var i=null;return 2!=t||this.initial_data.city[0]?3!=t||this.initial_data.district[0]?(2==t?i=this.chosed_province_id:3==t&&(i=this.chosed_city_id),this.add_data={parent_id:i,name:"",id:"",arealevel:t},void(this.is_show_add=!0)):(this.$message.warning("请先选择市"),0):(this.$message.warning("请先选择省"),0)},submitAdd:function(){var t=this;this.loading.body=!0;var i={};2==this.add_data.arealevel?(i.id=this.chosed_province_id,i.arealevel=1):3==this.add_data.arealevel&&(i.id=this.chosed_city_id,i.arealevel=2),this.requestApi({url:"areainfos/add",data:this.add_data,success:function(){t.is_show_add=!1,t.$message.success("修改成功"),t.getAreaList(i)}})}},watch:{"search_data.province":function(t){this.search("province",t)},"search_data.city":function(t){this.search("city",t)},"search_data.district":function(t){this.search("district",t)}}}),l=n,d=(a("8939"),a("2877")),o=Object(d["a"])(l,e,s,!1,null,"231353a7",null);o.options.__file="area_manage.vue";i["default"]=o.exports}}]);