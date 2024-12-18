<?php
namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{   
    /* 
        input: name_class, user_id
        output: true => "Room created successfully"
                false(lop hoc da ton tai) => "Room already exists"
                false(loi he thong) => "Error creating room"
    */
    public function createRoom(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'owner_id' => 'required|exists:users,id',  // Kiểm tra owner_id có tồn tại trong bảng users
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);  // Trả lại lỗi nếu dữ liệu không hợp lệ
        }
    
        // Kiểm tra xem phòng học đã tồn tại chưa
        $existingRoom = Room::where('name', $request->name)->first();
        if ($existingRoom) {
            return response()->json(['message' => 'Room already exists'], 400);  // Phòng học đã tồn tại
        }
    
        // Tạo lớp học mới
        try {
            $room = Room::create([
                'name' => $request->name,
                'owner_id' => $request->owner_id,  // Gán owner_id là id của user tạo phòng học
            ]);
    
            return response()->json([
                'message' => 'Room created successfully',
                'room' => $room
            ], 201);
    
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating room', 'error' => $e->getMessage()], 500);
        }
    }
    
    /**
     * input: user_id
     * output: true => "Đã thêm người dùng vào lớp học"
     *         false(khong tim thay lop hoc) => "Không tồn tại lớp học"
     *         false(owner_id != user_id) => "Bạn không có quyền thêm người dùng vào lớp học"
     *         false(da ton tai user_id trong phong hoc) => "Người dùng đã được thêm vào lớp học"
     * 
     * 
     */
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
            return response()->json(['message' => 'Không tồn tại lớp học'], 404);  // Nếu lớp học không tồn tại
        }
    
        // Kiểm tra nếu người thực hiện hành động không phải là chủ sở hữu phòng
        if ($room->owner_id != auth()->id()) {
            return response()->json(['message' => 'Bạn không có quyền thêm người dùng vào lớp học'], 403);
        }
    
        // Kiểm tra nếu học sinh đã là thành viên của lớp học
        if ($room->roomMembers()->where('member_id', $request->student_id)->exists()) {
            return response()->json(['message' => 'Người dùng đã được thêm vào lớp học'], 400);
        }
    
        // Thêm học sinh vào lớp học
        try {
            $room->roomMembers()->create([
                'member_id' => $request->student_id,
            ]);
    
            return response()->json(['message' => 'Đã thêm người dùng vào lớp học'], 200);
    
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error adding student', 'error' => $e->getMessage()], 500);
        }
    }
    
    /**
     * Xóa 1 user khỏi phòng học 
     *
     * @param Request $request
     * @param [type] $roomId
     * @return void
     */
    public function removeStudentFromRoom(Request $request, $roomId)
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
            return response()->json(['message' => 'Không tồn tại lớp học'], 404);  // Nếu lớp học không tồn tại
        }

        // Kiểm tra nếu người thực hiện hành động không phải là chủ sở hữu phòng
        if ($room->owner_id != auth()->id()) {
            return response()->json(['message' => 'Bạn không có quyền xóa người dùng khỏi lớp học'], 403);
        }

        // Kiểm tra nếu học sinh không phải là thành viên của lớp học
        if (!$room->roomMembers()->where('member_id', $request->student_id)->exists()) {
            return response()->json(['message' => 'Người dùng không phải là thành viên của lớp học'], 400);
        }

        // Xóa học sinh khỏi lớp học
        try {
            $room->roomMembers()->where('member_id', $request->student_id)->delete();

            return response()->json(['message' => 'Đã xóa người dùng khỏi lớp học'], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error removing student', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Đổi tên lớp học 
     *
     * @param Request $request
     * @param id room_id
     * @return void
     */
    public function updateRoomName(Request $request, $roomId)
    {
        // Xác thực dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);  // Trả lại lỗi nếu dữ liệu không hợp lệ
        }

        // Lấy lớp học theo ID
        $room = Room::find($roomId);
        if (!$room) {
            return response()->json(['message' => 'Không tồn tại lớp học'], 404);  // Nếu lớp học không tồn tại
        }

        // Kiểm tra nếu người thực hiện hành động không phải là chủ sở hữu phòng
        if ($room->owner_id != auth()->id()) {
            return response()->json(['message' => 'Bạn không có quyền thay đổi tên lớp học'], 403);
        }

        // Thay đổi tên lớp học
        try {
            $room->update(['name' => $request->name]);

            return response()->json(['message' => 'Tên lớp học đã được thay đổi'], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating room name', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Hủy phòng học
     *
     * @param id room_id
     * @return void
     */
    public function deleteRoom($roomId)
    {
        // Lấy lớp học theo ID
        $room = Room::find($roomId);
        if (!$room) {
            return response()->json(['message' => 'Không tồn tại lớp học'], 404);  // Nếu lớp học không tồn tại
        }

        // Kiểm tra nếu người thực hiện hành động không phải là chủ sở hữu phòng
        if ($room->owner_id != auth()->id()) {
            return response()->json(['message' => 'Bạn không có quyền xóa lớp học'], 403);
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
