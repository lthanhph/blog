<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data = ['comments' =>  Comment::paginate(10)];
        if ($request->has('ajax_pagination')) {
            $view = response()->view('admin.path.table.comment', $data);
        } else {
            $view = view('admin.path.comment', $data);
        }
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $comment = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'content' => 'required',
            'user_id' => 'nullable',
            'post_id' => 'required',
            'parent' => 'nullable|numeric',
        ]);

        // if (isset($comment['user_id'])) {
        //     $comment['approved'] = User::find($comment['user_id'])->is_admin ? 1 : 0;
        // } else {
        //     $comment['approved'] = 0;
        // }

        // comment depth
        if (isset($comment['parent'])) {
            $parent = Comment::find($comment['parent']);
            $comment['depth'] = $parent->depth + 1 <= config('comment.depth.max') ? $parent->depth + 1 : config('comment.depth.max');
        } else {
            $comment['depth'] = 0;
        }

        // save to session
        if (!isset($comment['user_id']) && $request->input('save') == 1) {
            if (session()->has('guest')) {
                if (session('guest.name')[0] != $comment['name']) {
                    session()->forget('guest.name');
                    $request->session()->push('guest.name', $comment['name']);
                }
                if (session('guest.email')[0] != $comment['email']) {
                    session()->forget('guest.email');
                    $request->session()->push('guest.email', $comment['email']);
                }
            } else {
                $request->session()->push('guest.name', $comment['name']);
                $request->session()->push('guest.email', $comment['email']);
                $request->session()->push('guest.save', 'checked');
            }
        }
        
        // clear if uncheck
        if (session()->has('guest') && empty($request->input('save'))) {
            session()->forget('guest');
        }
        
        Comment::create($comment);

        return redirect()->route('post.show', ['post' => $comment['post_id']]);
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('admin.path.comment-edit', ['comment' => Comment::find($id)]);
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
        $comment = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'content' => 'requried',
        ]);
        Comment::find($id)->update($comment);
        return redirect()->route('comment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Comment::destroy($id);
        return redirect()->route('comment.index');
    }

    public function loadmore(Request $request, $post_id)
    {
        $comments = Comment::where([['depth', 0], ['post_id', $post_id]])
                            ->offset($request->input('offset'))
                            ->limit($request->input('limit'))
                            ->get();
        return response()->view('public.loop.comment', ['comments' => $comments]);
    }
}
