<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;

class PaymentController extends Controller
{
    public function __construct()
    {
        MercadoPagoConfig::setAccessToken(config('services.mercadopago.access_token'));
    }

    public function test()
    {
        try {
            Log::info('=== TEST MERCADOPAGO ===');

            $client = new PreferenceClient();

            $preference = $client->create([
                'items' => [
                    [
                        'title' => 'Test con precio mayor',
                        'quantity' => 1,
                        'currency_id' => 'COP',
                        'unit_price' => 1000,
                    ],
                ],
            ]);

            return response()->json([
                'status' => 'success',
                'preference_id' => $preference->id,
                'sandbox_init_point' => $preference->sandbox_init_point,
                'init_point' => $preference->init_point,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
        }
    }

    public function checkout(Request $request)
    {
        $debugInfo = [
            'timestamp' => now()->toString(),
            'method' => $request->method(),
            'url' => $request->url(),
            'full_url' => $request->fullUrl(),
            'all_data' => $request->all(),
            'headers' => $request->headers->all()
        ];

        file_put_contents(
            storage_path('logs/debug_checkout.txt'),
            "=== CHECKOUT EJECUTADO ===\n" .
                json_encode($debugInfo, JSON_PRETTY_PRINT) . "\n" .
                str_repeat("=", 50) . "\n\n",
            FILE_APPEND
        );

        Log::info('=== MÉTODO CHECKOUT LLAMADO ===');
        Log::info('Datos POST: ', $request->all());

        $title = $request->input('title', 'Producto ByteQuest');
        $price = (float) preg_replace('/[^\d\.]/', '', $request->input('price', 0));

        if ($price <= 0) {
            Log::error('Precio inválido', ['price' => $price]);
            return back()->with('error', 'El precio debe ser mayor a 0');
        }

        $backUrls = [
            "success" => route('pago.success'),
            "failure" => route('pago.failure'),
            "pending" => route('pago.pending'),
        ];

        $client = new PreferenceClient();

        try {
            $preferenceData = [
                'items' => [
                    [
                        'title' => $title,
                        'quantity' => 1,
                        'currency_id' => 'COP',
                        'unit_price' => $price,
                    ],
                ],
                // Descomenta si quieres redirecciones automáticas
                // 'back_urls'   => $backUrls,
                // 'auto_return' => 'approved',
                'statement_descriptor' => 'ByteQuest',
                'external_reference' => uniqid('bytequest_'),
            ];

            $preference = $client->create($preferenceData);

            $redirectUrl = $preference->sandbox_init_point ?? $preference->init_point;

            if ($redirectUrl) {
                return redirect()->away($redirectUrl);
            }

            return back()->with('error', 'No se pudo iniciar el checkout.');
        } catch (\Exception $e) {
            Log::error('=== ERROR EN CHECKOUT ===', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return back()->with('error', 'Error al procesar el pago: ' . $e->getMessage());
        }
    }

    public function success(Request $request)
    {
        Log::info('Pago exitoso', $request->all());
        return view('VistasEstudiante.pagos_success', ['data' => $request->all()]);
    }

    public function failure(Request $request)
    {
        Log::info('Pago fallido', $request->all());
        return view('VistasEstudiante.pagos_failure', ['data' => $request->all()]);
    }

    public function pending(Request $request)
    {
        Log::info('Pago pendiente', $request->all());
        return view('VistasEstudiante.pagos_pending', ['data' => $request->all()]);
    }
}
