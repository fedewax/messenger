<template>
        <b-img rounded="circle" blank width="10" 
        heigth="10" 
        :title=" conversacionOnline ? 'Conectado' : 'desconectado' "
        :blank-color=" conversacionOnline ? 'green' : 'red' " 
        alt="img" class="m-1" />
</template>
<script>
export default {
    props:{
        conversacionOnline: Boolean
    }
}
</script>

