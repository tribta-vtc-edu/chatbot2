<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OpenAI\Laravel\Facades\OpenAI;

class ChatBotController extends Controller
{
    public function sendChat(Request $request)
    {
        $prompt = $request->input('input');

        try {
            $result = OpenAI::completions()->create([
                'model' => 'gpt-3.5-turbo',
                'prompt' => 'Hello, World!',
                'max_tokens' => 100,
            ]);

            $response = array_reduce(
                $result->toArray()['choice'],
                fn($carry, $choice) => $carry.$choice['text'], 
            );

            return response()->json($response);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error'=>'An error occured please check log'], 500);
        }
    }
}
