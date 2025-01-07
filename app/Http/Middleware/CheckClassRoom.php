<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckClassRoom
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response{
        // menindah route jika tidak ada class yang dimiliki user
        $user = Auth::user();
        // dd($user->classRooms->count());
        // Jika pengguna belum memiliki classroom, arahkan ke halaman pembuatan classroom
        if (!$user->classRooms->count() && !$request->is('TaskNode/create/classroom')) {
            return redirect()->route('create_ClassRoom');
        }

        return $next($request); // Lanjutkan jika valid
    }
}
