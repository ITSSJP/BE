<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'User registered successfully.',
            'user' => $user,
        ], 201);
    }

    /**
     * Hàm đăng nhập
     * input: email, password
     * output: token đăng nhập nếu thành công, lỗi nếu không thành công
     */

    public function login(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',  // Kiểm tra email có tồn tại trong bảng users
            'password' => 'required|string|min:6',  // Kiểm tra mật khẩu có tồn tại và độ dài ít nhất 6 ký tự
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);  // Trả lại lỗi nếu dữ liệu không hợp lệ
        }
    
        // Lấy thông tin người dùng từ email
        $user = User::where('email', $request->email)->first();
    
        // Kiểm tra nếu người dùng tồn tại và mật khẩu đúng
        if ($user && $user->password === $request->password) {
            // Tạo token cho người dùng khi đăng nhập thành công
            $token = $user->createToken('MyApp')->plainTextToken;
    
            return response()->json([
                'message' => 'Đăng nhập thành công',
                'token' => $token,
                'user' => $user
            ], 200);
        }
    
        return response()->json(['message' => 'Email hoặc mật khẩu không chính xác'], 401);  // Nếu đăng nhập thất bại
    }
    
}
