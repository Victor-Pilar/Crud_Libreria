<template>
    <div>
        <h1 class="text-center">Gestionar Libros</h1>
        <hr />

        <!-- Button to Open the Modal -->
        <button @click="modificar = false; abrirModal();" type="button" class="btn btn-primary my-4">Nuevo</button>

        <!-- The Modal -->
        <div class="modal" :class="{ mostrar: modal }">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">{{ tituloModal }}</h4>
                        <button @click="cerrarModal();" type="button" class="close" data-dismiss="modal">
                            &times;
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="my-4">
                            <label for="autor">Autor</label>
                            <input v-model="libro.autor" type="text" class="form-control" id="autor"
                                placeholder="Nombre del autor">
                        </div>
                        <div class="my-4">
                            <label for="titulo">Titulo</label>
                            <input v-model="libro.titulo" type="text" class="form-control" id="titulo"
                                placeholder="Titulo del libro">
                        </div>
                        <div class="my-4">
                            <label for="edicion">Edición</label>
                            <input v-model="libro.edicion" type="text" class="form-control" id="edicion"
                                placeholder="Edición del libro">
                        </div>
                        <div class="my-4">
                            <label for="datos_publicacion">Datos de publicación</label>
                            <input v-model="libro.datos_publicacion" type="text" class="form-control"
                                id="datos_publicacion" placeholder="Datos de publicación">
                        </div>
                        <div class="my-4">
                            <label for="tipo_contenido">Tipo de contenido</label>
                            <input v-model="libro.tipo_contenido" type="text" class="form-control" id="tipo_contenido"
                                placeholder="Tipo de contenido">
                        </div>
                        <div class="my-4">
                            <label for="restricciones">Restricciones</label>
                            <input v-model="libro.restricciones" type="text" class="form-control" id="restricciones"
                                placeholder="Restricciones">
                        </div>
                        <div class="my-4">
                            <label for="materia">Materia</label>
                            <input v-model="libro.materia" type="text" class="form-control" id="materia"
                                placeholder="Materia">
                        </div>
                        <div class="my-4">
                            <label for="provedor">Provedor</label>
                            <input v-model="libro.provedor" type="text" class="form-control" id="provedor"
                                placeholder="Provedor">
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button @click="cerrarModal();" type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button @click="guardar();" type="button" class="btn btn-success" data-dismiss="modal">
                            Guardar
                        </button>


                    </div>
                </div>
            </div>
        </div>

        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Edición</th>
                    <th scope="col">Datos de publicación</th>
                    <th scope="col">Tipo de contenido</th>
                    <th scope="col">Restricciones</th>
                    <th scope="col">Materia</th>
                    <th scope="col">Provedor</th>
                    <th scope="col" colspan="2" class="text-center">Accion</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="art in libros" :key="art.id">
                    <th scope="row">{{ art.id }}</th>
                    <td>{{ art.autor }}</td>
                    <td>{{ art.titulo }}</td>
                    <td>{{ art.edicion }}</td>
                    <td>{{ art.datos_publicacion }}</td>
                    <td>{{ art.tipo_contenido }}</td>
                    <td>{{ art.restricciones }}</td>
                    <td>{{ art.materia }}</td>
                    <td>{{ art.provedor }}</td>
                    <td>
                        <button @click="modificar = true; abrirModal(art);" class="btn btn-warning">Editar</button>
                    </td>
                    <td>
                        <button @click="eliminar(art.id)" class="btn btn-danger">
                            Eliminar
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    data() {
        return {
            libro: {
                autor:'yy',
                titulo:'yy',
                edicion:'yy',
                datos_publicacion:'yy',
                tipo_contenido:'y',
                restricciones:'yy',
                materia:'yy',
                provedor:'y'
            },
            id: 0,
            modificar: true,
            modal: 0,
            tituloModal: '',
            libros: [],
        };
    },
    methods: {
        async listar() {
            const res = await axios.get('/libros');
            this.libros = res.data;
        },
        async eliminar(id) {
            const res = await axios.delete('/libros/' + id);
            this.listar();
        },
        async guardar() {
            if (this.modificar) {
                const res = await axios.put('/libros/' + this.id, this.libro);
                // console.log(this.id);

            } else {
                const res = await axios.post('/libros/', this.libro);
            }
            this.cerrarModal();
            this.listar();
        },
        abrirModal(data = {}) {
            this.modal = 1;
            if (this.modificar) {
                this.id = data.id;
                this.tituloModal = "Modificar Libro";
                this.libro.autor = data.autor;
                this.libro.titulo = data.titulo;
                this.libro.edicion = data.edicion;
                this.libro.datos_publicacion = data.datos_publicacion;
                this.libro.tipo_contenido = data.tipo_contenido;
                this.libro.restricciones = data.restricciones;
                this.libro.materia = data.materia;
                this.libro.provedor = data.provedor;
            } else {
                this.id = 0;
                this.libro.autor = '';
                this.libro.titulo = '';
                this.libro.edicion = '';
                this.libro.datos_publicacion = '';
                this.libro.tipo_contenido = '';
                this.libro.restricciones = '';
                this.libro.materia = '';
                this.libro.provedor = '';
            }
        },
        cerrarModal() {
            this.modal = 0;
        },
    },
    created() {
        this.listar();
    },
};
</script>
<style>
.mostrar {
    display: list-item;
    opacity: 1;
    background: rgba(75, 56, 143, 0.705);
}
</style>