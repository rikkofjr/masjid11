<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Zis\PembayaranZis;
use App\Models\Zis\ZisPenerimaan;
use Illuminate\Http\Request;
use Midtrans\Midtrans;
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Transaction;
use Midtrans\StatusResponse;
use RealRashid\SweetAlert\Facades\Alert;

class MidtransPaymentController extends Controller
{

    public function updatePembayaranZis($id, $snapToken){

        //dd($id);

        //post snap
        $zis = ZisPenerimaan::where('id', $id)->first();

        if($zis->status_pembayaran == "PENDING"){
            $zis->snap_token = $snapToken;
            $zis->save();

            
            Config::$serverKey = config('midtrans.serverKey');
            Config::$clientKey = config('midtrans.clientKey');
            Config::$isSanitized = config('midtrans.isSanitized');
            Config::$is3ds = config('midtrans.is3ds');

            try {
                // Get the transaction status using the transaction token
                $statusResponse = Transaction::status($id);

                // Extract the payment status
                $paymentStatus = $statusResponse->transaction_status;
                
                // Handle the payment status and update order accordingly
                switch ($paymentStatus) {
                    case 'settlement':
                        // Payment is successful, update order status to 'paid'
                        return $this->updateOrderStatus($statusResponse->order_id, 'PAID');

                    case 'pending':
                        // Payment is pending, update order status to 'pending'
                        return $this->updateOrderStatus($statusResponse->order_id, 'pending');

                    case 'deny':
                        // Payment was denied, update order status to 'failed'
                        return $this->updateOrderStatus($statusResponse->order_id, 'failed');

                    case 'expire':
                        // Payment expired, update order status to 'expired'
                        return $this->updateOrderStatus($statusResponse->order_id, 'expired');

                    case 'cancel':
                        // Payment was canceled, update order status to 'cancelled'
                        return $this->updateOrderStatus($statusResponse->order_id, 'cancelled');

                    default:
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Unhandled transaction status: ' . $paymentStatus,
                        ]);
                }

            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error checking payment status: ' . $e->getMessage(),
                ], 500);
            }
        }
        
        return abort(404, 'Page not found.');
        
   
    }
    private function updateOrderStatus($id, $status)
    {

        // Find the order using the order ID
        $zis = ZisPenerimaan::where('id', $id)->first();

        if (!$zis) {
            return response()->json([
                'status' => 'error',
                'message' => 'zis not found.'
            ], 404);
        }

        // Update zis status to 'paid', 'pending', etc.
        if($status == "PAID"){
            $zis->status_pembayaran = 'PAID';
            $zis->save();

            Alert::success('Berhasil Melakukan Pembayaran');
            return redirect()->route('confirm-pembayaran-zis', ['id' => $id, 'snapToken' => $zis->snap_token]);
        
        }else{
            return response()->json([
                'status_pembayaran' => 'success',
                'message' => "Order status updated to {$status}.",
            ]);    
        }

        
    }

}
