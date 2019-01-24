

require('./bootstrap');

window.Vue = require('vue');

import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue);


Vue.component('contacto-componente', require('./components/contactoComponente.vue').default);
Vue.component('lista-contactos-componente', require('./components/listaContactosComponente.vue').default);
Vue.component('conversacion-componente', require('./components/conversacionComponente.vue').default);


const app = new Vue({
    el: '#app',
    methods: {
        logout(){
            document.getElementById('logout-form').submit();
        }
    },
});
