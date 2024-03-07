<?php

namespace App\Repositories;


use DB;
use App\Models\Page;

class PageRepository 
{
    //


    public static function mainmenu(){
        $data=Page::where('status','1')->where('parent_id','0')->get();
        return $data;
    }


}