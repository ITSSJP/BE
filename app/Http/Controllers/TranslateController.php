<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateController extends Controller
{
    public function translate(Request $request)
    {
        // Xác thực input
        $validated = $request->validate([
            'text' => 'required|string', // Chuỗi cần dịch
        ]);

        $text = $validated['text'];

        try {
            // Sử dụng Google Translate API
            $translator = new GoogleTranslate('ja'); // Ngôn ngữ đích: Nhật
            $translator->setSource('vi');           // Ngôn ngữ nguồn: Việt

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
