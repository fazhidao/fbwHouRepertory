(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-7c1b4d1c"],{"28e9":function(t,s,a){"use strict";(function(t){a("cadf"),a("551c"),a("097d");s["a"]={data:function(){return{data:{users:["...","...","..."]}}},created:function(){6==t.user_class?this.getIndexData():5==t.user_class?this.$router.push("/clients/0"):this.$router.push("/ask_help_wait")},methods:{getIndexData:function(){var t=this;this.requestApi({url:"getIndexData",success:function(s){t.data=s}})}}}}).call(this,a("c8ba"))},"334e":function(t,s,a){},"37f9":function(t,s,a){"use strict";a.r(s);var i=function(){var t=this,s=t.$createElement,a=t._self._c||s;return a("div",[a("div",{staticClass:"num_box"},[a("div",{staticClass:"num_item"},[a("div",{staticClass:"num_title"},[t._v("普通用户注册人数")]),a("div",{staticClass:"num_value"},[t._v(t._s(t.data.users[0]))])]),a("div",{staticClass:"num_item"},[a("div",{staticClass:"num_title"},[t._v("企业注册数")]),a("div",{staticClass:"num_value"},[t._v(t._s(t.data.users[1]))])]),a("div",{staticClass:"num_item"},[a("div",{staticClass:"num_title"},[t._v("律师注册人数")]),a("div",{staticClass:"num_value"},[t._v(t._s(t.data.users[2]))])])]),a("div",{staticClass:"num_box"},[a("div",{staticClass:"num_item"},[a("div",{staticClass:"num_title"},[t._v("已处理法律咨询数")]),a("div",{staticClass:"num_value"},[t._v(t._s(t.data.ask_helps))])]),a("div",{staticClass:"num_item"},[a("div",{staticClass:"num_title"},[t._v("已受理案件委托数")]),a("div",{staticClass:"num_value"},[t._v(t._s(t.data.ask_entrusts))])])]),a("div",{staticClass:"num_box"},[a("div",{staticClass:"num_item",staticStyle:{width:"500px"}},[a("div",{staticClass:"num_title"},[t._v("已付款订单总额")]),a("div",{staticClass:"num_value"},[t._v("￥"+t._s((t.data.orders/100).toFixed(2)))])])])])},e=[],u=a("28e9"),n=u["a"],c=(a("e458"),a("2877")),l=Object(c["a"])(n,i,e,!1,null,"1f77ffa4",null);l.options.__file="index.vue";s["default"]=l.exports},e458:function(t,s,a){"use strict";var i=a("334e"),e=a.n(i);e.a}}]);