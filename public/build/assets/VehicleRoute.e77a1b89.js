import{d as x,o as r,c as L,w as $,a as e,e as i,t as d,f as u,i as g,F as _,h as s,g as F,v as c,K as k,D as m,x as C,y}from"./app.5f52fafc.js";import{_ as T}from"./AppLayout.d74536ab.js";import"./_plugin-vue_export-helper.cdc0426e.js";const j={class:"py-12"},N={class:"max-w-7xl mx-auto sm:px-6 lg:px-8"},S={class:"bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4"},A={key:0,class:"bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3",role:"alert"},M={class:"flex"},R={class:"text-sm"},B={class:"table-fixed w-full"},I=e("thead",null,[e("tr",{class:"bg-gray-100"},[e("th",{class:"px-4 py-2 w-72"},"Registration Number"),e("th",{class:"px-4 py-2 w-24"},"Vehicle"),e("th",{class:"px-4 py-2 w-24"},"From"),e("th",{class:"px-4 py-2"},"To"),e("th",{class:"px-4 py-2"},"Driver"),e("th",{class:"px-4 py-2 w-44"},"Transmitter"),e("th",{class:"px-4 py-2"},"Status"),e("th",{class:"px-4 py-2 w-72"},"Action")])],-1),O={class:"border px-4 py-2"},z={class:"border px-4 py-2"},K={class:"border px-4 py-2"},P={class:"border px-4 py-2"},q={class:"border px-4 py-2"},G={class:"border px-4 py-2"},H={class:"border px-4 py-2"},J={class:"border px-4 py-2"},Q=["onClick"],W=["onClick"],X=["onClick"],Y={key:1,class:"fixed z-10 inset-0 overflow-y-auto ease-out duration-400"},Z={class:"flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"},ee=e("div",{class:"fixed inset-0 transition-opacity"},[e("div",{class:"absolute inset-0 bg-gray-500 opacity-75"})],-1),te=e("span",{class:"hidden sm:inline-block sm:align-middle sm:h-screen"},null,-1),oe={class:"inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full",role:"dialog","aria-modal":"true","aria-labelledby":"modal-headline"},se={class:"bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4"},le={class:""},ne={class:"mb-4"},re=e("label",{for:"vehicles",class:"block text-gray-700 text-sm font-bold mb-2"},"Vehicle:",-1),de=e("option",{value:"",disabled:"",selected:""},"Choose a Vehicle",-1),ie=["value"],ae={key:0,class:"text-red-500"},ue={class:"mb-4"},ce=e("label",{for:"transmitter",class:"block text-gray-700 text-sm font-bold mb-2"},"Transmitter:",-1),me=e("option",{value:"",disabled:"",selected:""},"Choose a Transmitter",-1),fe=["value"],he={key:0,class:"text-red-500"},be={class:"mb-4"},pe=e("label",{for:"from",class:"block text-gray-700 text-sm font-bold mb-2"},"From:",-1),xe={key:0,class:"text-red-500"},ge={class:"flex justify-between"},_e={class:"mb-4"},ye=e("label",{for:"from_long",class:"block text-gray-700 text-sm font-bold mb-2"},"From Longitude:",-1),ve={key:0,class:"text-red-500"},we={class:"mb-4"},ke=e("label",{for:"from_lat",class:"block text-gray-700 text-sm font-bold mb-2"},"from Latitude:",-1),Ce={key:0,class:"text-red-500"},Ve={class:"mb-4"},De=e("label",{for:"to",class:"block text-gray-700 text-sm font-bold mb-2"},"To:",-1),Ee={key:0,class:"text-red-500"},Ue={class:"flex justify-between"},Le={class:"mb-4"},$e=e("label",{for:"to_long",class:"block text-gray-700 text-sm font-bold mb-2"},"Destination Longitude:",-1),Fe={key:0,class:"text-red-500"},Te={class:"mb-4"},je=e("label",{for:"to_lat",class:"block text-gray-700 text-sm font-bold mb-2"},"Destination Latitude:",-1),Ne={key:0,class:"text-red-500"},Se={class:"mb-4"},Ae=e("label",{for:"driver",class:"block text-gray-700 text-sm font-bold mb-2"},"Driver:",-1),Me={key:0,class:"text-red-500"},Re={class:"bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"},Be={class:"flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto"},Ie={class:"flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto"},Oe={class:"mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto"},qe={__name:"VehicleRoute",props:{data:Array,errors:Object,vehicles:Array,transmitters:Array},setup(n){let f=x(!1),p=x(!1),l=x({vehicle_id:"",transmitter_id:""});function v(){p.value=!0}function h(){p.value=!1,b(),f.value=!1}function b(){l.value={vehicle_id:null,from:null,from_long:null,from_lat:null,to:null,to_long:null,to_lat:null,driver:null}}function V(a){y.Inertia.post("/routes",a,{onError:o=>{console.log(o)},onSuccess:o=>{b(),h(),f.value=!1}})}function D(a){l.value=Object.assign({},a),f.value=!0,v()}function E(a){a._method="PUT",delete a.vehicle,y.Inertia.post("/routes/"+a.id,a),b(),h()}function U(a){!confirm("Are you sure want to remove?")||(a._method="DELETE",y.Inertia.post("/routes/"+a.id,a),b(),h())}return(a,o)=>(r(),L(T,null,{default:$(()=>[e("div",j,[e("div",N,[e("div",S,[a.$page.props.flash.message?(r(),i("div",A,[e("div",M,[e("div",null,[e("p",R,d(a.$page.props.flash.message),1)])])])):u("",!0),e("button",{onClick:o[0]||(o[0]=t=>v()),class:"bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3"}," Create New Route "),e("table",B,[I,e("tbody",null,[(r(!0),i(_,null,g(n.data,t=>(r(),i("tr",{key:t.id},[e("td",O,d(t.reg_no),1),e("td",z,d(t.vehicle.name),1),e("td",K,d(t.from),1),e("td",P,d(t.to),1),e("td",q,d(t.driver),1),e("td",G,d(t.transmitter.imei_number),1),e("td",H,d(t.status),1),e("td",J,[e("button",{onClick:w=>D(t),class:"bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2"}," Edit ",8,Q),t.status==="on"?(r(),i("button",{key:0,onClick:w=>a.endRoute(t),class:"bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded mr-2"}," Finish ",8,W)):u("",!0),e("button",{onClick:w=>U(t),class:"bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"}," Delete ",8,X)])]))),128))])]),s(p)?(r(),i("div",Y,[e("div",Z,[ee,te,F("\u200B "),e("div",oe,[e("form",null,[e("div",se,[e("div",le,[e("div",ne,[re,c(e("select",{id:"vehicles",name:"vehicle",class:"shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline","onUpdate:modelValue":o[1]||(o[1]=t=>s(l).vehicle_id=t)},[de,(r(!0),i(_,null,g(n.vehicles,t=>(r(),i("option",{value:t.id,key:t.id},d(t.name),9,ie))),128))],512),[[k,s(l).vehicle_id]]),n.errors.vehicle_id?(r(),i("div",ae,d(n.errors.vehicle_id),1)):u("",!0)]),e("div",ue,[ce,c(e("select",{id:"transmitter",name:"transmitter",class:"shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline","onUpdate:modelValue":o[2]||(o[2]=t=>s(l).transmitter_id=t)},[me,(r(!0),i(_,null,g(n.transmitters,t=>(r(),i("option",{value:t.id,key:t.id},d(t.imei_number),9,fe))),128))],512),[[k,s(l).transmitter_id]]),n.errors.vehicle_id?(r(),i("div",he,d(n.errors.vehicle_id),1)):u("",!0)]),e("div",be,[pe,c(e("input",{type:"text",class:"shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline",id:"from",placeholder:"Enter From","onUpdate:modelValue":o[3]||(o[3]=t=>s(l).from=t)},null,512),[[m,s(l).from]]),n.errors.from?(r(),i("div",xe,d(n.errors.from),1)):u("",!0)]),e("div",ge,[e("div",_e,[ye,c(e("input",{type:"text",class:"shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline",id:"from",placeholder:"Enter From Longitude","onUpdate:modelValue":o[4]||(o[4]=t=>s(l).from_long=t)},null,512),[[m,s(l).from_long]]),n.errors.from_long?(r(),i("div",ve,d(n.errors.from_long),1)):u("",!0)]),e("div",we,[ke,c(e("input",{type:"text",class:"shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline",id:"from",placeholder:"Enter From Latitude","onUpdate:modelValue":o[5]||(o[5]=t=>s(l).from_lat=t)},null,512),[[m,s(l).from_lat]]),n.errors.from_lat?(r(),i("div",Ce,d(n.errors.from_lat),1)):u("",!0)])]),e("div",Ve,[De,c(e("input",{type:"text",class:"shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline",id:"to",placeholder:"Enter Destination","onUpdate:modelValue":o[6]||(o[6]=t=>s(l).to=t)},null,512),[[m,s(l).to]]),n.errors.to?(r(),i("div",Ee,d(n.errors.to),1)):u("",!0)]),e("div",Ue,[e("div",Le,[$e,c(e("input",{type:"text",class:"shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline",id:"to_long",placeholder:"Enter Destination Longitude","onUpdate:modelValue":o[7]||(o[7]=t=>s(l).to_long=t)},null,512),[[m,s(l).to_long]]),n.errors.to_long?(r(),i("div",Fe,d(n.errors.to_long),1)):u("",!0)]),e("div",Te,[je,c(e("input",{type:"text",class:"shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline",id:"to_lat",placeholder:"Enter Destination Latitude","onUpdate:modelValue":o[8]||(o[8]=t=>s(l).to_lat=t)},null,512),[[m,s(l).to_lat]]),n.errors.to_lat?(r(),i("div",Ne,d(n.errors.to_lat),1)):u("",!0)])]),e("div",Se,[Ae,c(e("input",{type:"text",class:"shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline",id:"driver",placeholder:"Enter Driver Name","onUpdate:modelValue":o[9]||(o[9]=t=>s(l).driver=t)},null,512),[[m,s(l).driver]]),n.errors.driver?(r(),i("div",Me,d(n.errors.driver),1)):u("",!0)])])]),e("div",Re,[e("span",Be,[c(e("button",{"wire:click.prevent":"store()",type:"button",class:"inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5",onClick:o[10]||(o[10]=t=>V(s(l)))}," Save ",512),[[C,!s(f)]])]),e("span",Ie,[c(e("button",{"wire:click.prevent":"store()",type:"button",class:"inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5",onClick:o[11]||(o[11]=t=>E(s(l)))}," Update ",512),[[C,s(f)]])]),e("span",Oe,[e("button",{onClick:o[12]||(o[12]=t=>h()),type:"button",class:"inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"}," Cancel ")])])])])])])):u("",!0)])])])]),_:1}))}};export{qe as default};
