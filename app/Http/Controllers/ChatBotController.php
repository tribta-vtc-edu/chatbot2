<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 

class ChatBotController extends Controller
{
    public function sendChat(Request $request)
    {
        $userMessage = $request->input('input');
        Log::info('User message: ' . $userMessage); 

        $responses = [
            'hello' => 'Hi! How can I assist you today?',
            'how are you' => 'I am just a bot, but I\'m here to help!',
            'bye' => 'Goodbye! Have a nice day!',
            'default' => 'Sorry, I didn\'t understand that. Can you rephrase?'
        ];

        $response = $responses['default'];

        foreach ($responses as $key => $reply) {
            if (stripos($userMessage, $key) !== false) {
                $response = $reply;
                break;
            }
        }

        Log::info('Chatbot response: ' . $response);

        return response()->json($response);
    }
}
