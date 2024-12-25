<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FlashCardPackage;
use App\Models\FlashCardItem;

class TestController extends Controller
{
    /**
     * 
     *
     * @param Request (id của flash_card_packages, n: Số lượng câu hỏi trong bài testtest)
     * return: (List các câu hỏi mỗi câu hỏi gồm "question, 4 lựa chọn, câu trả lời của question")
     */
    public function createTest(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:flash_card_packages,id',
            'n' => 'required|integer|min:1',
        ]);

        $packageId = $request->id;
        $n = $request->n;

        // Lấy các từ của gói flash_card_items có package_id tương ứng
        $flashCardItems = FlashCardItem::where('package_id', $packageId)->get();

        if ($flashCardItems->count() < $n) {
            return response()->json([
                'message' => 'Số lượng từ không đủ để tạo bài test',
                'available_words' => $flashCardItems->count(),
                'required_words' => $n,
            ], 400);
        }

        // Lấy ngẫu nhiên n từ trong danh sách
        $selectedItems = $flashCardItems->random($n);

        $questions = [];

        foreach ($selectedItems as $item) {
            // Lấy 3 đáp án sai từ các câu trả lời khác
            $incorrectAnswers = $flashCardItems
                ->where('id', '!=', $item->id) // Loại bỏ đáp án đúng
                ->pluck('answer')
                ->random(3); // Lấy 3 đáp án sai ngẫu nhiên

            // Đáp án (gồm 1 đúng + 3 sai)
            $answers = $incorrectAnswers->toArray();
            $answers[] = $item->answer; // Thêm đáp án đúng
            shuffle($answers); // Trộn ngẫu nhiên các đáp án

            // Tạo câu hỏi
            $questions[] = [
                'question' => $item->question,
                'options' => $answers,
                'correct_answer' => $item->answer,
            ];
        }

        return response()->json([
            'message' => 'Bài test đã được tạo thành công',
            'questions' => $questions,
        ], 200);
    }
}
