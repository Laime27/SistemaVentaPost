@extends('Layout/dashboard')

@section('contenido')

<div class="relative overflow-x-auto shadow-md sm:rounded-xl  bg-white p-4 " >
    <div class="pb-4 ">
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative mt-1">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search for items">
        </div>
    </div>
    <table class="w-full text-sm  text-left text-gray-500 " id="tablaCategorias">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">Categorías</th>
                <th scope="col" class="px-6 py-3">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
          
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        listarCategorias();
    });

    function listarCategorias() {
        $.ajax({
            url: "/ListarCategorias",
            type: "get",
            dataType: "json",
            success: function(response) {
                let tbody = $("#tablaCategorias tbody");
                tbody.empty(); 
                if (response.categorias && response.categorias.length > 0) {
                    response.categorias.forEach(function(categoria) {
                        let row = `
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    ${categoria.nombre}
                                </th>
                                <td class="px-6 py-4">
                                    <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
                                </td>
                            </tr>
                        `;
                        tbody.append(row);
                    });
                } else {
                    let noDataRow = `
                        <tr>
                            <td colspan="2" class="px-6 py-4 text-center text-gray-500">No hay categorías disponibles</td>
                        </tr>
                    `;
                    tbody.append(noDataRow); 
                } 

                let dataTable = new simpleDatatables.DataTable("#tablaCategorias", {
                    searchable: false,
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
</script>

@endsection
