namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public function createRoom(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'owner_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Tạo lớp học mới
        $room = Room::create([
            'name' => $request->name,
            'owner_id' => $request->owner_id,
        ]);

        return response()->json(['message' => 'Room created successfully', 'room' => $room], 201);
    }
    public function addStudentToRoom(Request $request, $roomId)
    {
        // Xác thực dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Lấy lớp học theo ID
        $room = Room::find($roomId);
        if (!$room) {
            return response()->json(['message' => 'Room not found'], 404);
        }

        // Thêm học sinh vào lớp học
        $room->roomMembers()->create([
            'member_id' => $request->student_id,
        ]);

        return response()->json(['message' => 'Student added to room successfully'], 200);
    }

}
