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
                            <b-form class="mb-0">
                                <b-input-group>
                                    <b-form-input type="text">
                                    </b-form-input>
                                    <b-input-group-append>
                                        <b-button variant="primary">Enviar</b-button>  
                                    </b-input-group-append>
                                </b-input-group>    
                            </b-form>
                        </div>
                    </b-card>         
                </b-col>
                <b-col cols="4">
                     <b-img rounded="circle" blank width="60" heigth="60" blank-color="#777" alt="img" class="m-1"/>
                     <p>Usuario seleccioando</p>
                     <hr>
                     <b-form-checkbox>Desactivar las notificaciones</b-form-checkbox>
                </b-col>
        </b-row>
    </div>
</template>
<script>
export default {
    data() {
        return {
            mensajes: []
        }
    },
    methods: {
        getMensajes(){
            axios.get('/mensajes')
            .then((response) => {
                console.log(response.data);
                this.mensajes = response.data;
            });
        }
    },
    mounted() {
       this.getMensajes();
    },
}
</script>
