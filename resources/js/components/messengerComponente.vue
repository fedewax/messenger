<template>
<b-container fluid style="height: 83%">
   <b-row>
        <b-col cols="4">
            <!--aqui mandamos llamar al metedo conversacionSeleccionada del componente lista-contactos -->    
           <lista-contactos-componente v-on:conversacionSeleccionada="cargarConversacion($event)"
           :mensaje="mensaje"
>
           </lista-contactos-componente>
        </b-col>       

        <b-col cols="8">
           <conversacion-componente v-on:mensajeEnviado="nuevoMensaje($event)"
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
            mensajes : []
        }
    },
    methods: {
        cargarConversacion(conversacion) {
            this.datosConversacion = conversacion;
            this.listarMensajes();
        },
        nuevoMensaje(_mensaje) {
            this.mensaje = _mensaje;
        },
        listarMensajes(){
            axios.get('/mensajes?contacto_id='+this.datosConversacion.contacto_id)
            .then((response) => {
                this.mensajes = response.data;
            });
        },
        datosMensaje(mensaje){
            if(this.datosConversacion.contacto_id == mensaje.emisor_id
            || this.datosConversacion.contacto_id == mensaje.receptor_id)
            {
              this.mensajes.push(mensaje);
            }
        }
    },
    mounted() {
        Echo.channel(`users.${this.user_id}`)
    		    .listen('eventMensajeEnviado', data => {
                 const mensaje = data.mensaje;
                 mensaje.escrito_por_mi = false;
                 this.datosMensaje(mensaje);
    	    	 this.nuevoMensaje(mensaje.contenido);
    		    });
    }
}
</script>

