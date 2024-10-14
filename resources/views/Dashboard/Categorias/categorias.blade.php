@extends('Layout/dashboard')

@section('contenido')
    <div class="relative overflow-x-auto shadow-md sm:rounded-xl bg-white p-4 max-w-4xl mx-auto">
        <div class="flex mt-4 mb-8 items-center gap-2">
            <h3 class="font-semibold text-xl">Categorías</h3>
            <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded"
                id="total-categorias">0</span>
        </div>

        <div class="pb-4">
            <label for="table-search" class="sr-only">Buscar</label>
            <div class="relative flex flex-col sm:flex-row sm:justify-between">
                <div class="relative flex items-center">
                    <div class="absolute inset-y-0 left-0 -top-4 sm:top-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" id="table-search"
                        class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-full sm:w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 mb-4 sm:mb-0"
                        placeholder="Buscar elementos">
                </div>
                <button data-modal-target="modal-categoria" data-modal-toggle="modal-categoria"
                    class="mt-2 sm:mt-0 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                    type="button" id="abrir-modal">
                    Agregar Categoría
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500" id="tablaCategorias">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Categorías</th>
                        <th scope="col" class="px-6 py-3">ACCIONES</th>
                    </tr>
                </thead>
                <tbody id="tbody-categoria">

                </tbody>
            </table>
        </div>
    </div>

    <div id="modal-categoria" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">Categoría</h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="modal-categoria">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>

                <div class="p-4 md:p-5 space-y-4">
                    <input id="input-categoria" type="text"
                        class="block w-full px-4 py-2.5 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Nombre de la categoría">
                    <span class="text-red-500 text-sm" id="errorCategoria"></span>
                </div>

                <div class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b">
                    <button id="guardarCategoria" type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Guardar</button>
                    <button data-modal-hide="modal-categoria" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            listarCategorias();
        });

        $("#guardarCategoria").click(function() {
            crearCategoria();
        });

        $('#abrir-modal').click(function() {
            abrirModal();
        });


        function listarCategorias() {
            $.ajax({
                url: "/ListarCategorias",
                type: "get",
                dataType: "json",
                success: function(response) {
                    let categorias = response.categorias;

                    let template = "";
                    $("#total-categorias").text(response.categorias.length);

                    if (categorias.length > 0) {
                        categorias.forEach(function(categoria) {
                            template += `
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">${categoria.nombre}</th>
                                    <td class="px-6 py-4">
                                        <a href="#" class="font-medium text-blue-600 hover:underline">Editar</a>
                                    </td>
                                </tr>
                            `;
                        });
                        $("#tbody-categoria").html(template);
                    } else {
                        template = `
                            <tr>
                                <td colspan="2" class="px-6 py-4 text-center text-gray-500">No hay categorías disponibles</td>
                            </tr>
                        `;
                        $("#tbody-categoria").html(template);
                    }



                    let dataTable = new simpleDatatables.DataTable("#tablaCategorias", {
                        searchable: false,
                        perPage: 10,
                        labels: {
                            perPage: "registros por página",
                            noRows: "No hay datos para mostrar",
                            info: "Mostrando {start} a {end} de {rows} registros"
                        }
                    });
                       


                    $("#table-search").on("input", function() {
                        dataTable.search(this.value);
                    });
                },
                error: function(xhr) {
                    console.error("Error al listar categorías:", xhr);
                }
            });
        }


        function crearCategoria() {
            let categoria = $("#input-categoria").val();
            if (categoria.trim() == "") {
                $("#errorCategoria").text("El campo es requerido");
                return;
            }

            $.ajax({
                url: "/categorias",
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    nombre: categoria
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == "success") {
                        $("#input-categoria").val("");
                        $("#errorCategoria").text("");
                        cerrarModal();
                        listarCategorias();
                    }
                },
                error: function(xhr) {
                    console.error("Error al crear categoría:", xhr);
                }
            });
        }

        function cerrarModal() {
            $("#modal-categoria").addClass("hidden");
            const $modal = $("#modal-categoria");
            const modal = new Modal($modal[0]);
            modal.hide();
        }

        function abrirModal() {
            const $modal = $("#modal-categoria");
            $modal.removeClass("hidden");
            const modal = new Modal($modal[0]);
            modal.show();
            $("#input-categoria").val("");
            $("#errorCategoria").text("");
        }
    </script>
@endsection
