<template>
<b-container fluid style="height: 83%">
   <b-row>
        <b-col cols="4">
            <!--aqui mandamos llamar al metedo conversacionSeleccionada del componente lista-contactos -->    
           <lista-contactos-componente v-on:conversacionSeleccionada="cargarConversacion($event)"
           :dMensaje="dMensaje">
           <!--v-on:listaDeConversaciones="listaDeConversaciones($event)"-->
           </lista-contactos-componente>
        </b-col>       

        <b-col cols="8">
           <conversacion-componente
           v-on:_datosMensaje="datosMensaje($event)"
           v-if="datosConversacion" 
           :contacto_id="datosConversacion.contacto_id"
           :nombre_contacto="datosConversacion.nombre_contacto"
           :mensajes="mensajes">
           </conversacion-componente>
        </b-col>
   </b-row>
</b-container>
</template>
<script>
export default {
    props:{
        user_id: Number
    },
    data() {
        return {
            datosConversacion : null,
            mensaje : "",
            mensajes : [],
            dMensaje : null
        }
    },
    methods: {
        cargarConversacion(conversacion) {
            this.datosConversacion = conversacion;
            this.listarMensajes();
        },
        listarMensajes(){
            axios.get('/mensajes?contacto_id='+this.datosConversacion.contacto_id)
            .then((response) => {
                this.mensajes = response.data;
            });
        },
        datosMensaje(_mensaje){
            const mensaje = _mensaje 
            this.dMensaje = mensaje;
            if(this.datosConversacion != null)
            {
                if(this.datosConversacion.contacto_id == _mensaje.emisor_id
                || this.datosConversacion.contacto_id == _mensaje.receptor_id)
                {
                   this.mensajes.push(mensaje);
                }
            }
        }
    },
    mounted() {
        Echo.private(`users.${this.user_id}`)
    		    .listen('eventMensajeEnviado', data => {
                 const mensaje = data.mensaje;
                 mensaje.escrito_por_mi = false;
                 this.datosMensaje(mensaje);
    		    });
    }
}
</script>

