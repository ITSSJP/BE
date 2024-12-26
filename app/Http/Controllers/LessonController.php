<?php

namespace App\Http\Controllers;

use App\Models\FlashCardItem;
use App\Models\FlashCardPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    function create($id){
        return view('content.lesson.create',['roomId'=> $id]);
    }
    public function store($id, Request $request)
    {
        // Validate dữ liệu từ request
        $validated = $request->validate([
            'title' => 'required|string',
            'question' => 'required|array',
            'romaji' => 'nullable|array',
            'answer' => 'required|array',
        ]);

        // Tạo package
        $package = FlashCardPackage::create([
            'title' => $validated['title'],
            'description' => $request->input('description', ''), // Có thể thêm trường description
            'owner_id' => Auth::id(),
            'room_id' => $id,
        ]);

        // Tạo các items từ dữ liệu mảng
        $items = [];
        for ($i = 0; $i < count($validated['question']); $i++) {
            $items[] = new FlashCardItem([
                'question' => $validated['question'][$i],
                'transcription' => $validated['romaji'][$i] ?? null, // Gán null nếu không có giá trị
                'answer' => $validated['answer'][$i],
            ]);
        }

        // Lưu các items vào database
        $package->items()->saveMany($items);

        return response()->json([
            'message' => 'Package and items added successfully!',
            'success' => true,
            'data' => [
                'package' => $package,
                'items' => $items,
            ],
            'url' => route('room.detail',['id'=>$id]),

        ], 201);
    }
    public function getFlashCardPackages($roomId)
    {
        // Lấy danh sách FlashCardPackage theo Room ID
        $packages = FlashCardPackage::where('room_id', $roomId)
            ->get(['id', 'title']);

        // Kiểm tra nếu không có gói nào
        if ($packages->isEmpty()) {
            return response()->json([
                'message' => 'No flash card packages found for this room.',
            ], 404);
        }

        // Trả về kết quả
        return response()->json([
            'message' => 'Flash card packages retrieved successfully.',
            'data' => $packages,
        ], 200);
    }
    public function showLesson($roomId, $lessonId){
        return view('content.lesson.lesson',['lessonId'=>$lessonId,'roomId'=> $roomId]);
    }
    public function getFlashCardItems($roomId, $lessonId){
        $flashCardItems =FlashCardPackage::find($lessonId)->items;
        // Chuyển đổi danh sách items thành mảng theo định dạng yêu cầu
        $flashcards = $flashCardItems->map(function ($item) {
            return [
                'word' => $item->question,
                'reading' => $item->romaji ?? '',
                'meaning' => $item->answer,
                'audio' => ""
            ];
        })->toArray();

        // Trả về mảng flashcards
        return response()->json(['flashcards' => $flashcards]);
    }
    public function createTest($roomId, $lessonId, Request $request)
    {
        return view('content.lesson.test',['roomId'=>$roomId,'lessonId'=>$lessonId, 'numberQuestion'=>$request->number_question]);
    }
    public function generateQuiz($roomId, $lessonId, Request $request)
    {
        $flashcards = FlashCardItem::where('package_id', $lessonId)->get();

        if ($flashcards->isEmpty()) {
            return response()->json([
                'message' => 'No flashcards found for this lesson.',
            ], 404);
        }

        // Số lượng câu hỏi cần tạo, mặc định là 1
        $numQuestions = $request->query('numQuestions', 1);

        if ($flashcards->count() < $numQuestions) {
            return response()->json([
                'message' => 'Not enough flashcards to generate the requested number of unique questions.',
            ], 400);
        }

        $questions = [];
        $usedFlashcards = collect();

        for ($i = 0; $i < $numQuestions; $i++) {
            // Random một câu hỏi đúng từ danh sách chưa dùng
            $correctFlashcard = $flashcards->diff($usedFlashcards)->random();

            // Lưu câu hỏi vào danh sách đã sử dụng
            $usedFlashcards->push($correctFlashcard);

            // Lấy các đáp án sai từ nghĩa của các từ khác
            $incorrectOptions = $flashcards
                ->where('id', '!=', $correctFlashcard->id)
                ->pluck('answer')
                ->shuffle()
                ->take(3);

            // Trộn đáp án đúng và sai
            $allOptions = $incorrectOptions->push($correctFlashcard->answer)->shuffle();

            // Thêm câu hỏi vào danh sách
            $questions[] = [
                'question' => $correctFlashcard->question,
                'correct' => $correctFlashcard->answer,
                'options' => $allOptions->toArray()
            ];
        }

        return response()->json($questions);
    }

}
