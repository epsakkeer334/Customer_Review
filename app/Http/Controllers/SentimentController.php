<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SentimentController extends Controller
{
    public function analyze(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
        ]);

        $text = $request->input('text');

        $sentiment = $this->determineSentiment($text);

        return response()->json(['sentiment' => $sentiment]);
    }


    private function determineSentiment($text)
    {

        $positiveWords = ['good', 'great', 'excellent', 'amazing', 'happy'];
        $negativeWords = ['bad', 'terrible', 'awful', 'sad', 'angry'];

        $lowerText = strtolower($text);

        foreach ($positiveWords as $word) {
            if (strpos($lowerText, $word) !== false) {
                return 'positive';
            }
        }

        foreach ($negativeWords as $word) {
            if (strpos($lowerText, $word) !== false) {
                return 'negative';
            }
        }

        return 'neutral';
    }
}
