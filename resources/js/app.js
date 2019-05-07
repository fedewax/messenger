

require('./bootstrap');

import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import store from './store' 
Vue.use(BootstrapVue);

Vue.component('contacto-componente', require('./components/contactoComponente.vue').default);
Vue.component('lista-contactos-componente', require('./components/listaContactosComponente.vue').default);
Vue.component('conversacion-componente', require('./components/conversacionComponente.vue').default);
Vue.component('mensaje-componente', require('./components/mensajeComponente.vue').default);
Vue.component('messenger-componente', require('./components/messengerComponente.vue').default);
Vue.component('messenger-componente', require('./components/messengerComponente.vue').default);
Vue.component('info-contacto-componente', require('./components/infoContactoComponente.vue').default);
Vue.component('config-perfil-componente', require('./components/configPerfilComponente.vue').default);
Vue.component('b-conversacion-componente', require('./components/bConversacionComponente.vue').default);




const app = new Vue({
    el: '#app',
    store,
    data() {
        return {
            menu : 0
        }
    },
    
    methods: {
        logout(id){
            
            const params = {
                id : id,
                online : false
                };

            axios.post('/cambiarEstadoOnline',params)
            .then((response)=>{ 

                document.getElementById('logout-form').submit();

            });
            
        }
    },
});
