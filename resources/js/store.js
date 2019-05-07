import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);
export default new Vuex.Store({
    state: {
      mensajes : [],
      datosConversacion : null,
      conversaciones : [],
      buscar: '',
    },
    //hacer cambios sobre las variables state
    mutations: {
        mensajesMuta(state, mensajes){
            state.mensajes = mensajes;
        },
        agregarMensajeMuta(state,mensaje){
            state.mensajes.push(mensaje);
        },
        datosConversacion(state,conversacion){
            state.datosConversacion = conversacion;
        },
        buscarMuta(state, value){
            state.buscar = value;
        },
        conversacionesMuta(state,conversaciones){
            state.conversaciones = conversaciones;
        }


    },
    //hacer cambios asincronos sobres las variables states
    actions: {
        listarMensajes(context,conversacion){
            
            axios.get('/mensajes?contacto_id='+conversacion.contacto_id)
            .then((response) => {
                   //el commit es para esar las mutaciones y alterir los datos
                   context.commit('datosConversacion', conversacion);  
                   context.commit('mensajesMuta', response.data);

            });
        },
        listarConversaciones(context){
            axios.get('/conversaciones')
            .then((response) => {
                context.commit('conversacionesMuta', response.data);
            }); 
        }
    },
    //obtener ciertos datos de forma espesifica del state
    getters: {
        
        //metodo para hacer busqueda de conversaciones.
        conversacionesFiltradas(state) {
            return state.conversaciones.filter(
                conversacion => 
                    conversacion.nombre_contacto
                        .toLowerCase()
                        .includes(state.buscar.toLowerCase())
            );
        }
    }
});