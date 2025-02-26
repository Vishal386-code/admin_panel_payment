<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use DataTables;

class PaymentController extends Controller
{   
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $payments = Payment::query();
            return DataTables::of($payments)
                ->addColumn('action', function ($payment) {
                    return '<button class="btn btn-danger btn-sm delete-btn" data-id="'.$payment->id.'">Delete</button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.payment.index');
    }

     // ✅ Delete Function
     public function destroy($id)
     {
         $payment = Payment::find($id);
 
         if (!$payment) {
             return response()->json(['success' => false, 'message' => 'Payment record not found'], 404);
         }
 
         $payment->delete();
 
         return response()->json(['success' => true, 'message' => 'Payment record deleted successfully']);
     }
}
