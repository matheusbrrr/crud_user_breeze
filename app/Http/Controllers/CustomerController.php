<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Customer::where([
            ['nome', '!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->s)) {
                    $query->orWhere('nome', 'LIKE', '%' . $s . '%')
                          ->orWhere('cep', 'LIKE', '%' . $s . '%')
                        ->get();
                }
            }]
        ])->paginate(15);

        $user = Auth::user();

        return view('customers.index', compact('customers', 'user'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('customers.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nome'       => 'required',
                'email'      => 'required',
                'cep'        => 'required',
                'cidade'     => 'required',
                'logradouro' => 'required',
                'bairro'     => 'required',
                'uf'         => 'required',
                'numero'     => 'required',
            ]);
            
            Customer::create([
                'nome'       => $request->nome,
                'email'      => $request->email,
                'cep'        => $request->cep,
                'cidade'     => $request->cidade,
                'cnpj'       => $request->cnpj,
                'logradouro' => $request->logradouro,
                'bairro'     => $request->bairro,
                'uf'         => $request->uf,
                'numero'     => $request->numero,
                'status'     => $request->status,
                // 'user_id'    => $request->user_id
            ]);

            $email_data = array(
                'nome' => $request['nome'],
                'email' => $request['email'],
            );

            Mail::send('welcome_email_customer', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'], $email_data['nome'])
                    ->subject('Seja Bem-vindo(a) ao sistema do Matheus')
                    ->from('matheuslher@gmail.com', 'Matheus');
            });
    } catch (Throwable $e){
        report($e);
        return false;
    }
        return redirect()->route('customers.index')->with('success','Cliente criado com Sucesso.');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Customer  $Customer
    * @return \Illuminate\Http\Response
    */
    public function show(Customer $customer)
    {
        return view('customers.show',compact('customer'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Customer  $Customer
    * @return \Illuminate\Http\Response
    */
    public function edit(Customer $customer)
    {
        return view('customers.edit',compact('customer'));
    }

    public function status(Customer $customer, $id)
    {
        return view('customers.status',compact('customer'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Customer  $Customer
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'nome'       => 'required',
            'email'      => 'required',
            'cep'        => 'required',
            'cidade'     => 'required',
            'logradouro' => 'required',
            'bairro'     => 'required',
            'uf'         => 'required',
            'numero'     => 'required',
            'status'     => 'required'
        ]);
        
        $customer->fill($request->post())->save();

        return redirect()->route('customers.index')->with('success','Cliente atualizado com sucesso!');
    }

    public function updateStatus(Request $request, Customer $customer, $id)
    {
        $request->validate([
            'status' => 'required',
            'email'  => 'required'
        ]);

        if($customer->status == 0){
            $customer->status = 1;
            $customer->save();
        }else{
            $customer->status = 0;
            $customer->save();
        }

        $email_data = array(
            'nome' => $request['nome'],
            'email' => $request['email'],
        );

        Mail::send('welcome_email_customer_status', $email_data, function ($message) use ($email_data) {
            $message->to($email_data['email'], $email_data['nome'])
                ->subject('Você foi aprovado!')
                ->from('matheuslher@gmail.com', 'Matheus');
        });
        
        $customer->fill($request->post())->save();

        return redirect()->route('customers.index')->with('success','Status atualizado com sucesso!');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Customer  $Customer
    * @return \Illuminate\Http\Response
    */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success','Cliente deletado com sucesso!');
    }
}
