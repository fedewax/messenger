<template>  
  
    <b-form class="my-3 mx-2">
        <b-form-input class="text-center" type="text" v-model="buscar" placeholder="Buscar contacto">
        </b-form-input>
    </b-form>
</template>
<script>
export default {
    computed: {
        buscar:{
            get(){ 
                return this.$store.state.buscar;
            },
            set(value){
                this.$store.commit('buscarMuta',value)
            }
        }
    }
}
</script>

