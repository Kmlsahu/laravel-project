<?php

use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Models\Quote;
use App\Models\QuoteItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

function getPages()
{
    $pages = Page::orderBy('ordering')->where('status', 1)->get();
    return $pages;
}

function Category()
{
    $category = Category::where('category_parent_id', 0)->where('status', 1)->where('show_in_menu', 1)->get();

    return $category;
}

function SubCategory($id)
{
    $category = Category::where('category_parent_id', $id)->where('status', 1)->where('show_in_menu', 1)->get();

    return $category;
}

function MidlCategory()
{
    $category = Category::where('status', 1)->orderBy('id', 'DESC')->limit(6)->get();

    return $category;
}

function Product()
{
    $product = Product::where('status', 1)->where('is_featured', 1)->limit(8)->get();

    return $product;
}

function Products()
{
    $product = Product::where('is_featured', 1)->where('is_featured', 2)->where('status', 1)->get();

    return $product;
}

function getProducts($id)
{
    $id = explode(' , ', $id);

    $relatedproducts = Product::whereIn('id', $id)->get();
    return $relatedproducts;
}

function getProductPrice($pId)
{
    $todayDate = now();
    $product = Product::find($pId);
    if (($todayDate >= $product->special_price_from) && ($todayDate <= $product->special_price_to) and ($product->special_price)) {
        return $product->special_price;
    } else {
        return $product->price;
    }
}

function getProductPriceShow($product)
{
    $todayDate = Carbon\Carbon::now();
    if (($product->special_price_from <= $todayDate) && ($product->special_price_to >= $todayDate) && ($product->special_price)) {

        $price = $product->special_price;
    } else {

        $price = $product->price;
    }
    return $price;
}

//CartItem count 
function cartSummaryCount()
{
    $cartId = Session::get('cart_id');
    if ($cartId) {
        $quote = Quote::where('cart_id', $cartId)->first();
        return ($quote->items ?? 0) ? $quote->items->count() : 0;
    } else {
        return 0;
    }
}
function recalculateCart()
{
    $cartId = Session::get('cart_id');
    $quote = Quote::where('cart_id', $cartId)->first();

    //data get from relationship //QuoteItem load where Quote_id
    $items = $quote->items;
    // dd($items);
    foreach ($items as $item) {
        $item->row_total = $item->qty * $item->price;
        $item->save();
    }

    $quote->subtotal = $quote->items->sum('row_total');
    if ($quote->subtotal > $quote->coupon_discount) {
        $quote->total = $quote->subtotal - $quote->coupon_discount;
    } else {
        $quote->total = $quote->subtotal;
        $quote->coupon = null;
        $quote->coupon_discount = 0.00;
    }
    $quote->save();
}

function productImage($pId)
{
    $product = Product::find($pId);
    return $product->getFirstMediaUrl('thumbnail_image');
}


function getActivateCart($userId)
{
    // Get the current cart ID from the session
    $cartId = Session::get('cart_id');

    // Update the quote with the user ID
    $quote = Quote::where('cart_id', $cartId)->update(['user_id' => $userId]);

    // Check if there is a cart ID(logout hone ke bad aad to cart kren pr carcurrent cart ID)
    if ($cartId) {
        // Find any existing quotes associated with the user and a different cart
        $quoteOld = Quote::where('user_id', $userId)->where('cart_id', '!=', $cartId)->first();
       
        // If there is an existing quote, merge its items with the current cart
        if ($quoteOld) {
            $newQuote = Quote::where('cart_id', $cartId)->first();
            $quoteId = $newQuote->id ?? 0;
           
            // Update the quote ID for the items in the existing quote
            QuoteItem::where('quote_id', $quoteOld->id)->update(['quote_id' => $quoteId]);

            // Delete the existing quote
            $quoteOld->delete();
        }
    } else {
        // If there is no cart ID, retrieve the quote associated with the user(logut hone ke bad bina addto cart kre login hone pr phle wale caritem show ke liye)
        $quote = Quote::where('user_id', $userId)->first();
        // dd($quote);
        // If a quote is found, set its cart ID to the session
        if ($quote) {
            $cartId = $quote->cart_id;
            Session::put('cart_id', $cartId);
        }
    }
}

// get Auth User Id
function getAuthUserId()
{
    if (Auth::user()) {
        return Auth::user()->id;
    } else {
        return 0;
    }
}

