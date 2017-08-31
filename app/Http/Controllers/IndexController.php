<?php

namespace App\Http\Controllers;

use App\Page;
use App\People;
use App\Portfolio;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\DocBlock\Tags\See;

class IndexController extends Controller
{
    //
    public function execute(Request $request) {

        if ($request->isMethod('post')) {

            $messages =[
                'required'=>"Поле :attribute Обовязков до заповнення",
                'email'=>"Поле :attribute повинно вiдповiдати formaty емаiл адресу"
            ];

            $this->validate($request, [
                'name'=>'required|max:50',
                'email'=>'required|email',
                'text'=>'required'

            ], $messages);
//            dump($request);

            $data = $request->all();

            //mail send
            $result = Mail::send('site.email',['data'=>$data], function ($message) use ($data) {

                $mail_admin = env('MAIL_ADMIN');

                $message->from($data['email'],$data['name']);
                $message->to($mail_admin,'Mr.Admin')->subject('Question');
//                dump("Email is sand");
            });

            if ($result) {
                return redirect()->route('home')->with('status','Email is sand');
            }





        }


        $pages = Page::all();
        $portfolios = Portfolio::get(array('name','filter','images'));
        $services = Service::where('id','<','20')->get();
        $people = People::take(3)->get();

        $tags = DB::table('portfolios')->distinct()->pluck('filter');

//        dd($tags);

        $menu = array();
        foreach ($pages as $page) {
            $item = array('title' => $page->name, 'alias' => $page->alias);
            array_push($menu, $item);
        }

        $item = array('title'=>'Services','alias'=>'service');
        array_push($menu, $item);

        $item = array('title'=>'Portfolio','alias'=>'Portfolio');
        array_push($menu, $item);

        $item = array('title'=>'Team','alias'=>'team');
        array_push($menu, $item);

        $item = array('title'=>'Contact','alias'=>'contact');
        array_push($menu, $item);

//        dd($menu);
        return view('site.index',array(
                                        'menu'=>$menu,
                                        'pages'=>$pages,
                                        'services'=>$services,
                                        'portfolios'=>$portfolios,
                                        'people'=>$people,
                                        'tags'=>$tags
        ));
    }

}
