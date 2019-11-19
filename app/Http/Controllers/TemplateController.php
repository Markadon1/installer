<?php

namespace App\Http\Controllers;

use App\Category;
use App\SubCategory;
use App\TempInputs;
use App\Templates;
use Illuminate\Http\Request;

class TemplateController extends Controller
{

    public function redirect_to_create(Request $request){

        $id = $request->input('id');

        if($id == NULL){
            $template = 'empty';
        }
        else{
            $template = Templates::find($id);
        }
        return view('pages.templates.create')
            ->with('template',$template);

    }

    public function create(Request $request){

        $id = $request->input('id');
        $name = $request->input('name');
        $type = $request->input('type');

        if($id == '0'){
            $template = new Templates();
            $template->name = $name;
            $template->type = $type;
            $template->save();
        }
        else{
            $template = Templates::find($id);
            $template->name = $name;
            $template->type = $type;
            $template->save();
        }

        return $template->id;

    }

    public function input_create(Request $request){

        $name = $request->input('name');
        $id = $request->input('id');
        $input_id = $request->input('input_id');

        $template = Templates::find($id);

        if($input_id == '0'){

            $add_sub = new TempInputs();
            $add_sub->name = $name;
            $add_sub->value = $name;
            $add_sub->save();

            $template->inputs()->save($add_sub);

            $input = TempInputs::find($add_sub->id);
        }
        else{
            $template->inputs()->where('input_id',$input_id)->update([
                'name' => $name,
                'value' => $name
            ]);

            $input = TempInputs::find($input_id);
        }



        return view('pages.templates.input_settings')
            ->with('input',$input)
            ->with('template',$template);

    }
}
