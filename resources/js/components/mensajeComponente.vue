<template>
        <b-media :right-align="miMensaje" vertical-align="center" class="mb-2">
                <b-img v-if="miMensaje" v-bind="mainProps" v-bind:src="'../../../imagenes/'+imagen_usuario" rounded alt="Rounded image" slot="aside" />
                <b-img v-else v-bind="mainProps" v-bind:src="'../../../imagenes/'+imagen_contacto" rounded alt="Rounded image" slot="aside" />
                
                
                    <b-alert v-if="miMensaje" show variant="info" >{{mensaje}}</b-alert>
          
                    <b-alert v-else show variant="secondary" >{{mensaje}}</b-alert>
              
        </b-media>    
</template>
<script>
export default {
    props: {
        miMensaje : Boolean,
        mensaje : String,
        imagen_contacto : String,
        usuario_id : Number,
        imagen_usuario :String
    },
    data() {
        return { 
              mainProps: { width: 65, height: 65 },
            
        }
    },
    methods: {
       
    },
    mounted() {
   
    },
}
</script>
