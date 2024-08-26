<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'first_access' => 1,
        ]);

        $attempt = Categories::where('user_id', $user->id)->first();

        if ($attempt == null) {
            //Inclusão das categorias padrões
            $categories = [
                ['titulo' => 'Saúde', 'color' => 1, 'type' => 'saida', 'user_id' => $user->id],
                ['titulo' => 'Restaurante', 'color' => 9, 'type' => 'saida', 'user_id' => $user->id],
                ['titulo' => 'Lanches', 'color' => 12, 'type' => 'saida', 'user_id' => $user->id],
                ['titulo' => 'Passeios', 'color' => 7, 'type' => 'saida', 'user_id' => $user->id],
                ['titulo' => 'Mercado', 'color' => 18, 'type' => 'saida', 'user_id' => $user->id],
                ['titulo' => 'Bares', 'color' => 16, 'type' => 'saida', 'user_id' => $user->id],
                ['titulo' => 'Compras', 'color' => 13, 'type' => 'saida', 'user_id' => $user->id],
                ['titulo' => 'Assinaturas', 'color' => 6, 'type' => 'saida', 'user_id' => $user->id],
                ['titulo' => 'Moradia', 'color' => 2, 'type' => 'saida', 'user_id' => $user->id],
                ['titulo' => 'Imposto', 'color' => 14, 'type' => 'saida', 'user_id' => $user->id],
                ['titulo' => 'Investimentos', 'color' => 8, 'type' => 'saida', 'user_id' => $user->id],
                ['titulo' => 'Entreternimento', 'color' => 3, 'type' => 'saida', 'user_id' => $user->id],
                ['titulo' => 'Transporte', 'color' => 11, 'type' => 'saida', 'user_id' => $user->id],
                ['titulo' => 'Educação', 'color' => 4, 'type' => 'saida', 'user_id' => $user->id],
                ['titulo' => 'Outros', 'color' => 15, 'type' => 'saida', 'user_id' => $user->id],
                ['titulo' => 'Salário', 'color' => 9, 'type' => 'entrada', 'user_id' => $user->id],
                ['titulo' => 'Rendimento', 'color' => 13, 'type' => 'entrada', 'user_id' => $user->id],
                ['titulo' => 'Outros', 'color' => 16, 'type' => 'entrada', 'user_id' => $user->id],
            ];

            foreach ($categories as $category) {
                Categories::create($category);
            }

            // $alter_user = User::find($user->id);
            // $alter_user->first_access = 0;
            // $alter_user->save();
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
