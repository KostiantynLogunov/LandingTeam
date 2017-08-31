<?php

namespace App\Http\Controllers;

use App\Page;
use Validator;
use Illuminate\Http\Request;

class PagesAddController extends Controller
{
    //
    public function execute(Request $request) {
        if (view()->exists('admin.pages_add')) {

            if ($request->isMethod('post')) {
                $input= $request->except('_token');


                $masseges = [
                    'required' => ' Поле :attribute обовязкове до заповнення',
                    'unique' => ' Поле :attribute обовязкове бути унікальним'
                ];

                $validator = Validator::make($input,[
                    'name'=>'required|max:50',
                    'alias'=>'required|unique:pages|max:255',
                    'text'=>'required'
                ], $masseges);

                if ($validator->fails()) {
                    return redirect()->route('pagesAdd')->withErrors($validator)->withInput();
                }
//                dd($input);

                if ($request->hasFile('images')) {
                    $file = $request->file('images');
                    $input['images'] = $file->getClientOriginalName();

                    $file -> move(public_path().'/assets/img',$input['images']);
//                    dd($input);
                }

                $page = new Page($input);
//                or $page->fill($input);
              if ($page->save()) {
                  return redirect('admin')->with('status','Added_pages');
              }
            }

            $data = [
                'title'=> 'Нова Сторінка'
            ];
            return view('admin.pages_add',$data);
        }
        abort(404);
    }
}
