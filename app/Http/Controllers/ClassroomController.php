<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassroomController extends Controller
{
    // API tạo lớp học
    public function createClassroom(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'owner_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Kiểm tra xem lớp học đã tồn tại chưa theo tên
        $existingRoom = Room::where('name', $request->name)->first();
        if ($existingRoom) {
            return response()->json(['message' => 'Lớp học đã tồn tại'], 400);
        }

        // Tạo lớp học mới (Room)
        $room = Room::create([
            'name' => $request->name,
            'owner_id' => $request->owner_id, // Giả sử owner_id là ID người tạo lớp
        ]);

        return response()->json(['message' => 'Lớp học đã được tạo thành công', 'room' => $room], 201);
    }

    // API thêm sinh viên vào lớp học
    public function addStudentToClassroom(Request $request, $roomId)
    {
        // Kiểm tra dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'student_identifier' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Kiểm tra xem lớp học có tồn tại không
        $room = Room::find($roomId);
        if (!$room) {
            return response()->json(['message' => 'Lớp học không tồn tại'], 404);
        }

        // Tìm sinh viên theo email hoặc tên
        $student = User::where('email', $request->student_identifier)
                       ->orWhere('name', $request->student_identifier)
                       ->first();

        if (!$student) {
            return response()->json(['message' => 'Sinh viên không tồn tại'], 404);
        }

        // Kiểm tra xem sinh viên đã là thành viên của lớp học chưa
        $existingMember = RoomMember::where('room_id', $roomId)
            ->where('member_id', $student->id)
            ->first();

        if ($existingMember) {
            return response()->json(['message' => 'Sinh viên đã có trong lớp học'], 400);
        }

        // Thêm sinh viên vào lớp học
        RoomMember::create([
            'room_id' => $roomId,
            'member_id' => $student->id,
        ]);

        return response()->json(['message' => 'Sinh viên đã được thêm vào lớp học thành công'], 200);
    }
}
