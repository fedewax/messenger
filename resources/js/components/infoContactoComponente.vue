<template>
    <b-col cols="4">
                     <b-img v-if="imagen_contacto == null" v-bind:src="'../../../imagenes/noProfile.png'" v-bind="mainProps" rounded="circle"  alt="Circle image"/>
               <b-img v-else rounded="circle" v-bind="mainProps" v-bind:src="'../../../imagenes/'+imagen_contacto" alt="Circle image"/>
                     <p>Usuario seleccioando</p>
                     <strong>{{ nombre_contacto }}</strong>
                     <hr>
                     <b-form-checkbox>Desactivar las notificaciones</b-form-checkbox>
    </b-col>
</template>
<script>
export default {
    props : {
        nombre_contacto : String,
        imagen_contacto :String
    },
    data() {
        return {
            mainProps: { width: 70, height: 70 }
        }
    },

                   
}
</script>

