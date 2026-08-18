<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;

use MercadoPago\MercadoPagoConfig;

use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;

class CheckoutController extends Controller
{
    public function index()
    {
        MercadoPagoConfig::setAccessToken(
            config('mercadopago.access_token')
        );
    }
    public function webhook(Request $request)
    {
        Log::info('WEBHOOK MERCADO PAGO', [
            'body' => $request->all(),
        ]);
        return response()->json([
            'success' => true,
        ], 200);
    }
    public function preapproval(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'plan_id' => ['required','integer','exists:plans,id'],
        ]);

        $plan = Plan::findOrFail($request->plan_id);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $cardFormData = $request->cardFormData;

        $response = Http::withToken(

            config('mercadopago.access_token')

        )->post('https://api.mercadopago.com/preapproval',[
            'preapproval_plan_id' => $plan->mp_plan_id,
            'payer_email' => $cardFormData['payer']['email'],
            'card_token_id' => $cardFormData['token'],
            'external_reference' => $request->plan_id,
            'status' => 'authorized',
            'back_url' => 'https://comma-kennel-poser.ngrok-free.dev/stopwatch',
        ]);

        if ($response->failed()) {
            $user->delete();
            return response()->json([
                'success' => false,
                'message' => 'Erro ao criar assinatura.',
                'error' => $response->json(),
            ], $response->status());
        }

        $data = $response->json();
        Subscription::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'mp_preapproval_id' => $data['id'],
            'mp_payment_id' => null,
            'status' => $data['status'],
            'starts_at' => now(),
            'expires_at' => now()->addDays(30),
        ]);

        event(new Registered($user));
        Auth::login($user);

        return response()->json(['success' => true]);
    }
    public function showFormPlan() {
        return view('layouts.admin');
    }
    public function createPlan(Request $request) 
    {
        $response = Http::withToken(
            config('mercadopago.access_token')
        )->post('https://api.mercadopago.com/preapproval_plan', [
            'reason' => $request->name,
            'auto_recurring' => [
                'frequency' => 1,
                'frequency_type' => 'months',
                'transaction_amount' => (float) $request->price,
                'currency_id' => 'BRL',
                'free_trial' => [
                    'frequency' => 14,
                    'frequency_type' => "days"
                ],
            ],
            'back_url' => 'https://comma-kennel-poser.ngrok-free.dev/form-plan',
        ]);
        $mercadoPagoPlan = $response->json();
        Plan::create([
            'name' => $request->name,
            'description' => $request->description ?? null,
            'price' => $request->price,
            'mp_plan_id' => $mercadoPagoPlan['id'],
        ]);

        Log::info('CRIAÇÃO DE PLANO', [
            'body' => $request->all(),
        ]);

        Log::info('CRIAÇÃO DE PLANO', [
            'body' => $mercadoPagoPlan,
        ]);

        return redirect()->back();
    }
    
}