import{d as x,o as r,c as N,w as E,a as e,e as i,t as d,f as u,i as $,F as D,h as o,g as T,v as c,D as f,x as v,y}from"./app.7d668e99.js";import{_ as j}from"./AppLayout.89d71980.js";import"./_plugin-vue_export-helper.cdc0426e.js";const U={class:"py-12"},B={class:"max-w-7xl mx-auto sm:px-6 lg:px-8"},M={class:"bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4"},O={key:0,class:"bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3",role:"alert"},P={class:"flex"},A={class:"text-sm"},I={class:"table-fixed w-full"},L=e("thead",null,[e("tr",{class:"bg-gray-100"},[e("th",{class:"px-4 py-2 w-60"},"Plate Number"),e("th",{class:"px-4 py-2"},"Name"),e("th",{class:"px-4 py-2"},"Type"),e("th",{class:"px-4 py-2"},"Driver"),e("th",{class:"px-4 py-2"},"Action")])],-1),S={class:"border px-4 py-2"},F={class:"border px-4 py-2"},z={class:"border px-4 py-2"},R={class:"border px-4 py-2"},q={class:"border px-4 py-2"},G=["onClick"],H=["onClick"],J={key:1,class:"fixed z-10 inset-0 overflow-y-auto ease-out duration-400"},K={class:"flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"},Q=e("div",{class:"fixed inset-0 transition-opacity"},[e("div",{class:"absolute inset-0 bg-gray-500 opacity-75"})],-1),W=e("span",{class:"hidden sm:inline-block sm:align-middle sm:h-screen"},null,-1),X={class:"inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full",role:"dialog","aria-modal":"true","aria-labelledby":"modal-headline"},Y={class:"bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4"},Z={class:""},ee={class:"mb-4"},te=e("label",{for:"name",class:"block text-gray-700 text-sm font-bold mb-2"},"Name:",-1),se={key:0,class:"text-red-500"},le={class:"mb-4"},oe=e("label",{for:"type",class:"block text-gray-700 text-sm font-bold mb-2"},"Type:",-1),ne={key:0,class:"text-red-500"},ae={class:"mb-4"},re=e("label",{for:"plate",class:"block text-gray-700 text-sm font-bold mb-2"},"Plate:",-1),de={key:0,class:"text-red-500"},ie={class:"mb-4"},ue=e("label",{for:"driver",class:"block text-gray-700 text-sm font-bold mb-2"},"Driver:",-1),ce={key:0,class:"text-red-500"},me={class:"bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"},pe={class:"flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto"},be={class:"flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto"},fe={class:"mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto"},ge={__name:"vessel",props:{data:Array,errors:Object},setup(a){let m=x(!1),h=x(!1),n=x({name:null,type:null,plate:null,driver:null,status:null,speed:null,fuel_level:null,mileage:null});function g(){h.value=!0}function p(){h.value=!1,b(),m.value=!1}function b(){n.value={name:null,type:null,plate:null,driver:null,status:null,speed:null,fuel_level:null,mileage:null}}function _(s){s.status="Vehicle Off",s.speed="0",s.fuel_level="0",s.mileage="0",y.Inertia.post("/vessels",s),b(),p(),m.value=!1}function w(s){n.value=Object.assign({},s),m.value=!0,g()}function k(s){s._method="PUT",y.Inertia.post("/vessels/"+s.id,s),b(),p()}function C(s){!confirm("Are you sure want to remove?")||(s._method="DELETE",y.Inertia.post("/vessels/"+s.id,s),b(),p())}return(s,l)=>(r(),N(j,null,{default:E(()=>[e("div",U,[e("div",B,[e("div",M,[s.$page.props.flash.message?(r(),i("div",O,[e("div",P,[e("div",null,[e("p",A,d(s.$page.props.flash.message),1)])])])):u("",!0),e("button",{onClick:l[0]||(l[0]=t=>g()),class:"bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3"}," Create New Vessel "),e("table",I,[L,e("tbody",null,[(r(!0),i(D,null,$(a.data,t=>(r(),i("tr",{key:t.id},[e("td",S,d(t.plate),1),e("td",F,d(t.name),1),e("td",z,d(t.type),1),e("td",R,d(t.driver),1),e("td",q,[e("button",{onClick:V=>w(t),class:"bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2"}," Edit ",8,G),e("button",{onClick:V=>C(t),class:"bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"}," Delete ",8,H)])]))),128))])]),o(h)?(r(),i("div",J,[e("div",K,[Q,W,T("\u200B "),e("div",X,[e("form",null,[e("div",Y,[e("div",Z,[e("div",ee,[te,c(e("input",{type:"text",class:"shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline",id:"name",placeholder:"Enter Vehicle Name","onUpdate:modelValue":l[1]||(l[1]=t=>o(n).name=t)},null,512),[[f,o(n).name]]),a.errors.name?(r(),i("div",se,d(a.errors.name),1)):u("",!0)]),e("div",le,[oe,c(e("textarea",{class:"shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline",id:"type","onUpdate:modelValue":l[2]||(l[2]=t=>o(n).type=t),placeholder:"Enter Type"},null,512),[[f,o(n).type]]),a.errors.type?(r(),i("div",ne,d(a.errors.type),1)):u("",!0)]),e("div",ae,[re,c(e("textarea",{class:"shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline",id:"plate","onUpdate:modelValue":l[3]||(l[3]=t=>o(n).plate=t),placeholder:"Enter Vehicle License/Plate Number"},null,512),[[f,o(n).plate]]),a.errors.plate?(r(),i("div",de,d(a.errors.plate),1)):u("",!0)]),e("div",ie,[ue,c(e("textarea",{class:"shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline",id:"driver","onUpdate:modelValue":l[4]||(l[4]=t=>o(n).driver=t),placeholder:"Enter Driver Name"},null,512),[[f,o(n).driver]]),a.errors.driver?(r(),i("div",ce,d(a.errors.driver),1)):u("",!0)])])]),e("div",me,[e("span",pe,[c(e("button",{"wire:click.prevent":"store()",type:"button",class:"inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5",onClick:l[5]||(l[5]=t=>_(o(n)))}," Save ",512),[[v,!o(m)]])]),e("span",be,[c(e("button",{"wire:click.prevent":"store()",type:"button",class:"inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5",onClick:l[6]||(l[6]=t=>k(o(n)))}," Update ",512),[[v,o(m)]])]),e("span",fe,[e("button",{onClick:l[7]||(l[7]=t=>p()),type:"button",class:"inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"}," Cancel ")])])])])])])):u("",!0)])])])]),_:1}))}};export{ge as default};
