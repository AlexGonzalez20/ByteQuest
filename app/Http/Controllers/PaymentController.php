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
        // Configura el Access Token desde config/services.php y .env
        MercadoPagoConfig::setAccessToken(config('services.mercadopago.access_token'));
    }

    /**
     * Inicia el Checkout Pro de Mercado Pago
     */
    public function checkout(Request $request)
    {
        // Obtén datos del producto (puedes reemplazarlo luego con modelo Curso)
        $title = $request->input('title', 'Producto ByteQuest');
        $price = (float) preg_replace('/[^\d\.]/', '', $request->input('price', 0));

        // Rutas de retorno dinámicas (basadas en APP_URL)
        $backUrls = [
            "success" => route('pago.success'),
            "failure" => route('pago.failure'),
            "pending" => route('pago.pending'),
        ];

        $client = new PreferenceClient();

        try {
            $preference = $client->create([
                'items' => [
                    [
                        'title' => $title,
                        'quantity' => 1,
                        'currency_id' => 'COP', // Puedes probar "USD" si es necesario
                        'unit_price' => $price,
                    ],
                ],
                'back_urls'   => $backUrls,
                'auto_return' => 'approved',
            ]);

            // Si la preferencia se creó correctamente, redirige al checkout
            if (is_object($preference) && property_exists($preference, 'init_point')) {
                return redirect($preference->init_point);
            }

            // Loguea respuesta inesperada
            Log::error('Respuesta inesperada de MercadoPago', ['preference' => $preference]);
            return back()->with('error', 'No se pudo iniciar el checkout.');
        } catch (\Exception $e) {
            // Manejo de errores
            Log::error('MercadoPago checkout error', [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
            ]);

            return back()->with('error', 'Error al conectar con MercadoPago: ' . $e->getMessage());
        }
    }

    /**
     * Callbacks de pago
     */
    public function success(Request $request)
    {
        return view('VistasEstudiante.pagos_success', ['data' => $request->all()]);
    }

    public function failure(Request $request)
    {
        return view('VistasEstudiante.pagos_failure', ['data' => $request->all()]);
    }

    public function pending(Request $request)
    {
        return view('VistasEstudiante.pagos_pending', ['data' => $request->all()]);
    }
}
