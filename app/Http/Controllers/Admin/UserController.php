<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /* Handle Show View Login Admin */
    public function getLogin(){
        return view("admin.user.login");
    }

    /* Handle Login Data Validated Javascript */
    public function postLogin(\App\Http\Requests\Admin\User\LoginRequest $request){
        $userRq = $request->validated();
        /* Get User By Email */
        $userDb = User::select("password_hash", "user_id")
        ->where("email", $userRq["email"])
        ->whereIn("level", [2])
        ->first();
        /* Check Hash Password User */
        if (!$userDb || !Hash::check($userRq["password"], $userDb->password_hash)) {
            return redirect()->route("admin.user.login")
            ->withErrors("Account Password Is Incorrect");
        };
        /* Set Auth Login Global System */
        Auth::login($userDb);
        return redirect()->route("admin.user");
    }

    /* Handle Logout */
    public function getLogout(){
        Auth::logout();
        return redirect()->route("admin.user.login")->with("Đăng Xuất Thành Công!");
    }
    
    /* Handle Show View User Add */
    public function getAdd(){
        return view("admin.user.add");
    }

    /* Handle Add User To Database */
    public function postAdd(\App\Http\Requests\Admin\User\AddRequest $request){
        $userRq = $request->validated();
        $userRq["password_hash"] = Hash::make($userRq["password"]);
        // create active mail
        $userRq["user_active_mail"] = 1;
        User::create($userRq);
        return "Thêm User Thành Công";
    }

    /* Handle Show View Users */
    public function getIndex(){
        return view("admin.user.index");
    }

    /* Handle Datatable Of Users */
    public function getDatatable(){
        /* Option Case */
        $setText=function($value){
            return "<span>{$value}</span>";
        };
        $setAvatar=function($thumbnail){
            if($thumbnail){
                return '<a href="" class="box-thumbnail avatar">
                    <img src="'.asset($thumbnail).'" class="thumbnail" />
                </a>';
            }
            return '<span>K.Có</span>';
        };
        $setAction=function ($user){
            $routeUpdate=route("admin.user.update",$user->user_id);
            $routeRole=route("admin.user.role",$user->user_id);
            $btnRole='<a href="'.$routeRole.'" class="btn btn-success btn-lock">
                <i class="fa fa-unlock" aria-hidden="true"></i>
            </a>';
            if($user->level){
                $btnRole='<a href="'.$routeRole.'" class="btn btn-warning btn-lock">
                <i class="fa fa-lock" aria-hidden="true"></i>
            </a>';
            }
            return '
            <div>
                <a href="'.$routeUpdate.'" class="btn btn-info btn-edit">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>
                '.$btnRole.'
                <a href="" class="btn btn-danger btn-delete">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                </a>
            </div>';
        };
        /* Handle Render */
        $users= User::get();
        $userRender=\Yajra\Datatables\Datatables::of($users)
            ->editColumn("fullname", function ($user) use ($setText) {
                return $setText($user->fullname);
            })
            ->editColumn("email",function ($user) use ($setText){
                return $setText($user->email);
            })
            ->editColumn("phone",function($user) use($setText){
                return $setText($user->phone);
            })
            ->editColumn("level",function($user) use($setText){
                return $setText(["B.Khóa","K.Hàng","QTV"][$user->level]);
            })
            ->editColumn("user_active_mail",function($user) use ($setText){
                return [$setText("Chưa Kích Hoạt"),$setText("Đã Kích Hoạt")][$user->user_active_mail];
            })
            ->editColumn("user_created_at",function($user) use ($setText){
                return $setText(date("Y-m-d",strtotime($user->user_created_at)));
            })
            ->editColumn("avatar",function($user) use ($setAvatar){
                return $setAvatar($user->avatar);
            })            
            ->addColumn("action",function($user) use ($setAction){
                return $setAction($user);
            })
            /* Set Value Columns HTML Render */
            ->rawColumns(["fullname", "email","phone","level","user_active_mail","user_created_at","avatar","action"])
            ->make(true);
        return $userRender;
    }

    /* Handle Show View Update User */
    public function getUpdate($id){
        $user=User::find($id);
        return view("admin.user.add",compact("user"));
    }

    /* Handle Update Update User */
    public function postUpdate(\App\Http\Requests\Admin\User\UpdateRequest $request, $id){
        $userRq = $request->validated();
        $userRq["password_hash"] = Hash::make($request->password);
        User::find($id)->update($userRq);
        return redirect()->route("admin.user")
        ->with("success", "Cập Nhật T.Tin Thành Công!");
    }

    /* Handle Set Lock Or UnLock */
    public function setRole($id){
        /* Get User By Id */
        $user = User::where("user_id",$id)->whereIn("level",[0,1])->first();
        if(!$user){
            return response()
                ->json(["status"=>false,"data"=>null,"message"=>"NO EDIT BY USER!"]);
        }
        /* Converter Level 1 with 0 And 0 with 1 */
        $levelNew=(int) !$user->level;
        User::where("user_id",$id)->update(["level"=>$levelNew]);
        $levelText=["B.Khóa","K.Hàng","QTV"][$levelNew];
        return response()
            ->json(["status"=>true,"data"=>[
                "level"=>$levelNew,"levelText"=>$levelText
        ],"message"=>"Cập Nhật Thành Công!"]);
    }

    public function checkEmail( $request){
        $user=User::where("email",$request->email)->first();
        return $user ? ["result"=> true] : ["result"=>false];
    }
    
}  
