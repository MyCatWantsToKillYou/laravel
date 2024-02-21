<?php

namespace App\Http\Controllers;
use App\Models\Link;
use Illuminate\Support\Str;
use App\Http\Requests\LinksRequest;
use Illuminate\Http\Request;
use Spatie\FlareClient\Http\Exceptions\NotFound;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LinksControler extends Controller
{
    public function show()
    {
        return view('links.show');
    }

    public function send(LinksRequest $request)
    {
        $url = $request->input('url');

        $urlPrefix = str_shuffle(Str::random(2) . Str::lower(Str::random(2)) . mt_rand(10,99));
        //dd($urlPrefix);
        $link = (new \App\Models\Link)->create([
            'source_link'=>$url,
            'link_key'=> $urlPrefix
        ]);

        if($link) {
            return back()->with('success', route('links.away',['prefix'=> $urlPrefix ]));
        }
        return back()->with('errors', 'Не уалось сохранить ссылку');
    }
    public function away(string $prefix)
    {
        $link = Link::where(['link_key'=>$prefix])->firstOrFail();
        if($link){
            return redirect()->away($link->source_link);

        }

    }
}
