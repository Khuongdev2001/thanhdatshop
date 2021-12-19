<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class provinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinceStr='[
            {
            "province_id": "01",
            "province_name": "Thành phố Hà Nội"
            },
            {
            "province_id": "79",
            "province_name": "Thành phố Hồ Chí Minh"
            },
            {
            "province_id": "31",
            "province_name": "Thành phố Hải Phòng"
            },
            {
            "province_id": "48",
            "province_name": "Thành phố Đà Nẵng"
            },
            {
            "province_id": "92",
            "province_name": "Thành phố Cần Thơ"
            },
            {
            "province_id": "02",
            "province_name": "Tỉnh Hà Giang"
            },
            {
            "province_id": "04",
            "province_name": "Tỉnh Cao Bằng"
            },
            {
            "province_id": "06",
            "province_name": "Tỉnh Bắc Kạn"
            },
            {
            "province_id": "08",
            "province_name": "Tỉnh Tuyên Quang"
            },
            {
            "province_id": "10",
            "province_name": "Tỉnh Lào Cai"
            },
            {
            "province_id": "11",
            "province_name": "Tỉnh Điện Biên"
            },
            {
            "province_id": "12",
            "province_name": "Tỉnh Lai Châu"
            },
            {
            "province_id": "14",
            "province_name": "Tỉnh Sơn La"
            },
            {
            "province_id": "15",
            "province_name": "Tỉnh Yên Bái"
            },
            {
            "province_id": "17",
            "province_name": "Tỉnh Hoà Bình"
            },
            {
            "province_id": "19",
            "province_name": "Tỉnh Thái Nguyên"
            },
            {
            "province_id": "20",
            "province_name": "Tỉnh Lạng Sơn"
            },
            {
            "province_id": "22",
            "province_name": "Tỉnh Quảng Ninh"
            },
            {
            "province_id": "24",
            "province_name": "Tỉnh Bắc Giang"
            },
            {
            "province_id": "25",
            "province_name": "Tỉnh Phú Thọ"
            },
            {
            "province_id": "26",
            "province_name": "Tỉnh Vĩnh Phúc"
            },
            {
            "province_id": "27",
            "province_name": "Tỉnh Bắc Ninh"
            },
            {
            "province_id": "30",
            "province_name": "Tỉnh Hải Dương"
            },
            {
            "province_id": "33",
            "province_name": "Tỉnh Hưng Yên"
            },
            {
            "province_id": "34",
            "province_name": "Tỉnh Thái Bình"
            },
            {
            "province_id": "35",
            "province_name": "Tỉnh Hà Nam"
            },
            {
            "province_id": "36",
            "province_name": "Tỉnh Nam Định"
            },
            {
            "province_id": "37",
            "province_name": "Tỉnh Ninh Bình"
            },
            {
            "province_id": "38",
            "province_name": "Tỉnh Thanh Hóa"
            },
            {
            "province_id": "40",
            "province_name": "Tỉnh Nghệ An"
            },
            {
            "province_id": "42",
            "province_name": "Tỉnh Hà Tĩnh"
            },
            {
            "province_id": "44",
            "province_name": "Tỉnh Quảng Bình"
            },
            {
            "province_id": "45",
            "province_name": "Tỉnh Quảng Trị"
            },
            {
            "province_id": "46",
            "province_name": "Tỉnh Thừa Thiên Huế"
            },
            {
            "province_id": "49",
            "province_name": "Tỉnh Quảng Nam"
            },
            {
            "province_id": "51",
            "province_name": "Tỉnh Quảng Ngãi"
            },
            {
            "province_id": "52",
            "province_name": "Tỉnh Bình Định"
            },
            {
            "province_id": "54",
            "province_name": "Tỉnh Phú Yên"
            },
            {
            "province_id": "56",
            "province_name": "Tỉnh Khánh Hòa"
            },
            {
            "province_id": "58",
            "province_name": "Tỉnh Ninh Thuận"
            },
            {
            "province_id": "60",
            "province_name": "Tỉnh Bình Thuận"
            },
            {
            "province_id": "62",
            "province_name": "Tỉnh Kon Tum"
            },
            {
            "province_id": "64",
            "province_name": "Tỉnh Gia Lai"
            },
            {
            "province_id": "66",
            "province_name": "Tỉnh Đắk Lắk"
            },
            {
            "province_id": "67",
            "province_name": "Tỉnh Đắk Nông"
            },
            {
            "province_id": "68",
            "province_name": "Tỉnh Lâm Đồng"
            },
            {
            "province_id": "70",
            "province_name": "Tỉnh Bình Phước"
            },
            {
            "province_id": "72",
            "province_name": "Tỉnh Tây Ninh"
            },
            {
            "province_id": "74",
            "province_name": "Tỉnh Bình Dương"
            },
            {
            "province_id": "75",
            "province_name": "Tỉnh Đồng Nai"
            },
            {
            "province_id": "77",
            "province_name": "Tỉnh Bà Rịa - Vũng Tàu"
            },
            {
            "province_id": "80",
            "province_name": "Tỉnh Long An"
            },
            {
            "province_id": "82",
            "province_name": "Tỉnh Tiền Giang"
            },
            {
            "province_id": "83",
            "province_name": "Tỉnh Bến Tre"
            },
            {
            "province_id": "84",
            "province_name": "Tỉnh Trà Vinh"
            },
            {
            "province_id": "86",
            "province_name": "Tỉnh Vĩnh Long"
            },
            {
            "province_id": "87",
            "province_name": "Tỉnh Đồng Tháp"
            },
            {
            "province_id": "89",
            "province_name": "Tỉnh An Giang"
            },
            {
            "province_id": "91",
            "province_name": "Tỉnh Kiên Giang"
            },
            {
            "province_id": "93",
            "province_name": "Tỉnh Hậu Giang"
            },
            {
            "province_id": "94",
            "province_name": "Tỉnh Sóc Trăng"
            },
            {
            "province_id": "95",
            "province_name": "Tỉnh Bạc Liêu"
            },
            {
            "province_id": "96",
            "province_name": "Tỉnh Cà Mau"
            }
            ]';

        $provinces=json_decode($provinceStr,true);
        foreach($provinces as &$province){
            $province["province_id"]=(int) $province["province_id"];
        }

        // dd($provinces);


        DB::table("provinces")->insert($provinces);
    }
}
