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
                           :mensaje ="mensaje.contenido"
                           :imagen_contacto="imagen_contacto"
                           :imagen_usuario="imagen_usuario"
                           :usuario_id="usuario_id">
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
               <info-contacto-componente :nombre_contacto="nombre_contacto"
               :imagen_contacto="imagen_contacto">
               </info-contacto-componente>
        </b-row>
    </div>
</template>
<script>
export default {
    props:{
        imagen_contacto : String,
        contacto_id : Number,
        nombre_contacto : String,
        usuario_id : Number
    },
    data() {
        return {
            mensaje : '',
            imagen_usuario: ''
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
         obtenerImagen(){
             axios.get('/usuarios/imagenUsuario?id='+this.usuario_id)
            .then((response) => {
                let imagen = response.data.imagen;
                this.imagen_usuario = imagen;
            });
        },
        scrollAbajo(){
            const a = document.querySelector('.card-body-cls');
            a.scrollTop = a.scrollHeight;
        }
    },
    mounted() {
            this.obtenerImagen();
    },
    updated() {
        this.scrollAbajo();
    },
    //el watch sirve para ver cambos en variables props si cambia el vor de contato_id de la conversacion
    //volvemos a listar los mensajes de la nueva conversacion selecionada
    //watch: {
      //  contacto_id(){
      //    this.listarMensajes();
      //  }
    //},
    computed: {
        mensajes(){
            //el state es solo para usar los datos sin modificarlos
            return this.$store.state.mensajes;
        }
    }
}
</script>
