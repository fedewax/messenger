<template>
    
                        <b-media :right-align="miMensaje" vertical-align="center" class="mb-2">
                            <b-img rounded="circle" slot="aside" blank blank-color="#ccc" 
                                   width="50" alt="placeholder"/>
                            <b-card>
                            <!--en lugar de pasar los valores por pros enviamos las propiedades y las mostramos en un slot-->
                            <slot></slot>
                            </b-card>
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
    },
}
</script>
