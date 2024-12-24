<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateController extends Controller
{
    public function index(){
        return view('content.translate.index');
    }
    public function translate(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'text' => 'required|string',  // Text to be translated
            'from' => 'required|string', // Source language
            'to' => 'required|string',   // Target language
        ]);

        $text = $validated['text'];
        $fromLang = $validated['from'];
        $toLang = $validated['to'];

        try {
            // Use Google Translate API
            $translator = new GoogleTranslate();
            $translator->setSource($fromLang);  // Source language
            $translator->setTarget($toLang);   // Target language

            $translatedText = $translator->translate($text);

            return response()->json([
                'success' => true,
                'original_text' => $text,
                'translated_text' => $translatedText,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Translation failed: ' . $e->getMessage(),
            ], 500);
        }
    }
}
