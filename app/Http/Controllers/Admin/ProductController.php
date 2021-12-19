<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\CatProduct as Cat;
use App\Models\ProductThumbnail;
use App\Models\Product;
use App\Models\Brand;

class ProductController extends Controller
{
    public function __construct()
    {
        /* Set Globaly Dir Upload Image Of Product */
        $this->dirUpload = "source/img/products/";
        $this->dirUploadCat = "source/img/products/cats";
        $this->dirUploadBrand = "source/img/products/brands/";
    }
    /* Handle Show View Add Cat  */
    public function getAddCategory($id = null)
    {
        $cats = Cat::getCatModel([
            "cat_id as module_id",
            "parent_id",
            "cat_title as module_title"
        ])->where("cat_id", "<>", $id)->get();
        $cat = Cat::find($id);
        return view("admin.product.cat.add", compact("cats", "cat"));
    }

    /* Handle Add Database Cat Product */
    public function postAddCategory(\App\Http\Requests\Admin\Product\Cat\AddRequest $request)
    {
        $catRq = $request->validated();
        $idLogin = Auth::id();
        $catRq["cat_slug"] = Str::slug($request->cat_title);
        $catRq["user_id"] = $idLogin;
        $catRq["sort"] = (int) $catRq["sort"];
        $catRq["parent_id"] = (int) $catRq["parent_id"];
        /* Check Upload File */
        if ($request->hasFile("file")) {
            $file = $request->file("file");
            $filename = $catRq["cat_slug"] . "_cat." . $file->getClientOriginalExtension();
            $dir = $this->dirUploadCat;
            $file->move($dir, $filename);
            $catRq["cat_thumbnail"] = $dir . $filename;
        }
        Cat::create($catRq);
        return redirect()->back()->with("success", "Thêm Thành Công Danh Mục !");
    }

    /* Handle Datatable Cat Product */
    public function getDatatableCategory()
    {
        /* Option Case */
        $setText = function ($value) {
            return "<span>{$value}</span>";
        };
        $setAvatar = function ($thumbnail) {
            if ($thumbnail) {
                return '<a href="" class="box-thumbnail cat avatar">
                            <img src="' . asset($thumbnail) . '"/>
                        </a>';
            }
            return 'No Image';
        };
        $setAction = function ($value) {
            $routeUpdate = route("admin.product.category.add", $value->cat_id);
            $routeDelete = route("admin.product.category.delete", $value->cat_id);
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
            "cat_title as module_title",
            "cat_slug",
            "cat_thumbnail",
            "sort",
            "fullname",
            "parent_id",
            "cat_products.created_at"
        ])
        ->leftJoin("users","users.user_id","cat_products.user_id")
        ->get();
        $cats = convertCat($cats);
        $catRenders = \Yajra\Datatables\Datatables::of($cats)
            ->addColumn("cat_id", function ($cat) use ($setText) {
                return $setText($cat->cat_id);
            })
            ->editColumn("cat_thumbnail", function ($cat) use ($setAvatar) {
                return $setAvatar($cat->cat_thumbnail);
            })
            ->editColumn("fullname", function ($cat) use ($setText) {
                return $setText($cat->fullname);
            })
            ->editColumn("created_at", function ($cat) use ($setText) {
                return $setText(date("Y-m-d", strtotime($cat->created_at)));
            })
            ->addColumn("cat_title", function ($cat) use ($setText) {
                return $setText($cat["level"] . $cat->cat_title);
            })
            ->editColumn("sort", function ($cat) use ($setText) {
                return $setText($cat->sort);
            })
            ->addColumn("action", function ($cats) use ($setAction) {
                return $setAction($cats);
            })
            ->rawColumns(["fullname", "cat_thumbnail", "action", "cat_id", "sort", "cat_title", "created_at"])
            ->make(true);
        return $catRenders;
    }

    /* Handle Update Cat */
    public function postUpdateCategory(\App\Http\Requests\Admin\Product\Cat\AddRequest $request, $id)
    {
        $cat = Cat::select("cat_id", "cat_thumbnail")->find($id);
        $catRq = $request->validated();
        $catRq["cat_slug"] = Str::slug($catRq["cat_title"]);
        $catRq["parent_id"] = (int) $catRq["parent_id"];
        /* Check Remove Image Old  */
        if (!$request->imgs) {
            $catRq["cat_thumbnail"] = null;
            is_file($cat->cat_thumbnail) && unlink($cat->cat_thumbnail);
        }
        if ($request->hasFile("file")) {
            $dir = $this->dirUploadCat;
            $file = $request->file("file");
            $filename = $this->setNameImage($file, $catRq["cat_slug"]);
            $file->move($dir, $filename);
            $catRq["cat_thumbnail"] = $dir . $filename;
            /* Xóa File Cũ */
            if ($cat->cat_thumbnail) {
                if (is_file($cat->cat_thumbnail)) {
                    unlink($cat->cat_thumbnail);
                }
            }
        }
        $cat->update($catRq);
        return redirect()->back()->with("success", "Cập Nhật Thành Công");
    }

    /* Hanlde Delete Category Product */
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
    /* Handle Show View Add Product */
    public function getAdd()
    {
        $cats = Cat::where("cat_status", 1)->get();
        $brands = Brand::where("brand_status", 1)->get();
        return view("admin.product.add", compact("cats", "brands"));
    }

    /* Handle Add Product Database */
    public function postAdd(\App\Http\Requests\Admin\Product\AddRequest $request)
    {
        $productRq = $request->validated();
        $productRq["product_slug"] = Str::slug($productRq["product_title"]);
        $productRq["user_id"] = Auth::id();
        $id = Product::create($productRq)->product_id;
        $images = [];
        if ($request->hasFile("files")) {
            $files = $request->file("files");
            /* Loop File Upload */
            foreach ($files as $file) {
                $filename = $this->setNameImage($file, $productRq["product_slug"]);
                $dir = $this->dirUpload;
                $file->move($dir, $filename);
                $images[] = ["url" => $dir . $filename, "product_id" => $id];
            }
            ProductThumbnail::insert($images);
        }
        return redirect()->back()->with("success", "Thêm Thành Công!");
    }

    /* Handle Show View Products */
    public function getIndex()
    {
        return view("admin.product.index");
    }

    /* Handle Show View Datatable */
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
        $setAction = function ($product) {
            $routeUpdate = route("admin.product.update", $product->product_id);
            $routeDelete = route("admin.product.delete", $product->product_id);
            return '
            <div>
                <a href="' . $routeUpdate . '" class="btn btn-info btn-edit" target="_blank">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>
                <a href="' . $routeDelete . '" class="btn btn-danger btn-delete">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                </a>
            </div>';
        };
        /* Handle Render */
        $products = Product::getproductAdmins();
        $productRenders = \Yajra\Datatables\Datatables::of($products)
            ->editColumn("product_id", function ($product) use ($setText) {
                return $setText($product->product_id);
            })
            ->editColumn("product_thumbnail", function ($product) use ($setAvatar) {
                return $setAvatar($product->product_thumbnail);
            })
            ->editColumn("product_title", function ($product) use ($setText) {
                return $setText($product->product_title);
            })
            ->addColumn("price", function ($product) use ($setText) {
                return $setText($product->price
                    ? currencyFormat($product->price)
                    : "...");
            })
            ->editColumn("brand_name", function ($product) use ($setText) {
                return $setText($product->brand_name ?? "...");
            })
            ->editColumn("cat_title", function ($product) use ($setText) {
                return $setText($product->cat_title ?? "...");
            })
            ->editColumn("fullname", function ($product) use ($setText) {
                return $setText($product->fullname);
            })
            ->editColumn("product_status", function ($product) use ($setText) {
                return [$setText("Tạm Lưu"), $setText("Xuất Bản")][$product->product_status];
            })
            ->editColumn("created_at", function ($product) use ($setText) {
                return $setText(date("Y-m-d", strtotime($product->created_at)));
            })
            ->addColumn("action", function ($products) use ($setAction) {
                return $setAction($products);
            })
            ->rawColumns(
                [
                    "product_id",
                    "product_thumbnail",
                    "product_title",
                    "cat_title",
                    "fullname",
                    "product_status",
                    "price",
                    "brand_name",
                    "created_at",
                    "action"
                ]
            )
            ->make(true);

        return $productRenders;
    }

    /* Handle Show View Update Product */
    public function getUpdate($id)
    {
        $product = Product::where("product_status", "<>", -1)->where("product_id", $id)->first();
        $brands = Brand::where("brand_status", 1)->get();
        $productThumbnails = $product->images;
        $cats = Cat::where("cat_status", 1)->get();
        return view("admin.product.add", compact("product", "cats", "productThumbnails", "brands"));
    }

    /* Hanlde Update Product Database */
    public function postUpdate(\App\Http\Requests\Admin\Product\UpdateRequest $request, $id)
    {
        $productRq = $request->validated();
        $productRq["product_slug"] = Str::slug($productRq["product_title"]);
        $imgOlds = $request->imgs ? $request->imgs : [];
        /* Handle Delete Not Select */
        /* Get File No Select */
        $imgNotSelectModel = ProductThumbnail::where("product_id", $id)
            ->whereNotIn("thumbnail_id", $imgOlds);
        $imgNotSelects = $imgNotSelectModel->get("url");
        if (isset($imgNotSelects[0])) {
            foreach ($imgNotSelects as $img) {
                if (is_file($img->url)) {
                    unlink($img->url);
                }
            }
            $imgNotSelectModel->delete();
        }
        /* Handle Upload File */
        $imgs = [];
        if ($request->hasFile("files")) {
            $files = $request->file("files");
            /* Loop File Upload */
            foreach ($files as $file) {
                $filename = $this->setNameImage($file, $productRq["product_slug"]);
                $dir = $this->dirUpload;
                $file->move($dir, $filename);
                $imgs[] = ["url" => $dir . $filename, "product_id" => $id];
            }
            ProductThumbnail::insert($imgs);
        }

        /* Handle Update Product */
        Product::find($id)->update($productRq);
        return redirect()->back()->with("success", "Cập Nhật Thành Công!");
    }
    /* Handle Delete Product */

    public function getDelete($id)
    {
        $status = Product::find($id)->update([
            "product_status" => -1
        ]);
        return response()->json(["message" => "Xóa Được {$status} Sản Phẩm", "status" => $status]);
    }

    private function setNameImage($file, $oldName)
    {
        return $oldName . "-" . rand(1, 2000) . "." . $file->getClientOriginalExtension();
    }

    /* Handle Add Brand Product */
    public function getAddBrand($id = null)
    {
        $brand = Brand::find($id);
        return view("admin.product.brand.add", compact("brand"));
    }
    /* Handle Post Add Database Brand Product */
    public function postAddBrand(\App\Http\Requests\Admin\Product\Brand\AddRequest $request)
    {

        $brandRq = $request->validated();
        $brandRq["sort"] = (int) $brandRq["sort"];
        /* Check Upload File */
        if ($request->hasFile("file")) {
            $file = $request->file("file");
            $filename = $this->setNameImage($file, Str::slug($request->brand_name));
            $dir = $this->dirUploadBrand;
            $file->move($dir, $filename);
            $brandRq["brand_image"] = $dir . $filename;
        }
        Brand::create($brandRq);
        return redirect()->back()->with("success", "Thêm Thành Công Thương Hiệu!");
    }

    /* Handle Datatable Brand Product */
    public function getDatatableBrand()
    {
        $brands = Brand::where("brand_status", 1)->get();
        /* Option Case */
        $setLink = function ($value, $text) {
            return "<a href='{$value}' target='_blank'>{$text}</a>";
        };
        $setText = function ($value) {
            return "<span>{$value}</span>";
        };
        $setAvatar = function ($image) {
            if ($image) {
                return '<a href="" class="box-thumbnail cat avatar">
                            <img src="' . asset($image) . '"/>
                        </a>';
            }
            return 'No Image';
        };
        $setAction = function ($value) {
            $routeUpdate = route("admin.product.brand.add", $value->brand_id);
            $routeDelete = route("admin.product.brand.delete", $value->brand_id);
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
        $brandRenders = \Yajra\Datatables\Datatables::of($brands)
            ->editColumn("brand_id", function ($brand) use ($setText) {
                return $setText($brand->brand_id);
            })
            ->editColumn("brand_image", function ($brand) use ($setAvatar) {
                return $setAvatar($brand->brand_image);
            })
            ->editColumn("brand_name", function ($brand) use ($setText) {
                return $setText($brand->brand_name);
            })
            ->editColumn("sort", function ($brand) use ($setText) {
                return $setText($brand->sort);
            })
            ->editColumn("brand_sort", function ($brand) use ($setText) {
                return $setText($brand->brand_sort);
            })
            ->editColumn("brand_link", function ($brand) use ($setLink) {
                return $setLink($brand->brand_link, $brand->brand_link);
            })
            ->editColumn("created_at", function ($brand) use ($setText) {
                return $setText(date("Y-m-d", strtotime($brand->created_at)));
            })
            ->addColumn("action", function ($brands) use ($setAction) {
                return $setAction($brands);
            })
            ->rawColumns(["brand_id", "brand_image", "brand_name", "sort", "brand_link", "action", "created_at"])
            ->make(true);
        return $brandRenders;
    }

    /* Handle Update Brand Product */
    public function postUpdateBrand(\App\Http\Requests\Admin\Product\Brand\AddRequest $request, $id)
    {
        $brand = Brand::select("brand_id", "brand_image")->find($id);
        $brandRq = $request->validated();
        /* Check Remove Image Old  */
        if (!$request->imgs) {
            $brandRq["brand_image"] = null;
            is_file($brand->brand_image) && unlink($brand->brand_image);
        }
        if ($request->hasFile("file")) {
            $dir = $this->dirUploadBrand;
            $file = $request->file("file");
            $filename = $this->setNameImage($file, Str::slug($request->brand_name));
            $file->move($dir, $filename);
            $brandRq["brand_image"] = $dir . $filename;
            /* Xóa File Cũ */
            if ($brand->brand_image) {
                if (is_file($brand->brand_image)) {
                    unlink($brand->brand_image);
                }
            }
        }
        $brand->update($brandRq);
        return redirect()->back()->with("success", "Cập Nhật Thành Công!");
    }

    /* Handle Delete Brand Product */
    public function getDeleteBrand($id)
    {
        $brand = Brand::find($id);
        if (is_file($brand->brand_image)) {
            unlink($brand->brand_image);
        }
        $brand->update([
            "brand_status" => -1
        ]);
        return redirect()->route("admin.product.brand.add")
            ->with("success", "Xóa Thành Công");
    }
}
