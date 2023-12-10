<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use NumberFormatter;
use App\Http\Requests\ConvertNumberRequest;
use Rmunate\Utilities\SpellNumber;

class NumberConverterController extends Controller
{
    public function index() : View
    {
        return view('converter');
    }

    public function convert(ConvertNumberRequest $request): RedirectResponse
    {
        $input = $request->input('input');
        $result = $this->convertToInteger($input);

        return redirect()->route('result', compact('result', 'input'));
    }

    public function result(Request $request): View
    {
        $result = $request->query('result');
        $input  = $request->query('input');
        return view('result', compact('result', 'input'));
    }

    protected function convertToInteger(string $input): int
    {
        $formatter = new NumberFormatter(app()->getLocale(), NumberFormatter::SPELLOUT);

        return $formatter->parse(strtolower($input));
    }
}