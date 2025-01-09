<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IcABotTelegramController extends Controller
{
    // index
    public function index(Request $request){
        $token = '7315004380:AAFuU6xRnd8rIUWbiqpU4SDlbsGPaqXHXUo'; // Token bot Anda
        $url = "https://api.telegram.org/bot$token/getUpdates";

        $lastUpdateFile = storage_path('last_update_id.txt');
        $lastUpdateId = file_exists($lastUpdateFile) ? file_get_contents($lastUpdateFile) : 0;

        $response = Http::get($url, [
            'offset' => $lastUpdateId + 1,
            'timeout' => 30,
        ]);

        $updates = $response->json()['result'] ?? [];

        foreach ($updates as $update) {
            $chatId = $update['message']['chat']['id'] ?? null;
            $text = $update['message']['text'] ?? '';

            if ($chatId && $text) {
                $reply = match (strtolower($text)) {
                    '/start' => 'Halo! Kirimkan komentar Anda.',
                    default => "Terima kasih atas komentar Anda: $text"
                };

                Http::post("https://api.telegram.org/bot$token/sendMessage", [
                    'chat_id' => $chatId,
                    'text' => $reply,
                ]);
            }

            $lastUpdateId = $update['update_id'];
        }

        file_put_contents($lastUpdateFile, $lastUpdateId);

        return 'Polling selesai.';
    }

    private function sendMessage($chatId, $text){
        // https://api.telegram.org/bot7315004380:AAFuU6xRnd8rIUWbiqpU4SDlbsGPaqXHXUo/getWebhookInfo
        // https://api.telegram.org/bot7315004380:AAFuU6xRnd8rIUWbiqpU4SDlbsGPaqXHXUo/setWebhook?url=https://ica.free.nf/bot/telegram
        $token = '7315004380:AAFuU6xRnd8rIUWbiqpU4SDlbsGPaqXHXUo'; // Ganti dengan token bot Anda
        $url = "https://api.telegram.org/bot$token/sendMessage";

        $data = [
            'chat_id' => $chatId,
            'text' => $text,
        ];

        file_get_contents($url . '?' . http_build_query($data));
    }
}
