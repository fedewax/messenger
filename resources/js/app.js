

require('./bootstrap');

import Vue from 'vue'
import Vuex from 'vuex'
import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue);
Vue.use(Vuex);


Vue.component('contacto-componente', require('./components/contactoComponente.vue').default);
Vue.component('lista-contactos-componente', require('./components/listaContactosComponente.vue').default);
Vue.component('conversacion-componente', require('./components/conversacionComponente.vue').default);
Vue.component('mensaje-componente', require('./components/mensajeComponente.vue').default);
Vue.component('messenger-componente', require('./components/messengerComponente.vue').default);
Vue.component('messenger-componente', require('./components/messengerComponente.vue').default);
Vue.component('info-contacto-componente', require('./components/infoContactoComponente.vue').default);
Vue.component('config-perfil-componente', require('./components/configPerfilComponente.vue').default);

const store = new Vuex.Store({
    state: {
      mensajes : []
    },
    mutations: {
        mensajesMuta(state, mensajes){
            state.mensajes = mensajes;
        },
        agregarMensajeMuta(state,mensaje){
            state.mensajes.push(mensaje);
        }

    }
});

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
