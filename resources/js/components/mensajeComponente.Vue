<template>
    
                        <b-media :right-align="miMensaje" vertical-align="center" class="mb-2">
                            <b-img rounded="circle" slot="aside" blank blank-color="#ccc" 
                                   width="50" alt="placeholder"/>
                            <b-card><slot></slot></b-card>
                        </b-media>    
                      
</template>
<script>
export default {
    props: {
        miMensaje : Boolean
    },
    data() {
        return { 
        }
    },
    mounted() {
        console.log('hola mounted')
    },
}
</script>
