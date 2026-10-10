<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /** Supported locales. Default first. */
    public const LOCALES = ['bn', 'en'];

    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->query('lang');

        if ($locale && in_array($locale, self::LOCALES, true)) {
            session(['locale' => $locale]);
        } else {
            $locale = session('locale', $request->cookie('locale', config('app.locale', 'bn')));
            if (! in_array($locale, self::LOCALES, true)) {
                $locale = 'bn';
            }
        }

        App::setLocale($locale);

        $response = $next($request);

        if ($response instanceof Response) {
            $response->headers->setCookie(cookie('locale', $locale, 60 * 24 * 365));
        }

        return $response;
    }
}
