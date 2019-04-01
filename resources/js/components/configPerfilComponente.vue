<template>
            <b-container>
                   <b-row>
                    <b-col cols="6" md="6" sm="12">
                      <b-card border-variant="info">
                            
                            <i  slot="header" class="mt-2 fas fa-user-edit float-right"></i>
                            <p slot="header" class="mt-2" ><strong>INFORMACION PERSONAL</strong></p>
                           
                            <a title="Editar perfil" @click="mostrarModal()" style="cursor:hand"><i class="fas fa-pencil-alt float-right"></i></a>
                            <p>Usuario: {{datosUsuario.name}}</p>                            
                            <hr/>

                            <p>Correo electronico: {{datosUsuario.email}}</p>
                            <hr/>

                            <b-img v-bind="mainProps" class="float-right" rounded alt="Rounded image"></b-img>
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
                                <b-form-input  placeholder="Contraseña actual"></b-form-input>
                                </b-col>
                            </b-row>
                            <hr/>

                            <b-row class="my-1">
                                <b-col sm=4>
                                <label for="input-valid">Nueva contraseña:</label>
                                </b-col>
                                <b-col sm="8" >
                                <b-form-input  placeholder="Nueva contraseña"></b-form-input>
                                </b-col>
                            </b-row>
                            <hr/>

                             <b-row class="my-1 ">
                                <b-col sm=4>
                                <label for="input-valid">Confirmar nueva contraseña:</label>
                                </b-col>
                                <b-col sm="8" >
                                <b-form-input  placeholder="Contraseña anterior"></b-form-input>
                            </b-col>
                                
                            </b-row>
                            <b-button variant="info" class="float-right">Guardar cambios</b-button>
                           
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
                                <input v-model="email" @keyup="comprobarEmail()" placeholder="Correo electronico" class="form-control">
                                <div v-show="emailRegistrado" class="form-group">
                                    <p style="color:red;">Este correo electronico ya se encuentra en uso.</p>
                                </div>
                                </b-col>
                            </b-row>
                            <hr/>

                             <b-row class="my-1 ">
                                <b-col sm=4>
                                <label for="input-valid">Imagen de perfil:</label>
                                </b-col>
                                <b-col sm="8" >
                                    <b-form-file
                                        v-model="file"
                                        :state="Boolean(file)"
                                        placeholder="Choose a file..."
                                        drop-placeholder="Drop file here..."
                                        v-on:change="onImageChange"
                                        >
                                    </b-form-file>
                                    <div class="mt-3">Selected file: {{ file ? file.name : '' }}</div>
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
            </b-container>
</template>
<script>

export default {
    
    props:{
        user_id : Number
    },
    data() {
        return {
            file : null,
            datosUsuario : [],
            name : '',
            email : '',
            id : 0,
            emailRegistrado : false, 
            mainProps : { blank: true, blankColor: '#777', width: 129, height: 129, class: 'm1' },
            imagen : ''
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
                alert("datos actualizados");
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
        }  
    },
    mounted() {
        this.obtenerDatosUsuario();     
    },
}
</script>

