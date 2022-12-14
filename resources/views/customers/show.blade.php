<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                        <form action="{{ route('customers.show',$customer->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-2 gap-6">
                                <div class="grid grid-rows-2 gap-6">
                                    <div>
                                        <x-input-label for="name" :value="__('Nome')" />
                                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="nome" value="{{ $customer->nome }}" readonly />
                                    </div>
                                    <div>
                                        <x-input-label for="cep" :value="__('CEP')" />
                                        <x-text-input id="cep" class="block mt-1 w-full" type="text" name="cep" value="{{ $customer->cep }}" readonly />
                                    </div>
                                    <div>
                                        <x-input-label for="status" :value="__('Status')" />
                                        <x-text-input id="status" class="block mt-1 w-full" type="text" name="status" value="{{ $customer->status ? $customer->status = 'Habilitado' : 'Desabilitado'}}" readonly />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>