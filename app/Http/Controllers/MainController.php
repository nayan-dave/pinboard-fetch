<?php

namespace App\Http\Controllers;

use App\Models\Pinboard;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;


class MainController extends Controller
{
    public function index(Request $request)
    {
        $tags = $request->all();
        $items = array();
        if(!empty($tags))
        {
            $items = Pinboard::all()->reject(function (Pinboard $item) use($tags) {
                    $allTagsNotExist = false;
                    foreach($tags AS $tag)
                    {
                        if($item->tags()->where('tag',$tag)->count() == 0)
                        {
                            $allTagsNotExist = true;
                            break;
                        }
                    }
                    return $allTagsNotExist;
                });
        }
        return response()->json($items);
    }
}
