<template>
    <b-list-group-item  :variant="color">
        <b-row class="p-2" algin-h="center">
            <b-col cols="12" md="3" class="text-center">
                <b-img rounded="circle" blank width="60" heigth="60" blank-color="#777" alt="img" class="m-1"/>
            </b-col>
            <b-col cols="6" algin-self="center" class="d-none d-md-block">
                <p class="mb-1">{{ nombre }}</p>
                <p class="text-muted small mb-1">{{ ultimoMensaje }}</p>
            </b-col>
            <b-col cols="3" class="d-none d-md-block">
                <p class="text-muted small">{{ fechaHora }}</p>
            </b-col>
        </b-row>
    </b-list-group-item> 
  
</template>

<script>
    export default {
        props:[
            'color'
        ],
        data() {
            return {
               nombre: 'Federico',
               ultimoMensaje: 'Tu: Hasta luego',
               fechaHora : '1:37 pm',
             
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
