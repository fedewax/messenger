<template>
<b-container fluid style="height: 83%">
   <b-row>
        <b-col cols="4">
            <!--aqui mandamos llamar al metedo conversacionSeleccionada del componente lista-contactos -->    
           <lista-contactos-componente v-on:conversacionSeleccionada="cargarConversacion($event)">
           </lista-contactos-componente>
        </b-col>       

        <b-col cols="8">
           <conversacion-componente 
           v-if="datosConversacion" 
           :contacto_id="datosConversacion.contacto_id">
           </conversacion-componente>
        </b-col>
   </b-row>
</b-container>
</template>
<script>
export default {
    data() {
        return {
            datosConversacion : null
        }
    },
    methods: {
        cargarConversacion(conversacion) {
            this.datosConversacion = conversacion;
        }
    }
}
</script>

