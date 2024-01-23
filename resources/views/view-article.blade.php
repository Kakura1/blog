@extends('layouts.app')

@section('title')
    YB - {{ $article->title }}
@endsection

@section('content')

    <div class="row col-bg-12 mb-4">
        <img src="{{ $article->banner_image }}" class="img-fluid" style="max-height: 400px">
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-bg-8">
                @if ($article->presentation == 'Formal')
                    <div class="card">
                        <div class="card-header mt-1">
                            <h2 class="text-center font-bolder">
                                {{ $article->title }}
                            </h2>
                        </div>
                        <div class="card-body">
                            <p class="mx-4 mt-2">
                                {{ $article->content }}
                            </p>
                            <div class="text-center">
                                <img src="{{ $article->content_image }}" class="img-fluid mb-3" style="height: 250px">
                            </div>
                            <div class="row justify-content-center">
                                @foreach ($categories as $category)
                                    @if ($category->id === $article->category_id)
                                        <div class="feature col-md-3 m-2 ">
                                            <div class="card" style="height: 100%">
                                                <div class="card-header bg-primary">
                                                    <h2 class="text-center m-1">{{ $category->category }}</h2>
                                                </div>
                                                <div class="card-body">
                                                    <img src="{{ $category->image }}" class="img-thumbnail">
                                                    <p class="mx-3 mt-2">
                                                        {{ $category->description }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                @foreach ($tags as $tag)
                                    @if ($tag->id === $article->tag_id)
                                        <div class="feature col-md-3 m-2">
                                            <div class="card">
                                                <div class="card-header bg-primary">
                                                    <h2 class="text-center m-1">{{ $tag->tag }}</h2>
                                                </div>
                                                <div class="card-body">
                                                    <h3 class="mx-3 mt-2 font-bold text-center">
                                                        {{ $tag->description }}
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                @if ($article->presentation == 'Informal')
                    <div class="card">
                        <div class="card-header mt-1">
                            <h2 class="text-center font-bolder">
                                {{ $article->title }}
                            </h2>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <img src="{{ $article->content_image }}" class="img-fluid" style="height: 250px">
                            </div>
                            <p class="mx-3 mt-1">
                                {{ $article->content }}
                            </p>
                            <div class="row justify-content-center">
                                @foreach ($categories as $category)
                                    @if ($category->id === $article->category_id)
                                        <div class="feature col-md-3 m-2 ">
                                            <div class="card" style="height: 100%">
                                                <div class="card-header bg-primary">
                                                    <h2 class="text-center m-1">{{ $category->category }}</h2>
                                                </div>
                                                <div class="card-body">
                                                    <img src="{{ $category->image }}" class="img-thumbnail">
                                                    <p class="mx-3 mt-2">
                                                        {{ $category->description }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                @foreach ($tags as $tag)
                                    @if ($tag->id === $article->tag_id)
                                        <div class="feature col-md-3 m-2">
                                            <div class="card">
                                                <div class="card-header bg-primary">
                                                    <h2 class="text-center m-1">{{ $tag->tag }}</h2>
                                                </div>
                                                <div class="card-body">
                                                    <h3 class="mx-3 mt-2 font-bold text-center">
                                                        {{ $tag->description }}
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
