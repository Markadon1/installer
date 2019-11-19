<?php

namespace App\Http\Controllers;

use App\SubCategory;
use Illuminate\Http\Request;

use App\Cards;
use App\Category;
use App\Templates;
class CardController extends Controller
{
    public function redirect_to_change_cat(Request $request){

        $categories = Category::all();

        return view('pages.cards.change_category')
            ->with('categories',$categories);

    }

    public function redirect_to_create(Request $request){

        $id = $request->input('id');

        $category = Category::find($id);

        return view('pages.cards.create')
            ->with('category',$category);
    }

    public function create(Request $request)
    {

        $subcat_id = $request->subcategory_id;
        $template_id = $request->template_id;
        $category_id = $request->input('category_id');

        $category = Category::find($category_id);

        $card = new Cards();
        $card->name = 'Name';
        $card->logo = 'Link to Logo';
        $card->save();

        $category->cards()->save($card);

        foreach ($template_id as $temp_id) {

            $template = Templates::find($temp_id);
            $input_name = 'template_' . $template->type . '_' . $template->id;
            $input_val = $request->$input_name;
            if ($template->type == 'checkbox') {
                $string_check = '';
                foreach ($input_val as $val) {
                    $string_check.= $val.',';
                }
                $card->temp_values()->create([
                    'template_id' => $template->id,
                    'template_name' => $template->name,
                    'value' => $string_check
                ]);
            } else {
                $card->temp_values()->create([
                    'template_id' => $template->id,
                    'template_name' => $template->name,
                    'value' => $input_val
                ]);
            }
        }
        foreach ($subcat_id as $sub_id) {

            $subcategory = SubCategory::find($sub_id);

            foreach ($subcategory->input as $input) {
                $input_val = $request->input('subcat_' . $sub_id . '_input_' . $input->id);
                if ($input_val == NULL) {
                    $input_val = 0;
                }
                $card->prices()->create([
                    'input_id' => $input->id,
                    'price' => $input_val
                ]);
            }

        }



       return view('pages.cards.update')
           ->with('category',$category)
           ->with('card',$card);

    }
}
