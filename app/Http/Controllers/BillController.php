<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\Customer;
use App\BillDetail;

class BillController extends Controller
{
    public function listBills()
    {
    	$bills = Bill::orderBy('created_at', 'desc')->get();
    	return view('admin.bills.list', ['bills'=>$bills]);
    }

    public function listBillsInProcess()
    {
    	$bills = Bill::where('status', 0)->orderBy('created_at', 'desc')->get();
    	return view('admin.bills.list', ['bills'=>$bills]);
    }

    public function getDelete($id)
    {
    	$bill = Bill::find($id);
    	$bill->delete();

    	return redirect('admin/bills/list')->with('notification', 'Xóa thành công');
    }

    public function billDetail($id)
    {
    	$bill = Bill::find($id);
    	return view('admin.bills.bill_detail', ['bill'=>$bill]);
    }

    public function billStatus(Request $request)
    {
    	$bill = Bill::find($request->id);
    	$bill->status = $request->status;
    	$bill->save();

    	return redirect('admin/bills/bill_detail/'.$bill->id);
    }
}
