<template>
<b-container fluid style="height: 83%">
   <b-row>
        <b-col cols="4">
            <!--aqui mandamos llamar al metedo conversacionSeleccionada del componente lista-contactos -->    
           <lista-contactos-componente v-on:conversacionSeleccionada="cargarConversacion($event)"
           :mensaje="mensaje">
           </lista-contactos-componente>
        </b-col>       

        <b-col cols="8">
           <conversacion-componente v-on:mensajeEnviado="nuevoMensaje($event)"
           v-if="datosConversacion" 
           :contacto_id="datosConversacion.contacto_id"
           :nombre_contacto="datosConversacion.nombre_contacto">
            </conversacion-componente>
        </b-col>
   </b-row>
</b-container>
</template>
<script>
export default {
    data() {
        return {
            datosConversacion : null,
            mensaje : ""
        }
    },
    methods: {
        cargarConversacion(conversacion) {
            this.datosConversacion = conversacion;
        },
        nuevoMensaje(_mensaje) {
            this.mensaje = _mensaje;
        }
    }
}
</script>

