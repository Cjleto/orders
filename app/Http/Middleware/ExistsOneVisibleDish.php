<?php

namespace App\Http\Middleware;

use Alert;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExistsOneVisibleDish
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $macros = Auth::user()->company->macroCategories()->visible();

        if ($macros->count() < 1) {
            Alert::error('Devi creare o rendere visibile almeno una macrocategoria prima di poter creare un piatto');
            return redirect()->route('macro_categories.create');
        }

        $dishes = $macros->first()->dishes();
        $dishesCount = $dishes->count();

        if ($dishesCount < 1) {
            Alert::error('Devi creare almeno un piatto prima di poter creare un menu');
            return redirect()->route('dishes.create', ['user' => Auth::user()]);
        }

        // verifica se nei dishesh visibili c'è almeno un piatto
        $unvisibleDishes = $dishes->with('category')->unvisible()->get();

        if ($unvisibleDishes->count() == $dishesCount)  {
            $firstDish = $unvisibleDishes->first();
            Alert::error('Devi rendere visibile almeno un piatto prima di poter creare un menu');
            return redirect()->route('category.dishes.index', ['category' => $firstDish->category]);
        }


        return $next($request);
    }
}
