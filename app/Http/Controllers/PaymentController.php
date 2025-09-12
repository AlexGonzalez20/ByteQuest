<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use App\Models\Usuario;

class PaymentController extends Controller
{
    public function __construct()
    {
        MercadoPagoConfig::setAccessToken(config('services.mercadopago.access_token'));
    }

    public function checkout(Request $request)
    {
        Log::info('=== MÉTODO CHECKOUT LLAMADO ===', $request->all());

        $title = $request->input('title', 'Producto ByteQuest');
        $price = (float) preg_replace('/[^\d\.]/', '', $request->input('price', 0));

        if ($price <= 0) {
            return back()->with('error', 'El precio debe ser mayor a 0');
        }

        $backUrls = [
            "success" => "https://bytequest.up.railway.app/success",
            "failure" => "https://bytequest.up.railway.app/failure",
            "pending" => "https://bytequest.up.railway.app/pending",
        ];

        try {
            $client = new PreferenceClient();

            $preferenceData = [
                'items' => [
                    [
                        'title' => $title,
                        'quantity' => 1,
                        'currency_id' => 'COP',
                        'unit_price' => $price,
                    ],
                ],
                'back_urls'   => $backUrls,
                'auto_return' => 'approved',
                'statement_descriptor' => 'ByteQuest',
                'external_reference' => $title, // 🔥 ahora enviamos el producto real
            ];

            $preference = $client->create($preferenceData);

            $redirectUrl = $preference->init_point ?? $preference->sandbox_init_point;
            return redirect()->away($redirectUrl);

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


        $user = Usuario::find(Auth::id());
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para procesar el pago.');
        }

        // Producto desde external_reference
        $producto = $request->get('external_reference', '');

        // ✅ lógica específica de "Recupera todas tus vidas"
        if ($producto === 'Recupera todas tus vidas') {
            $user->vidas = 5;
            $user->save();
            Auth::setUser($user);

            Log::info('✅ Vidas restauradas', [
                'usuario_id' => $user->id,
                'vidas' => $user->vidas,
            ]);
        }

        return view('VistasEstudiante.pagos_success', [
            'data' => $request->all(),  // todos los datos que envía MercadoPago
            'producto' => $producto,
        ]);
    }

    public function failure(Request $request)
    {
        Log::info('Pago fallido', $request->all());
        return view('VistasEstudiante.pagos_failure', [
            'data' => $request->all(),

        ]);
    }

    public function pending(Request $request)
    {
        Log::info('Pago pendiente', $request->all());
        return view('VistasEstudiante.pagos_pending', [
            'data' => $request->all(),
        ]);
    }
}
