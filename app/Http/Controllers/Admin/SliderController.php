<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function __construct()
    {
        /* Set Globaly Dir Upload Image Of Slider */
        $this->dirUpload = "source/img/sliders/";
    }

    /* Handle Show View Add And Index */
    public function getAdd($id = null)
    {
        $slider = Slider::find($id);
        return view("admin.slider.add", compact("slider"));
    }
    /* Handle Add Database Slider */
    public function postAdd(\App\Http\Requests\Admin\Slider\AddRequest $request)
    {
        $sliderRq = $request->validated();
        $idLogin = Auth::id();
        $sliderRq["user_id"] = $idLogin;
        $sliderRq["sort"] = (int) $sliderRq["sort"];
        /* Check Upload File */
        if ($request->hasFile("file")) {
            $file = $request->file("file");
            $filename = "slider_" . time() . "." . $file->getClientOriginalExtension();
            $dir = $this->dirUpload;
            $file->move($dir, $filename);
            $sliderRq["slider_thumbnail"] = $dir . $filename;
        }
        Slider::create($sliderRq);
        return redirect()->back()->with("success", "Thêm Thành Slider !");
    }
    /* Handle Datatable Slider */
    public function getDatatable()
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
            $routeUpdate = route("admin.slider.add", $value->slider_id);
            $routeDelete = route("admin.slider.delete", $value->slider_id);
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
        $sliders = Slider::getsliderAdmins();
        $sliderRenders = \Yajra\Datatables\Datatables::of($sliders)
            ->editColumn("slider_id", function ($slider) use ($setText) {
                return $setText($slider->slider_id);
            })
            ->editColumn("slider_thumbnail", function ($slider) use ($setAvatar) {
                return $setAvatar($slider->slider_thumbnail);
            })
            ->editColumn("slider_link", function ($slider) use ($setText) {
                return $setText(!empty($slider->slider_link)
                    ? "<a href='{$slider->slider_link}' target='_blank'>{$slider->slider_link}</a>"
                    : "Không Có");
            })
            ->editColumn("fullname", function ($slider) use ($setText) {
                return $setText($slider->fullname);
            })
            ->editColumn("slider_type", function ($slider) use ($setText) {
                return [$setText("Nhỏ"), $setText("Lớn")][$slider->slider_type];
            })
            ->editColumn("slider_status", function ($slider) use ($setText) {
                return [$setText("Tạm Lưu"), $setText("Xuất Bản")][$slider->slider_status];
            })
            ->editColumn("created_at", function ($slider) use ($setText) {
                return $setText(date("Y-m-d", strtotime($slider->created_at)));
            })
            ->editColumn("sort", function ($slider) use ($setText) {
                return $setText($slider->sort);
            })
            ->addColumn("action", function ($sliders) use ($setAction) {
                return $setAction($sliders);
            })
            ->rawColumns(["fullname", "slider_link", "slider_type", "slider_status", "slider_thumbnail", "action", "slider_id", "sort", "created_at"])
            ->make(true);
        return $sliderRenders;
    }
    /* Handle Update Slider */
    public function postUpdate(\App\Http\Requests\Admin\Slider\AddRequest $request, $id)
    {
        $slider = Slider::select("slider_id", "slider_thumbnail")->find($id);
        $sliderRq = $request->validated();
        if ($request->hasFile("file")) {
            $dir = $this->dirUpload;
            $file = $request->file("file");
            $filename = $this->setNameImage($file, "slider");
            $file->move($dir, $filename);
            $sliderRq["slider_thumbnail"] = $dir . $filename;
            /* Xóa File Cũ */
            if ($slider->slider_thumbnail) {
                if (is_file($slider->slider_thumbnail)) {
                    unlink($slider->slider_thumbnail);
                }
            }
        }
        $slider->update($sliderRq);
        return redirect()->back()->with("success", "Cập Nhật Thành Công!");
    }
    /* Handle Delete Slider */
    public function getDelete($id)
    {
        $slider = Slider::find($id);
        if(is_file($slider->slider_thumbnail)){
            unlink($slider->slider_thumbnail);
        }
        $slider->update([
            "slider_status"=>-1
        ]);
        return redirect()->route("admin.slider.add")->with("success","Xóa Thành Công Slider!");
    }

    protected function setNameImage($file, $oldName)
    {
        return $oldName . "-" . rand(1, 2000) . "." . $file->getClientOriginalExtension();
    }
}
