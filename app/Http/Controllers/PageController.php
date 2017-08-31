<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function execute($alias) {
        if (!$alias) {
            abort(404);
        }

        if (view()->exists('site.page')) {

            //where 'alias = $alias
            $page = Page::where('alias', strip_tags($alias))->first();

            $data = [
                'title'=>$page->name,
                'page'=>$page
            ];
            return view('site.page',$data);
        }
        else {
            abort(404);
        }
    }
}
