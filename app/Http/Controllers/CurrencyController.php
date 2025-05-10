<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class CurrencyController extends Controller
{
    public function changeCurrency(Request $request)
    {
        try {
            $currency = Currency::where('code', $request->currency_code)->firstOrFail();
            $request->session()->put('currency_code', $request->currency_code);

            Flash::success('Currency changed to ' . $currency->name);
            return response()->json([
                'status' => true,
                'message' => 'Currency changed to ' . $currency->name
            ]);
        } catch (\Exception $e) {
            Flash::error('Unable to change currency');
            return response()->json([
                'status' => false,
                'message' => 'Unable to change currency'
            ], 422);
        }
    }

    public function index()
    {
        try {
            $currencies = Currency::latest()->paginate(10);
            $active_currencies = Currency::getActiveCurrencies();

            Flash::success('Currencies loaded successfully');
            return view('admin.business_settings.currency', compact('currencies', 'active_currencies'));
        } catch (\Exception $e) {
            Flash::error('Unable to load currencies');
            return back();
        }
    }


    public function edit(Request $request)
    {
        try {
            $currency = Currency::findOrFail($request->id);
            return view('partials.currency_edit', compact('currency'));
        } catch (\Exception $e) {
            Flash::error('Currency edit error' . $e->getMessage());
            return response()->json(['error' => 'Currency not found'], 404);
        }
    }


    public function store(Request $request)
    {
        try {
            Currency::create([
                'name' => $request->name,
                'symbol' => $request->symbol,
                'code' => $request->code,
                'exchange_rate' => $request->exchange_rate,
                'status' => 0
            ]);

            Flash::success('Currency created successfully');
            return redirect()->route('currency.index');
        } catch (\Exception $e) {
            Flash::error('Failed to create currency');
            return redirect()->route('currency.index');
        }
    }

    public function update(Request $request)
    {
        try {
            $currency = Currency::findOrFail($request->id);
            $currency->update([
                'name' => $request->name,
                'symbol' => $request->symbol,
                'code' => $request->code,
                'exchange_rate' => $request->exchange_rate
            ]);

            Flash::success('Currency updated successfully');
            return redirect()->route('currency.index');
        } catch (\Exception $e) {
            Flash::error('Failed to update currency');
            return redirect()->route('currency.index');
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            $currency = Currency::findOrFail($request->id);
            $currency->status = $request->status;
            $currency->save();

            Flash::success('Currency status updated');
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Flash::error('Failed to update status');
            return response()->json(['success' => false], 422);
        }
    }
    public function create()
    {
        return view('partials.currency_create');
    }
}
