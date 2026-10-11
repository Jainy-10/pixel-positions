<?php

namespace App\Http\Controllers;
use App\Models\Tag;

class TagController extends Controller
{
    public function __invoke(Tag $tag)
    {
        return view('result', [
            'heading' => $tag->name,
            'jobs' => $tag->jobs
        ]);
    }
}
