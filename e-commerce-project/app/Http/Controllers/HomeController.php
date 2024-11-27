<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Stripe;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class HomeController extends Controller
{
    public function index()
    {
        $user = User::where('usertype', 'user')->get()->count();
        $product = Product::all()->count();
        $order = Order::all()->count();
        $delivered = Order::where('status', 'Delivered')->get()->count();
        return view('admin.index', compact('user', 'product', 'order', 'delivered'));
    }

    //anasayfada ürünleri görüntülemek için // 
    public function home()
    {
        $product = Product::all();
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
        } else {
            $count = '';
        }


        return view('home.index', compact('product', 'count'));
    }

    public function myorders()
    {
        $user = Auth::user()->id;

        $count = Cart::where('user_id', $user)->get()->count();
        $order = Order::where('user_id', $user)->get();

        return view('home.order', compact('count', 'order'));
    }

    public function stripe($value = null): View
    {
        return view('home.stripe', compact('value'));
    }

    public function stripePost(Request $request, $value = null): RedirectResponse
    {

        $code = Stripe\Stripe::setApiKey(config('stripe.STRIPE_SECRET'));

        

        Stripe\Charge::create([

            "amount" => $value * 100,

            "currency" => "usd",

            "source" => $request->stripeToken,

            "description" => "Test payment from completed."

        ]);


        // Kullanıcıdan gelen bilgileri alıyoruz: isim, adres ve telefon numarası.
        $name = Auth::user()->name;        // Kullanıcının gönderdiği isim.
        $phone = Auth::user()->phone;    // Kullanıcının gönderdiği adres.
        $address = Auth::user()->address;
        $userid=Auth::user()->id;      // Kullanıcının gönderdiği telefon numarası.

        $cart=Cart::where('user_id',$userid)->get();

        // Bu kullanıcının sepetindeki tüm ürünleri alıyoruz.
        $cart = Cart::where('user_id', $userid)->get();

        // Kullanıcının sepetindeki her ürün için bir sipariş kaydı oluşturuyoruz.
        foreach ($cart as $carts) {
            $order = new Order;                 // Yeni bir Order (Sipariş) modeli oluşturuyoruz.
            $order->name = $name;               // Sipariş için isim bilgisi ekleniyor.
            $order->rec_address = $address;     // Sipariş için adres bilgisi ekleniyor.
            $order->phone = $phone;          // Sipariş için telefon bilgisi ekleniyor.
            $order->user_id = $userid;          // Siparişin kime ait olduğunu belirtiyoruz (kullanıcı ID'si).
            $order->product_id = $carts->product_id; // Sepetteki ürünün ID'sini siparişe kaydediyoruz.
            $order->payment_status="paid";
            $order->save();                     // Sipariş kaydını veritabanına kaydediyoruz.
        }

        // Sepeti boşaltmak için kullanıcının tüm sepet öğelerini alıyoruz.
        $cart_remove = Cart::where('user_id', $userid)->get();

        // Kullanıcının sepetindeki her bir öğeyi siliyoruz.
        foreach ($cart_remove as $remove) {
            $data = Cart::find($remove->id); // Sepet tablosundan her bir öğeyi buluyoruz.
            $data->delete();                // Bulunan sepet öğesini siliyoruz.
        }

        // Kullanıcıya siparişin başarıyla tamamlandığını bildiren bir mesaj gösteriyoruz.
        toastr()->closeButton()->timeOut(5000)->success('Pay  successfully');

        // Kullanıcıyı bir önceki sayfaya yönlendiriyoruz.
        return redirect()->back();
    }






    //login  işlemi yaptıktan sonra ürünleri görüntülemek için // 
    public function login_home()
    {
        // Tüm ürünleri veritabanından çekip $product değişkenine atıyoruz
        $product = Product::all();

        // Kullanıcının giriş yapıp yapmadığını kontrol ediyoruz
        if (Auth::id()) {
            // Giriş yapan kullanıcının bilgilerini alıyoruz
            $user = Auth::user();

            // Kullanıcının ID'sini alıp $userid değişkenine atıyoruz
            $userid = $user->id;

            // Giriş yapan kullanıcının sepetindeki ürünlerin sayısını alıyoruz
            $count = Cart::where('user_id', $userid)->count();
        }

        // home.index görünümünü döndürüyoruz ve 
        // ürünler ($product) ve sepet sayısı ($count) verilerini bu görünüme aktarıyoruz
        return view('home.index', compact('product', 'count'));
    }


    public function product_details($id)
    {
        $data = Product::find($id);
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
        } else {
            $count = '';
        }
        return view('home.product_details', compact('data', 'count'));
    }
    public function add_cart($id)
    {

        // 1. Parametre olarak gelen ürün ID'si alınıyor.
        $product_id = $id;

        // 2. Auth sınıfı kullanılarak giriş yapmış kullanıcı bilgisi alınıyor.
        $user = auth::user();

        // 3. Giriş yapan kullanıcının ID'si alınıyor.
        $user_id = $user->id;

        // 4. Yeni bir `Cart` (Sepet) modeli oluşturuluyor.
        $data = new Cart;

        // 5. Sepet modeline kullanıcının ID'si atanıyor.
        $data->user_id = $user_id;

        // 6. Sepet modeline ürün ID'si atanıyor.
        $data->product_id = $product_id;

        // 7. Toastr kütüphanesi kullanılarak bir başarı mesajı hazırlanıyor.
        toastr()->closeButton()->timeout(5000)->success('Product added to the cart successfully');

        // 8. Sepet kaydı veritabanına kaydediliyor.
        $data->save();

        // 9. Kullanıcıyı önceki sayfaya yönlendiriyor.
        return redirect()->back();
    }

    public function mycart()
    {

        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
            $cart = Cart::where('user_id', $userid)->get();
        }
        return view('home.mycart', compact('count', 'cart'));
    }
    public function comfirm_order(Request $request)
    {

        // Kullanıcıdan gelen bilgileri alıyoruz: isim, adres ve telefon numarası.
        $name = $request->name;        // Kullanıcının gönderdiği isim.
        $address = $request->rec_address;  // Kullanıcının gönderdiği adres.
        $phone = $request->phone;      // Kullanıcının gönderdiği telefon numarası.

        // Şu an giriş yapmış olan kullanıcının ID'sini alıyoruz.
        $userid = Auth::user()->id;

        // Bu kullanıcının sepetindeki tüm ürünleri alıyoruz.
        $cart = Cart::where('user_id', $userid)->get();

        // Kullanıcının sepetindeki her ürün için bir sipariş kaydı oluşturuyoruz.
        foreach ($cart as $carts) {
            $order = new Order;                 // Yeni bir Order (Sipariş) modeli oluşturuyoruz.
            $order->name = $name;               // Sipariş için isim bilgisi ekleniyor.
            $order->rec_address = $address;     // Sipariş için adres bilgisi ekleniyor.
            $order->phone = $phone;             // Sipariş için telefon bilgisi ekleniyor.
            $order->user_id = $userid;          // Siparişin kime ait olduğunu belirtiyoruz (kullanıcı ID'si).
            $order->product_id = $carts->product_id; // Sepetteki ürünün ID'sini siparişe kaydediyoruz.
            $order->save();                     // Sipariş kaydını veritabanına kaydediyoruz.
        }

        // Sepeti boşaltmak için kullanıcının tüm sepet öğelerini alıyoruz.
        $cart_remove = Cart::where('user_id', $userid)->get();

        // Kullanıcının sepetindeki her bir öğeyi siliyoruz.
        foreach ($cart_remove as $remove) {
            $data = Cart::find($remove->id); // Sepet tablosundan her bir öğeyi buluyoruz.
            $data->delete();                // Bulunan sepet öğesini siliyoruz.
        }

        // Kullanıcıya siparişin başarıyla tamamlandığını bildiren bir mesaj gösteriyoruz.
        toastr()->closeButton()->timeOut(5000)->success('Product ordered successfully');

        // Kullanıcıyı bir önceki sayfaya yönlendiriyoruz.
        return redirect()->back();
    }

    public function shop()
    {
        $product = Product::all();
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
        } else {
            $count = '';
        }


        return view('home.shop', compact('product', 'count'));

    }

    public function why(){
        $product = Product::all();
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
        } else {
            $count = '';
        }


        return view('home.why', compact('product', 'count'));
    }

    public function testimonial(){
        $product = Product::all();
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
        } else {
            $count = '';
        }
        return view('home.testimonial', compact('product', 'count'));
    }

    public function contact(){
        $product = Product::all();
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
        } else {
            $count = '';
        }
        return view('home.contact', compact('product', 'count'));
    }
}
