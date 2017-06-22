@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <img src="{{ $article->picture or 'default.jpg' }}" alt="{{ $article->title }}" style="width: 100%; height: auto">
            </div>
            <div class="col-sm-8">
                <div>{{ $article->title }}</div>
                <div>written by: {{ $article->author->name }} published at: {{ $article->published_at or $article->created_at }}</div>
                <div>
                    {{ $article->excerpt }}
                </div>
                <div>
                    {!! $article->contents !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h3>Comments</h3>
                @forelse($comments as $comment)
                    <hr>
                    <div class="col-sm-12" style="margin-bottom: 40px">
                        <div>written by: {{ $comment->user? $comment->user->name: 'guest' }} published at: {{ $comment->created_at }}</div>
                        <div>
                            <div>{{ $comment->message }}</div>
                            @if(!empty($parsedSubComments[$comment->id]))
                                <ul>
                                    @include('comment.subcomment', ['bundle' => $parsedSubComments[$comment->id]])
                                </ul>
                            @endif
                        </div>
                        <div>
                            <h5>reply to this comment</h5>
                            <div>
                                @include('comment.form', ['comment' => $comment])

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-sm-12">Be the first one who posts a comment</div>
                @endforelse
                @if(count($comments))
                    {{ $comments->links() }}
                @endif
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('article.comment', ['article' => $article->id]) }}" method="post" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="comment" class="col-sm-4">Comment</label>
                        <div class="col-sm-8">
                            @if($errors->has('message'))
                                {{ $errors->first('message') }}
                            @endif
                            <textarea name="message" id="message" cols="30" rows="10" class="form-control">{{old('message')}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection