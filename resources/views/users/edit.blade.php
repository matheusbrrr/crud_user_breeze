<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-success-status class="mb-4" :status="session('message')"/>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                        <form action="{{ route('users.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-2 gap-6">
                                <div class="grid grid-rows-2 gap-6">
                                    <div>
                                        <x-input-label for="name" :value="__('Name')" />
                                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $user->name }}" required autofocus />
                                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                    </div>
                                    <div>
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $user->email }}" required autofocus />
                                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                    </div>
                                </div>
                                <div class="grid grid-rows-2 gap-6">
                                    <div>
                                        <x-input-label for="password" :value="__('Nova Senha')" />
                                        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                    </div>
                            
                                    <div>
                                        <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" />
                                        <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                    </div>
                                </div> 
                            </div>
                            <div class="flex items-center gap-4 mt-2">
                                <x-primary-button>{{ __('Salvar') }}</x-primary-button>
                    
                                @if (session('status') === 'password-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600"
                                    >{{ __('Salvar.') }}</p>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>