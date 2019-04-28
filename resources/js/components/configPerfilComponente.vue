<template>
            <b-container>
                   <b-row>
                    <b-col cols="6" md="6" sm="12">
                      <b-card border-variant="info">
                            
                            <i  slot="header" class="mt-2 fas fa-user-edit float-right"></i>
                            <p slot="header" class="mt-2" ><strong>INFORMACION PERSONAL</strong></p>

                            <b-row>
                               <b-col cols="6" md="12" sm="12"> 
                                    <b-button title="Editar perfil" class="float-right" variant="info" @click="mostrarModal()"><i class="fas fa-pencil-alt float-right"></i></b-button>                         
                                <p>Usuario: {{datosUsuario.name}}</p>   
                               
                                <hr/>
                               </b-col>
                            </b-row>

                            <p>Correo electronico: {{datosUsuario.email}}</p>
                            <hr/>
                            <b-img v-if="datosUsuario.imagen == null " v-bind="mainProps" v-bind:src="'../../../imagenes/noProfile.png'"  class="float-right" rounded alt="Rounded image"></b-img>
                            <b-img v-else v-bind="mainProps" v-bind:src="'../../../imagenes/'+datosUsuario.imagen"  class="float-right" rounded alt="Rounded image"></b-img>
                            <p >Imagen de perfil: </p>

                        </b-card>
                    </b-col>
                            
                    <b-col cols="6" md="6" sm="12"> 
                        <b-card border-variant="info">
                            
                            <i  slot="header" class="mt-2 fas fa-key float-right"></i>
                            
                            <p slot="header" class="mt-2" ><strong>RESTAURAR CONTRASEÑA</strong></p>
                            
                            <b-row class="my-1">
                                <b-col sm=4>
                                <label for="input-valid">Contraseña actual:</label>
                                </b-col>
                                <b-col sm="8" >
                                <b-form-input v-model="claveActual" type="password" placeholder="Contraseña actual"></b-form-input>
                                </b-col>
                            </b-row>
                            <hr/>

                            <b-row class="my-1">
                                <b-col sm=4>
                                <label for="input-valid">Nueva contraseña:</label>
                                </b-col>
                                <b-col sm="8" >
                                <b-form-input v-model="claveNueva" type="password" placeholder="Nueva contraseña"></b-form-input>
                                </b-col>
                            </b-row>
                            <hr/>

                             <b-row class="my-1 ">
                                <b-col sm=4>
                                <label for="input-valid">Confirmar nueva contraseña:</label>
                                </b-col>
                                <b-col sm="8" >
                                <b-form-input v-model="claveNueva2" type="password" placeholder="Confirmar nueva contraseña"></b-form-input>
                                <div v-show="camposVacios" class="form-group">
                                    <p style="color:red;">Completa todos los campos para continuar...</p>
                                </div>
                                <div v-show="claveCorta" class="form-group">
                                    <p style="color:red;">La contraseña debe tener minimio 6 digitos...</p>
                                </div>
                                <div v-show="clavesDiferentes" class="form-group">
                                    <p style="color:red;">La contraseñas nuevas contraseñas no coinciden...</p>
                                </div>
                            </b-col>
                                
                            </b-row>
                            <b-button variant="success" @click="mensajeContrasena()" class="float-right">Restaurar</b-button>
                           
                        </b-card>
                    </b-col>
                  </b-row>
                <!--Inicio de la ventana modal para  editar informacion de usuario-->
                <div>
                    <b-modal ref="my-modal" size="lg" hide-header>   
                    <!--header del modal-->
                           <button type="button" class="close" @click="ocultarModal()" aria-label="Close">
                           <span aria-hidden="true">×</span>
                           </button>
                           <h6 class="modal-title">EDITAR INFORMACION PERSONAL</h6>
                           <hr/>
                    <!--Cierrde del header-->
                        
                        <div>
                           <b-row class="my-1">
                                <b-col sm=4>
                                <label for="input-valid">Nombre de usaurio:</label>
                                </b-col>
                                <b-col sm="8" >
                                <b-form-input v-model="name" placeholder="Nombre de usaurio"></b-form-input>
                                </b-col>
                            </b-row>
                            <hr/>

                            <b-row class="my-1">
                                <b-col sm=4>
                                <label for="input-valid">Correo electronico:</label>
                                </b-col>
                                <b-col sm="8" >
                                <input type="email" v-model="email" @keyup="comprobarEmail()" placeholder="Correo electronico" class="form-control">
                                <div v-show="emailRegistrado" class="form-group">
                                    <p style="color:red;">Este correo electronico ya se encuentra en uso.</p>
                                </div>
                                <div v-show="errorEmail" class="form-group">
                                    <p style="color:red;">Por favor escriba un correo valido.</p>
                                </div>
                                </b-col>
                            </b-row>
                            <hr/>

                             <b-row class="my-1 ">
                                <b-col sm=4>
                                <label for="input-valid">Imagen de perfil:</label>
                                </b-col>
                                <b-col sm="8" >
                                    <b-form-file @change="onImageChange" 
                                        accept=".jpg, .png"
                                        v-model="file"
                                        :state="Boolean(file)"
                                        placeholder="Elige una imagen"
                                        browse-text="Buscar imagen"></b-form-file>
                                    
                                    <div class="mt-3">Imagen seleccionada: {{ file ? file.name : '' }}
                                        <button type="button" v-show="file" class="close" @click="file=null,url=null,imagen=''" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                
                                    <div id="preview">
                                        <b-img v-if="url" rounded alt="Rounded image" :src="url"> </b-img>
                                    </div>
                                </b-col>
                             </b-row>   
                        </div>
                        <div slot="modal-footer" class="w-100">
                            <b-button
                            variant="info"
                            size="md"
                            class="ml-2 float-right"
                            @click="actualizarUsuario()"
                            >
                            Guardar cambios
                            </b-button>
                            
                            <b-button
                            variant="Danger"
                            size="md"
                            class="float-right"
                            @click="ocultarModal()"
                            >
                            Cancelar
                            </b-button>
                        </div>
                    </b-modal>
                </div>
                <!--fin de la ventana modal-->
            </b-container>
</template>
<script>

import Swal from 'sweetalert2'

export default {
    
    props:{
        user_id : Number
    },
    data() {
        return {
            url: null,
            file : null,
            datosUsuario : [],
            name : '',
            email : '',
            id : 0,
            emailRegistrado : false, 
            mainProps : { width: 230, height: 130, class: 'm1' },
            imagen : '',
            errorEmail : false,
            claveActual : '',
            claveNueva : '',
            claveNueva2 : '',
            camposVacios : false,
            claveCorta : false,
            clavesDiferentes : false
        }
    },
   
    methods: {
        obtenerDatosUsuario(){
             axios.get('/usuarios/datosUsuario?id='+this.user_id)
            .then((response) => {
                this.datosUsuario = response.data;
                this.email = this.datosUsuario.email;
                this.name  = this.datosUsuario.name;
                this.id    = this.datosUsuario.id;
            });
        },
        actualizarUsuario(){
            if(!this.validEmail())
            {
                this.errorEmail = true;
                return;
            }
            if(this.emailRegistrado)
            return;
            const params = {
                email : this.email,
                name : this.name,
                id : this.id,
                imagen : this.imagen
            };
            axios.post('/usuarios/modificar',params)
            .then((response)=>{ 
                this.mensajeActualizar();
                this.ocultarModal();
                this.obtenerDatosUsuario();
            });
        },
        mostrarModal() {
            this.$refs['my-modal'].show();
        },
        ocultarModal() {
            this.$refs['my-modal'].hide();
            this.emailRegistrado = false;
            this.errorEmail = false;
            this.file = null;
            this.url = null;
            this.imagen = '';
        },
        comprobarEmail(){
            let me=this;
            var url= '/usuarios/comprobarEmail?email=' + this.email;
            axios.get(url).then(function (response) {
                var respuesta= response.data;
                me.emailRegistrado = respuesta;
            })  
            .catch(function (error) {
                console.log(error);
            });
        },
        onImageChange(e) {
                //estas dos lineas son para crear la imagen creo xd...
                const file = e.target.files[0];
                this.url = URL.createObjectURL(file);
                
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
        },
        createImage(file) {
            let reader = new FileReader();
            let me = this;
            reader.onload = (e) => {
                me.imagen = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        mensajeActualizar(){
            Swal.fire({
            type: 'success',
            title: 'Informacion actualizada con exito!',
            showConfirmButton: false,
            timer: 1500
            })
        },
        camposClaveVacios(){
            if(!this.claveActual || !this.claveNueva || !this.claveNueva2)
            {
                this.camposVacios = true;     
                return true;
            }
            else 
            {
                this.camposVacios = false;
                return false;
            }
        },
        validarClavesNuevas(){
            if(this.claveNueva.length <6 || this.claveNueva2.length <6)
            {
                this.claveCorta = true;
                return true;
            }
            else
            {
                this.claveCorta = false;
                return false;
            }
        },
        validadClavesDistintas(){
            if(this.claveNueva != this.claveNueva2)
            {   
                this.clavesDiferentes = true;
                return;
            }
            else
            {
                this.clavesDiferentes = false;
            }
        },
        mensajeContrasena(){
            if(this.camposClaveVacios())
                return;
            if(this.validarClavesNuevas())
                return;
            if(this.validadClavesDistintas())
                return;
            Swal.fire({
            title: 'Estas seguro?',
            text: "Vas a cambiar tu contraseña!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, cambiar!',
            cancelButtonText : 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    const params = {
                       claveActual : this.claveActual,
                       claveNueva : this.claveNueva
                    };
                    axios.post('/usuarios/modificarClave',params)
                    .then((response)=>{
                        console.log(response.data);
                        if(response.data == true){
                            Swal.fire(
                            'Exito!',
                            'Contraseña cambiada con exito.',
                            )
                            this.claveActual = '';
                            this.claveNueva = '';
                            this.claveNueva2 = '';
                        }
                        else{
                            Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Su contraseña anterior esta incorrecta!',
                            })
                        }
                    });
                }
            })
        },
        validEmail(){
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(this.email);
        }     
    },
    mounted() {
        this.obtenerDatosUsuario();     
    }
}
</script>
<style>
#preview {
  display: flex;
  justify-content: center;
  align-items: center;
}

#preview img {
  max-width: 50%;
  max-height: 25%;
}
</style>


