<?php
namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public  function index(){
        $user=Auth::user();
        if ($user->role==User::STUDENT){
            $rooms=$user->rooms;
        }elseif ($user->role==User::TEACHER){
            $rooms=$user->ownedRooms;
        }
        return view("content.room.index",['rooms'=>$rooms]);
    }
    function detail($id){
        $room=Room::find($id);
        return view("content.room.detail",['room'=>$room]);

    }
    public function createRoom(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'owner_id' => 'required|exists:users,id',  // Kiểm tra owner_id có tồn tại trong bảng users
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => "Tên lớp học là bắt buộc"]);

        }

        // Tạo lớp học mới
        try {
            $room = Room::create([
                'name' => $request->name,
                'owner_id' => $request->owner_id,
            ]);
            return response()->json(
                [
                    'success' => true,
                    'message' => __('create success'),
                    'url' => route('room.index'),
                    'room' => $room,
                ],200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating room', 'error' => $e->getMessage()], 500);
        }
    }
    public function addStudentToRoom(Request $request, $roomId)
    {
        // Xác thực dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:users,id',  // Kiểm tra student_id có tồn tại trong bảng users
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);  // Trả lại lỗi nếu dữ liệu không hợp lệ
        }

        // Lấy lớp học theo ID
        $room = Room::find($roomId);
        if (!$room) {
            return response()->json(['message' => 'Room not found'], 404);  // Nếu lớp học không tồn tại
        }

        // Kiểm tra nếu học sinh đã là thành viên của lớp học
        if ($room->roomMembers()->where('member_id', $request->student_id)->exists()) {
            return response()->json(['message' => 'Student already a member of this room'], 400);
        }

        // Thêm học sinh vào lớp học
        try {
            $room->roomMembers()->create([
                'member_id' => $request->student_id,
            ]);

            return response()->json(['message' => 'Student added to room successfully'], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error adding student', 'error' => $e->getMessage()], 500);
        }
    }

}
