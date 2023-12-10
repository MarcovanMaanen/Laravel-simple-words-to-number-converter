<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Collection;

class Localization
{
    protected ?string $lang     = null;
    protected ?string $langCode = null;
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next) : Response
    {
        foreach ($this->parseHttpLocales($request) as $locale) {
            if( is_array($locale) && count($locale) == 2) {
                $this->langCode = substr($locale['locale'], 0, 2);
                if ($this->isValidLocale($this->langCode)) {
                    $this->lang = $this->langCode;
                    break;
                }
            }
        }

        if( is_null($this->lang) ){
            app()->setLocale(env(FALLBACK_LANGUAGE,'nl'));
        }

        if ($this->lang && is_string($this->lang) && $this->lang !== app()->getLocale()) {
            app()->setLocale($this->lang);
            $request->setLocale($this->lang);
        }

        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }

        return $next($request);
    }

    protected function isValidLocale(string $locale): bool
    {
        $appLocales = array_values(config('locales.locales'));

        return in_array($locale, $appLocales);
    }

    private function parseHttpLocales(Request $request): Collection
    {
        $list = explode(',', $request->server('HTTP_ACCEPT_LANGUAGE'));

        return Collection::make($list)->map(function($locale) {
            $parts = explode(';', $locale);

            $mapping['locale'] = trim($parts[0]);

            if (isset($parts[1])) {
                $factorParts = explode('=', $parts[1]);

                $mapping['factor'] = $factorParts[1];
            } else {
                $mapping['factor'] = 1;
            }

            return $mapping;
        })->sortByDesc(function($locale) {
            return $locale['factor'];
        });
    }


}
