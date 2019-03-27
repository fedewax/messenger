<template>
    <b-col cols="4">
                            <b-img rounded="circle" blank width="60" heigth="60" blank-color="#777" alt="img" class="m-1"/>
                            <p>Usuario seleccioando</p>
                            <strong>{{ nombre_contacto }}</strong>
                            <hr>
                            <b-form-checkbox>Desactivar las notificaciones</b-form-checkbox>
    </b-col>
</template>
<script>
export default {
    props : {
        nombre_contacto : String
    }
}
</script>

