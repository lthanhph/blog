<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostTermController;
use App\Models\Post;
use App\Models\Term;
use App\Models\PostTerm;
use App\Models\Taxonomy;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if ($request->user()->can('viewAll', Post::class)) {
            $posts = Post::paginate(10);
        } else {
            $posts = $request->user()->post()->paginate(10);
        }

        $data = ['posts' => $posts];
        if ($request->has('ajax_pagination')) {
            $view = response()->view('admin.path.table.post', $data);
        } else {
            $view = view('admin.path.post', $data);
        }
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        if ($request->user()->cannot('create', Post::class)) {
            abort(403);
        }

        return view('admin.path.post-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if ($request->user()->cannot('store', Post::class)) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'thumbnail_id' => 'nullable',
        ]);
        $post = Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'thumbnail_id' => $validated['thumbnail_id'],
            'user_id' => Auth::user()->id,
        ]);
        $this->syncPostTerms(
            $post->id, 
            $request->input('category_ids'), 
            $request->input('tag_titles')
        );
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        return view('public.path.post-show', [ 
            'post' => Post::find($id), 
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        $post = Post::find($id);
        if ($request->user()->cannot('edit', $post)) {
            abort(403);
        }
        
        return view('admin.path.post-edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $post = Post::find($id);
        if ($request->user()->cannot('update', $post)) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'thumbnail_id' => 'nullable|numeric',
        ]);
        $post->update($validated);

        $this->syncPostTerms(
            $id, 
            $request->input('category_ids'), 
            $request->input('tag_titles')
        );

        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $post = Post::find($id);
        if ($request->user()->cannot('destroy', $post)) {
            abort(403);
        }

        $post->comment()->delete();
        $post->term()->detach();
        $post->delete();

        return redirect()->route('post.index');
    }

    public function loadMore(Request $request)
    {
        $validated = $request->validate([
            'offset' => 'required',
            'limit' => 'required',
        ]);
        $post = Post::offset($validated['offset'])->limit($validated['limit'])->get();
        return response()->view('public.loop.post', ['post' => $post]);
    }

    /**
     * Sync post terms
     * @param string|int $id
     * @param array $category_ids   
     * @param array $tag_titles
     */
    public function syncPostTerms($id, $category_ids, $tag_titles)
    {
        $term_ids = [];
        if (!empty($category_ids) && is_array($category_ids)) {
            $term_ids = $category_ids;
        }
        if (!empty($tag_titles) && is_array($tag_titles)) {
            foreach ($tag_titles as $tag_title) {
                $tag = Term::firstOrCreate([
                    'title' => $tag_title,
                    'taxonomy_id' => Taxonomy::firstWhere('name', 'tag')->id
                ]);
                $term_ids[] = $tag->id;
            }
        }
        if (!empty($term_ids)) {
            Post::find($id)->term()->sync($term_ids);
        }
    }
}
