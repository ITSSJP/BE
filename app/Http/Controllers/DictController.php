<?php

namespace App\Http\Controllers;

use App\Models\DictionaryWord;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DictController extends Controller
{
    public function getDict():JsonResponse 
    {
        $words = DictionaryWord::paginate(20);
        return response()->json($words);
    }

    public function search(Request $request): JsonResponse
    {
        $query = $request->input('q'); 

        if (!$query) {
            $words = DictionaryWord::paginate(20);
            return response()->json($words);
        }
        // Search by ja, vie, or furigana fields
        $results = DictionaryWord::where('ja', 'like', '%' . $query . '%')
            ->orWhere('vie', 'like', '%' . $query . '%')
            ->orWhere('furigana', 'like', '%' . $query . '%')
            ->paginate(20);
        if (!$results) {
            return response()->json(
                [
                    "message" => "Word hasnt added yet",
                    "date" => [],
                ]
                );
        }
        return response()->json($results);
    }

    public function getRandomWords():JsonResponse
    {
        $words = DictionaryWord::inRandomOrder()->limit(5)->get();
        return response()->json(data: $words);
    }
}
