import{_ as p}from"./AppLayout.82a48274.js";import c from"./DeleteUserForm.88b22fdf.js";import l from"./LogoutOtherBrowserSessionsForm.a7d6a5cb.js";import{S as s}from"./SectionBorder.4430882c.js";import f from"./TwoFactorAuthenticationForm.eb95e321.js";import u from"./UpdatePasswordForm.2c6980e2.js";import d from"./UpdateProfileInformationForm.18a3e345.js";import{o as e,c as _,w as n,a as i,d as r,b as t,e as a,F as h}from"./app.3002f0d4.js";import"./_plugin-vue_export-helper.cdc0426e.js";import"./ActionSection.8ab32f5f.js";import"./SectionTitle.6d92b97b.js";import"./DangerButton.9521670f.js";import"./DialogModal.bae48aad.js";import"./Modal.ac25b7e6.js";import"./TextInput.6d86f531.js";import"./SecondaryButton.c336a36b.js";import"./ActionMessage.a6b2477e.js";import"./PrimaryButton.53bc5c91.js";import"./InputLabel.1095f9ed.js";import"./FormSection.fd96fee8.js";const g=i("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Profile ",-1),$={class:"max-w-7xl mx-auto py-10 sm:px-6 lg:px-8"},w={key:0},k={key:1},y={key:2},H={__name:"Show",props:{confirmsTwoFactorAuthentication:Boolean,sessions:Array},setup(m){return(o,x)=>(e(),_(p,{title:"Profile"},{header:n(()=>[g]),default:n(()=>[i("div",null,[i("div",$,[o.$page.props.jetstream.canUpdateProfileInformation?(e(),r("div",w,[t(d,{user:o.$page.props.user},null,8,["user"]),t(s)])):a("",!0),o.$page.props.jetstream.canUpdatePassword?(e(),r("div",k,[t(u,{class:"mt-10 sm:mt-0"}),t(s)])):a("",!0),o.$page.props.jetstream.canManageTwoFactorAuthentication?(e(),r("div",y,[t(f,{"requires-confirmation":m.confirmsTwoFactorAuthentication,class:"mt-10 sm:mt-0"},null,8,["requires-confirmation"]),t(s)])):a("",!0),t(l,{sessions:m.sessions,class:"mt-10 sm:mt-0"},null,8,["sessions"]),o.$page.props.jetstream.hasAccountDeletionFeatures?(e(),r(h,{key:3},[t(s),t(c,{class:"mt-10 sm:mt-0"})],64)):a("",!0)])])]),_:1}))}};export{H as default};
