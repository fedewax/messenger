<template>
    
                        <b-media :right-align="miMensaje" vertical-align="center" class="mb-2">
                                <b-img v-bind="mainProps" rounded alt="Rounded image" slot="aside" />
                                <div v-if="miMensaje">
                                    <b-alert show variant="info" >{{mensaje}}</b-alert>
                                </div>
                                <div v-else>    
                                    <b-alert show variant="secondary" >{{mensaje}}</b-alert>
                                </div>
                        </b-media>    
                      
</template>
<script>
export default {
    props: {
        miMensaje : Boolean,
        mensaje : String
    },
    data() {
        return { 
              mainProps: { blank: true, blankColor: '#777', width: 65, height: 65, class: 'm1' }
        }
    },
    mounted() {
    },
}
</script>
