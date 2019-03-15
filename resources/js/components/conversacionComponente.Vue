<style>
    .card-body-cls{
        max-height: calc(100vh - 63px);
        overflow-y: auto;  
    }    
</style>
<template>
    <div>
        <b-row>
                <b-col cols="8">
                    <b-card no-body
                           footer-bg-variant="light"
                           footer-border-variant="dark"
                           title="Conversacion activa"
                           class="h-100">
                          
                          <b-card-body class="card-body-cls">
                           <mensaje-componente v-for="mensaje in mensajes" 
                           :key="mensaje.id"
                           :miMensaje="mensaje.escrito_por_mi"
                           :mensaje ="mensaje.contenido">
                           </mensaje-componente>
                          </b-card-body>
                        
                        <div slot="footer" >
                            <b-form class="mb-0" @submit.prevent="addMensaje" autocomplete="off">
                                <b-input-group>
                                    <b-form-input v-model="mensaje" type="text">
                                    </b-form-input>
                                    <b-input-group-append>
                                        <b-button type="submit" variant="info">Enviar</b-button>  
                                    </b-input-group-append>
                                </b-input-group>    
                            </b-form>
                        </div>
                        
                    </b-card>         
                </b-col>
                <b-col cols="4">
                     <b-img rounded="circle" blank width="60" heigth="60" blank-color="#777" alt="img" class="m-1"/>
                     <p>Usuario seleccioando</p>
                     <strong>{{ nombre_contacto }}</strong>
                     <hr>
                     <b-form-checkbox>Desactivar las notificaciones</b-form-checkbox>
                </b-col>
        </b-row>
    </div>
</template>
<script>
export default {
    props:{
        contacto_id : Number,
        nombre_contacto : String,
        mensajes: Array
    },
    data() {
        return {
            mensaje : ''
        }
    },
    methods: {
        addMensaje(){
            
            if(!this.mensaje)
            return;
            
            const params = {
                id : this.contacto_id,
                mensaje : this.mensaje 
            };
            axios.post('mensajes/agregar',params)
            .then((response)=>{
                const mensaje = response.data;
                mensaje.escrito_por_mi = true;
                this.$emit('_datosMensaje', mensaje);
                this.mensaje = '';
            });
            
        },
        scrollAbajo(){
            const a = document.querySelector('.card-body-cls');
            a.scrollTop = a.scrollHeight;
        }
    },
    mounted() {
    },
    updated() {
        this.scrollAbajo();
    },
    //el watch sirve para ver cambos en variables props si cambia el valor de contato_id de la conversacion
    //volvemos a listar los mensajes de la nueva conversacion selecionada
    //watch: {
      //  contacto_id(){
      //    this.listarMensajes();
      //  }
    //},
}
</script>
