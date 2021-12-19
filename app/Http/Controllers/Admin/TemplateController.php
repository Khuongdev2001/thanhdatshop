<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Menu;

class TemplateController extends Controller
{
    /* Handle Show View Menu Add */
    public function getMenuAdd($id = null)
    {
        $menus = Menu::getModel([
            "menu_title as module_title",
            "menu_id as module_id"
        ])->where("menu_id", "<>", $id)->get();
        $menu = Menu::find($id);
        return view("admin.template.menu.add", compact("menu", "menus"));
    }

    /* Handle Add Menu to Database */
    public function postMenuAdd(\App\Http\Requests\Admin\Template\Menu\AddRequest $request)
    {
        $userLogin = Auth::user();
        Menu::create([
            "menu_title" => $request->menu_title,
            "user_id" => $userLogin->user_id,
            "parent_id" => $request->parent_id ?? 0,
            "menu_link" => $request->menu_link,
            "sort" => $request->sort ?? 0
        ]);
        return redirect()->back()->with("success", "Thêm Thành Công Menu !");
    }

    /* Handle Datatable Menu */
    public function getMenuDatatable()
    {
        /* Option Case */
        $setText = function ($value) {
            return "<span>{$value}</span>";
        };
        $setAction = function ($value) {
            $routeUpdate = route("admin.template.menu.add", $value->module_id);
            $routeDelete = route("admin.template.menu.delete", $value->module_id);
            return '
            <div>
                <a href="' . $routeUpdate . '" class="btn  btn-info btn-edit">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>
                <a href="' . $routeDelete . '" class="btn btn-danger btn-delete">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                </a>
            </div>';
        };
        $menus = Menu::getModel([
            "menu_id as module_id",
            "fullname",
            "menus.created_at",
            "menu_title as module_title",
            "menu_link",
            "sort"
        ])
            ->leftJoin("users", "users.user_id", "menus.user_id")
            ->get();
        $menus = convertCat($menus);
        $menuRenders = \Yajra\Datatables\Datatables::of($menus)
            ->editColumn("module_id", function ($menu) use ($setText) {
                return $setText($menu->module_id);
            })
            ->editColumn("fullname", function ($menu) use ($setText) {
                return $setText($menu->fullname);
            })
            ->editColumn("menu_link", function ($menu) use ($setText) {
                return $setText(!empty($menu->menu_link)
                    ? "<a href='{$menu->menu_link}' target='_blank'>{$menu->menu_link}</a>"
                    : "Không Có");
            })
            ->editColumn("created_at", function ($menu) use ($setText) {
                return $setText($menu->created_at);
            })
            ->editColumn("module_title", function ($menu) use ($setText) {
                return $setText($menu["level"] . $menu->module_title);
            })
            ->editColumn("sort", function ($menu) use ($setText) {
                return $setText($menu->sort);
            })
            ->addColumn("action", function ($menus) use ($setAction) {
                return $setAction($menus);
            })
            ->rawColumns(["fullname", "action", "module_id", "sort", "module_title", "menu_link", "created_at"])
            ->make(true);
        return $menuRenders;
    }

    /* Handle Update Menu */
    public function postMenuUpdate(\App\Http\Requests\Admin\Template\Menu\AddRequest $request, $id)
    {
        $menuRq = $request->validated();
        if ($id == $menuRq["parent_id"]) {
            return redirect()->back()->withErrors("Không Cập Nhật Vậy!");
        }
        /* Check Menu Parent Has Child Menu Is Not  */
        $numChild = Menu::where([["menu_status", 1], ["parent_id", $id]])->count();
        /* Defind Data Update */
        $menuRq["parent_id"] = $request->parent_id ?? 0;
        $message = "Menu Đã Cập Nhật !";
        if ($numChild) {
            $message = "Menu Đã Cập Nhật! Menu Cha Còn Con Không Di Chuyển Được!";
            unset($menuRq["parent_id"]);
        }
        Menu::where("menu_id", $id)->update($menuRq);
        return redirect()->back()->with("success", $message);
    }

    /* Handle Delete Menu */
    public function getDeleteMenu($id)
    {
        /* Check Menu Parent Has Child Menu Is Not  */
        $numChild = Menu::where([["menu_status", 1], ["parent_id", $id]])->count();
        if ($numChild) {
            $message = "Không Thể Xóa Khi Còn Menu Con";
            return redirect()->back()->withErrors($message);
        }
        $status = Menu::where("menu_id", $id)->update(
            ["menu_status" => -1]
        );
        return redirect()->back()->with("success", "Xóa Thành Công Menu !");
    }
}
