<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
class ProductController extends Controller
{
    public function create(Request $request, $id = null)
    {

        $product_id = null;
        if($request->isMethod('post')){

            if($request->has('product_id')){
                $this->validate($request, [
                    'description' => 'required|max:900',
                    'category_id' => 'required|integer'
                ]);
                $product = Product::findOrFail($request->product_id);
                $product->category_id = $request->category_id;
                if(auth()->user()->role == 'admin') {
                    $product->user_id = $request->user_id;
                }else{
                    $product->user_id = auth()->id();
                }
                $product->description = $request->description;
                $product->code = $request->code;
                $product->hash = $request->hash;
                $product->srp = $request->srp;
                $product->cost = $request->cost;
                $product->qty = $request->qty;


                if($request->hasFile('image')){

                    $filename = time() . Str::random(6) . '.' . $request->file('image')->extension();
                    $file = $request->file('image');
                    $url = 'products/' . $product->id . '/' . $filename;

                    $this->image_process($file, $url, 300, 300);

                    $product->image = $filename;

                }

                $product->save();
                $product_id = $product->id;
            }else{

                $this->validate($request, [
                    'description' => 'required|max:900',
                    'image' => 'required',
                    'category_id' => 'required|integer'
                ]);
                $product = new Product();

                $product->image = 'null';
                $product->description = $request->description;
                $product->code = $request->code;
                $product->hash = $request->hash;
                $product->srp = $request->srp;
                $product->qty = $request->qty;
                $product->category_id = $request->category_id;
                if(auth()->user()->role == 'admin') {
                    $product->user_id = $request->user_id;
                }else{
                    $product->user_id = auth()->id();
                }
                $product->cost = $request->cost;


                $product->save();
                $filename = time() . Str::random(6) . '.' . $request->file('image')->extension();
                $file = $request->file('image');
                $url = 'products/' . $product->id . '/' . $filename;
                $this->image_process($file, $url, 300, 300);
                $product->image = $filename;
                $product->save();

                $product_id = $product->id;
            }
            return redirect()->route('menu.page', ['id' => $product_id]);
        }
        $users = User::all();
        if(is_null($id)){
            return view('pages.edit', compact('users'));
        }
        $product = Product::findOrFail($id);
        return view('pages.edit', compact('product', 'users'));
    }

    private function image_process($file, $url, $width=null, $height=null) {
        if($file == null) { return; }
        $resizeWidth = $width;
        $resizeHeight = $height;
        $ext = $file->guessClientExtension();
        if (in_array($ext, ['jpeg', 'jpg', 'png'])) {
            $image = Image::make($file)
                ->resize($resizeWidth, $resizeHeight, function (Constraint $constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode($file->getClientOriginalExtension(), 75);
        }else{
            $image = $file;
        }
        return Storage::disk('public_uploads')->put('uploads/' . $url, (string) $image, 'public');
    }


    public function delete(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $product->delete();
        return 'OK';
    }

    public function changeCount(Request $request)
    {
        Product::where('id', $request->product_id)->update([
           'qty' => $request->qty
        ]);
        return 'OK';
    }
}
