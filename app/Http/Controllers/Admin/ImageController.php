<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    public function handleUploadEditor(Request $request){
        /* Create Rules */
        $rules=[
            'file' => ['required','image','mimes:jpeg,png','mimetypes:image/jpeg,image/png','max:1024']
        ];
        /* Create Message If Error */
        $messages= [
            "file.required"=>"Không Tìm Thấy Ảnh",
            "file.mimes"=>"Không Phải Định Dạng Ảnh",
            "file.max"=>"Ảnh Tối Đa 1MB"
        ];
        /* Start Validate */
        $validates=Validator::make($request->all(),$rules,$messages);
        /* Loop Error */
        foreach($validates->errors()->all() as $error){
            return response()->json(["status"=>false ,"message"=>$error],404);
        }
        $dir="source/img/upload_editor/";
        $file=$request->file;
        /* Get File Name */
        $filename="editor_".$file->getClientOriginalName();
        $urlReponse=asset($dir.$filename);
        /* If File Exist No Upload */
        if(file_exists($dir.$filename)){
            return response()->json(["status"=>true ,"url"=>$urlReponse],200);
        }
        $file->move($dir,$filename);
        return response()->json(["status"=>true ,"url"=>$urlReponse],200);
    }
}
