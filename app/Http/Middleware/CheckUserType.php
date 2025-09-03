<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Vérifie si l’utilisateur n’est pas connecté OU si son type d’utilisateur n’est pas égal au rôle attendu
        if (!Auth::check() || Auth::user()->usertype !== $role) {
            return redirect('/');  // Si la condition est vraie, on redirige vers la page d’accueil
        }

        return $next($request);   // Sinon, on laisse passer la requête au middleware suivant ou au contrôleur
    }
}
