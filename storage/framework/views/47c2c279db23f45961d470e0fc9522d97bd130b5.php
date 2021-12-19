<div style="background-color: #ffffff; color: #000000;">
    <div style="margin: 0px auto;">
        <div style="padding: 30px 20px;">
            <table
                align="center"
                bgcolor="#dcf0f8"
                border="0"
                cellpadding="0"
                cellspacing="0"
                style="margin: 0; padding: 0; background-color: #ffffff; width: 100% !important; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #444; line-height: 18px;"
                width="100%"
            >
                <tbody>
                    <tr>
                        <td>
                            <h1 style="font-size: 17px; font-weight: bold; color: #444; padding: 0 0 5px 0; margin: 0;">Cảm ơn quý khách <?php echo e($cart["buyer_fullname"]); ?> đã đặt hàng tại <span class="il">Thành Đạt</span>,</h1>

                            <p style="margin: 4px 0; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #444; line-height: 18px; font-weight: normal;">
                                <span class="il">Thành Đạt</span> rất vui thông báo đơn hàng <?php echo e($cart["code"]); ?> của quý khách đã được tiếp nhận và đang trong quá trình xử lý. <span class="il">Thành Đạt</span> sẽ thông báo đến quý khách ngay khi hàng chuẩn bị
                                được giao.
                            </p>

                            <h3 style="font-size: 13px; font-weight: bold; color: #02acea; text-transform: uppercase; margin: 20px 0 0 0; border-bottom: 1px solid #ddd;">
                                Thông tin đơn hàng <?php echo e($cart["code"]); ?> <span style="font-size: 12px; color: #777; text-transform: none; font-weight: normal;">(<?php echo e($cart["created_at"]); ?>)</span>
                            </h3>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #444; line-height: 18px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th align="left" style="padding: 6px 9px 0px 9px; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #444; font-weight: bold;" width="50%">Thông tin thanh toán</th>
                                        <th align="left" style="padding: 6px 9px 0px 9px; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #444; font-weight: bold;" width="50%">Địa chỉ giao hàng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="padding: 3px 9px 9px 9px; border-top: 0; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #444; line-height: 18px; font-weight: normal;" valign="top">
                                            <span style="text-transform: capitalize;"><?php echo e($cart["buyer_fullname"]); ?></span><br />
                                            <a href="mailto:khuongmy1@gmail.com" target="_blank"><?php echo e($cart["buyer_email"]); ?></a><br />
                                            <?php echo e($cart["buyer_phone"]); ?>

                                        </td>
                                        <td style="padding: 3px 9px 9px 9px; border-top: 0; border-left: 0; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #444; line-height: 18px; font-weight: normal;" valign="top">
                                            <span style="text-transform: capitalize;"><?php echo e($cart["buyer_fullname"]); ?></span><br />
                                            <a href="mailto:khuongmy1@gmail.com" target="_blank"><?php echo e($cart["buyer_email"]); ?></a><br />
                                            <?php echo e($cart["address"]); ?><br />
                                            T: <?php echo e($cart["buyer_phone"]); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="padding: 7px 9px 0px 9px; border-top: 0; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #444;" valign="top">
                                            <p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #444; line-height: 18px; font-weight: normal;">
                                                Chúng Tôi Sẽ Liên Hệ Trong Thời Gian Sớm Nhất <br />
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h2 style="text-align: left; margin: 10px 0; border-bottom: 1px solid #ddd; padding-bottom: 5px; font-size: 13px; color: #02acea;">CHI TIẾT ĐƠN HÀNG</h2>

                            <table border="0" cellpadding="0" cellspacing="0" style="background: #f5f5f5;" width="100%">
                                <thead>
                                    <tr>
                                        <th align="left" bgcolor="#02acea" style="padding: 6px 9px; color: #fff; font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 14px;">Sản phẩm</th>
                                        <th align="left" bgcolor="#02acea" style="padding: 6px 9px; color: #fff; font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 14px;">Đơn giá</th>
                                        <th align="left" bgcolor="#02acea" style="padding: 6px 9px; color: #fff; font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 14px;">Số lượng</th>
                                        <th align="left" bgcolor="#02acea" style="padding: 6px 9px; color: #fff; font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 14px;">Giảm giá</th>
                                        <th align="right" bgcolor="#02acea" style="padding: 6px 9px; color: #fff; font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 14px;">Tổng tạm</th>
                                    </tr>
                                </thead>
                                <tbody bgcolor="#eee" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #444; line-height: 18px;">
                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td align="left" style="padding: 3px 9px;" valign="top"><span><?php echo e($product["product_title"]); ?></span><br /></td>
                                        <td align="left" style="padding: 3px 9px;" valign="top"><span><?php echo e(currencyFormat($product["price"])); ?></span></td>
                                        <td align="left" style="padding: 3px 9px;" valign="top"><?php echo e($product["qty"]); ?></td>
                                        <td align="left" style="padding: 3px 9px;" valign="top"><span>0VNĐ</span></td>
                                        <td align="right" style="padding: 3px 9px;" valign="top"><span><?php echo e(currencyFormat($product["price"]*$product["qty"])); ?></span></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #444; line-height: 18px;">
                                    <tr>
                                        <td align="right" colspan="4" style="padding: 5px 9px;">Tạm tính</td>
                                        <td align="right" style="padding: 5px 9px;"><span><?php echo e(currencyFormat($cart["total_price"])); ?></span></td>
                                    </tr>
                                    <tr>
                                        <td align="right" colspan="4" style="padding: 5px 9px;">Giảm giá</td>
                                        <td align="right" style="padding: 5px 9px;"><span>0VNĐ</span></td>
                                    </tr>
                                    <tr bgcolor="#eee">
                                        <td align="right" colspan="4" style="padding: 7px 9px;">
                                            <strong><big>Tổng giá trị đơn hàng</big> </strong>
                                        </td>
                                        <td align="right" style="padding: 7px 9px;">
                                            <strong>
                                                <big><span><?php echo e(currencyFormat($cart["total_price"])); ?></span> </big>
                                            </strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                            <div style="margin: auto;">
                                <a
                                    href="<?php echo e(route("cart.order",$cart->cart_id)); ?>"
                                    style="
                                        display: inline-block;
                                        text-decoration: none;
                                        background-color: #00b7f1 !important;
                                        margin-right: 30px;
                                        text-align: center;
                                        border-radius: 3px;
                                        color: #fff;
                                        padding: 5px 10px;
                                        font-size: 12px;
                                        font-weight: bold;
                                        margin-left: 35%;
                                        margin-top: 5px;
                                    "
                                    target="_blank"
                                    data-saferedirecturl="https://www.google.com/url?q=https://x64km.mjt.lu/lnk/BAAAAk-r6BsAAAAAAAAAACIAB-0AAAAA3NwAAAAAABPsQgBhnF9DYJH8FsKVQpS8NTmZpoy2VAAPBhU/5/Xe9pyTOrX6-h9Od7k9dOng/aHR0cHM6Ly90aWtpLnZuL3NhbGVzL29yZGVyL3ZpZXcvODMyOTM3ODg3&amp;source=gmail&amp;ust=1639919895289000&amp;usg=AOvVaw3JhipakrKuzt7inYBWSTij"
                                >
                                    Chi tiết đơn hàng tại <span class="il">Thành Đạt</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            &nbsp;
                            <p style="margin: 0; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #444; line-height: 18px; font-weight: normal;">
                                Trường hợp quý khách có những băn khoăn về đơn hàng, có thể xem thêm mục
                                <a
                                    href="https://x64km.mjt.lu/lnk/BAAAAk-r6BsAAAAAAAAAACIAB-0AAAAA3NwAAAAAABPsQgBhnF9DYJH8FsKVQpS8NTmZpoy2VAAPBhU/6/mVbHjZn1Bx1JU79XDp8xpQ/aHR0cDovL2hvdHJvLnRpa2kudm4vaGMvdmkvP3V0bV9zb3VyY2U9dHJhbnNhY3Rpb25hbCtlbWFpbCZ1dG1fbWVkaXVtPWVtYWlsJnV0bV90ZXJtPWxvZ28mdXRtX2NhbXBhaWduPW5ldytvcmRlcg"
                                    title="Các câu hỏi thường gặp"
                                    target="_blank"
                                    data-saferedirecturl="https://www.google.com/url?q=https://x64km.mjt.lu/lnk/BAAAAk-r6BsAAAAAAAAAACIAB-0AAAAA3NwAAAAAABPsQgBhnF9DYJH8FsKVQpS8NTmZpoy2VAAPBhU/6/mVbHjZn1Bx1JU79XDp8xpQ/aHR0cDovL2hvdHJvLnRpa2kudm4vaGMvdmkvP3V0bV9zb3VyY2U9dHJhbnNhY3Rpb25hbCtlbWFpbCZ1dG1fbWVkaXVtPWVtYWlsJnV0bV90ZXJtPWxvZ28mdXRtX2NhbXBhaWduPW5ldytvcmRlcg&amp;source=gmail&amp;ust=1639919895289000&amp;usg=AOvVaw2kslVsbcL6D-I1Qc02nER9"
                                >
                                    <strong>các câu hỏi thường gặp</strong>.
                                </a>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            &nbsp;
                            <p>Một lần nữa <span class="il">Thành Đạt</span> cảm ơn quý khách.</p>

                            <p>
                                <strong>
                                    <a
                                        href="https://x64km.mjt.lu/lnk/BAAAAk-r6BsAAAAAAAAAACIAB-0AAAAA3NwAAAAAABPsQgBhnF9DYJH8FsKVQpS8NTmZpoy2VAAPBhU/8/Zqj767mYiP_RTlLvfosJ6g/aHR0cDovL3Rpa2kudm4_dXRtX3NvdXJjZT10cmFuc2FjdGlvbmFsK2VtYWlsJnV0bV9tZWRpdW09ZW1haWwmdXRtX3Rlcm09bG9nbyZ1dG1fY2FtcGFpZ249bmV3K29yZGVy"
                                        style="color: #00a3dd; text-decoration: none; font-size: 14px;"
                                        target="_blank"
                                        data-saferedirecturl="https://www.google.com/url?q=https://x64km.mjt.lu/lnk/BAAAAk-r6BsAAAAAAAAAACIAB-0AAAAA3NwAAAAAABPsQgBhnF9DYJH8FsKVQpS8NTmZpoy2VAAPBhU/8/Zqj767mYiP_RTlLvfosJ6g/aHR0cDovL3Rpa2kudm4_dXRtX3NvdXJjZT10cmFuc2FjdGlvbmFsK2VtYWlsJnV0bV9tZWRpdW09ZW1haWwmdXRtX3Rlcm09bG9nbyZ1dG1fY2FtcGFpZ249bmV3K29yZGVy&amp;source=gmail&amp;ust=1639919895289000&amp;usg=AOvVaw2sOMCfofPp6kSZL7JiONGu"
                                    >
                                        <span class="il">Thành Đạt</span>
                                    </a>
                                </strong>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\laravel\thanh_dat\thanhdat_cosmetics\resources\views/mail/cart/checkout.blade.php ENDPATH**/ ?>