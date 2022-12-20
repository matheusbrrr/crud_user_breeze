<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-success-status class="mb-4" :status="session('message')"/>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('customers.updateStatus', ['customer' => $customer->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label for="email">Email</label>
                                    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" type="email" id="email" name="email" autofocus value="{{ $customer->email }}">
                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                </div>
                                <div>
                                    <label for="status">Status</label>
                                    <select id="status" name="status" class="form-control custom-select">
                                        @if($customer->status == 1)
                                            <option value="0">Desabilitado</option>
                                            <option value="1" selected>Habilitado</option>
                                        @else
                                            <option value="0" selected>Desabilitado</option>
                                            <option value="1">Habilitado</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 mt-2">
                                <x-primary-button>{{ __('Salvar') }}</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>