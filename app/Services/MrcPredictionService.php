<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MrcPredictionService
{
    public static function predict($creatinine, $gfr, $albumin)
    {
        $url = config('services.mrc_api.url');

        $response = Http::post($url, [
            'creatinine' => $creatinine,
            'gfr' => $gfr,
            'albumin' => $albumin,
        ]);

        if ($response->successful()) {
            return $response->json(); // Retourne la réponse JSON
        }

        return ['error' => 'Impossible de récupérer la prédiction'];
    }
}
