(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-53ec9939"],{"02f4":function(e,t,n){var s=n("4588"),i=n("be13");e.exports=function(e){return function(t,n){var c,r,u=String(i(t)),a=s(n),l=u.length;return a<0||a>=l?e?"":void 0:(c=u.charCodeAt(a),c<55296||c>56319||a+1===l||(r=u.charCodeAt(a+1))<56320||r>57343?e?u.charAt(a):c:e?u.slice(a,a+2):r-56320+(c-55296<<10)+65536)}}},"0390":function(e,t,n){"use strict";var s=n("02f4")(!0);e.exports=function(e,t,n){return t+(n?s(e,t).length:1)}},"28a5":function(e,t,n){"use strict";var s=n("aae3"),i=n("cb7c"),c=n("ebd6"),r=n("0390"),u=n("9def"),a=n("5f1b"),l=n("520a"),o=Math.min,_=[].push,d="split",m="length",h="lastIndex",v=!!function(){try{return new RegExp("x","y")}catch(e){}}();n("214f")("split",2,function(e,t,n,f){var x=n;return"c"=="abbc"[d](/(b)*/)[1]||4!="test"[d](/(?:)/,-1)[m]||2!="ab"[d](/(?:ab)*/)[m]||4!="."[d](/(.?)(.?)/)[m]||"."[d](/()()/)[m]>1||""[d](/.?/)[m]?x=function(e,t){var i=String(this);if(void 0===e&&0===t)return[];if(!s(e))return n.call(i,e,t);var c,r,u,a=[],o=(e.ignoreCase?"i":"")+(e.multiline?"m":"")+(e.unicode?"u":"")+(e.sticky?"y":""),d=0,v=void 0===t?4294967295:t>>>0,f=new RegExp(e.source,o+"g");while(c=l.call(f,i)){if(r=f[h],r>d&&(a.push(i.slice(d,c.index)),c[m]>1&&c.index<i[m]&&_.apply(a,c.slice(1)),u=c[0][m],d=r,a[m]>=v))break;f[h]===c.index&&f[h]++}return d===i[m]?!u&&f.test("")||a.push(""):a.push(i.slice(d)),a[m]>v?a.slice(0,v):a}:"0"[d](void 0,0)[m]&&(x=function(e,t){return void 0===e&&0===t?[]:n.call(this,e,t)}),[function(n,s){var i=e(this),c=void 0==n?void 0:n[t];return void 0!==c?c.call(n,i,s):x.call(String(i),n,s)},function(e,t){var s=f(x,e,this,t,x!==n);if(s.done)return s.value;var l=i(e),_=String(this),d=c(l,RegExp),m=l.unicode,h=(l.ignoreCase?"i":"")+(l.multiline?"m":"")+(l.unicode?"u":"")+(v?"y":"g"),p=new d(v?l:"^(?:"+l.source+")",h),g=void 0===t?4294967295:t>>>0;if(0===g)return[];if(0===_.length)return null===a(p,_)?[_]:[];var k=0,b=0,A=[];while(b<_.length){p.lastIndex=v?b:0;var y,w=a(p,v?_:_.slice(b));if(null===w||(y=o(u(p.lastIndex+(v?0:b)),_.length))===k)b=r(_,b,m);else{if(A.push(_.slice(k,b)),A.length===g)return A;for(var S=1;S<=w.length-1;S++)if(A.push(w[S]),A.length===g)return A;b=k=y}}return A.push(_.slice(k)),A}]})},3846:function(e,t,n){n("9e1e")&&"g"!=/./g.flags&&n("86cc").f(RegExp.prototype,"flags",{configurable:!0,get:n("0bfb")})},"6b54":function(e,t,n){"use strict";n("3846");var s=n("cb7c"),i=n("0bfb"),c=n("9e1e"),r="toString",u=/./[r],a=function(e){n("2aba")(RegExp.prototype,r,e,!0)};n("79e5")(function(){return"/a/b"!=u.call({source:"a",flags:"b"})})?a(function(){var e=s(this);return"/".concat(e.source,"/","flags"in e?e.flags:!c&&e instanceof RegExp?i.call(e):void 0)}):u.name!=r&&a(function(){return u.call(this)})},"6ee8":function(e,t,n){"use strict";var s=n("8c5a"),i=n.n(s);i.a},"8c5a":function(e,t,n){},"9c58":function(e,t,n){"use strict";(function(e){n("6b54"),n("28a5");t["a"]={name:"app",data:function(){return{activeIndex:"",user_class:e.user_class}},created:function(){this.activeIndex=this.$route.path.split("_")[0]},methods:{loginOut:function(){localStorage.removeItem("token"),localStorage.removeItem("expire_time"),this.$router.push("/login")},checkAuth:function(t){return t=t.toString(),e.authority.indexOf(t)>-1}}}}).call(this,n("c8ba"))},aae3:function(e,t,n){var s=n("d3f4"),i=n("2d95"),c=n("2b4c")("match");e.exports=function(e){var t;return s(e)&&(void 0!==(t=e[c])?!!t:"RegExp"==i(e))}},ed3a:function(e,t,n){"use strict";n.r(t);var s=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{attrs:{id:"app"}},[n("el-menu",{staticClass:"el-menu-demo",attrs:{"default-active":e.activeIndex,mode:"horizontal",router:!0,"menu-trigger":"click","unique-opened":!0,"background-color":"#545c64","text-color":"#fff","active-text-color":"#ffd04b","collapse-transition":!1}},[n("span",{staticClass:"logo"},[e._v("法保网APP管理后台")]),6==e.user_class?n("el-menu-item",{attrs:{index:"/index"}},[e._v("首页")]):e._e(),6==e.user_class?n("el-submenu",{attrs:{index:"/docs"}},[n("template",{slot:"title"},[e._v("文档管理")]),e.checkAuth(100)?n("el-menu-item",{attrs:{index:"/docs_banners"}},[e._v("首页轮播图管理")]):e._e(),e.checkAuth(101)?n("el-menu-item",{attrs:{index:"/docs_article_banners"}},[e._v("文章页轮播图管理")]):e._e(),e.checkAuth(102)?n("el-menu-item",{attrs:{index:"/docs_articles/list"}},[e._v("学法文章管理")]):e._e(),e.checkAuth(103)?n("el-submenu",{attrs:{index:"/docs_contract"}},[n("template",{slot:"title"},[e._v("合同管理")]),n("el-menu-item",{attrs:{index:"/docs_contracts"}},[e._v("合同列表")]),n("el-menu-item",{attrs:{index:"/docs_contracts_industries"}},[e._v("合同行业管理")]),n("el-menu-item",{attrs:{index:"/docs_contracts_types"}},[e._v("合同类别管理")])],2):e._e(),e.checkAuth(104)?n("el-menu-item",{attrs:{index:"/docs_professions"}},[e._v("专业律师管理")]):e._e()],2):e._e(),6==e.user_class?n("el-submenu",{attrs:{index:"/system"}},[n("template",{slot:"title"},[e._v("基础资料编辑")]),e.checkAuth(200)?n("el-menu-item",{attrs:{index:"/system_area_manage"}},[e._v("地域信息管理")]):e._e(),e.checkAuth(201)?n("el-menu-item",{attrs:{index:"/system_credit_infos"}},[e._v("基础信息管理")]):e._e(),e.checkAuth(202)?n("el-menu-item",{attrs:{index:"/system_vipinfo"}},[e._v("vip权益管理")]):e._e(),e.checkAuth(203)?n("el-menu-item",{attrs:{index:"/system_ask_entrust_types"}},[e._v("案件委托类别管理")]):e._e(),e.checkAuth(203)?n("el-menu-item",{attrs:{index:"/system_register_agreement"}},[e._v("注册协议编辑")]):e._e(),e.checkAuth(203)?n("el-menu-item",{attrs:{index:"/system_lawyer_manage"}},[e._v("入驻律师管理办法编辑")]):e._e()],2):e._e(),6==e.user_class?n("el-submenu",{attrs:{index:"/userdocs"}},[n("template",{slot:"title"},[e._v("用户数据管理")]),e.checkAuth(300)?n("el-menu-item",{attrs:{index:"/userdocs_admins"}},[e._v("管理员管理")]):e._e(),e.checkAuth(300)?n("el-menu-item",{attrs:{index:"/userdocs_servants"}},[e._v("问法客服管理")]):e._e(),e.checkAuth(301)?n("el-menu-item",{attrs:{index:"/userdocs_agencies"}},[e._v("代理商管理")]):e._e(),e.checkAuth(302)?n("el-menu-item",{attrs:{index:"/userdocs_audit_clients"}},[e._v("代理商客户审核")]):e._e(),e.checkAuth(303)?n("el-menu-item",{attrs:{index:"/userdocs_users"}},[e._v("用户列表")]):e._e(),e.checkAuth(304)?n("el-menu-item",{attrs:{index:"/userdocs_contract_custom"}},[e._v("定制合同数据")]):e._e(),e.checkAuth(305)?n("el-menu-item",{attrs:{index:"/userdocs_ask_help"}},[e._v("法律咨询数据")]):e._e(),e.checkAuth(306)?n("el-menu-item",{attrs:{index:"/userdocs_ask_entrust"}},[e._v("案件委托数据")]):e._e(),e.checkAuth(307)?n("el-menu-item",{attrs:{index:"/userdocs_ask_advance"}},[e._v("诉讼垫资数据")]):e._e(),e.checkAuth(307)?n("el-menu-item",{attrs:{index:"/userdocs_orders"}},[e._v("交易记录")]):e._e()],2):e._e(),5==e.user_class?n("el-menu-item",{attrs:{index:"/clients/0"}},[e._v("客户列表")]):e._e(),7==e.user_class?n("el-submenu",{attrs:{index:"/ask_help"}},[n("template",{slot:"title"},[e._v("法律咨询")]),n("el-menu-item",{attrs:{index:"/ask_help_wait"}},[e._v("待处理列表")]),n("el-menu-item",{attrs:{index:"/ask_help_finish"}},[e._v("已完成列表")])],2):e._e(),n("el-menu-item",{staticStyle:{float:"right"},attrs:{index:""},on:{click:function(t){e.loginOut()}}},[e._v("登 出")])],1),n("router-view")],1)},i=[],c=n("9c58"),r=c["a"],u=(n("6ee8"),n("2877")),a=Object(u["a"])(r,s,i,!1,null,"2f19b5fc",null);a.options.__file="layout.vue";t["default"]=a.exports}}]);