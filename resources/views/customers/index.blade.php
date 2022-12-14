<x-app-layout>
    <x-slot nome="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Lista de Usuários') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{route('customers.create')}}" class="btn btn-primary mb-2">
                        <i class="fas fa-plus"></i> Clientes
                    </a>

                    <div class="mt-1 mb-4">
                        <div class="relative max-w-xs">
                            <form action="{{ route('customers.index') }}" method="GET">
                                Pesquisar: <input type="text" name="s"
                                    class="gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400"
                                    />
                            </form>
                        </div>

                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nome
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        CEP
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        CNPJ
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Data de criação
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Ações
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        {{$customer->id}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$customer->nome}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$customer->email}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$customer->cep}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$customer->cnpj ? $customer->cnpj : "Não existe CNPJ" }} 
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$customer->status ? $customer->status = "Habilitado" : "Desabilitado"}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ date_format($customer->created_at, 'd/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('customers.destroy',$customer->id) }}" method="Post" onsubmit="return submitForm(this);">
                                            <a class="inline-flex items-center px-2 py-1 bg-white border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150" href="{{ route('customers.show',$customer->id) }}">Visualizar</a>
                                            <a class="inline-flex items-center px-2 py-1 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150" href="{{ route('customers.edit',$customer->id) }}">Editar</a>
                                            <a class="inline-flex items-center px-2 py-1 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150" href="{{ route('customers.status',$customer->id) }}">Atualizar Status</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-2 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">Deletar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        {{ $customers->links() }}
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function submitForm(form) {
            swal({
                title: `Tem certeza que deseja apagar esse registro?`,
                text: "Se você apagar isso, ele vai desaparecer para sempre.",
                icon: "warning",
                buttons: ['Cancelar', 'Sim, deletar!'],
                dangerMode: true,
            })
            .then(function (isOkay) {
                if (isOkay) {
                    form.submit();
                }
            });
            return false;
        }

    </script>
</x-app-layout>