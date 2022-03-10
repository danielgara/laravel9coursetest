<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Item;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::all();
        $productsInCart = [];
        $ids = $request->session()->get("products"); //we get the ids of the products stored in session
        if($ids){
            $productsInCart = Product::findMany(array_keys($ids));
            /*foreach ($products as $key => $product) {
                if(in_array($key, array_keys($ids))){
                    $productsInCart[$key] = $product;
                }
            }*/
        }

        $viewData = [];
        $viewData["title"] = "Cart - Online Store";
        $viewData["subtitle"] =  "Shopping Cart";
        $viewData["products"] = $products;
        $viewData["productsInCart"] =$productsInCart;

        return view('cart.index')->with("viewData",$viewData);
    }

    public function add($id, Request $request)
    {
        $products = $request->session()->get("products");
        $products[$id] = $id;
        $request->session()->put('products', $products);
        return back();
    }

    public function purchase(Request $request)
    {
 
        $productsInSession = $request->session()->get("products");

        $products = Product::findMany(array_keys($productsInSession));
        $order = new Order();
        $order->setTotal(0);
        $order->save();

        $total = 0;

        foreach ($products as $key => $product) {
            $item = new Item();
            $item->setQuantity(1);
            $item->setProductId($product->getId());
            $item->setPrice($product->getPrice());
            $item->setOrderId($order->getId());
            $item->save();
            $total = $total + $product->getPrice();
        }

        $order->setTotal($total);
        $order->save();

        dd("Felicitaciones");
    }

    public function removeAll(Request $request)
    {
        $request->session()->forget('products');
        return back();
    }
}
