(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d1dee8c"],{3846:function(e,t,s){s("9e1e")&&"g"!=/./g.flags&&s("86cc").f(RegExp.prototype,"flags",{configurable:!0,get:s("0bfb")})},"5e15":function(e,t,s){},"6b54":function(e,t,s){"use strict";s("3846");var n=s("cb7c"),c=s("0bfb"),i=s("9e1e"),a="toString",u=/./[a],r=function(e){s("2aba")(RegExp.prototype,a,e,!0)};s("79e5")(function(){return"/a/b"!=u.call({source:"a",flags:"b"})})?r(function(){var e=n(this);return"/".concat(e.source,"/","flags"in e?e.flags:!i&&e instanceof RegExp?c.call(e):void 0)}):u.name!=a&&r(function(){return u.call(this)})},"9c58":function(e,t,s){"use strict";(function(e){s("6b54"),s("28a5"),s("cadf"),s("551c"),s("097d");t["a"]={name:"app",data:function(){return{activeIndex:"",user_class:e.user_class}},created:function(){this.activeIndex=this.$route.path.split("_")[0]},methods:{loginOut:function(){localStorage.removeItem("token"),localStorage.removeItem("expire_time"),this.$router.push("/login")},checkAuth:function(t){return t=t.toString(),e.authority.indexOf(t)>-1}}}}).call(this,s("c8ba"))},a80e:function(e,t,s){"use strict";var n=s("5e15"),c=s.n(n);c.a},ed3a:function(e,t,s){"use strict";s.r(t);var n=function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",{attrs:{id:"app"}},[s("el-menu",{staticClass:"el-menu-demo",attrs:{"default-active":e.activeIndex,mode:"horizontal",router:!0,"menu-trigger":"click","unique-opened":!0,"background-color":"#545c64","text-color":"#fff","active-text-color":"#ffd04b","collapse-transition":!1}},[s("span",{staticClass:"logo"},[e._v("法保网APP管理后台")]),6==e.user_class?s("el-menu-item",{attrs:{index:"/index"}},[e._v("首页")]):e._e(),6==e.user_class?s("el-submenu",{attrs:{index:"/docs"}},[s("template",{slot:"title"},[e._v("文档管理")]),e.checkAuth(100)?s("el-menu-item",{attrs:{index:"/docs_banners"}},[e._v("首页轮播图管理")]):e._e(),e.checkAuth(101)?s("el-menu-item",{attrs:{index:"/docs_article_banners"}},[e._v("文章页轮播图管理")]):e._e(),e.checkAuth(102)?s("el-menu-item",{attrs:{index:"/docs_articles/list"}},[e._v("学法文章管理")]):e._e(),e.checkAuth(103)?s("el-submenu",{attrs:{index:"/docs_contract"}},[s("template",{slot:"title"},[e._v("合同管理")]),s("el-menu-item",{attrs:{index:"/docs_contracts"}},[e._v("合同列表")]),s("el-menu-item",{attrs:{index:"/docs_contracts_industries"}},[e._v("合同行业管理")]),s("el-menu-item",{attrs:{index:"/docs_contracts_types"}},[e._v("合同类别管理")])],2):e._e(),e.checkAuth(104)?s("el-menu-item",{attrs:{index:"/docs_professions"}},[e._v("专业律师管理")]):e._e()],2):e._e(),6==e.user_class?s("el-submenu",{attrs:{index:"/system"}},[s("template",{slot:"title"},[e._v("基础资料编辑")]),e.checkAuth(200)?s("el-menu-item",{attrs:{index:"/system_area_manage"}},[e._v("地域信息管理")]):e._e(),e.checkAuth(201)?s("el-menu-item",{attrs:{index:"/system_goods_manage"}},[e._v("价格管理")]):e._e(),e.checkAuth(201)?s("el-menu-item",{attrs:{index:"/system_system_infos"}},[e._v("基础信息管理")]):e._e(),e.checkAuth(202)?s("el-menu-item",{attrs:{index:"/system_vipinfo"}},[e._v("vip权益管理")]):e._e(),e.checkAuth(203)?s("el-menu-item",{attrs:{index:"/system_ask_entrust_types"}},[e._v("案件委托类别管理")]):e._e(),e.checkAuth(203)?s("el-menu-item",{attrs:{index:"/system_register_agreement"}},[e._v("注册协议编辑")]):e._e(),e.checkAuth(203)?s("el-menu-item",{attrs:{index:"/system_lawyer_manage"}},[e._v("入驻律师管理办法编辑")]):e._e()],2):e._e(),6==e.user_class?s("el-submenu",{attrs:{index:"/userdocs"}},[s("template",{slot:"title"},[e._v("用户数据管理")]),e.checkAuth(300)?s("el-menu-item",{attrs:{index:"/userdocs_admins"}},[e._v("管理员管理")]):e._e(),e.checkAuth(300)?s("el-menu-item",{attrs:{index:"/userdocs_servants"}},[e._v("问法客服管理")]):e._e(),e.checkAuth(301)?s("el-menu-item",{attrs:{index:"/userdocs_agencies"}},[e._v("代理商管理")]):e._e(),e.checkAuth(302)?s("el-menu-item",{attrs:{index:"/userdocs_audit_clients"}},[e._v("代理商客户审核")]):e._e(),e.checkAuth(303)?s("el-menu-item",{attrs:{index:"/userdocs_users"}},[e._v("用户列表")]):e._e(),e.checkAuth(303)?s("el-menu-item",{attrs:{index:"/userdocs_services"}},[e._v("企业服务数据")]):e._e(),e.checkAuth(304)?s("el-menu-item",{attrs:{index:"/userdocs_contract_custom"}},[e._v("定制合同数据")]):e._e(),e.checkAuth(305)?s("el-menu-item",{attrs:{index:"/userdocs_ask_help"}},[e._v("法律咨询数据")]):e._e(),e.checkAuth(306)?s("el-menu-item",{attrs:{index:"/userdocs_ask_entrust"}},[e._v("案件委托数据")]):e._e(),e.checkAuth(307)?s("el-menu-item",{attrs:{index:"/userdocs_ask_advance"}},[e._v("诉讼垫资数据")]):e._e(),e.checkAuth(307)?s("el-menu-item",{attrs:{index:"/userdocs_orders"}},[e._v("交易记录")]):e._e()],2):e._e(),5==e.user_class?s("el-menu-item",{attrs:{index:"/clients/0"}},[e._v("客户列表")]):e._e(),7==e.user_class?s("el-submenu",{attrs:{index:"/ask_help"}},[s("template",{slot:"title"},[e._v("法律咨询")]),s("el-menu-item",{attrs:{index:"/ask_help_wait"}},[e._v("待处理列表")]),s("el-menu-item",{attrs:{index:"/ask_help_finish"}},[e._v("已完成列表")])],2):e._e(),s("el-menu-item",{staticStyle:{float:"right"},attrs:{index:""},on:{click:function(t){e.loginOut()}}},[e._v("登 出")])],1),s("router-view")],1)},c=[],i=s("9c58"),a=i["a"],u=(s("a80e"),s("2877")),r=Object(u["a"])(a,n,c,!1,null,"f8572416",null);r.options.__file="layout.vue";t["default"]=r.exports}}]);