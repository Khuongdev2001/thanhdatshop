@extends("admin.master.layout")
@section("css")    
@endsection
@section("js")
<script src="{{asset("source/admin/js/validate/validate.js")}}"></script>
<script>
/* Start Validate Form Reg */
Validator({
    form:"#form-add-user",
    rules:[
        Validator.isRequired("#fullname","Không Được Để Trống Họ Và Tên!"),
        Validator.minLengthValue("#fullname","Họ và Tên Tối Thiểu 5 Từ!",5),
        Validator.maxLengthValue("#fullname","Họ và Tên Tối Đa 30 Từ!",30),
        Validator.isRequired("#email","Không Được Để Trống Email!"),
        Validator.minLengthValue("#email","Email Tối Thiểu 5 Từ!",5),
        Validator.maxLengthValue("#email","Email Tối Đa 30 Từ!",30),
        Validator.isEmail("#email","Sai Định Dạng Email!"),
        Validator.isRequired("#password","Không Được Để Trống Mật Khẩu!"),
        Validator.minLengthValue("#password","Mật Khẩu Tối Thiểu 5 Từ!",5),
        Validator.maxLengthValue("#password","Mật Khẩu Tối Đa 30 Từ!",30),
        Validator.isRequired("#password_confirm","Không Được Để Trống Mật Khẩu!"),
        Validator.isConfirm("#password_confirm","#password","Mật Khẩu Xác Thực Không Khớp!"),
        Validator.maxLengthValue("#province","Tỉnh Thành Tối Đa 30 Từ!",30),
        Validator.maxLengthValue("#district","Huyện Thành Tối Đa 30 Từ!",30),
        Validator.maxLengthValue("#address","Địa Chỉ Thành Tối Đa 200 Từ!",200),
        Validator.isPhone("#phone","Sai Định Dạng Số Điện Thoại!"),
        Validator.isRequired("#level","Không Được Bỏ Trống Cấp Bậc!"),
        Validator.inValue("#level",[1,2],"Sai Cấu Trúc HTML!"),
    ]
})
</script>
@endsection

@section("content")
<div class="breadcome-area">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="breadcome-list">
               <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                     <div class="breadcomb-wp">
                        <div class="breadcomb-icon">
                           <i class="icon nalika-home"></i>
                        </div>
                        <div class="breadcomb-ctn">
                           <h2>{{isset($user) ? "Cập Nhật Thành Viên" : "Thêm Thành Viên"}}</h2>
                           <p>Welcome to Nalika <span class="bread-ntd">Admin Template</span></p>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                     <div class="breadcomb-report">
                        <button data-toggle="tooltip" data-placement="left" title="Download Report" class="btn"><i class="icon nalika-download"></i></button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="single-product-tab-area mg-b-30">
   <!-- Single pro tab review Start-->
   <div class="single-pro-review-area">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="review-tab-pro-inner">
                  <div id="myTabContent" class="tab-content custom-product-edit">
                     <form id="form-add-user" action="{{ isset($user) 
                     ? route("admin.user.update",$user->user_id) 
                     : route("admin.user.add")
                     }}" method="POST">
                        @csrf
                        <div class="row">
                           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <div class="review-content-section">
                                 <div class="form-group mg-b-pro-edt">
                                    <input type="text" id="fullname" class="form-control" name="fullname" 
                                       value="{{old("fullname") ?? $user->fullname ?? null}}" placeholder="Họ Và Tên">
                                    <span class="help-block small invalid-feedback"></span>
                                 </div>
                                 <div class="mg-b-pro-edt">
                                    <input type="text" id="email" class="form-control" name="email" 
                                       value="{{old("email") ?? $user->email ?? null}}" placeholder="Email" >
                                    <span class="help-block small invalid-feedback"></span>
                                 </div>
                                 <div class="mg-b-pro-edt">
                                    <input type="password" class="form-control" id="password" name="password" 
                                       value="{{old("password_confirm")}}" placeholder="Mật Khẩu">
                                    <span class="help-block small invalid-feedback"></span>
                                 </div>
                                 <div class="mg-b-pro-edt">
                                    <input type="password" class="form-control" id="password_confirm" 
                                       value="{{old("password_confirm")}}" name="password_confirm" placeholder="Xác Nhận Mật Khẩu">
                                    <span class="help-block small invalid-feedback"></span>
                                 </div>
                                 <div class="mg-b-pro-edt">
                                    <input type="text" class="form-control" id="phone" name="phone" 
                                       value="{{old("phone") ?? $user->phone ?? null}}" placeholder="Số Điện Thoại">
                                    <span class="help-block small invalid-feedback"></span>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <div class="review-content-section">
                                 <div class="mg-b-pro-edt">
                                    <input type="text" class="form-control" id="province" name="province" 
                                       value="{{old("province") ?? $user->province ?? null}}" placeholder="Tỉnh Thành">
                                    <span class="help-block small invalid-feedback"></span>
                                 </div>
                                 <div class="mg-b-pro-edt">
                                    <input type="text" class="form-control" id="district" name="district" 
                                       value="{{old("district") ?? $user->district ?? null}}" placeholder="Huyện">
                                    <span class="help-block small invalid-feedback"></span>
                                 </div>
                                 <div class="mg-b-pro-edt">
                                    <textarea type="text" class="form-control" id="address" name="address" 
                                       value="{{old("address") ?? $user->address ?? null}}" placeholder="Địa Chỉ"></textarea>
                                    <span class="help-block small invalid-feedback"></span>
                                 </div>
                                 <div class="mg-b-pro-edt">
                                    <select class="form-control pro-edt-select form-control-primary" id="level" name="level">
                                       @foreach([""=>"Cấp Bậc",1=>"Khách Hàng",2=>"Quản Trị Viên"] as $value=>$text)
                                          <option value="{{$value}}"
                                          @if(old("level")==$value || isset($user) && $user->level==$value)
                                             selected
                                          @endif   
                                          >{{$text}}</option>
                                       @endforeach
                                    </select>
                                    <span class="help-block small invalid-feedback"></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <div class="text-center custom-pro-edt-ds">
                                 <button class="btn btn-ctl-bt waves-effect waves-light m-r-10">Lưu
                                 </button>
                                 <button class="btn btn-ctl-bt waves-effect waves-light">Quay Lại
                                 </button>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection