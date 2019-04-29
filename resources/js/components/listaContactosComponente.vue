<template>  
    <b-list-group>
                <contacto-componente v-for="conversacion in conversaciones" :key="conversacion.id"
                :conversacion="conversacion"
                :dMensaje="dMensaje"
                :selected="selectedConversacionId === conversacion.id"
                @click.native="seleccionarConversacion(conversacion)">
                </contacto-componente>
    </b-list-group>
</template>
<script>
export default {
    props:{
        dMensaje : Object,
        conversaciones : Array
    }, 
    data() {
        return {
            selectedConversacionId : null
        }
    },
    methods: {
       
        seleccionarConversacion(conversacion){
            this.selectedConversacionId = conversacion.id
            //si se ejecuta el metodo seleccionarConversacion mandamos ejecutar conversacion seleccionada desde el componente padre.
            this.$emit('conversacionSeleccionada',conversacion);
        }
    },
    mounted() {
    }
    
}
</script>

