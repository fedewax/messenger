<template>
    <b-list-group-item :variant="variant" >
        <b-row class="p-2" algin-h="center">
            <b-col cols="12" md="3" class="text-center">
               <b-img v-if="conversacion.imagen == null" v-bind:src="'../../../imagenes/noProfile.png'" v-bind="mainProps" rounded="circle"  alt="Circle image"/>
               <b-img v-else rounded="circle" v-bind="mainProps" v-bind:src="'../../../imagenes/'+conversacion.imagen" alt="Circle image"/>
            </b-col>
            
            <b-col cols="6" algin-self="center" class="d-none d-md-block">
                
                <p class="mb-1">
                 
                  <b-img v-if="conversacion.online" rounded="circle" blank width="10" heigth="10" blank-color="green" alt="img" class="m-1"/>
                 
                  <b-img v-else rounded="circle" blank width="10" heigth="10" blank-color="red"  alt="img" class="m-1"/>
                 
                    <strong>{{ conversacion.nombre_contacto }}</strong>
                </p>
                
                <div v-if="conversacion.user_ultimo_mensaje == conversacion.usuario_id"> 
                    <p class="text-muted small mb-1">
                        <strong>Tu:</strong> {{ conversacion.ultimo_mensaje}}
                    </p>
                </div>

                <div v-else> 
                    <p class="text-muted small mb-1">
                      <strong>{{conversacion.nombre_contacto}}:</strong> {{ conversacion.ultimo_mensaje}}
                    </p>
                </div>
                
            </b-col>
           
            <b-col cols="3" class="d-none d-md-block">
                <p class="text-muted small">{{ conversacion.tiempo_mensaje}}</p>
            </b-col>
        </b-row>
    </b-list-group-item> 
  
</template>

<script>
    export default {
        props:{
            conversacion : Object,
            selected: Boolean
        },
        data() {
            return {
                mainProps: { width: 70, height: 70 }
            }
        },
        computed: {
            variant(){
                
                return this.selected ? 'info': '';
            }
        },
    }
</script>
