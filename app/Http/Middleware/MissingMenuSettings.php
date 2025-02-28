<?php

namespace App\Http\Middleware;

use Alert;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MissingMenuSettings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $company = $request->route('company');

        if (!$company->menuSetting) {

            // se la route è public.menu devo stapare una vista ad hoc
            if ($request->route()->getName() == 'public.menu') {
                return redirect()->to('missing_menu_setting');
            }


            Alert::html('Attenzione. Nessun menu configurato', "Per favore procedi alla creazione del menu<br><a href='".route('company.settings')."'>Clicca qui</a>", 'warning');
            /* alert()->html('<i>HTML</i> <u>example</u>', " You can use <b>bold text</b>, <a href='//github.com'>links</a> and other HTML tags ", 'success'); */

            return redirect()->back();
            /* return redirect()->route('company.settings'); */
        }

        return $next($request);
    }
}
