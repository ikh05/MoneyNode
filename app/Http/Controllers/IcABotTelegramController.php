<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IcABotTelegramController extends Controller{

    // setting aliran
    // https://api.telegram.org/bot7315004380:AAFuU6xRnd8rIUWbiqpU4SDlbsGPaqXHXUo/setWebhook?url=http://api.scraperapi.com?api_key=ad23062b57dbed31858f54691da6511f&url=https://ica.free.nf/bot/telegram


    // index
    public function index(Request $request){
        return response(['a']);  
    }
    
    private function generateResponse($text)
    {
        // Contoh logika untuk membalas pesan
        return "Anda mengirimkan pesan: $text";
    }
}
