<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Page;

class PageController extends Controller
{
    /* Handle Show View Add Page */
    public function getAdd()
    {
        return view("admin.page.add");
    }

    /* Handle Add Page To Database */
    public function postAdd(\App\Http\Requests\Admin\Page\AddRequest $request)
    {
        $pageRq = $request->validated();
        /* Convert page Slug */
        $pageRq["page_slug"] = Str::slug($pageRq["page_title"]);
        $pageRq["user_id"] = Auth::id();
        Page::create($pageRq);
        return redirect()->back()->with("success", "Thêm Thành Công!");
    }
    /* Handle Show View Page Index */
    public function getIndex()
    {
        return view("admin.page.index");
    }

    /* Handle Show View Page Datatable */
    public function getDatatable()
    {
        /* Option Case */
        $setText = function ($value) {
            return "<span>{$value}</span>";
        };
        $setAction = function ($page) {
            $routeUpdate = route("admin.page.update", $page->page_id);
            $routeDelete = route("admin.page.delete", $page->page_id);
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
        /* Handle Render */
        $pages = Page::getPageAdmins();
        $pageRenders = \Yajra\Datatables\Datatables::of($pages)
            ->editColumn("page_id", function ($page) use ($setText) {
                return $setText($page->page_id);
            })
            ->editColumn("page_title", function ($page) use ($setText) {
                return $setText($page->page_title);
            })
            ->editColumn("fullname", function ($page) use ($setText) {
                return $setText($page->fullname);
            })
            ->editColumn("page_status", function ($page) use ($setText) {
                return [$setText("Tạm Lưu"), $setText("Đã Xuất Bản")][$page->page_status];
            })
            ->editColumn("created_at", function ($page) use ($setText) {
                return $setText(date("Y-m-d", strtotime($page->created_at)));
            })
            ->addColumn("action", function ($pages) use ($setAction) {
                return $setAction($pages);
            })
            ->rawColumns(
                ["page_id",  "page_title", "fullname", "page_status", "created_at", "action"]
            )
            ->make(true);
        return $pageRenders;
    }

    /* Handle Show View Update Page */
    public function getUpdate($id)
    {
        $page = Page::whereIn("page_status", [0, 1])->where("page_id", $id)->first();
        return view("admin.page.add", compact("page"));
    }

    /* Handle Update Database Page */
    public function postUpdate(\App\Http\Requests\Admin\Page\AddRequest $request, $id)
    {
        $pageRq = $request->validated();
        /* Convert page Slug */
        $pageRq["page_slug"] = Str::slug($pageRq["page_title"]);
        Page::find($id)->update($pageRq);
        return redirect()->back()->with("success", "Cập Nhật Thành Công!");
    }
    /* Handle Delete Page */
    public function getDelete($id){
        $status = Page::find($id)->update(
            ["page_status" => -1]
        );
        return response()->json(["message" => "Xóa Được {$status} Trang", "status" => $status]);
    }
}
