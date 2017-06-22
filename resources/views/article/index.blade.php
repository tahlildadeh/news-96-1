@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @forelse($articles as $article)
                <div class="col-sm-12" style="margin-bottom: 40px">
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="{{ $article->picture or 'default.jpg' }}" alt="{{ $article->title }}" style="width: 100%; height: auto">
                        </div>
                        <div class="col-sm-8">
                            <div>{{ $article->title }}</div>
                            <div>written by: {{ $article->author->name }} published at: {{ $article->published_at or $article->created_at }}</div>
                            <div>
                                {{ $article->excerpt }}
                                <a href="{{ url('article/' .$article->id) }}" title="read more">read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-sm-12">No article found</div>
            @endforelse
            @if(count($articles))
                {{ $articles->links() }}
            @endif
        </div>
    </div>

@endsection