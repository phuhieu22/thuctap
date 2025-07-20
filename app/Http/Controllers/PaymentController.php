<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;

class PaymentController extends Controller
{
    /**
     * Redirect user sang VNPay để thanh toán.
     */
    public function createVnpay($orderId, Request $request): RedirectResponse
    {
        // 1. Lấy đơn hàng
        $order = Order::findOrFail($orderId);

        // 2. Load cấu hình từ config/services.php (hoặc .env)
        $vnp_TmnCode    = config('services.vnpay.tmn_code');
        $vnp_HashSecret = config('services.vnpay.hash_secret');
        $vnp_Url        = config('services.vnpay.url');
        $vnp_Returnurl  = config('services.vnpay.return_url');

        // 3. Tạo timestamps theo GMT+7
        $now    = Carbon::now('Asia/Ho_Chi_Minh');
        $create = $now->format('YmdHis');
        $expire = $now->copy()->addMinutes(15)->format('YmdHis');

        // 4. Build mảng input (bắt buộc có cả ExpireDate nếu bạn muốn sử dụng)
        $inputData = [
            'vnp_Version'    => '2.1.0',
            'vnp_TmnCode'    => $vnp_TmnCode,
            'vnp_Amount'     => intval($order->total_amount * 100),
            'vnp_Command'    => 'pay',
            'vnp_CreateDate' => $create,
            'vnp_ExpireDate' => $expire,
            'vnp_CurrCode'   => 'VND',
            'vnp_IpAddr'     => $request->ip(),
            'vnp_Locale'     => 'vn',
            'vnp_OrderInfo'  => "Thanh toán đơn hàng #{$order->id}",
            'vnp_OrderType'  => 'other',
            'vnp_ReturnUrl'  => $vnp_Returnurl,
            'vnp_TxnRef'     => $order->id,
        ];

        // 5. Sắp xếp key và build mảng pairs
        ksort($inputData);
        $pairs = [];
        foreach ($inputData as $key => $value) {
            // urlencode chuyển space thành '+'
            $pairs[] = urlencode($key) . '=' . urlencode($value);
        }

        // 6. Tạo hashdata và query string
        $hashdata = implode('&', $pairs);        // dùng để tính HMAC
        $query    = implode('&', $pairs) . '&';  // dùng để nối URL

        // 7. Tính secure hash
        $secureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);

        // 8. Build URL cuối cùng
        $finalUrl = $vnp_Url
                  . '?' . $query
                  . 'vnp_SecureHashType=SHA512'
                  . '&vnp_SecureHash=' . $secureHash;

        // 9. (Tùy chọn) Log debug
        Log::debug('VNPAY hashdata: ' . $hashdata);
        Log::debug('VNPAY secureHash: ' . $secureHash);
        Log::debug('VNPAY finalUrl: ' . $finalUrl);

        // 10. Redirect user sang VNPay
        return redirect()->away($finalUrl);
    }
}
