<?php

namespace App\Http\Controllers;

use App\Services\PriceCalculator;
use Illuminate\Http\Request;
use Illuminate\View\View;
use InvalidArgumentException;

class PriceCalculatorController extends Controller
{
    public function __construct(private readonly PriceCalculator $calculator)
    {
    }

    public function showForm(): View
    {
        return view('price', ['a' => null, 'b' => null, 'op' => 'vat', 'label' => null, 'result' => null, 'error' => null]);
    }

    public function calculate(Request $request): View
    {
        $validated = $request->validate([
            'a' => ['required', 'integer', 'min:0'],
            'b' => ['required', 'numeric'],
            'op' => ['required', 'in:vat,discount,installment,eur'],
        ]);

        $a = (int) $validated['a'];
        $b = (float) $validated['b'];
        $op = $validated['op'];
        $data = ['a' => $a, 'b' => $b, 'op' => $op, 'label' => null, 'result' => null, 'error' => null];

        try {
            [$label, $result] = match ($op) {
                'vat' => ['Price with VAT', number_format($this->calculator->addVat($a, (int) $b), 0, ',', ' ') . ' HUF'],
                'discount' => ['Discounted price', number_format($this->calculator->applyDiscount($a, (int) $b), 0, ',', ' ') . ' HUF'],
                'installment' => ['Monthly installment', number_format($this->calculator->monthlyInstallment($a, (int) $b), 2, ',', ' ') . ' HUF'],
                'eur' => ['Price in EUR', number_format($this->calculator->convertToEur($a, $b), 2, ',', ' ') . ' EUR'],
            };
            $data['label'] = $label;
            $data['result'] = $result;
        } catch (InvalidArgumentException $exception) {
            $data['error'] = $exception->getMessage();
        }

        return view('price', $data);
    }
}