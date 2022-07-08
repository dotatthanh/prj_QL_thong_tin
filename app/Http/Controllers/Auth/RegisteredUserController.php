<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'birthday' => ['required', 'date'],
            'address' => ['required'],
        ];

        $messages = [
            'name.required' => 'Họ và tên là trường bắt buộc!',
            'name.string' => 'Họ và tên phải là một chuỗi!',
            'name.max' => 'Họ và tên không được quá :max ký tự!',
            'email.required' => 'Email là trường bắt buộc!',
            'email.string' => 'Email phải là một chuỗi!',
            'email.email' => 'Email không đúng định dạng!',
            'email.max' => 'Email không được quá :max ký tự!',
            'email.unique' => 'Email đã tồn tại!',
            'password.required' => 'Mật khẩu là trường bắt buộc!',
            'password.confirmed' => 'Xác nhận mật khẩu không chính xác!',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự!',
            'birthday.required' => 'Ngày sinh là trường bắt buộc!',
            'birthday.date' => 'Ngày sinh không hợp lệ!',
            'address.required' => 'Địa chỉ là trường bắt buộc!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birthday' => date("Y-m-d", strtotime($request->birthday)),
            'gender' => $request->gender,
            'address' => $request->address,
            'avatar' => $request->avatar,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
