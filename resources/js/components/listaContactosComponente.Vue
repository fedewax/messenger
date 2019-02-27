<template>
<div>
    <b-form class="my-3 mx-2">
                <b-form-input class="text-center" type="text" placeholder="Buscar contacto">
                </b-form-input>
    </b-form>
    <b-list-group>
                <contacto-componente v-for="conversacion in conversaciones" :key="conversacion.id"
                :conversacion="conversacion"
                @click.native="seleccionarConversacion(conversacion)">
                </contacto-componente>
    </b-list-group>
</div>
</template>
<script>
export default {
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
            });
        },
        seleccionarConversacion(){
            console.log("hola");
        }
    },
    mounted() {
        this.listarConversaciones();
    },
}
</script>

