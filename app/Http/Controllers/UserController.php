<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate(
            [
                'name' => 'required',
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'password' => ['required', 'min:8', 'confirmed'],
            ],
            [
                'name.required' => 'กรุณากรอกชื่อของคุณ',
                'email.required' => 'กรุณากรอกอีเมลของคุณ',
                'email.email' => 'กรุณากรอกอีเมลที่ถูกต้อง',
                'email.unique' => 'อีเมลนี้ถูกใช้งานแล้ว',
                'password.required' => 'กรุณากรอกรหัสผ่านของคุณ',
                'password.min' => 'รหัสผ่านของคุณต้องมีอย่างน้อย 8 ตัวอักษร',
                'password.confirmed' => 'รหัสผ่านที่คุณกรอกไม่ตรงกัน',

            ]
        );

        $user = User::create($formFields);

        auth()->login($user);

        return redirect('/')->with('success_message', 'สร้างบัญชีผู้ใช้งานสำหรับ ' . $request->input('name') . ' เสร็จสิ้น');
    }

    public function login(Request $request)
    {
        $formFields = $request->validate(
            [
                'email' => 'required',
                'password' => 'required',
            ],
            [
                'email.required' => 'กรุณากรอกอีเมลของคุณ',
                'password.required' => 'กรุณากรอกรหัสผ่านของคุณ',
            ]
        );

        if (!auth()->attempt($formFields)) {
            return back()->withInput()->withErrors(['email' => 'ข้อมูลที่คุณกรอกไม่ถูกต้อง'])->with('error_message', 'เกิดข้อผิดพลาดในการเข้าสู่ระบบ');
        }

        return redirect('/')->with('success_message', 'เข้าสู่ระบบสำเร็จ');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success_message', 'ออกจากระบบเสร็จสิ้น');
    }
}
