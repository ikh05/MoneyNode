<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IcABotTelegramController extends Controller
{
    // index
    public function index(Request $request){
        $message = $request->input('message');
        $chatId = $message['chat']['id'] ?? null;
        $text = $message['text'] ?? '';

        // Contoh respon sederhana
        $responseText = match (strtolower($text)) {
            '/start' => 'Halo! Bot Anda sudah terhubung dengan Laravel.',
            default => "Anda mengirimkan pesan: $text"
        };

        // Kirim balasan ke Telegram
        $this->sendMessage($chatId, $responseText);

        return response()->json(['status' => 'success']);
    }

    private function sendMessage($chatId, $text){
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
