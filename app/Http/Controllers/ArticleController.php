<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with(['category', 'author'])->visible()->paginate(2);

        return view('article.index')->with('articles', $articles);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::with(['author', 'category'])->visible()->find($id);

        if(!$article){
            session()->flash('error_message', "article {$id} does not exists");
            return back();
        }

        $comments = $article->comments()->paginate(2);

        $firstTierComments = [];
        foreach ($comments as $comment)
        {
            $firstTierComments[] = $comment->id;
        }


        $subComments = Comment::with(['user'])->where(function($query) use ($firstTierComments) {
            foreach ($firstTierComments as $firstTierComment){
                $query = $query->orWhere('address', 'like', "{$firstTierComment}-%");
            }

            return $query;

        })->orderBy('id', 'asc')->get();


        $parsedSubComments = [];
        foreach ($comments as $comment)
        {
            $parsedSubComments[$comment->id] = [];
            foreach ($subComments as $subComment){
                if(strpos($subComment->address, $comment->id . '-') !==0){
                    continue;
                }
                $reference = &$parsedSubComments[$comment->id];
                $parts = explode('-', trim($subComment->address, '-'));
                $l = count($parts);
                for($i=1; $i<$l; $i++){
                    $reference = &$reference[$parts[$i]]['sub_comments'];
                }

                $reference[$subComment->id] = [
                    'comment' => $subComment,
                    'sub_comments' => [],
                ];

            }

        }

        return view('article.show', compact('article', 'comments', 'subComments', 'parsedSubComments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    }


    public function comment(Request $request, $id)
    {
        $this->validate($request, [
            'message' => 'required|min:5',
        ]);

        $article = Article::with(['author', 'category'])->visible()->find($id);

        if(!$article){
            session()->flash('error_message', "article {$id} does not exists");
            return back()->withInput();
        }


        $comment = $article->submitComment($request->message, \Auth::user());

        if(!$comment) {
            session()->flash('error_message', 'Your comment could not be saved');
            return back()->withInput();
        }

        session()->flash('success_message', 'Your comment added');
        return back();
    }
}
