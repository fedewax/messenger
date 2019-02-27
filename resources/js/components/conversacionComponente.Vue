<template>
    <div>
        <b-row>
                <b-col cols="8">
                    <b-card footer-bg-variant="light"
                           footer-border-variant="dark"
                           title="Conversacion activa"
                           class="h-100">
                          
                           <mensaje-componente v-for="mensaje in mensajes" 
                           :key="mensaje.id"
                           :miMensaje="mensaje.escrito_por_mi">
                               {{mensaje.contenido}}
                           </mensaje-componente>
                       
                        <div slot="footer" >
                            <b-form class="mb-0" @submit.prevent="addMensaje" autocomplete="off">
                                <b-input-group>
                                    <b-form-input v-model="mensaje" type="text">
                                    </b-form-input>
                                    <b-input-group-append>
                                        <b-button type="submit" variant="primary">Enviar</b-button>  
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
        nombre_contacto : String
    },
    data() {
        return {
            mensajes : [],
            mensaje : '',
        }
    },
    methods: {
        listarMensajes(){
            axios.get('/mensajes?contacto_id='+this.contacto_id)
            .then((response) => {
                this.mensajes = response.data;
            });
        },
        addMensaje(){
            const params = {
                id : this.contacto_id,
                mensaje : this.mensaje 
            };
            axios.post('mensajes/agregar',params)
            .then((response)=>{
                this.listarMensajes();
                this.mensajeAgregado();
                this.mensaje = '';
               
            });
        },
        mensajeAgregado(){
            //si se ejecuta el metodo seleccionarConversacion mandamos ejecutar conversacion seleccionada desde el componente padre.
            this.$emit('mensajeEnviado',this.mensaje);
        }
    },
    mounted() {
       this.listarMensajes();
    },
    //el watch sirve para ver cambos en variables si cambia el valor de contato_id de la conversacion
    //volvemos a listar los mensajes de la nueva conversacion selecionada
    watch: {
        contacto_id(){
            this.listarMensajes();
        }
    },
}
</script>
