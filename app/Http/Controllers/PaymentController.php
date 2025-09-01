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
        // Asegúrate de tener services.mercadopago.access_token en config/services.php y en .env
        MercadoPagoConfig::setAccessToken(config('services.mercadopago.access_token'));
    }

    public function checkout(Request $request)
    {
        // Sanitiza y valida entrada básica
        $title = $request->input('title', 'Producto ByteQuest');
        // elimina símbolos y comas -> fuerza float
        $price = (float) preg_replace('/[^\d\.]/', '', $request->input('price', 0));

        // Construye las back_urls usando route() — depende de APP_URL
        $backUrls = [
            "success" => "https://abcd-1234-56-78.ngrok-free.app/pago/success",
            "failure" => "https://abcd-1234-56-78.ngrok-free.app/pago/failure",
            "pending" => "https://abcd-1234-56-78.ngrok-free.app/pago/pending", 
        ];

        // DEBUG rápido: descomenta si quieres ver las URLs que se están generando
        // dd($backUrls);

        $client = new PreferenceClient();

        try {
            $preference = $client->create([
                'items' => [
                    [
                        'title' => $title,
                        'quantity' => 1,
                        'currency_id' => 'COP', // si falla prueba "USD"
                        'unit_price' => $price,
                    ],
                ],
                'back_urls' => $backUrls,
                'auto_return' => 'approved',
            ]);

            // Si la creación fue exitosa, normalmente $preference tiene init_point
            if (is_object($preference) && property_exists($preference, 'init_point')) {
                return redirect($preference->init_point);
            }

            // Si el SDK devolvió un objeto de respuesta (p.ej. MPResponse con error)
            // intentamos sacar su contenido de forma segura para depuración:
            if (is_object($preference)) {
                if (method_exists($preference, 'getContent')) {
                    dd($preference->getContent());
                } elseif (property_exists($preference, 'content')) {
                    dd($preference->content);
                } else {
                    dd($preference);
                }
            }

            // En caso raro: si no es objeto, mostramos lo que sea que devolvió
            dd($preference);
        } catch (\Exception $e) {
            // Si la excepción tiene la respuesta de la API (SDK), la mostramos:
            if (method_exists($e, 'getApiResponse')) {
                dd($e->getApiResponse());
            }

            // Guárdalo en logs para no perder trazas e imprime el mensaje básico:
            Log::error('MercadoPago checkout error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Muestra algo legible en la UI (dev)
            dd([
                'error' => $e->getMessage(),
            ]);
        }
    }

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
