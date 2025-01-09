<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IcABotTelegramController extends Controller
{
    // index
    public function index(){
        $token = '7315004380:AAFuU6xRnd8rIUWbiqpU4SDlbsGPaqXHXUo'; // Token bot Anda
        $telegramUrl = "https://api.telegram.org/bot$token/getUpdates";

        // Gunakan ScraperAPI sebagai proxy
        $scraperApiUrl = "http://api.scraperapi.com";
        $response = Http::get($scraperApiUrl, [
            'api_key' => 'ad23062b57dbed31858f54691da6511f', // Ganti dengan API Key ScraperAPI Anda
            'url' => $telegramUrl,
        ]);

        if ($response->failed()) {
            return response()->json(['error' => 'Gagal terhubung ke Telegram'], 500);
        }

        $updates = $response->json()['result'] ?? [];

        foreach ($updates as $update) {
            $chatId = $update['message']['chat']['id'] ?? null;
            $text = $update['message']['text'] ?? '';

            if ($chatId && $text) {
                // Kirim balasan melalui ScraperAPI
                $sendMessageUrl = "https://api.telegram.org/bot$token/sendMessage";
                Http::get($scraperApiUrl, [
                    'api_key' => 'ad23062b57dbed31858f54691da6511f',
                    'url' => $sendMessageUrl,
                    'chat_id' => $chatId,
                    'text' => "Terima kasih atas komentar Anda: $text",
                ]);
            }
        }

        return 'Polling selesai.';
    }
}
