<template>
<div>
    <b-form class="my-3 mx-2">
                <b-form-input class="text-center" type="text" placeholder="Buscar contacto">
                </b-form-input>
    </b-form>
    <b-list-group>
                <contacto-componente v-for="conversacion in conversaciones" :key="conversacion.id"
                :conversacion="conversacion"
                :dMensaje="dMensaje"
                @click.native="seleccionarConversacion(conversacion)">
                </contacto-componente>
    </b-list-group>
</div>
</template>
<script>
export default {
    props:{
        dMensaje : Object
    }, 
    data() {
        return {
            conversaciones: []
        }
    },
    methods: {
        listarConversaciones(){
            axios.get('/conversaciones')
            .then((response) => {
                this.conversaciones = response.data;
                //this.$emit('listaDeConversaciones', this.conversaciones);
            });
        },
        seleccionarConversacion(conversacion){
            //si se ejecuta el metodo seleccionarConversacion mandamos ejecutar conversacion seleccionada desde el componente padre.
            this.$emit('conversacionSeleccionada',conversacion);
        }
    },
    mounted() {
        this.listarConversaciones();
    },
    watch: {
        dMensaje(){
            this.listarConversaciones();
        }
    }
}
</script>

