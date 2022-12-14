<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::where([
            ['name', '!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->s)) {
                    $query->orWhere('name', 'LIKE', '%' . $s . '%')
                        ->orWhere('email', 'LIKE', '%' . $s . '%')
                        ->get();
                }
            }]
        ])->paginate(15);

        return view('users.index', compact('users'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('users.create');
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
                'name' => 'required',
                'email' => 'required',
                'nivel_acesso' => 'required'
            ]);
            
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'nivel_acesso' => $request->nivel_acesso,
                'password' => Hash::make($request->password),
            ]);

            $email_data = array(
                'name' => $request['name'],
                'email' => $request['email'],
            );

            Mail::send('welcome_email', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'], $email_data['name'])
                    ->subject('Seja Bem-vindo(a) ao sistema do Matheus')
                    ->from('matheuslher@gmail.com', 'Matheus');
            });

        } catch (Throwable $e) {
            report($e);
            return false;
        }
            return redirect()->route('users.index')->with('success','Usuário criado com Sucesso.');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\user  $user
    * @return \Illuminate\Http\Response
    */
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\User  $user
    * @return \Illuminate\Http\Response
    */
    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\User  $user
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'nivel_acesso' => 'required'
        ]);

        $validated = $request->validateWithBag('updatePassword', [
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);
        
        $user->fill($request->post())->save();

        return redirect()->route('users.index')->with('success','Usuário atualizado com sucesso!');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\User  $user
    * @return \Illuminate\Http\Response
    */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success','Usuário deletado com sucesso!');
    }
}
