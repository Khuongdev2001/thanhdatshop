<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use \Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Social;
use App\Models\UserSocial;
use App\Models\UserAddress;


class UserController extends Controller
{
    public function __construct()
    {
        /* Config Service 1:facebook 2:google*/
        $this->modes = [null, "facebook", "google"];
    }
    /* Handle Login */
    public function postLogin(Request $request)
    {
        /* Create Rules */
        $rules = [
            "email" => "required|email",
            "password" => "required"
        ];
        $validator = Validator::make($request->input(), $rules);
        /* Loop Error */
        foreach ($validator->errors()->all() as $error) {
            return response()->json(["status" => false, "message" => $error], 401);
        }
        /* Get User By Email */
        $userDb = User::select("password_hash", "user_id")
            ->where("email", $request->email)
            ->first();
        /* Check Hash Password User */
        if (!$userDb || !Hash::check($request->password, $userDb->password_hash)) {
            return response()
                ->json(["status" => false, "message" => "Thông Tin Mật Khẩu Không Chính Xác!"], 401);
        }
        /*Check Account Block */
        if ($userDb->level == -1) {
            return response()
                ->json(["status" => false, "message" => "Tài Khoản Đã Bị Khóa!"], 401);
        }
        /* Set Auth Login Global System */
        Auth::login($userDb);
        return response()
            ->json(["status" => true, "message" => "Đăng Nhập Thành Công!"], 200);
    }

    /* Handle Reg Api */
    public function postReg(Request $request)
    {
        /* Create Rules */
        $rules = [
            "fullname" => "required|min:5|max:50",
            "email" => "nullable|email|min:5|max:50|unique:users",
            "password" => "required|min:5|max:50",
            "password_confirm" => "same:password",
            "phone" => "nullable|min:5|max:50",
        ];
        $messages = [
            "email.unique" => "Email Đã Tồn Tại Trên Hệ Thống!"
        ];
        $validator = Validator::make($request->input(), $rules, $messages);
        /* Loop Error */
        foreach ($validator->errors()->all() as $error) {
            return response()->json(["status" => false, "message" => $error], 401);
        }
        $userRq = $validator->validated();
        /* Hash Password */
        $userRq["password_hash"] = Hash::make($request->password);
        /* Random Token */
        $userRq["token"] = User::createToken();
        User::create($userRq);
        return response()
            ->json(["status" => true, "message" => "Đăng Ký Thành Công! Vui Lòng Kiểm Tra Mail Để Kích Hoạt"], 200);
    }

    /* Handle Login Social */

    public function getLoginSocial($mode)
    {
        $convertion = [1 => "facebook", 2 => "google"];
        return Socialite::driver($convertion[$mode])->redirect();
    }

    public function getConnect($mode, $option)
    {
        /* Handle Delete Social */
        $idLogin = Auth::id();
        $socialConnected = UserSocial::where("user_id", $idLogin)
            ->where("social_type_id", $mode)->first();
        if (!$socialConnected) {
            /* Handle Connect Social */
            return Socialite::driver($this->modes[$mode])->redirect();
        }
        /* Dont Delete User Account Create With Social */
        if ($socialConnected->is_primary) {
            return redirect()->back();
        }
        $socialConnected->delete();
        return redirect()->back()->with("success", "Xóa Liên Kết Thành Công");
    }

    /* Handle Callback Login Social And Connect Social */
    public function getCallbackSocial(Request $request, $mode)
    {
        $userSocial = Socialite::driver($this->modes[$mode])->user();
        /* Check User Login */
        if (Auth::check()) {
            return $this->handleConnectSocial($userSocial, $mode);
        }
        return $this->handleLoginSocial($userSocial, $mode);
    }

    private function handleConnectSocial($userSocial, $mode)
    {
        $idLogin = Auth::id();
        /* Check User Connect Id */
        $userConnected = UserSocial::where("user_id", $idLogin)
            ->where("social_type_id", $mode)
            ->first();
        if ($userConnected) {
            return redirect()->route("user.account")
                ->withErrors("Đã Có Tài Khoản Liên Kết Với Tài Khoản Này !");
        }
        /* Connect Social */
        UserSocial::create([
            "user_id" => $idLogin,
            "social_id" => $userSocial->id,
            "social_type_id" => $mode
        ]);
        return redirect()->route("user.account")->with("success", "Liên Kết Tài Khoản Thành Công");
    }

    private function handleLoginSocial($userSocial, $mode)
    {
        /* Get User Social */
        $socialConnected = UserSocial::where("social_id", $userSocial->id)
            ->where("social_type_id", $mode)->first();
        /* Login Social Connect */
        if ($socialConnected) {
            $user = User::find($socialConnected->user_id);
            Auth::login($user);
            return redirect()->route("home")->with("success", "Đăng Nhập Thành Công!");
        }
        /* Handle Create Account With Social */
        if (!$userSocial->email) {
            return redirect()->route("home")->withErrors("Email Chưa Liên Kết Với Tài Khoản");
        }
        /* Handle Login By Email */
        $user = User::where("email", $userSocial->email)->first();
        if ($user) {
            Auth::login($user);
            return redirect()->route("home")->with("success", "Đăng Nhập Thành Công!");
        }
        /* Handle Create Account With Social */
        $userNew = User::create([
            "fullname" => $userSocial->name,
            "email" => $userSocial->email,
            "user_active_mail" => 1,
            "avatar_cdn" => $userSocial->avatar,
            "level" => 1
        ]);
        /* Create User Socail */
        UserSocial::create([
            "user_id" => $userNew->user_id,
            "social_id" => $userSocial->id,
            "social_type_id" => $mode,
            "is_primary" => 1,
            "level" => 1
        ]);
        Auth::login($userNew);
        return redirect()->route("home")->with("success", "Đăng Nhập Thành Công!");
    }
    /* Handle Logout */
    public function getLogout()
    {
        Auth::logout();
        return redirect()->back()->with("Đăng Xuất Thành Công!");
    }

    /* Handle Show View Update Account */

    public function getUpdate()
    {
        $userLogin = Auth::user();
        return view("user.user.account");
    }
    /* Handle Update */
    public function postUpdate(Request $request)
    {
        /* Create Rules */
        $rules = [
            "fullname" => "required|min:5|max:50",
            "phone" => "nullable|min:5|max:50",
            "province_id" => ["nullable", function ($attribute, $value, $fail) {
                $check = User::checkCoutry(request("province_id"), request("district_id"), request("commune_id"));
                if (!$check) {
                    $fail("Lỗi");
                }
            }],
            "district_id" => "nullable",
            "commune_id" => "nullable",
            "address" => "nullable|max:500"
        ];

        $validator = Validator::make($request->input(), $rules);
        /* Loop Error */
        foreach ($validator->errors()->all() as $error) {
            return response()->json(["status" => false, "message" => $error], 401);
        }
        $userLogin = Auth::user();
        $userLogin->update($validator->validated());
        return response()
            ->json(["status" => true, "message" => "Đã Cập Nhật!"], 200);
    }
    /* Handle Change Password */

    public function postChangePassword(Request $request)
    {
        /* Create Rules */
        $rules = [
            "password" => "required|min:5|max:50",
            "password_confirm" => "same:password"
        ];

        $validator = Validator::make($request->input(), $rules);
        /* Loop Error */
        foreach ($validator->errors()->all() as $error) {
            return response()->json(["status" => false, "message" => $error], 401);
        }
        $userLogin = Auth::user();
        $userRq = $validator->validated();
        /* Hash Password */
        $userRq["password_hash"] = Hash::make($request->password);
        /* Random Token */
        $userRq["token"] = User::createToken();
        $userLogin->update($userRq);
        return response()
            ->json(["status" => true, "message" => "Cập Nhật Mật Khẩu Thành Công!"], 200);
    }

    /* Handle Show View Address User */
    public function getAddress()
    {
        $userId = Auth::id();
        $userAddress = UserAddress::AddressModel([
            "province_name",
            "district_name",
            "commune_name"
        ])
            ->leftJoin("provinces", "provinces.province_id", "user_address.province_id")
            ->leftJoin("districts", "districts.district_id", "user_address.district_id")
            ->leftJoin("communes", "communes.commune_id", "user_address.commune_id")
            ->where("user_id", $userId)
            ->orderBy("is_default", "DESC")
            ->get();
        return view("user.user.address.index", compact("userAddress"));
    }

    /* Handle Show View Add Address User */

    public function getAddAddress($id = null)
    {
        $userId = Auth::id();
        $checkAddress = UserAddress::AddressModel()
            ->where("user_id", $userId)
            ->where("id", "<>", $id)
            ->count("id");
        $userAddress = UserAddress::AddressModel([
            "province_id",
            "district_id",
            "commune_id"
        ])
            ->where("user_id", $userId)
            ->where("id", $id)
            ->first();
        return view("user.user.address.add", compact("checkAddress", "userAddress"));
    }

    /* Handle Create Database Address */
    public function postAddAddress(\App\Http\Requests\User\Address\AddRequest $request)
    {
        $router = $request->continue ?? route("user.address");
        $addresRq = $request->validated();
        $userId = Auth::id();
        $addresRq["user_id"] = $userId;
        if ($request->is_default) {
            UserAddress::AddressModel()->where("user_id", $userId)
                ->update(["is_default" => false]);
        }
        /* Address First */
        $checkAddress = UserAddress::AddressModel()->where("user_id", $userId)->count("id");
        if (!$checkAddress) {
            $addresRq["is_default"] = 1;
        }
        UserAddress::create($addresRq);
        return redirect($router)->with("success", "Thêm Địa Chỉ Thành Công!");
    }

    /* Handle Update Datatable user_address */

    public function postUpdateAddress(\App\Http\Requests\User\Address\AddRequest $request, $id)
    {
        $router = $request->continue ?? route("user.address");
        $addresRq = $request->validated();
        $userId = Auth::id();
        if ($request->is_default) {
            UserAddress::AddressModel()->where("user_id", $userId)
                ->update(["is_default" => false]);
        }
        /* Allow user_defalt of address only = -1 */
        $checkAddress = UserAddress::AddressModel()->where("user_id", $id)->count("id");
        if (!$checkAddress) {
            $addresRq["is_default"] = 1;
        }
        UserAddress::where("user_id", $userId)->where("id", $id)
            ->update($addresRq);
        return redirect($router)->with("success", "Cập Nhật Địa Chỉ Thành Công!");
    }

    public function getDeleteAddress($id)
    {
        $userId = Auth::id();

        $status = UserAddress::AddressModel()
            ->where("user_id", $userId)
            ->where("id", $id)
            ->update(["status" => -1]);

        return response()->json([
            "status" => $status,
            "message" => $status ? "Xóa Thành Công Địa Chỉ" : "error",
        ], 200);
    }
}
