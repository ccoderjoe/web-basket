<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function basket()
    {
        $orderId = session('orderId');
//        dd($orderId);
        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
        } else {
            $order = Order::create();
            session(['orderId' => $order->id]);
        }

        return view('basket', compact('order'));
    }

    public function addToBasket($productId)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }

        if ($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        } else {
            $order->products()->attach($productId);
        }


        return redirect()->route('basket');
    }

    public function deleteFromBasket($productId)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('basket');
        }
        $order = Order::find($orderId);

        if ($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            if ($pivotRow->count < 2) {
                $order->products()->detach($productId);
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }

        return redirect()->route('basket');
    }

    public function checkout()
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('basket');
        }
        $order = Order::find($orderId);

        return view('form', compact('order'));
    }

    public function confirm(Request $request)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('basket');
        }
        $order = Order::find($orderId);

        $success = $order->confirmOrder($request->name, $request->phone, $request->email);
        session()->forget('orderId');

        if ($success) {
            session()->flash('success', 'Order confirmed, our team will contact you!');
        } else {
            session()->flash('danger', 'Something went wrong!');
        }


        return redirect()->route('home');
    }
}
