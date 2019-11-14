<?php

namespace App\Http\Controllers;

use App\SubCategory;
use App\SubInput;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Category;
class CategoryController extends Controller
{
    public function redirect_to_create(Request $request){

        $id = $request->input('id');

        if($id == NULL){
        $category = 'empty';
        }
        else{
            $category = Category::find($id);
        }
        return view('pages.category.create')
            ->with('category',$category);

    }

    public function create(Request $request){

        $name = $request->input('name');
        $id = $request->input('id');

        if($id == '0'){
        $category = new Category();
        $category->name = $name;
        $category->save();
        }
        else{
            $category = Category::find($id);
            $category->name = $name;
            $category->save();
        }

        return $category->id;
    }

    public function sub_create(Request $request){

        $name = $request->input('name');
        $id = $request->input('id');
        $sub_id = $request->input('sub_id');

        $category = Category::find($id);

        if($sub_id == '0'){

            $add_sub = new SubCategory();
            $add_sub->name = $name;
            $add_sub->save();

            $category->subcategory()->save($add_sub);

            $subcategory = SubCategory::find($add_sub->id);
        }
        else{
            $category->subcategory()->where('subcategory_id',$sub_id)->update([
                'name' => $name
            ]);

            $subcategory = SubCategory::find($sub_id);
        }



        return view('pages.category.subcategory_settings')
            ->with('subcategory',$subcategory)
            ->with('category',$category);
    }

    public function sub_input_create(Request $request){

        $sub_id = $request->input('sub_id');
        $name = $request->input('name');
        $id = $request->input('id');

        $subcategory = SubCategory::find($sub_id);

        if($id == '0'){
            $subcategory->input()->create([
                "name" => $name
            ]);
        }
        else{
            $subcategory->input()->where('input_id',$id)->update([
                "name" => $name
            ]);
        }



        return view('pages.category.subcategory_items')
            ->with('subcategory',$subcategory);
    }

    public function sub_edit(Request $request){

        $subcategory = SubCategory::find($request->input('id'));

        return view('pages.category.subcategory_edit')
            ->with('subcategory',$subcategory);

    }
    public function sub_input_edit(Request $request){

        $input = SubInput::find($request->input('id'));

        return view('pages.category.edit_sub-item')
            ->with('input',$input);

    }

    public function sub_input_edit_confirm(Request $request){

        $id = $request->input('id');
        $name = $request->input('name');

        $input = SubInput::find($id);
        $input->name = $name;
        $input->save();

        return view('pages.category.new_input')
            ->with('input',$input);

    }

    public function delete_category(Request $request){

        $id = $request->input('id');

    }

    public function delete_subcategory(Request $request){

        $id = $request->input('id');

        $sub = SubCategory::find($id);

        $sub->input()->delete();

        $sub->delete();

        DB::table('category_subcategory')->where('subcategory_id','=',$id)->delete();

    }

    public function delete_input(Request $request){

        $id = $request->input('id');

        SubInput::where('id','=',$id)->delete();

        DB::table('subcategory_input')->where('input_id','=',$id)->delete();

    }

}
