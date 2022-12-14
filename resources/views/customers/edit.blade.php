<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-success-status class="mb-4" :status="session('message')"/>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                        <form action="{{ route('customers.update',$customer->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-2 gap-6">
                                <div class="grid grid-rows-3 gap-6">
                                    <div>
                                        <label for="nome">Nome</label>
                                        <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" type="text" id="nome" name="nome" autofocus value="{{ $customer->nome }}">
                                        <x-input-error class="mt-2" :messages="$errors->get('nome')" />
                                    </div>
                                    <div>
                                        <label for="email">Email</label>
                                        <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" type="email" id="email" name="email" autofocus value="{{ $customer->email }}">
                                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                    </div>
                                    <div>
                                        <label for="cnpj">CNPJ</label>
                                        <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" type="text" id="cnpj" name="cnpj" maxlength="18" autofocus value="{{ $customer->cnpj }}">
                                        <x-input-error class="mt-2" :messages="$errors->get('cnpj')" />
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
                                    <div>
                                        <label for="cep">CEP</label>
                                        <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" type="text" id="cep" name="cep" maxlength="9" placeholder="13483-000" autofocus value="{{ $customer->cep }}">
                                        <x-input-error class="mt-2" :messages="$errors->get('cep')" />
                                    </div>
                                </div>
                            <div>
                                <div>
                                    <label for="uf">UF</label>
                                    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" type="text" id="uf" name="uf"  value="{{ $customer->uf }}">
                                    <x-input-error class="mt-2" :messages="$errors->get('uf')" />
                                </div>
                                <div class="mt-4">
                                    <label for="cidade">Cidade</label>
                                    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" type="text" id="cidade" name="cidade"  value="{{ $customer->cidade }}">
                                    <x-input-error class="mt-2" :messages="$errors->get('cidade')" />
                                </div>
                                <div class="mt-4">
                                    <label for="bairro">Bairro</label>
                                    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" type="text" id="bairro" name="bairro"  value="{{ $customer->bairro }}">
                                    <x-input-error class="mt-2" :messages="$errors->get('bairro')" />
                                </div>
                                <div class="mt-4">
                                    <label for="endereco">Endereço</label>
                                    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" type="text" id="endereco" name="logradouro"  value="{{ $customer->logradouro }}">
                                    <x-input-error class="mt-2" :messages="$errors->get('endereco')" />
                                </div>
                                <div class="mt-4">
                                    <label for="numero">Número</label>
                                    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" type="text" id="numero" name="numero"  value="{{ $customer->numero }}">
                                    <x-input-error class="mt-2" :messages="$errors->get('numero')" />
                                </div>
                            </div>
                        </div>
                            {{-- <div class="grid grid-cols-2 gap-6">
                                <div class="grid grid-rows-2 gap-6">
                                    <div>
                                        <x-input-label for="name" :value="__('Name')" />
                                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $customer->name }}" required autofocus />
                                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                    </div>
                                    <div>
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $customer->email }}" required autofocus />
                                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                    </div>
                                </div>
                            </div> --}}
                            <div class="flex items-center gap-4 mt-2">
                                <x-primary-button>{{ __('Salvar') }}</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
		<script>
			/*
			 * Para efeito de demonstração, o JavaScript foi
			 * incorporado no arquivo HTML.
			 * O ideal é que você faça em um arquivo ".js" separado. Para mais informações
			 * visite o endereço https://developer.yahoo.com/performance/rules.html#external
			 */
			
			// Registra o evento blur do campo "cep", ou seja, a pesquisa será feita
			// quando o usuário sair do campo "cep"
			$("#cep").blur(function(){
				// Remove tudo o que não é número para fazer a pesquisa
				var cep = this.value.replace(/[^0-9]/, "");
				
				// Validação do CEP; caso o CEP não possua 8 números, então cancela
				// a consulta
				if(cep.length != 8){
					return false;
				}
				
				// A url de pesquisa consiste no endereço do webservice + o cep que
				// o usuário informou + o tipo de retorno desejado (entre "json",
				// "jsonp", "xml", "piped" ou "querty")
				var url = "https://viacep.com.br/ws/"+cep+"/json/";
				
				// Faz a pesquisa do CEP, tratando o retorno com try/catch para que
				// caso ocorra algum erro (o cep pode não existir, por exemplo) a
				// usabilidade não seja afetada, assim o usuário pode continuar//
				// preenchendo os campos normalmente
				$.getJSON(url, function(dadosRetorno){
					try{
						// Preenche os campos de acordo com o retorno da pesquisa
						$("#endereco").val(dadosRetorno.logradouro);
						$("#bairro").val(dadosRetorno.bairro);
						$("#cidade").val(dadosRetorno.localidade);
						$("#uf").val(dadosRetorno.uf);
                        $("#numero").focus();
					}catch(ex){}
				});
			});
		</script>
</x-app-layout>