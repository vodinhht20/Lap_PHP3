<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\NewProduct;
use App\Models\News;
use Illuminate\Http\Request;
use Validator;

class NewController extends Controller
{
    public function index()
    {
        $news = News::paginate(10);
        return view('new.index', compact('news'));
    }

    public function remove(Request $request)
    {
        $id = $request->id;
        try {
            NewProduct::where('new_id', $id)->delete();
            News::find($id)->delete();
            return response()->json([
                'success' => true
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'messages' => $e
            ], 200);
        }
    }

    public function showUpdate($id)
    {
        $new = News::find($id);
        if (!$new) {
            return abort(404);
        }
        $categories = Category::all();
        return view('new.update', compact('new', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required",
            "images" => "required",
            "category_id" => "required",
            "contents" => "required"
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('message.error', $validator->messages()->first())->withInput();
        }
        $new = News::find($id);
        if (!$new) {
            return abort(404);
        }
        $new->update($request->all());
        return redirect()->back()->with('message.success', 'Cap nhat thanh cong');
    }
}
