<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $product = Product::search($request->all());
        return View('Admin.product.index', ['product' => $product, 'data' => $request->all()]);
    }

    public function create()
    {
        $cat_list = Category::get_cat_list();
        return view('Admin.product.create', ['cat_list' => $cat_list]);
    }


    public function store(ProductRequest $request)
    {
        $Product = new Product($request->all());

        $url = str_replace('-', '', $Product->title);
        $url = str_replace('/', '', $url);
        $Product->title_url = preg_replace('/\s+/', '-', $url);

        $Product->product_status = ($request->has('product_status')) ? $request->get('product_status') : 0;
        $Product->special = ($request->has('special')) ? $request->get('special') : 0;

        $url = str_replace('-', '', $Product->code);
        $url = str_replace('/', '', $url);
        $Product->code_url = preg_replace('/\s+/', '-', $url);

        $Product->view = 0;
        $Product->order_product = 0;
        $Product->saveOrFail();
        $cat = $request->get('cat');
        if (is_array($cat)) {
            foreach ($cat as $key => $value) {
                DB::table('cat_product')->insert(['product_id' => $Product->id, 'cat_id' => $value]);
            }
        }

        $color_name = $request->get('color_name');
        $color_code = $request->get('color_code');
        if (is_array($color_name)) {
            foreach ($color_name as $key => $value) {
                if (!empty($value) && !empty($color_code[$key])) {
                    DB::table('color_product')->insert(['product_id' => $Product->id, 'color_name' => $value, 'color_code' => $color_code[$key]]);

                }
            }
        }

        $url = 'admin/product/' . $Product->id . '/edit';
        return redirect($url);
    }

    public function edit($id)
    {
        $product = Product::with('get_colors')->findOrFail($id);
        $cat_list = Product::get_cat_list();
        $product_cat = Product::get_cat($id);
        return View('Admin.product.update', ['product' => $product, 'cat_list' => $cat_list, 'product_cat' => $product_cat]);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        DB::table('cat_product')->where('product_id', $id)->delete();
        DB::table('color_product')->where('product_id', $id)->delete();
        return redirect()->back();
    }

    public function gallery(Request $request)
    {
        $id = $request->get('id');
        $product = Product::findOrFail($id);
        $image = ProductImage::where('product_id', $id)->get();
        return View('Admin.product.gallery', ['product' => $product, 'image' => $image]);
    }

    public function upload(Request $request)
    {
        $product_id = $request->get('id');
        $files = $request->file('file');
        $type = $request->get('type');
        $file_name = md5($files->getClientOriginalName() . time() . $product_id) . '.' . $files->getClientOriginalExtension();
        if ($files->move('upload', $file_name)) {
            if ($type) {
                $ProductImage = new File();
                $ProductImage->type = $type;
            } else {
                $ProductImage = new ProductImage();
            }
            $ProductImage->product_id = $product_id;
            $ProductImage->url = $file_name;
            $ProductImage->save();
            return 1;
        } else {
            return 0;
        }
    }


    public function del_product_img($id)
    {
        $img = ProductImage::findOrFail($id);
        $url = $img->url;
        if (!empty($url)) {
            if (file_exists('upload/' . $url)) {
                $img->delete();
                unlink('upload/' . $url);
            }

        }
        return redirect()->back();
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $url = str_replace('-', '', $request->title);
        $url = str_replace('/', '', $url);
        $product->title_url = preg_replace('/\s+/', '-', $url);

        $url = str_replace('-', '', $request->code);
        $url = str_replace('/', '', $url);
        $product->code_url = preg_replace('/\s+/', '-', $url);


        $product->product_status = ($request->has('product_status')) ? $request->get('product_status') : 0;
        $product->special = ($request->has('special')) ? $request->get('special') : 0;

        DB::table('cat_product')->where('product_id', $product->id)->delete();
        $cat = $request->get('cat');
        if (is_array($cat)) {
            foreach ($cat as $key => $value) {
                DB::table('cat_product')->insert(['product_id' => $product->id, 'cat_id' => $value]);
            }
        }
        $product->update($request->all());

        $color_name = $request->get('color_name');
        $color_code = $request->get('color_code');
        if (is_array($color_name)) {
            foreach ($color_name as $key => $value) {
                if ($key > 0) {
                    if (!empty($value)) {
                        DB::table('color_product')->where('id', $key)->update(['color_name' => $value, 'color_code' => $color_code[$key]]);

                    } else {
                        DB::table('color_product')->where('id', $key)->delete();

                    }
                } else {
                    if (!empty($value) && !empty($color_code[$key])) {
                        DB::table('color_product')->insert(['product_id' => $product->id, 'color_name' => $value, 'color_code' => $color_code[$key]]);

                    }
                }
            }
        }
        $url = 'admin/product/' . $product->id . '/edit';
        return redirect($url);

    }
}
