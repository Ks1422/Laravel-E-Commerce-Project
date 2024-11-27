<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;

use function Laravel\Prompts\search;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function  view_category()
    {

        $data = Category::all();                                                          //category sayfasındaki tüm kayıtları çektim
        return view('admin.category', compact('data'));
    }

    public function add_category(Request $request)
    {
        $category = new Category();                                                      //$request->category ifadesi, kullanıcının formdan gönderdiği category verisini alır. Yani, kullanıcı formda bir kategori adı girerse, bu kategori adı $category_name alanına atanır.
        $category->category_name = $request->category;                                   //Burada $category_name tablodaki kategorinin adını tutan alanın ismi. Bu alan, veritabanındaki kategori tablosunun bir sütununa karşılık gelir.
        $category->save();
        toastr()->closeButton()->timeOut(5000)->success('Category added succesfuly');   // kategori eklemek için yazdıgım fonksiyon //
        return redirect()->back();                                                     // kullanıcı işlemi gerçekleştirdikten sonra aynı sayfaya geri yönlendirilir
    }

    public function delete_category($id)
    {

        $data = Category::find($id);
        $data->delete();
        toastr()->closeButton()->timeOut(5000)->success('Category delete succesfuly');   // kategorileri silmek için yazdıgım fonksiyon //
        return redirect()->back();
    }

    public function edit_category($id)
    {
        $data = Category::find($id);                                                    //kategorileri düzenlemek için oluşturduğum fonksiyon
        return view('admin.edit_category', compact('data'));
    }
    public function update_category(Request $request, $id)
    {
        $data = Category::find($id);
        $data->category_name = $request->category;
        $data->save();
        toastr()->closeButton()->timeOut(5000)->success('Category update succesfuly');   // kategorileri güncellemek için yazdıgım fonksiyon //
        return redirect('/view_category');
    }

    public function add_product()
    {

        $category = Category::all();

        return view('admin.add_product', compact('category'));
    }
    public function upload_product(Request $request)
    {
        $data = new Product;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->quantity = $request->qty;
        $data->category = $request->category;
        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();      //resim yükleme işlemi //
            $request->image->move('products', $imagename);
            $data->image = $imagename;
        }
        $data->save();
        toastr()->closeButton()->timeout(5000)->success('upload succesfuly');
        return redirect()->back();
    }

    public function view_product()
    {

        $product = Product::paginate(4);
        return view('admin.view_product', compact('product'));      //ürünler için yaptıgım pagination//
    }

    public function delete_product($id)
    {

        $data = Product::find($id);
        $image_path = public_path('products/' . $data->image);      //ürünlere ait olan fotografları silmek için yazdıgım fonk //

        if (file_exists($image_path)) {    //Bu koşul, belirtilen $image_path yolunda bir dosya olup olmadığını kontrol eder.//
            unlink($image_path);
        }

        $data->delete();
        toastr()->closeButton()->timeOut(5000)->success('product deleted succesfuly'); //ürün silmek için yazdıgım fonksiyon //
        return redirect()->back();
    }

    public function update_product($id)
    {
        $data = Product::find($id);
        $category = Category::all();
        return view('admin.update_page', compact('data', 'category'));
    }
    public function edit_product(Request $request, $id)
    {
        $data = Product::find($id);
        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->quantity = $request->quantity;
        $data->category = $request->category;
        $image = $request->image;

        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();     //fotograf yükleme  için yazdıgım fonksiyon
            $request->image->move('products', $imagename);
        }

        $data->save();
        toastr()->closeButton()->timeOut(5000)->success('Product edited successfuly');
        return redirect('/view_product');
    }

    // %'.$search.'% yapısı, aranan kelimenin başında veya sonunda başka karakterlerin olabileceği anlamına gelir. Bu sayede kısmi eşleşme yapılır//
    // LIKE ifadesi ile, title veya category sütunlarında, kullanıcının girdiği search terimini içeren ürünler aranır//
    public function product_search(Request $request)
    {
        $search = $request->search;
        $product = Product::where('title', 'LIKE', '%' . $search . '%')->orWhere('category', 'LIKE', '%' . $search . '%')->paginate(3);
        return view('admin.view_product', compact('product'));
    }

    public function view_orders(){
        $data=Order::all();
        return view('admin.order',compact('data'));
    }
    public function on_the_way($id){
        $data=Order::find($id);
        $data->status='On the way';
        $data->save();
        return redirect('/view_orders');
    }
    public function delivered($id){
        $data=Order::find($id);
        $data->status='Delivered';
        $data->save();
        return redirect('/view_orders');
    }
    public function print_pdf($id){
        $data=Order::find($id);
        $pdf = Pdf::loadView('admin.invoice',compact('data'));
        return $pdf->download('invoice.pdf');
       

    }
}
