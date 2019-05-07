<template>  
    <b-list-group>
                <contacto-componente v-for="conversacion in conversacionesFiltradas" :key="conversacion.id"
                :conversacion="conversacion"
                :dMensaje="dMensaje"
                :selected="esSeleccionado(conversacion)"
                @click.native="seleccionarConversacion(conversacion)">
                </contacto-componente>
    </b-list-group>
</template>
<script>
export default {
    props:{
        dMensaje : Object,
    }, 
    methods: {
        seleccionarConversacion(conversacion){
            this.$store.dispatch('listarMensajes', conversacion);
        },
        esSeleccionado(conversacion){  
            if(this.datosConversacion)
                this.datosConversacion.id === conversacion.id;
            else
                return false;
        }
    },
    computed: {
        datosConversacion(){     
            return this.$store.state.datosConversacion;
        },
        conversacionesFiltradas(){
            return this.$store.getters.conversacionesFiltradas;
        }
    },
}
</script>

