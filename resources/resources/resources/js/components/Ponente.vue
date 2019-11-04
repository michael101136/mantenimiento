<template>
    <div>
        <h2 class="text-center">Captura tus ideas</h2>
        <div class="well">
            <h4>¿En que estás pensando?</h4>
            <form v-on:submit.prevent="create">
                <div class="input-group">
                    <input type="text" v-model="nombre" class="form-control input-sm">
                    <input type="text" v-model="apellido" class="form-control input-sm">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary btn-sm">
                            Agregar
                        </button>
                    </span>
                </div>
            </form>
            <hr>
            <ul class="list-unstyled">
                    <li v-for="ponente in ponentes" :key="ponente.id">
                        <p>
                            <small>
                                    <em>
                                       {{ since(ponente.created_at)}} ° {{ponente.name}}
                                    </em>
                            </small>

                            {{
                                ponente.apellido
                            }}
                        </p>
                    </li>
            </ul>
        </div>
    </div>

</template>

<script>
    import axios from 'axios'
    import moment from 'moment'

    moment.lang('es');
    export default {
            data ()
            {
                return {
                    ponentes:[],
                    nombre:'',
                    apellido:''
                }
            },
            created:function(){
                    this.getPonentes();
            },
            methods: {
                since: function (d)
                {
                    return moment(d).fromNow();
                },
                getPonentes:function(){
                    var urlPonentes ='mis-ponentes';
                    axios.get(urlPonentes).then(response =>{
                            this.ponentes=response.data
                    });
                },
                create :function()
                {
                   var url='guardar-ponentes';
                   axios.post(url,{
                       name:this.nombre,
                       apellido:this.apellido
                   }).then(response=>{
                        this.getPonentes();
                        this.nombre='';
                        this.apellido='';
                        this.correcto();
                   }).catch(error =>{
                       this.error();
                   })
                },
                 correcto(){

                        this.$swal("Good job!", "Se inserto corectamente", "success")

                    },
                error()
                {
                        this.$swal({
                        title: "Error?",
                        text: "Problemas de inserción",
                        type: "warning",
                        }, );
                }

            },
    }
</script>
