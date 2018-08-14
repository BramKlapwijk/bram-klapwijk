<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use \Intervention\Image\Facades\Image;

class PageController extends Controller
{
    protected $types = [
        'card-list',
        'slider',
        'text'
    ];

    protected $templates = [
        'card-list' => [],
        'slider' => [],
        'text' => ['img' => '', 'background_image' => '', 'text' => ""],
    ];

    public function show($id)
    {
        $page = Page::find($id);
        $view = view('pages.types.'.$page->type);
        $view->page = $page;

        return $view;
    }

    public function image(Request $request, $id, $type, $name)
    {
        $img = Image::make($request->file('file')->getRealPath());

        $path = public_path('images/page-images/'. $id .'/'. $type);

        if (!is_dir($path)) {
            File::makeDirectory($path, 0777, true);
        }

        $img->save($path. '/' . $name . '.png');

        return redirect()->back();
    }

    public function save(Request $request, $id = null)
    {
//        $request->validate([
//            'body' => 'string|required'
//        ]);
        $page = Page::findOrNew($id);

        $page->title = $request->get('title') ?? $page->title;
        $page->type = $request->get('type') ?? $page->type;
        $page->body = $request->get('body') ?? json_encode($this->templates[$request->get('type')]);
        $page->position = $page->position ?? (Page::orderByDesc('position')->first()->position + 1);

        $page->save();

        return redirect()->back();
    }

    public function move(Page $move, Page $pos)
    {
        $bigger = $move->position < $pos->position;
        $move->position = $pos->position;
        $move->save();
        if ($bigger) {
            $pos->position -= 2;
        } else {
            $pos->position += 1;
        }
        $pos->save();
        dump($pos->position);

        Page::where('position', '=', $pos->position)->where('id', '!=', $pos->id)->get()->each(function ($q) use ($bigger) {
            if ($bigger) {
                $q->position -= 1;
            } else {
                $q->position += 1;
            }
            $q->save();
        });
    }

    public function create()
    {
        $view = view('pages.create');

        $view->types = $this->types;

        return $view;
    }

    public function delete($id)
    {
        Page::find($id)->delete();

        return redirect()->to('/home');
    }
}
