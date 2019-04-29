<template>
<b-container fluid style="height: 83%">
   <b-row>
        <b-col cols="4">
             <b-form class="my-3 mx-2">
                <b-form-input class="text-center" type="text" v-model="buscar" placeholder="Buscar contacto">
                </b-form-input>
            </b-form>
            <!--aqui mandamos llamar al metedo conversacionSeleccionada del componente lista-contactos -->    
           <lista-contactos-componente v-on:conversacionSeleccionada="cargarConversacion($event)"
           :conversaciones="conversacionesFiltradas"
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
            datosConversacion : null,
            dMensaje : null,
            conversaciones : [],
            buscar: ''
        }
    },
    methods: {
        cargarConversacion(conversacion) {
            this.datosConversacion = conversacion;
            this.listarMensajes();
        },
         listarConversaciones(){
            axios.get('/conversaciones')
            .then((response) => {
                this.conversaciones = response.data;
            });
            
        },
        listarMensajes(){
            axios.get('/mensajes?contacto_id='+this.datosConversacion.contacto_id)
            .then((response) => {
                this.$store.commit('mensajesMuta', response.data); 
            });
        },
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
                //const index = this.conversaciones.findIndex((conversacion) =>{
                //   return conversacion.contacto_id == user.id;
                //});
                //if(index >= 0)
                  //  Vue.set(this.conversaciones[index],'online', status);
                //alert(id,status);

                const params = {
                id : id,
                online : status
                };
                axios.post('/cambiarEstadoOnline',params);
                //.then((response)=>{
                  //  console.log(response.data);
                //});
        },
      
    },
    mounted() {
        this.listarConversaciones();
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
                this.listarConversaciones();
            })
            .joining((user)=>{
                this.cambiarEstadoOnline(user.id,true);
                this.listarConversaciones();
            })
            .leaving((user)=>{
                this.cambiarEstadoOnline(user.id,false);
                this.listarConversaciones();
            });        
    },
    watch: {
        dMensaje(){
            this.listarConversaciones();
        }
    },
    computed: {
        //metodo para hacer busqueda de conversaciones.
        conversacionesFiltradas() {
            //includes diferencia entre mayudsucas y minusculas usamos tolowerCase 
            return this.conversaciones.filter((conversacion)=> 
            conversacion.nombre_contacto.toLowerCase()
            .includes(this.buscar.toLowerCase()));
        },
    },
}
</script>

