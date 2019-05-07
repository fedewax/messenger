<template>
<b-container fluid style="height: 83%">
   <b-row>
        <b-col cols="4">
            <b-conversacion-componente>

            </b-conversacion-componente>
            <!--aqui mandamos llamar al metedo conversacionSeleccionada del componente lista-contactos -->    
           <lista-contactos-componente
           :dMensaje="dMensaje">
           <!--v-on:listaDeConversaciones="listaDeConversaciones($event)"-->
           </lista-contactos-componente>
        </b-col>       

        <b-col cols="8">
           <conversacion-componente
           v-on:_datosMensaje="datosMensaje($event)"
           v-if="datosConversacion"
           :contacto_id="datosConversacion.contacto_id"
           :nombre_contacto="datosConversacion.nombre_contacto"
           :imagen_contacto="datosConversacion.imagen"
           :usuario_id="datosConversacion.usuario_id">
           </conversacion-componente>
        </b-col>
   </b-row>
</b-container>
</template>
<script>
export default {
    props:{
        user_id: Number
    },
    data() {
        return {
            dMensaje : null        
        }
    },
    methods: {
        datosMensaje(_mensaje){
            const mensaje = _mensaje 
            this.dMensaje = mensaje;
            if(this.datosConversacion != null)
            {
                if(this.datosConversacion.contacto_id == _mensaje.emisor_id
                || this.datosConversacion.contacto_id == _mensaje.receptor_id)
                {
                   this.$store.commit('agregarMensajeMuta', mensaje);
                }
            }
        },
        cambiarEstadoOnline(id, status){
                const params = {
                id : id,
                online : status
                };
                axios.post('/cambiarEstadoOnline',params);
        },
    },
    mounted() {
        this.$store.dispatch('listarConversaciones');
        Echo.private(`users.${this.user_id}`)
    		.listen('eventMensajeEnviado', data => {
                 const mensaje = data.mensaje;
                 mensaje.escrito_por_mi = false;
                 this.datosMensaje(mensaje);
                });
            
            Echo.join('messenger')
            .here((users)=>{
                //los que ya estan en el canala tambiene estan online  
                users.forEach((user) => this.cambiarEstadoOnline(user.id, true
                ));
                this.$store.dispatch('listarConversaciones');
            })
            .joining((user)=>{
                this.cambiarEstadoOnline(user.id,true);
                this.$store.dispatch('listarConversaciones');
            })
            .leaving((user)=>{
                this.cambiarEstadoOnline(user.id,false);
                this.$store.dispatch('listarConversaciones');
            });        
    },
    watch: {
        dMensaje(){
             this.$store.dispatch('listarConversaciones');
        }
    },
    computed: {
        datosConversacion(){
            return this.$store.state.datosConversacion;
        }

    },
}
</script>

