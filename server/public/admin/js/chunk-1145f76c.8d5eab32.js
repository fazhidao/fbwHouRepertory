(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-1145f76c"],{"32f6":function(t,e,n){"use strict";(function(t){n("7f7f"),n("ac6a"),n("cadf"),n("551c"),n("097d");var r=n("6625"),i=n.n(r);e["a"]={components:{VueUeditorWrap:i.a},data:function(){return{is_show_preview:!1,mode:"set",add_data:{},type_list:[{id:1,title:"法律头条"},{id:2,title:"经典案例"}],preview_data:"",predefineColors:["#ff4500","#ff8c00","#ffd700","#90ee90","#00ced1","#1e90ff","#c71585"],content_arr:[],content_index:-1,content:""}},mounted:function(){this.initEditor()},activated:function(){this.editor||this.initEditor(),"add"==this.$route.params.id?(this.mode="add",this.add_data={type:1,title:"",tag:"",tag_color:"#1E90FF",views:0,is_show:0,title_picture:0}):(this.mode="set",this.edit_id=this.$route.params.id,this.getContent())},methods:{initEditor:function(){},getContent:function(){var t=this;this.requestApi({url:"articles/get",data:{id:this.edit_id},success:function(e){t.add_data=e,t.content=e.content}})},upPicSuccess:function(t){1==t.status?this.add_data.title_picture=t.data:this.$message.error("服务器错误")},submit:function(e){var n=this;if(this.add_data.content=encodeURIComponent(this.content),""==this.add_data.title)return this.$message.warning("请输入标题"),0;this.add_data.is_show=e,this.requestApi({url:"articles/"+this.mode,data:this.add_data,success:function(r){0==e?(n.mode="set",n.edit_id=r):"add"==n.mode&&n.$router.go(-1),n.$message.success("操作成功！"),t.edited=!0}})},formatText:function(t,e){var n=this;t&&t.forEach(function(t){if("string"==typeof t&&"p"==n.content_arr[e].name)n.content_arr[e].children[0].text+=t;else{if("img"==t.tag){var r="";return t.attrs.forEach(function(t){"src"==t.name&&(r=t.value)}),n.content_arr[e]={name:"img",attrs:{style:"display: block;width: 100%;",src:r}},!1}t.children&&n.formatText(t.children,e)}})},getChildrenText:function(t){},showPreview:function(){this.is_show_preview=!0},goBack:function(){this.title="",this.content="",this.$router.go(-1)}}}}).call(this,n("c8ba"))},6625:function(t,e,n){!function(e,n){t.exports=n()}("undefined"!=typeof self&&self,function(){return function(t){var e={};function n(r){if(e[r])return e[r].exports;var i=e[r]={i:r,l:!1,exports:{}};return t[r].call(i.exports,i,i.exports,n),i.l=!0,i.exports}return n.m=t,n.c=e,n.d=function(t,e,r){n.o(t,e)||Object.defineProperty(t,e,{configurable:!1,enumerable:!0,get:r})},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="",n(n.s=39)}([function(t,e){var n=t.exports="undefined"!=typeof window&&window.Math==Math?window:"undefined"!=typeof self&&self.Math==Math?self:Function("return this")();"number"==typeof __g&&(__g=n)},function(t,e,n){var r=n(28)("wks"),i=n(29),o=n(0).Symbol,s="function"==typeof o;(t.exports=function(t){return r[t]||(r[t]=s&&o[t]||(s?o:i)("Symbol."+t))}).store=r},function(t,e){var n=t.exports={version:"2.5.7"};"number"==typeof __e&&(__e=n)},function(t,e,n){var r=n(6);t.exports=function(t){if(!r(t))throw TypeError(t+" is not an object!");return t}},function(t,e,n){var r=n(0),i=n(2),o=n(11),s=n(5),c=n(9),a=function(t,e,n){var u,f,l,d=t&a.F,p=t&a.G,h=t&a.S,v=t&a.P,m=t&a.B,_=t&a.W,y=p?i:i[e]||(i[e]={}),g=y.prototype,w=p?r:h?r[e]:(r[e]||{}).prototype;for(u in p&&(n=e),n)(f=!d&&w&&void 0!==w[u])&&c(y,u)||(l=f?w[u]:n[u],y[u]=p&&"function"!=typeof w[u]?n[u]:m&&f?o(l,r):_&&w[u]==l?function(t){var e=function(e,n,r){if(this instanceof t){switch(arguments.length){case 0:return new t;case 1:return new t(e);case 2:return new t(e,n)}return new t(e,n,r)}return t.apply(this,arguments)};return e.prototype=t.prototype,e}(l):v&&"function"==typeof l?o(Function.call,l):l,v&&((y.virtual||(y.virtual={}))[u]=l,t&a.R&&g&&!g[u]&&s(g,u,l)))};a.F=1,a.G=2,a.S=4,a.P=8,a.B=16,a.W=32,a.U=64,a.R=128,t.exports=a},function(t,e,n){var r=n(13),i=n(31);t.exports=n(7)?function(t,e,n){return r.f(t,e,i(1,n))}:function(t,e,n){return t[e]=n,t}},function(t,e){t.exports=function(t){return"object"==typeof t?null!==t:"function"==typeof t}},function(t,e,n){t.exports=!n(14)(function(){return 7!=Object.defineProperty({},"a",{get:function(){return 7}}).a})},function(t,e){t.exports={}},function(t,e){var n={}.hasOwnProperty;t.exports=function(t,e){return n.call(t,e)}},function(t,e){var n={}.toString;t.exports=function(t){return n.call(t).slice(8,-1)}},function(t,e,n){var r=n(12);t.exports=function(t,e,n){if(r(t),void 0===e)return t;switch(n){case 1:return function(n){return t.call(e,n)};case 2:return function(n,r){return t.call(e,n,r)};case 3:return function(n,r,i){return t.call(e,n,r,i)}}return function(){return t.apply(e,arguments)}}},function(t,e){t.exports=function(t){if("function"!=typeof t)throw TypeError(t+" is not a function!");return t}},function(t,e,n){var r=n(3),i=n(49),o=n(50),s=Object.defineProperty;e.f=n(7)?Object.defineProperty:function(t,e,n){if(r(t),e=o(e,!0),r(n),i)try{return s(t,e,n)}catch(t){}if("get"in n||"set"in n)throw TypeError("Accessors not supported!");return"value"in n&&(t[e]=n.value),t}},function(t,e){t.exports=function(t){try{return!!t()}catch(t){return!0}}},function(t,e,n){var r=n(16);t.exports=function(t){return Object(r(t))}},function(t,e){t.exports=function(t){if(void 0==t)throw TypeError("Can't call method on  "+t);return t}},function(t,e,n){var r=n(45),i=n(30);t.exports=Object.keys||function(t){return r(t,i)}},function(t,e,n){var r=n(26),i=n(16);t.exports=function(t){return r(i(t))}},function(t,e){var n=Math.ceil,r=Math.floor;t.exports=function(t){return isNaN(t=+t)?0:(t>0?r:n)(t)}},function(t,e,n){var r=n(28)("keys"),i=n(29);t.exports=function(t){return r[t]||(r[t]=i(t))}},function(t,e){t.exports=!0},function(t,e,n){var r=n(6),i=n(0).document,o=r(i)&&r(i.createElement);t.exports=function(t){return o?i.createElement(t):{}}},function(t,e,n){var r=n(13).f,i=n(9),o=n(1)("toStringTag");t.exports=function(t,e,n){t&&!i(t=n?t:t.prototype,o)&&r(t,o,{configurable:!0,value:e})}},function(t,e,n){"use strict";var r=n(12);t.exports.f=function(t){return new function(t){var e,n;this.promise=new t(function(t,r){if(void 0!==e||void 0!==n)throw TypeError("Bad Promise constructor");e=t,n=r}),this.resolve=r(e),this.reject=r(n)}(t)}},function(t,e,n){"use strict";(function(t){Object.defineProperty(e,"__esModule",{value:!0});var r=a(n(42)),i=a(n(51)),o=a(n(79)),s=a(n(85)),c=a(n(86));function a(t){return t&&t.__esModule?t:{default:t}}e.default={name:"VueUeditorWrap",data:function(){return{editor:null,status:0,initValue:"",defaultConfig:{UEDITOR_HOME_URL:t.env.BASE_URL?t.env.BASE_URL+"UEditor/":"/static/UEditor/",enableAutoSave:!1}}},props:{mode:{type:String,default:"observer",validator:function(t){return-1!==["observer","listener"].indexOf(t)}},value:{type:String,default:""},config:{type:Object,default:function(){return{}}},init:{type:Function,default:function(){return function(){}}},destroy:{type:Boolean,default:!1},name:{type:String,default:""},observerDebounceTime:{type:Number,default:50,validator:function(t){return t>=20}},observerOptions:{type:Object,default:function(){return{attributes:!0,attributeFilter:["src","style","type","name"],characterData:!0,childList:!0,subtree:!0}}},forceInit:{type:Boolean,default:!1}},computed:{mixedConfig:function(){return(0,o.default)({},this.defaultConfig,this.config)}},methods:{registerButton:function(t){var e=t.name,n=t.icon,r=t.tip,i=t.handler,o=t.index,s=t.UE,c=void 0===s?window.UE:s;c.registerUI(e,function(t,e){t.registerCommand(e,{execCommand:function(){i(t,e)}});var o=new c.ui.Button({name:e,title:r,cssRules:"background-image: url("+n+") !important;background-size: cover;",onclick:function(){t.execCommand(e)}});return t.addListener("selectionchange",function(){var n=t.queryCommandState(e);-1===n?(o.setDisabled(!0),o.setChecked(!1)):(o.setDisabled(!1),o.setChecked(n))}),o},o,this.id)},_initEditor:function(){var t=this;this.$refs.script.id=this.id="editor_"+Math.random().toString(16).slice(-6),this.init(),this.$emit("beforeInit",this.id,this.mixedConfig),this.editor=window.UE.getEditor(this.id,this.mixedConfig),this.editor.addListener("ready",function(){t.status=2,t.$emit("ready",t.editor),t.editor.setContent(t.initValue),"observer"===t.mode&&window.MutationObserver?t._observerChangeListener():t._normalChangeListener()})},_checkDependencies:function(){var t=this;return new i.default(function(e,n){window.UE&&window.UEDITOR_CONFIG&&0!==(0,r.default)(window.UEDITOR_CONFIG).length&&window.UE.getEditor?e():window.$loadEnv?window.$loadEnv.on("scriptsLoaded",function(){e()}):(window.$loadEnv=new s.default,t._loadConfig().then(function(){return t._loadCore()}).then(function(){e(),window.$loadEnv.emit("scriptsLoaded")}))})},_loadConfig:function(){var t=this;return new i.default(function(e,n){if(window.UE&&window.UEDITOR_CONFIG&&0!==(0,r.default)(window.UEDITOR_CONFIG).length)e();else{var i=document.createElement("script");i.type="text/javascript",i.src=t.mixedConfig.UEDITOR_HOME_URL+"ueditor.config.js",document.getElementsByTagName("head")[0].appendChild(i),i.onload=function(){window.UE&&window.UEDITOR_CONFIG&&0!==(0,r.default)(window.UEDITOR_CONFIG).length?e():console.error("加载ueditor.config.js失败,请检查您的配置地址UEDITOR_HOME_URL填写是否正确!\n",i.src)}}})},_loadCore:function(){var t=this;return new i.default(function(e,n){if(window.UE&&window.UE.getEditor)e();else{var r=document.createElement("script");r.type="text/javascript",r.src=t.mixedConfig.UEDITOR_HOME_URL+"ueditor.all.min.js",document.getElementsByTagName("head")[0].appendChild(r),r.onload=function(){window.UE&&window.UE.getEditor?e():console.error("加载ueditor.all.min.js失败,请检查您的配置地址UEDITOR_HOME_URL填写是否正确!\n",r.src)}}})},_setContent:function(t){t===this.editor.getContent()||this.editor.setContent(t)},_normalChangeListener:function(){var t=this;this.editor.addListener("contentChange",function(){t.$emit("input",t.editor.getContent())})},_observerChangeListener:function(){var t=this;this.observer=new MutationObserver((0,c.default)(function(e){t.editor.document.getElementById("baidu_pastebin")||t.$emit("input",t.editor.getContent())},this.observerDebounceTime)),this.observer.observe(this.editor.body,this.observerOptions)}},beforeDestroy:function(){this.destroy&&this.editor&&this.editor.destroy&&this.editor.destroy(),this.observer&&this.observer.disconnect&&this.observer.disconnect()},watch:{value:{handler:function(e){var n=this;switch(this.status){case 0:this.status=1,this.initValue=e,(this.forceInit||void 0!==t&&t.client||"undefined"!=typeof window)&&this._checkDependencies().then(function(){n.$refs.script?n._initEditor():n.$nextTick(function(){return n._initEditor()})});break;case 1:this.initValue=e;break;case 2:this._setContent(e)}},immediate:!0}}}}).call(e,n(41))},function(t,e,n){var r=n(10);t.exports=Object("z").propertyIsEnumerable(0)?Object:function(t){return"String"==r(t)?t.split(""):Object(t)}},function(t,e,n){var r=n(19),i=Math.min;t.exports=function(t){return t>0?i(r(t),9007199254740991):0}},function(t,e,n){var r=n(2),i=n(0),o=i["__core-js_shared__"]||(i["__core-js_shared__"]={});(t.exports=function(t,e){return o[t]||(o[t]=void 0!==e?e:{})})("versions",[]).push({version:r.version,mode:n(21)?"pure":"global",copyright:"© 2018 Denis Pushkarev (zloirock.ru)"})},function(t,e){var n=0,r=Math.random();t.exports=function(t){return"Symbol(".concat(void 0===t?"":t,")_",(++n+r).toString(36))}},function(t,e){t.exports="constructor,hasOwnProperty,isPrototypeOf,propertyIsEnumerable,toLocaleString,toString,valueOf".split(",")},function(t,e){t.exports=function(t,e){return{enumerable:!(1&t),configurable:!(2&t),writable:!(4&t),value:e}}},function(t,e,n){"use strict";var r=n(21),i=n(4),o=n(56),s=n(5),c=n(8),a=n(57),u=n(23),f=n(60),l=n(1)("iterator"),d=!([].keys&&"next"in[].keys()),p=function(){return this};t.exports=function(t,e,n,h,v,m,_){a(n,e,h);var y,g,w,b=function(t){if(!d&&t in S)return S[t];switch(t){case"keys":case"values":return function(){return new n(this,t)}}return function(){return new n(this,t)}},x=e+" Iterator",E="values"==v,O=!1,S=t.prototype,T=S[l]||S["@@iterator"]||v&&S[v],C=T||b(v),L=v?E?b("entries"):C:void 0,j="Array"==e&&S.entries||T;if(j&&(w=f(j.call(new t)))!==Object.prototype&&w.next&&(u(w,x,!0),r||"function"==typeof w[l]||s(w,l,p)),E&&T&&"values"!==T.name&&(O=!0,C=function(){return T.call(this)}),r&&!_||!d&&!O&&S[l]||s(S,l,C),c[e]=C,c[x]=p,v)if(y={values:E?C:b("values"),keys:m?C:b("keys"),entries:L},_)for(g in y)g in S||o(S,g,y[g]);else i(i.P+i.F*(d||O),e,y);return y}},function(t,e,n){var r=n(0).document;t.exports=r&&r.documentElement},function(t,e,n){var r=n(10),i=n(1)("toStringTag"),o="Arguments"==r(function(){return arguments}());t.exports=function(t){var e,n,s;return void 0===t?"Undefined":null===t?"Null":"string"==typeof(n=function(t,e){try{return t[e]}catch(t){}}(e=Object(t),i))?n:o?r(e):"Object"==(s=r(e))&&"function"==typeof e.callee?"Arguments":s}},function(t,e,n){var r=n(3),i=n(12),o=n(1)("species");t.exports=function(t,e){var n,s=r(t).constructor;return void 0===s||void 0==(n=r(s)[o])?e:i(n)}},function(t,e,n){var r,i,o,s=n(11),c=n(71),a=n(33),u=n(22),f=n(0),l=f.process,d=f.setImmediate,p=f.clearImmediate,h=f.MessageChannel,v=f.Dispatch,m=0,_={},y=function(){var t=+this;if(_.hasOwnProperty(t)){var e=_[t];delete _[t],e()}},g=function(t){y.call(t.data)};d&&p||(d=function(t){for(var e=[],n=1;arguments.length>n;)e.push(arguments[n++]);return _[++m]=function(){c("function"==typeof t?t:Function(t),e)},r(m),m},p=function(t){delete _[t]},"process"==n(10)(l)?r=function(t){l.nextTick(s(y,t,1))}:v&&v.now?r=function(t){v.now(s(y,t,1))}:h?(o=(i=new h).port2,i.port1.onmessage=g,r=s(o.postMessage,o,1)):f.addEventListener&&"function"==typeof postMessage&&!f.importScripts?(r=function(t){f.postMessage(t+"","*")},f.addEventListener("message",g,!1)):r="onreadystatechange"in u("script")?function(t){a.appendChild(u("script")).onreadystatechange=function(){a.removeChild(this),y.call(t)}}:function(t){setTimeout(s(y,t,1),0)}),t.exports={set:d,clear:p}},function(t,e){t.exports=function(t){try{return{e:!1,v:t()}}catch(t){return{e:!0,v:t}}}},function(t,e,n){var r=n(3),i=n(6),o=n(24);t.exports=function(t,e){if(r(t),i(e)&&e.constructor===t)return e;var n=o.f(t);return(0,n.resolve)(e),n.promise}},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var r=n(25),i=n.n(r);for(var o in r)"default"!==o&&function(t){n.d(e,t,function(){return r[t]})}(o);var s=n(87),c=n(40)(i.a,s.a,!1,null,null,null);c.options.__file="src/components/vue-ueditor-wrap.vue",e.default=c.exports},function(t,e){t.exports=function(t,e,n,r,i,o){var s,c=t=t||{},a=typeof t.default;"object"!==a&&"function"!==a||(s=t,c=t.default);var u,f="function"==typeof c?c.options:c;if(e&&(f.render=e.render,f.staticRenderFns=e.staticRenderFns,f._compiled=!0),n&&(f.functional=!0),i&&(f._scopeId=i),o?(u=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),r&&r.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(o)},f._ssrRegister=u):r&&(u=r),u){var l=f.functional,d=l?f.render:f.beforeCreate;l?(f._injectStyles=u,f.render=function(t,e){return u.call(e),d(t,e)}):f.beforeCreate=d?[].concat(d,u):[u]}return{esModule:s,exports:c,options:f}}},function(t,e){var n,r,i=t.exports={};function o(){throw new Error("setTimeout has not been defined")}function s(){throw new Error("clearTimeout has not been defined")}function c(t){if(n===setTimeout)return setTimeout(t,0);if((n===o||!n)&&setTimeout)return n=setTimeout,setTimeout(t,0);try{return n(t,0)}catch(e){try{return n.call(null,t,0)}catch(e){return n.call(this,t,0)}}}!function(){try{n="function"==typeof setTimeout?setTimeout:o}catch(t){n=o}try{r="function"==typeof clearTimeout?clearTimeout:s}catch(t){r=s}}();var a,u=[],f=!1,l=-1;function d(){f&&a&&(f=!1,a.length?u=a.concat(u):l=-1,u.length&&p())}function p(){if(!f){var t=c(d);f=!0;for(var e=u.length;e;){for(a=u,u=[];++l<e;)a&&a[l].run();l=-1,e=u.length}a=null,f=!1,function(t){if(r===clearTimeout)return clearTimeout(t);if((r===s||!r)&&clearTimeout)return r=clearTimeout,clearTimeout(t);try{r(t)}catch(e){try{return r.call(null,t)}catch(e){return r.call(this,t)}}}(t)}}function h(t,e){this.fun=t,this.array=e}function v(){}i.nextTick=function(t){var e=new Array(arguments.length-1);if(arguments.length>1)for(var n=1;n<arguments.length;n++)e[n-1]=arguments[n];u.push(new h(t,e)),1!==u.length||f||c(p)},h.prototype.run=function(){this.fun.apply(null,this.array)},i.title="browser",i.browser=!0,i.env={},i.argv=[],i.version="",i.versions={},i.on=v,i.addListener=v,i.once=v,i.off=v,i.removeListener=v,i.removeAllListeners=v,i.emit=v,i.prependListener=v,i.prependOnceListener=v,i.listeners=function(t){return[]},i.binding=function(t){throw new Error("process.binding is not supported")},i.cwd=function(){return"/"},i.chdir=function(t){throw new Error("process.chdir is not supported")},i.umask=function(){return 0}},function(t,e,n){t.exports={default:n(43),__esModule:!0}},function(t,e,n){n(44),t.exports=n(2).Object.keys},function(t,e,n){var r=n(15),i=n(17);n(48)("keys",function(){return function(t){return i(r(t))}})},function(t,e,n){var r=n(9),i=n(18),o=n(46)(!1),s=n(20)("IE_PROTO");t.exports=function(t,e){var n,c=i(t),a=0,u=[];for(n in c)n!=s&&r(c,n)&&u.push(n);for(;e.length>a;)r(c,n=e[a++])&&(~o(u,n)||u.push(n));return u}},function(t,e,n){var r=n(18),i=n(27),o=n(47);t.exports=function(t){return function(e,n,s){var c,a=r(e),u=i(a.length),f=o(s,u);if(t&&n!=n){for(;u>f;)if((c=a[f++])!=c)return!0}else for(;u>f;f++)if((t||f in a)&&a[f]===n)return t||f||0;return!t&&-1}}},function(t,e,n){var r=n(19),i=Math.max,o=Math.min;t.exports=function(t,e){return(t=r(t))<0?i(t+e,0):o(t,e)}},function(t,e,n){var r=n(4),i=n(2),o=n(14);t.exports=function(t,e){var n=(i.Object||{})[t]||Object[t],s={};s[t]=e(n),r(r.S+r.F*o(function(){n(1)}),"Object",s)}},function(t,e,n){t.exports=!n(7)&&!n(14)(function(){return 7!=Object.defineProperty(n(22)("div"),"a",{get:function(){return 7}}).a})},function(t,e,n){var r=n(6);t.exports=function(t,e){if(!r(t))return t;var n,i;if(e&&"function"==typeof(n=t.toString)&&!r(i=n.call(t)))return i;if("function"==typeof(n=t.valueOf)&&!r(i=n.call(t)))return i;if(!e&&"function"==typeof(n=t.toString)&&!r(i=n.call(t)))return i;throw TypeError("Can't convert object to primitive value")}},function(t,e,n){t.exports={default:n(52),__esModule:!0}},function(t,e,n){n(53),n(54),n(61),n(65),n(77),n(78),t.exports=n(2).Promise},function(t,e){},function(t,e,n){"use strict";var r=n(55)(!0);n(32)(String,"String",function(t){this._t=String(t),this._i=0},function(){var t,e=this._t,n=this._i;return n>=e.length?{value:void 0,done:!0}:(t=r(e,n),this._i+=t.length,{value:t,done:!1})})},function(t,e,n){var r=n(19),i=n(16);t.exports=function(t){return function(e,n){var o,s,c=String(i(e)),a=r(n),u=c.length;return a<0||a>=u?t?"":void 0:(o=c.charCodeAt(a))<55296||o>56319||a+1===u||(s=c.charCodeAt(a+1))<56320||s>57343?t?c.charAt(a):o:t?c.slice(a,a+2):s-56320+(o-55296<<10)+65536}}},function(t,e,n){t.exports=n(5)},function(t,e,n){"use strict";var r=n(58),i=n(31),o=n(23),s={};n(5)(s,n(1)("iterator"),function(){return this}),t.exports=function(t,e,n){t.prototype=r(s,{next:i(1,n)}),o(t,e+" Iterator")}},function(t,e,n){var r=n(3),i=n(59),o=n(30),s=n(20)("IE_PROTO"),c=function(){},a=function(){var t,e=n(22)("iframe"),r=o.length;for(e.style.display="none",n(33).appendChild(e),e.src="javascript:",(t=e.contentWindow.document).open(),t.write("<script>document.F=Object<\/script>"),t.close(),a=t.F;r--;)delete a.prototype[o[r]];return a()};t.exports=Object.create||function(t,e){var n;return null!==t?(c.prototype=r(t),n=new c,c.prototype=null,n[s]=t):n=a(),void 0===e?n:i(n,e)}},function(t,e,n){var r=n(13),i=n(3),o=n(17);t.exports=n(7)?Object.defineProperties:function(t,e){i(t);for(var n,s=o(e),c=s.length,a=0;c>a;)r.f(t,n=s[a++],e[n]);return t}},function(t,e,n){var r=n(9),i=n(15),o=n(20)("IE_PROTO"),s=Object.prototype;t.exports=Object.getPrototypeOf||function(t){return t=i(t),r(t,o)?t[o]:"function"==typeof t.constructor&&t instanceof t.constructor?t.constructor.prototype:t instanceof Object?s:null}},function(t,e,n){n(62);for(var r=n(0),i=n(5),o=n(8),s=n(1)("toStringTag"),c="CSSRuleList,CSSStyleDeclaration,CSSValueList,ClientRectList,DOMRectList,DOMStringList,DOMTokenList,DataTransferItemList,FileList,HTMLAllCollection,HTMLCollection,HTMLFormElement,HTMLSelectElement,MediaList,MimeTypeArray,NamedNodeMap,NodeList,PaintRequestList,Plugin,PluginArray,SVGLengthList,SVGNumberList,SVGPathSegList,SVGPointList,SVGStringList,SVGTransformList,SourceBufferList,StyleSheetList,TextTrackCueList,TextTrackList,TouchList".split(","),a=0;a<c.length;a++){var u=c[a],f=r[u],l=f&&f.prototype;l&&!l[s]&&i(l,s,u),o[u]=o.Array}},function(t,e,n){"use strict";var r=n(63),i=n(64),o=n(8),s=n(18);t.exports=n(32)(Array,"Array",function(t,e){this._t=s(t),this._i=0,this._k=e},function(){var t=this._t,e=this._k,n=this._i++;return!t||n>=t.length?(this._t=void 0,i(1)):i(0,"keys"==e?n:"values"==e?t[n]:[n,t[n]])},"values"),o.Arguments=o.Array,r("keys"),r("values"),r("entries")},function(t,e){t.exports=function(){}},function(t,e){t.exports=function(t,e){return{value:e,done:!!t}}},function(t,e,n){"use strict";var r,i,o,s,c=n(21),a=n(0),u=n(11),f=n(34),l=n(4),d=n(6),p=n(12),h=n(66),v=n(67),m=n(35),_=n(36).set,y=n(72)(),g=n(24),w=n(37),b=n(73),x=n(38),E=a.TypeError,O=a.process,S=O&&O.versions,T=S&&S.v8||"",C=a.Promise,L="process"==f(O),j=function(){},k=i=g.f,P=!!function(){try{var t=C.resolve(1),e=(t.constructor={})[n(1)("species")]=function(t){t(j,j)};return(L||"function"==typeof PromiseRejectionEvent)&&t.then(j)instanceof e&&0!==T.indexOf("6.6")&&-1===b.indexOf("Chrome/66")}catch(t){}}(),M=function(t){var e;return!(!d(t)||"function"!=typeof(e=t.then))&&e},R=function(t,e){if(!t._n){t._n=!0;var n=t._c;y(function(){for(var r=t._v,i=1==t._s,o=0,s=function(e){var n,o,s,c=i?e.ok:e.fail,a=e.resolve,u=e.reject,f=e.domain;try{c?(i||(2==t._h&&D(t),t._h=1),!0===c?n=r:(f&&f.enter(),n=c(r),f&&(f.exit(),s=!0)),n===e.promise?u(E("Promise-chain cycle")):(o=M(n))?o.call(n,a,u):a(n)):u(r)}catch(t){f&&!s&&f.exit(),u(t)}};n.length>o;)s(n[o++]);t._c=[],t._n=!1,e&&!t._h&&U(t)})}},U=function(t){_.call(a,function(){var e,n,r,i=t._v,o=I(t);if(o&&(e=w(function(){L?O.emit("unhandledRejection",i,t):(n=a.onunhandledrejection)?n({promise:t,reason:i}):(r=a.console)&&r.error&&r.error("Unhandled promise rejection",i)}),t._h=L||I(t)?2:1),t._a=void 0,o&&e.e)throw e.v})},I=function(t){return 1!==t._h&&0===(t._a||t._c).length},D=function(t){_.call(a,function(){var e;L?O.emit("rejectionHandled",t):(e=a.onrejectionhandled)&&e({promise:t,reason:t._v})})},F=function(t){var e=this;e._d||(e._d=!0,(e=e._w||e)._v=t,e._s=2,e._a||(e._a=e._c.slice()),R(e,!0))},A=function(t){var e,n=this;if(!n._d){n._d=!0,n=n._w||n;try{if(n===t)throw E("Promise can't be resolved itself");(e=M(t))?y(function(){var r={_w:n,_d:!1};try{e.call(t,u(A,r,1),u(F,r,1))}catch(t){F.call(r,t)}}):(n._v=t,n._s=1,R(n,!1))}catch(t){F.call({_w:n,_d:!1},t)}}};P||(C=function(t){h(this,C,"Promise","_h"),p(t),r.call(this);try{t(u(A,this,1),u(F,this,1))}catch(t){F.call(this,t)}},(r=function(t){this._c=[],this._a=void 0,this._s=0,this._d=!1,this._v=void 0,this._h=0,this._n=!1}).prototype=n(74)(C.prototype,{then:function(t,e){var n=k(m(this,C));return n.ok="function"!=typeof t||t,n.fail="function"==typeof e&&e,n.domain=L?O.domain:void 0,this._c.push(n),this._a&&this._a.push(n),this._s&&R(this,!1),n.promise},catch:function(t){return this.then(void 0,t)}}),o=function(){var t=new r;this.promise=t,this.resolve=u(A,t,1),this.reject=u(F,t,1)},g.f=k=function(t){return t===C||t===s?new o(t):i(t)}),l(l.G+l.W+l.F*!P,{Promise:C}),n(23)(C,"Promise"),n(75)("Promise"),s=n(2).Promise,l(l.S+l.F*!P,"Promise",{reject:function(t){var e=k(this);return(0,e.reject)(t),e.promise}}),l(l.S+l.F*(c||!P),"Promise",{resolve:function(t){return x(c&&this===s?C:this,t)}}),l(l.S+l.F*!(P&&n(76)(function(t){C.all(t).catch(j)})),"Promise",{all:function(t){var e=this,n=k(e),r=n.resolve,i=n.reject,o=w(function(){var n=[],o=0,s=1;v(t,!1,function(t){var c=o++,a=!1;n.push(void 0),s++,e.resolve(t).then(function(t){a||(a=!0,n[c]=t,--s||r(n))},i)}),--s||r(n)});return o.e&&i(o.v),n.promise},race:function(t){var e=this,n=k(e),r=n.reject,i=w(function(){v(t,!1,function(t){e.resolve(t).then(n.resolve,r)})});return i.e&&r(i.v),n.promise}})},function(t,e){t.exports=function(t,e,n,r){if(!(t instanceof e)||void 0!==r&&r in t)throw TypeError(n+": incorrect invocation!");return t}},function(t,e,n){var r=n(11),i=n(68),o=n(69),s=n(3),c=n(27),a=n(70),u={},f={};(e=t.exports=function(t,e,n,l,d){var p,h,v,m,_=d?function(){return t}:a(t),y=r(n,l,e?2:1),g=0;if("function"!=typeof _)throw TypeError(t+" is not iterable!");if(o(_)){for(p=c(t.length);p>g;g++)if((m=e?y(s(h=t[g])[0],h[1]):y(t[g]))===u||m===f)return m}else for(v=_.call(t);!(h=v.next()).done;)if((m=i(v,y,h.value,e))===u||m===f)return m}).BREAK=u,e.RETURN=f},function(t,e,n){var r=n(3);t.exports=function(t,e,n,i){try{return i?e(r(n)[0],n[1]):e(n)}catch(e){var o=t.return;throw void 0!==o&&r(o.call(t)),e}}},function(t,e,n){var r=n(8),i=n(1)("iterator"),o=Array.prototype;t.exports=function(t){return void 0!==t&&(r.Array===t||o[i]===t)}},function(t,e,n){var r=n(34),i=n(1)("iterator"),o=n(8);t.exports=n(2).getIteratorMethod=function(t){if(void 0!=t)return t[i]||t["@@iterator"]||o[r(t)]}},function(t,e){t.exports=function(t,e,n){var r=void 0===n;switch(e.length){case 0:return r?t():t.call(n);case 1:return r?t(e[0]):t.call(n,e[0]);case 2:return r?t(e[0],e[1]):t.call(n,e[0],e[1]);case 3:return r?t(e[0],e[1],e[2]):t.call(n,e[0],e[1],e[2]);case 4:return r?t(e[0],e[1],e[2],e[3]):t.call(n,e[0],e[1],e[2],e[3])}return t.apply(n,e)}},function(t,e,n){var r=n(0),i=n(36).set,o=r.MutationObserver||r.WebKitMutationObserver,s=r.process,c=r.Promise,a="process"==n(10)(s);t.exports=function(){var t,e,n,u=function(){var r,i;for(a&&(r=s.domain)&&r.exit();t;){i=t.fn,t=t.next;try{i()}catch(r){throw t?n():e=void 0,r}}e=void 0,r&&r.enter()};if(a)n=function(){s.nextTick(u)};else if(!o||r.navigator&&r.navigator.standalone)if(c&&c.resolve){var f=c.resolve(void 0);n=function(){f.then(u)}}else n=function(){i.call(r,u)};else{var l=!0,d=document.createTextNode("");new o(u).observe(d,{characterData:!0}),n=function(){d.data=l=!l}}return function(r){var i={fn:r,next:void 0};e&&(e.next=i),t||(t=i,n()),e=i}}},function(t,e,n){var r=n(0).navigator;t.exports=r&&r.userAgent||""},function(t,e,n){var r=n(5);t.exports=function(t,e,n){for(var i in e)n&&t[i]?t[i]=e[i]:r(t,i,e[i]);return t}},function(t,e,n){"use strict";var r=n(0),i=n(2),o=n(13),s=n(7),c=n(1)("species");t.exports=function(t){var e="function"==typeof i[t]?i[t]:r[t];s&&e&&!e[c]&&o.f(e,c,{configurable:!0,get:function(){return this}})}},function(t,e,n){var r=n(1)("iterator"),i=!1;try{var o=[7][r]();o.return=function(){i=!0},Array.from(o,function(){throw 2})}catch(t){}t.exports=function(t,e){if(!e&&!i)return!1;var n=!1;try{var o=[7],s=o[r]();s.next=function(){return{done:n=!0}},o[r]=function(){return s},t(o)}catch(t){}return n}},function(t,e,n){"use strict";var r=n(4),i=n(2),o=n(0),s=n(35),c=n(38);r(r.P+r.R,"Promise",{finally:function(t){var e=s(this,i.Promise||o.Promise),n="function"==typeof t;return this.then(n?function(n){return c(e,t()).then(function(){return n})}:t,n?function(n){return c(e,t()).then(function(){throw n})}:t)}})},function(t,e,n){"use strict";var r=n(4),i=n(24),o=n(37);r(r.S,"Promise",{try:function(t){var e=i.f(this),n=o(t);return(n.e?e.reject:e.resolve)(n.v),e.promise}})},function(t,e,n){t.exports={default:n(80),__esModule:!0}},function(t,e,n){n(81),t.exports=n(2).Object.assign},function(t,e,n){var r=n(4);r(r.S+r.F,"Object",{assign:n(82)})},function(t,e,n){"use strict";var r=n(17),i=n(83),o=n(84),s=n(15),c=n(26),a=Object.assign;t.exports=!a||n(14)(function(){var t={},e={},n=Symbol(),r="abcdefghijklmnopqrst";return t[n]=7,r.split("").forEach(function(t){e[t]=t}),7!=a({},t)[n]||Object.keys(a({},e)).join("")!=r})?function(t,e){for(var n=s(t),a=arguments.length,u=1,f=i.f,l=o.f;a>u;)for(var d,p=c(arguments[u++]),h=f?r(p).concat(f(p)):r(p),v=h.length,m=0;v>m;)l.call(p,d=h[m++])&&(n[d]=p[d]);return n}:a},function(t,e){e.f=Object.getOwnPropertySymbols},function(t,e){e.f={}.propertyIsEnumerable},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=function(){this.listeners={},this.on=function(t,e){void 0===this.listeners[t]&&(this.listeners[t]=[]),this.listeners[t].push(e)},this.emit=function(t){this.listeners[t]&&this.listeners[t].forEach(function(t){return t()})}}},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=function(t,e){var n=null;return function(){var r=this,i=arguments;n&&clearTimeout(n),n=setTimeout(function(){t.apply(r,i)},e)}}},function(t,e,n){"use strict";var r=function(){var t=this.$createElement;return(this._self._c||t)("script",{ref:"script",attrs:{name:this.name,type:"text/plain"}})};r._withStripped=!0;var i={render:r,staticRenderFns:[]};e.a=i}]).default})},"695c":function(t,e,n){"use strict";n.r(e);var r=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("div",{staticClass:"search_bar"},[n("el-button",{attrs:{type:"default",icon:"el-icon-arrow-left"},on:{click:function(e){t.goBack()}}},[t._v("返回")]),n("el-button",{attrs:{type:"info"},on:{click:function(e){t.showPreview()}}},[t._v("预览")]),n("el-button",{attrs:{type:"info"},on:{click:function(e){t.submit(0)}}},[t._v(t._s(1==t.add_data.is_show?"撤销发布":"保存草稿"))]),n("el-button",{attrs:{type:"primary"},on:{click:function(e){t.submit(1)}}},[t._v(t._s("set"==t.mode?"确认修改并发布":"确认发布"))]),n("el-breadcrumb",{attrs:{"separator-class":"el-icon-arrow-right"}},[n("el-breadcrumb-item",{attrs:{to:{path:"/index"}}},[t._v("首页")]),n("el-breadcrumb-item",[t._v("学法文章编辑")])],1)],1),n("el-form",{staticStyle:{background:"#fff",padding:"20px"},attrs:{"label-width":"90px"},nativeOn:{submit:function(t){t.preventDefault()}}},[n("el-form-item",{attrs:{label:"类别"}},[n("el-select",{attrs:{placeholder:"请选择"},model:{value:t.add_data.type,callback:function(e){t.$set(t.add_data,"type",e)},expression:"add_data.type"}},t._l(t.type_list,function(t){return n("el-option",{key:t.id,attrs:{label:t.title,value:t.id}})}),1)],1),n("el-form-item",{attrs:{label:"标题"}},[n("el-input",{model:{value:t.add_data.title,callback:function(e){t.$set(t.add_data,"title",e)},expression:"add_data.title"}})],1),n("el-form-item",{staticStyle:{width:"340px"},attrs:{label:"标签"}},[n("el-input",{staticStyle:{width:"200px"},model:{value:t.add_data.tag,callback:function(e){t.$set(t.add_data,"tag",e)},expression:"add_data.tag"}}),n("el-color-picker",{staticStyle:{float:"right"},attrs:{predefine:t.predefineColors},model:{value:t.add_data.tag_color,callback:function(e){t.$set(t.add_data,"tag_color",e)},expression:"add_data.tag_color"}})],1),n("el-form-item",{attrs:{label:"内容简介"}},[n("el-input",{attrs:{type:"textarea"},model:{value:t.add_data.abstract,callback:function(e){t.$set(t.add_data,"abstract",e)},expression:"add_data.abstract"}})],1),n("el-form-item",{attrs:{label:"默认浏览量"}},[n("el-input",{model:{value:t.add_data.views,callback:function(e){t.$set(t.add_data,"views",e)},expression:"add_data.views"}})],1),n("el-form-item",{attrs:{label:"标题图片"}},[n("el-upload",{staticClass:"avatar-uploader",attrs:{action:t.ServerUrl+"articles/upload","show-file-list":!1,"on-success":t.upPicSuccess}},[t.add_data.title_picture&&0!=t.add_data.title_picture?n("img",{staticClass:"upload-picture",attrs:{src:t.ImgUrl+t.add_data.title_picture}}):n("i",{staticClass:"el-icon-plus avatar-uploader-icon"})])],1),n("div",{ref:"editor"}),n("vue-ueditor-wrap",{model:{value:t.content,callback:function(e){t.content=e},expression:"content"}})],1),n("el-dialog",{attrs:{title:"预览",visible:t.is_show_preview,width:"410px"},on:{"update:visible":function(e){t.is_show_preview=e}}},[n("div",{staticClass:"preview_title"},[t._v("iPhone6屏幕尺寸")]),n("div",{staticClass:"preview_box",domProps:{innerHTML:t._s(t.preview_data)}})])],1)},i=[],o=n("32f6"),s=o["a"],c=n("2877"),a=Object(c["a"])(s,r,i,!1,null,null,null);a.options.__file="articles_edit.vue";e["default"]=a.exports},"7f7f":function(t,e,n){var r=n("86cc").f,i=Function.prototype,o=/^\s*function ([^ (]*)/,s="name";s in i||n("9e1e")&&r(i,s,{configurable:!0,get:function(){try{return(""+this).match(o)[1]}catch(t){return""}}})},ac6a:function(t,e,n){for(var r=n("cadf"),i=n("0d58"),o=n("2aba"),s=n("7726"),c=n("32e9"),a=n("84f2"),u=n("2b4c"),f=u("iterator"),l=u("toStringTag"),d=a.Array,p={CSSRuleList:!0,CSSStyleDeclaration:!1,CSSValueList:!1,ClientRectList:!1,DOMRectList:!1,DOMStringList:!1,DOMTokenList:!0,DataTransferItemList:!1,FileList:!1,HTMLAllCollection:!1,HTMLCollection:!1,HTMLFormElement:!1,HTMLSelectElement:!1,MediaList:!0,MimeTypeArray:!1,NamedNodeMap:!1,NodeList:!0,PaintRequestList:!1,Plugin:!1,PluginArray:!1,SVGLengthList:!1,SVGNumberList:!1,SVGPathSegList:!1,SVGPointList:!1,SVGStringList:!1,SVGTransformList:!1,SourceBufferList:!1,StyleSheetList:!0,TextTrackCueList:!1,TextTrackList:!1,TouchList:!1},h=i(p),v=0;v<h.length;v++){var m,_=h[v],y=p[_],g=s[_],w=g&&g.prototype;if(w&&(w[f]||c(w,f,d),w[l]||c(w,l,_),a[_]=d,y))for(m in r)w[m]||o(w,m,r[m],!0)}}}]);