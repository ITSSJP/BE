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
    public function addStudentToRoom(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:users,id',  // Kiểm tra student_id có tồn tại trong bảng users
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);  // Trả lại lỗi nếu dữ liệu không hợp lệ
        }

        // Lấy lớp học theo ID
        $room = Room::find($id);
        if (!$room) {
            return response()->json(['message' => 'Room not found'], 404);  // Nếu lớp học không tồn tại
        }

        // Kiểm tra nếu học sinh đã là thành viên của lớp học
        if ($room->roomMembers()->where('member_id', $request->student_id)->exists()) {
            return response()->json([
                'message' => 'Student already a member of this room',
                'success' => false,
                ]);
        }

        // Thêm học sinh vào lớp học
        try {
            $room->roomMembers()->create([
                'member_id' => $request->student_id,
            ]);

            return response()->json(['message' => 'Student added to room successfully', 'success' => true], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error adding student', 'error' => $e->getMessage()], 500);
        }
    }
    public function searchUser(Request $request){
        $query = $request->input('user_name');
        $users = User::where('name', 'LIKE', '%' . $query . '%')
            ->where('id', '!=', Auth::id())->where('role',User::STUDENT)
            ->get();

        // Kiểm tra nếu không tìm thấy người dùng
        if ($users->isEmpty()) {
            return response()->json([
                'data' => []
            ], 404);
        }

        // Trả về danh sách người dùng
        return response()->json([
            'data' => $users
        ]);
    }
    public function getRoomMembers($id)
    {
        // Lấy thông tin phòng và kiểm tra phòng tồn tại
        $room = Room::findOrFail($id);

        // Lấy danh sách thành viên của phòng
        $members = $room->roomMembers()
            ->join('users', 'room_members.member_id', '=', 'users.id') // Join với bảng users
            ->select('users.id', 'users.name', 'users.email') // Chỉ lấy các cột cần thiết
            ->get();

        // Trả về kết quả dưới dạng JSON
        return response()->json([
            'room_id' => $room->id,
            'room_name' => $room->name,
            'members' => $members,
        ]);
    }
    public function deleteMember($roomId, $memberId)
    {
        // Tìm phòng theo ID
        $room = Room::find($roomId);

        if (!$room) {
            return response()->json([
                'success'=>false,
                'message' => 'Không tìm thấy phòng với ID này.'
            ], 404);
        }

        // Kiểm tra xem thành viên có trong phòng không
        $member = $room->members()->find($memberId);

        if (!$member) {
            return response()->json([
                'success'=>false,
                'message' => 'Thành viên không thuộc phòng này.'
            ], 404);
        }

        // Xóa thành viên khỏi phòng
        $room->members()->detach($memberId);

        return response()->json([
            'success'=>true,

            'message' => 'Thành viên đã được xóa khỏi phòng thành công.'
        ], 200);
    }

    public function deleteRoom($roomId)
    {
        // Lấy lớp học theo ID
        $room = Room::find($roomId);
        if (!$room) {
            return response()->json(['message' => 'Không tồn tại lớp học'], 404);  // Nếu lớp học không tồn tại
        }
        // Hủy phòng học
        try {
            $room->delete();

            return response()->json(['message' => 'Phòng học đã bị xóa'], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting room', 'error' => $e->getMessage()], 500);
        }
    }
}
