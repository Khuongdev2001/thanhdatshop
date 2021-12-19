<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\CatPost as Cat;
use App\Models\Post;


class PostController extends Controller
{
    public function __construct()
    {
        /* Set Globaly Dir Upload Image Of Post */
        $this->dirUpload = "source/img/posts/";
    }
    /* Handle Show View Category Post */
    public function getAddCategory($id = null)
    {
        $cats = Cat::getCatModel([
            "cat_id as module_id",
            "cat_title as module_title"
        ])->where("cat_id", "<>", $id)->get();
        $cat = Cat::find($id);
        return view("admin.post.cat.add", compact("cats", "cat"));
    }

    /* Handle Add Category Post */
    public function postAddCategory(\App\Http\Requests\Admin\Post\Cat\AddRequest $request)
    {
        $userLogin = Auth::user();
        Cat::create([
            "cat_title" => $request->cat_title,
            "cat_slug" => Str::slug($request->cat_title) . "-" . time(),
            "parent_id" => $request->parent_id ?? 0,
            "user_id" => $userLogin->user_id,
            "sort" => $request->sort ?? 0
        ]);
        return redirect()->back()->with("success", "Thêm Thành Công Danh Mục !");
    }
    /* Handle Datatable Api Cat Post */
    public function getDatableCategory()
    {
        /* Option Case */
        $setText = function ($value) {
            return "<span>{$value}</span>";
        };
        $setAction = function ($value) {
            $routeUpdate = route("admin.post.category.add", $value->cat_id);
            $routeDelete = route("admin.post.category.delete", $value->cat_id);
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
        $cats = Cat::getCatModel([
            "cat_id as module_id",
            "sort",
            "fullname",
            "cat_title as module_title",
            "parent_id",
            "cat_status",
            "cat_posts.created_at"
        ])
            ->leftJoin("users", "users.user_id", "cat_posts.user_id")
            ->get();
        $cats = convertCat($cats);
        $catRenders = \Yajra\Datatables\Datatables::of($cats)
            ->editColumn("cat_id", function ($cat) use ($setText) {
                return $setText($cat->cat_id);
            })
            ->editColumn("fullname", function ($cat) use ($setText) {
                return $setText($cat->fullname);
            })
            ->editColumn("created_at", function ($cat) use ($setText) {
                return $setText($cat->created_at);
            })
            ->editColumn("cat_title", function ($cat) use ($setText) {
                return $setText($cat["level"] . $cat->cat_title);
            })
            ->editColumn("sort", function ($cat) use ($setText) {
                return $setText($cat->sort);
            })
            ->addColumn("action", function ($cats) use ($setAction) {
                return $setAction($cats);
            })
            ->rawColumns(["fullname", "action", "cat_id", "sort", "cat_title", "created_at"])
            ->make(true);
        return $catRenders;
    }

    /* Handle Update Category Post */
    public function postUpdateCategory(\App\Http\Requests\Admin\Post\Cat\AddRequest $request, $id)
    {
        $catRq = $request->validated();
        if ($id == $catRq["parent_id"]) {
            return redirect()->back()->withErrors("Không Cập Nhật Vậy!");
        }
        /* Check Cat Parent Has Child Cat Is Not  */
        $numChild = Cat::where([["cat_status", 1], ["parent_id", $id]])->count();
        /* Defind Data Update */
        $catRq["cat_slug"] = Str::slug($request->cat_title) . "-" . time();
        $catRq["parent_id"] = $request->parent_id ?? 0;
        $message = "Cập Nhật Danh Mục Thành Công";
        if ($numChild) {
            $message = "Danh Mục Đã Cập Nhật! D.Mục Cha Còn Con Không Di Chuyển Được!";
            unset($catRq["parent_id"]);
        }
        Cat::where("cat_id", $id)->update($catRq);
        return redirect()->back()->with("success", $message);
    }

    
    /* Hanlde Delete Category Post */
    public function getDeleteCategory($id)
    {
        /* Check Cat Parent Has Child Cat Is Not  */
        $numChild = Cat::where([["cat_status", 1], ["parent_id", $id]])->count();
        if ($numChild) {
            $message = "Không Thể Xóa Khi Còn Danh Mục Con";
            return redirect()->back()->withErrors($message);
        }
        $status = Cat::where("cat_id", $id)->update(
            ["cat_status" => -1]
        );
        return redirect()->back()->with("success", "Xóa Thành Công Danh Mục !");
    }

    /* Handle Show View Add Post */
    public function getAdd()
    {
        $cats = Cat::where("cat_status", 1)->get();
        return view("admin.post.add", compact("cats"));
    }

    /* Handle Add Post  */
    public function postAdd(\App\Http\Requests\Admin\Post\AddRequest $request)
    {
        $postRq = $request->validated();
        /* Convert Post Slug */
        $postRq["post_slug"] = Str::slug($postRq["post_title"]);
        $postRq["user_id"] = Auth::id();
        if ($request->hasFile("file")) {
            $dir = $this->dirUpload;
            $file = $request->file;
            $filename = $this->setNameImage($file, $postRq["post_slug"]);
            $file->move($dir, $filename);
            $postRq["post_thumbnail"] = $dir . $filename;
        }
        Post::create($postRq);
        return redirect()->back()->with("success", "Thêm Thành Công!");
    }
    /* Handle Show View Post */
    public function getIndex()
    {
        return view("admin.post.index");
    }

    /* Handle Datatable Post */
    public function getDatatable()
    {
        /* Option Case */
        $setText = function ($value) {
            return "<span>{$value}</span>";
        };
        $setAvatar = function ($thumbnail) {
            if ($thumbnail) {
                return '<a href="" class="box-thumbnail avatar">
                            <img src="' . asset($thumbnail) . '"/>
                        </a>';
            }
            return 'No Image';
        };
        $setAction = function ($post) {
            $routeUpdate = route("admin.post.update", $post->post_id);
            $routeDelete = route("admin.post.delete", $post->post_id);
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
        $posts = Post::getPostAdmins();
        $postRenders = \Yajra\Datatables\Datatables::of($posts)
            ->editColumn("post_id", function ($post) use ($setText) {
                return $setText($post->post_id);
            })
            ->editColumn("post_thumbnail", function ($post) use ($setAvatar) {
                return $setAvatar($post->post_thumbnail);
            })
            ->editColumn("post_title", function ($post) use ($setText) {
                return $setText($post->post_title);
            })
            ->editColumn("cat_title", function ($post) use ($setText) {
                return $setText($post->cat_title ?? "Không");
            })
            ->editColumn("fullname", function ($post) use ($setText) {
                return $setText($post->fullname);
            })
            ->editColumn("post_status", function ($post) use ($setText) {
                return [$setText("Tạm Lưu"), $setText("Đã Xuất Bản")][$post->post_status];
            })
            ->editColumn("created_at", function ($post) use ($setText) {
                return $setText(date("Y-m-d", strtotime($post->created_at)));
            })
            ->addColumn("action", function ($posts) use ($setAction) {
                return $setAction($posts);
            })
            ->rawColumns(
                ["post_id", "post_thumbnail", "post_title", "cat_title", "fullname", "post_status", "created_at", "action"]
            )
            ->make(true);
        return $postRenders;
    }
    /* Handle  Show View Update Post*/

    public function getUpdate($id)
    {
        $post = Post::whereIn("post_status", [0, 1])->where("post_id", $id)->first();
        $cats = Cat::where("cat_status", 1)->get();
        return view("admin.post.add", compact("post", "cats"));
    }

    /* Handle Update Post */
    public function postUpdate(\App\Http\Requests\Admin\Post\AddRequest $request, $id)
    {
        $post = Post::select("post_id", "post_thumbnail")->find($id);
        $postRq = $request->validated();
        $postRq["post_slug"] = Str::slug($postRq["post_title"]);
        /* Check Remove Image Old  */
        if (!$request->imgs) {
            $postRq["post_thumbnail"] = null;
            is_file($post->post_thumbnail) && unlink($post->post_thumbnail);
        }
        if ($request->hasFile("file")) {
            $dir = $this->dirUpload;
            $file = $request->file("file");
            $filename = $this->setNameImage($file, $postRq["post_slug"]);
            $file->move($dir, $filename);
            $postRq["post_thumbnail"] = $dir . $filename;
            /* Xóa File Cũ */
            if ($post->post_thumbnail) {
                if (is_file($post->post_thumbnail)) {
                    unlink($post->post_thumbnail);
                }
            }
        }
        $post->update($postRq);
        return redirect()->back()->with("success", "Cập Nhật Thành Công");
    }

    /* Handle Delete Post */
    public function getDelete($id)
    {
        $status = Post::find($id)->update(
            ["post_status" => -1]
        );
        return response()->json(["message" => "Xóa Được {$status} Bài Viết", "status" => $status]);
    }

    protected function setNameImage($file, $oldName)
    {
        return $oldName . "-" . time() . "." . $file->getClientOriginalExtension();
    }
}
