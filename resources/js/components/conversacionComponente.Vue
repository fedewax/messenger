<template>
    <div>
        <b-row>
                <b-col cols="8">
                    <b-card footer-bg-variant="light"
                           footer-border-variant="dark"
                           title="Conversacion activa"
                           class="h-100">
                        <b-media vertical-algin="center" class="mb-2">
                            <b-img rounded="circle" slot="aside" blank blank-color="#ccc" 
                                   width="50" alt="placeholder"/>
                            <b-card>hola joder tio</b-card>
                        </b-media>  
                        
                        <b-media right-align vertical-align="center" class="mb-2">
                            <b-img rounded="circle" slot="aside" blank blank-color="#ccc" 
                                   width="50" alt="placeholder"/>
                            <b-card>hola joder tio xd</b-card>
                        </b-media>       
                    
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