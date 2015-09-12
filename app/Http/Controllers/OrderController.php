<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;
use App\Order_detail;
use App\Product;
use App\Color;
use App\Size;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $order= Order::all();
        return view('backend.pages.order.listOrder', compact('order'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        $order = Order::find($id);
        $order_detail = Order_detail::where('order_id',$id)->get();
        $product = Product::all();
        $color = Color::all();
        $size = Size::all();
        return view('backend.pages.order.detail', array(
                                                        'order'=>$order,
                                                        'detail'=>$order_detail,
                                                        'product'=>$product,
                                                        'color'=>$color,
                                                        'size'=>$size));
    }


    public function update(Request $request, $id)
    {
        //
        $data= $request->all();
        Order::where('id',$id)->update(array('status'=>$data['status'],'shipped_date'=>$data['shipped_date']));
        return Redirect::back();
    }

    public function activeOrder($token,$id){
        $result = Order::checkactive($token,$id);

        switch ($result) {
            case '0':
                return redirect('cart')->withErrors(['error' => 'Xác nhận hết hạn']);
                break;
            case '1':
                return redirect('cart')->withErrors(['error' => 'Đơn Hàng đã được xác nhận']);
                break;
            case '2':
                return redirect('cart')->withErrors(['error' => 'Cám ơn bạn đã quan tâm, mua sắm cùng chúng tôi. Đơn hàng của bạn đã được xác nhận']);
                break;
            
            default:
                return redirect('cart')->withErrors(['error' => 'xác nhận hết hạn']);
                break;
        }

    }
}
