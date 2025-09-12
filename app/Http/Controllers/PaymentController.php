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
            "success" => "https://bytequest.up.railway.app/success",
            "failure" => "https://bytequest.up.railway.app/failure",
            "pending" => "https://bytequest.up.railway.app/pending",
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
                'back_urls'   => $backUrls,      // REDIRECCIONAR DESPUÉS DEL PAGO
                'auto_return' => 'approved',     // AUTO-REDIRECCIÓN SOLO SI SE APRUEBA
                'statement_descriptor' => 'ByteQuest',
                'external_reference' => uniqid('bytequest_'),
            ];

            $preference = $client->create($preferenceData);

            $redirectUrl = $preference->init_point ?? $preference->sandbox_init_point;

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

        $usuario = auth()->user();
        if (!$usuario) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para procesar el pago.');
        }

        // Extraer producto (puede venir por GET o por external_reference)
        $producto = $request->get('producto', '');

        if ($producto === 'Recupera todas tus vidas') {
            $usuario->vidas = 5;   // siempre restaurar a 5
            $usuario->save();

            Log::info('✅ Vidas restauradas', [
                'usuario_id' => $usuario->id,
                'vidas' => $usuario->vidas,
            ]);
        }

        return view('VistasEstudiante.pagos_success', [
            'data' => $request->all(),
            'producto' => $producto,
            'mensaje' => '¡Compra realizada con éxito! Tus vidas han sido restauradas.',
        ]);
    }



    public function failure(Request $request)
    {
        Log::info('Pago fallido', $request->all());

        return view('VistasEstudiante.pagos_failure', [
            'data' => $request->all(),
            'mensaje' => 'El pago no se completó. No se aplicaron cambios en tu cuenta.',
        ]);
    }


    public function pending(Request $request)
    {
        Log::info('Pago pendiente', $request->all());

        return view('VistasEstudiante.pagos_pending', [
            'data' => $request->all(),
            'mensaje' => 'Tu pago está pendiente. Cuando se confirme, se aplicarán los beneficios a tu cuenta.',
        ]);
    }
}
