<?php

namespace Modules\Dynaform\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use JeroenNoten\LaravelAdminLte\AdminLte;
use Modules\Dynaform\Entities\Element;
use Modules\Dynaform\Entities\Form;
use Modules\Dynaform\Entities\Value;

class DynaformController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    protected function parser($text)
    {

        $dat=array();
        preg_match_all('#\[dynaform=(.*?)\]#', $text, $dat);
        //dd($dat);
        if(count($dat) > 0 && $dat[0] != array() && isset($dat[1])){
            $i = 0;
            $actual_string = $dat[0];

            foreach($dat[1] as $temp){
                $content = preg_replace($actual_string[$i], "x".$i , $text);
                $i++;
            }
        }

        return $content;
    }

    public function index(Request $request)
    {
        $user_per_page=10;
        //$user=User::all();
        $forms=Form::orderBy('created_at')->paginate($user_per_page);
        $user_count=count($forms);
        return view('dynaform::forms_list',['forms' => $forms,'per_page'=>$user_per_page,'user_count'=>$user_count]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {

        return view('dynaform::index');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $title=$request->input('title');
        $type=$request->input('type');
        $style=$request->input('style');
        $required=$request->input('required');
        $form=new Form();
        $form->title="test";
        $form->save();
        $comment=array();
        for ($i=0;$i<count($title);$i++)
        {
            $req=isset($required[$i]) ? $required[$i]: 0 ;
            $comment[]=[
                'title' => $title[$i],
                'type' => $type[$i],
                'priority' => $i+1,
                'style' => $style[$i],
                'required' => $req,
                'form_id' => $form->id
            ];
        }
        $form->elements()->insert($comment);
        return redirect(URL::asset('panel/dynaform'))->with('success','form saved successfully...');

    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $form=Form::find($id);
        return view('dynaform::show_form',["form" => $form]);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $elements=Element::where('form_id',$id)->get();
        $form_id=$id;
        return view('dynaform::form_edit',['elements' => $elements,'form_id'=>$form_id]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        /*$form_id=$request->input('form_id');
        $elements_id=$request->input('elementid');

        $deleted_elements=Element::where('form_id',$form_id)->whereNotIn('id',$elements_id)->get();
        foreach ($deleted_elements as $deleted_element)
            $deleted_element->values()->delete();
        Element::whereIn('id',$elements_id)->delete();*/


    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $form=Form::where('id',$id)->with('elements')->first();
        foreach ($form->elements as $element)
            $element->values()->delete();
        foreach ($form->elements as $element)
            $element->delete();
        $form->delete();
        return back();
    }

    public function save(Request $request)
    {
        $arr=$request->all();
        $values=array();
        $rand=rand(1,1000);
        foreach ($arr as $key=>$value)
        {
            if(is_numeric($key))
            {
                $values[]=[
                    "element_id" => $key,
                    "value" =>$value,
                    "user_ip" => request()->ip()
                ];
            }
        }
        Value::insert($values);


    }


    public function users_form($id)
    {
        $form=Form::find($id)->elements()->pluck('id')->toArray();
        $ip=Value::with('element')->groupBy('user_ip')->whereIn('element_id',$form)->get();
        return view('dynaform::users_form_list',['users'=>$ip]);
    }

    public function user_form_detail($fid,$uid)
    {
        $form=Form::where("id" , $fid)->with('elements')->first();
        $ip=Value::where('id',$uid)->pluck('user_ip')->first();

        foreach ($form->elements as $element)
            $el_id[]=$element->id;
        $values=Value::where('user_ip',$ip)->whereIn('element_id',$el_id)->get();
        //dd($values);
        return view('dynaform::user_form_detail',["form"=>$form,'values'=>$values,'el_id'=>$el_id]);
    }
}
