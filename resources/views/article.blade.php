@extends('layouts.app')

@section('title')
    YB - Inicio
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-bg-8">
            <div class="card">
                <div class="card-header mt-1">
                    <h2 class="text-center">
                        Yourblog - Administrador de articulos
                    </h2>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row mt-1 text-center">
                        @if (session('message'))
                            <button type="button" class="btn btn-success" disabled="true" id="liveToastBtn">
                                {{ session('message') }} </button>
                        @endif
                    </div>
                    <div class="row mt-3 justify-content-center ">

                        <div class="feature col-md-4 m-2">
                            <div class="card" style="height: 100%">
                                <div class="card-header bg-primary mb-4">
                                    <h2 class="text-center m-1">Crea tus Ariculos</h2>
                                </div>
                                <div class="card-body">
                                    <img src="..\img\article.jpg" class="img-fluid rounded mx-auto d-block mb-4">
                                    <p class="mx-3">
                                        En your blog te damos la capacidad de crear articulos en los cuales
                                        puedes escribir sobre cualquier tema dentro de las categorias y etiquetas
                                        a las que pertenezca tu articulo.
                                    </p>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#createArticle{{ Auth::user()->id }}">
                                            Crea una nuevo articulo ahora!!!
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach ($articles as $article)
                            <div class="feature col-md-10 m-2">
                                <div class="card" style="height: 100%">
                                    <div class="card-header bg-primary">
                                        <h4 class="text-center m-1">{{ $article->title }}</h2>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img src="{{ $article->banner_image }}" class="img-thumbnail">
                                        </div>
                                        <p class="mx-3 mt-2">{{ $article->content }}</p>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal"
                                                data-bs-target="#editArticle{{ $article->id }}">
                                                Editar Articulo
                                            </button>
                                            <br>
                                            <button type="button" class="btn btn-success m-1" data-bs-toggle="modal"
                                                data-bs-target="#viewArticle{{ $article->id }}">
                                                Ver Articulo
                                            </button>
                                            <br>
                                            <button type="button" class="btn btn-danger m-1" data-bs-toggle="modal"
                                                data-bs-target="#deleteArticle{{ $article->id }}">
                                                Borrar Articulo
                                            </button>
                                            <br>
                                            <div class="row text-center">
                                                <a href="/articles/{{$article->id}}/view" class="btn btn-primary">Visualizar Pagina del Articulo</a>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal de Editar Articulo -->
                            <div class="modal modal-lg fade" id="editArticle{{ $article->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Editando Articulo</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('articles.update', $article->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <label class="form-label" for="Title">Titulo del Articulo:</label>
                                                <input type="text" name="title" id="Title"
                                                    class="form-control" placeholder="Nombre de la categoria"
                                                    value="{{ $article->title }}">
                                                <label class="form-label" for="Content">Contenido del Articulo:</label>
                                                <textarea name="content" id="Content" class="form-control" placeholder="Descripcion de la categoria"
                                                    rows="4">{{ $article->content }}</textarea>
                                                <label class="form-label" for="BannerImage">Imagen del banner:</label>
                                                <div class="row text-center">
                                                    <img src="{{ $article->banner_image }}" class="img-thumbnail">
                                                </div>
                                                <label for="changeBannerImage" class="form-label mx-1">Cambiar Imagen del banner:</label>
                                                <input class="form-control" accept="image/*" type="file"
                                                    name="changeImage1" id="changeBannerImage">
                                                <label class="form-label" for="BannerImage">Imagen del Contenido:</label>
                                                <div class="row text-center">
                                                    <img src="{{ $article->content_image }}" class="img-thumbnail">
                                                </div>
                                                <label for="changeContentImage" class="form-label mx-1">Cambiar Imagen del contenido:</label>
                                                <input class="form-control" accept="image/*" type="file"
                                                    name="changeImage2" id="changeContentImage">
                                                <label class="form-label" for="Presentation">Presentacion:</label>
                                                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="presentation" id="Presentation">
                                                    <option selected value="{{$article->presentation}}">{{$article->presentation}}</option>
                                                    @if ($article->presentation == 'Formal')
                                                    <option value="Informal">Informal</option>
                                                    @endif
                                                    @if ($article->presentation == 'Informal')
                                                    <option value="Formal">Formal</option>
                                                    @endif
                                                </select>
                                                <label class="form-label" for="category">Categoria:</label>
                                                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                                    @foreach ($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->category}}</option>
                                                    @endforeach
                                                </select>
                                                <label class="form-label" for="tag">Etiqueta:</label>
                                                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                                    @foreach ($tags as $tag)
                                                    <option value="{{$tag->id}}">{{$tag->tag}}</option>
                                                    @endforeach
                                                </select>
                                                <input type="number" name="id_user" value="{{ Auth::user()->id }}"
                                                    id="createCategory" style="display: none">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="reset" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal de Ver Articulo -->
                            <div class="modal modal-lg fade" id="viewArticle{{ $article->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ver informacion del articulo</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('articles.show', $article->id) }}" method="GET">
                                            @csrf
                                            <div class="modal-body">
                                                <label class="form-label" for="Title">Articulo:</label>
                                                <input type="text" name="title" id="Title"
                                                    class="form-control" placeholder="Titulo del articulo"
                                                    disabled="true" value="{{ $article->title }}">
                                                <label class="form-label" for="Content">Contenido del articulo:</label>
                                                <textarea name="content" id="Content" class="form-control" placeholder="Descripcion de la categoria"
                                                    rows="4" disabled="true">{{ $article->content }}</textarea>
                                                <label class="form-label" for="Image">Imagen del banner:</label>
                                                <div class="row text-center">
                                                    <img src="{{ $article->banner_image }}" class="img-thumbnail">
                                                </div>
                                                <label class="form-label" for="Image">Imagen del contenido:</label>
                                                <div class="row text-center">
                                                    <img src="{{ $article->content_image }}" class="img-thumbnail">
                                                </div>
                                                <label class="form-label" for="Category">Categoria del Articulo:</label>
                                                @foreach ($categories as $category)
                                                @if ($category->id == $article->category_id)
                                                    <input type="text" name="tag" id="Tag"
                                                    class="form-control" placeholder="Titulo del articulo"
                                                    disabled="true" value="{{ $category->category }}">
                                                @endif
                                                @endforeach 
                                                <label class="form-label" for="Tag">Etiqueta del Articulo:</label>
                                                @foreach ($tags as $tag)
                                                @if ($tag->id == $article->tag)
                                                    <input type="text" name="tag" id="Tag"
                                                    class="form-control" placeholder="Titulo del articulo"
                                                    disabled="true" value="{{ $tag->tag }}">
                                                @endif
                                                @endforeach                                                
                                                <label class="form-label" for="Presentation">Presentacion del Articulo:</label>
                                                <input type="text" name="presentation" id="Presentation"
                                                    class="form-control" placeholder="Titulo del articulo"
                                                    disabled="true" value="{{ $article->presentation }}">
                                                <input type="number" name="id_user" value="{{ Auth::user()->id }}"
                                                    id="createCategory" style="display: none">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="reset" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal de Borrar Articulo -->
                            <div class="modal modal-lg fade" id="deleteArticle{{ $article->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Borrar Articulo</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('articles.destroy', $article->id) }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('delete')
                                            <div class="modal-body">
                                                <h3> ¿Estas seguro de borrar este articulo?</h3>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="reset" class="btn btn-secundary btn-reset"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Aceptar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Modal de Crear Articulo -->
                    <div class="modal modal-lg fade" id="createArticle{{ Auth::user()->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Creando Articulo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('articles.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <label class="form-label" for="Title">Titulo del Articulo:</label>
                                        <input type="text" name="title" id="Title" class="form-control"
                                            placeholder="Titulo del articulo">
                                        <label class="form-label" for="Content">Contenido:</label>
                                        <textarea name="content" id="Content" class="form-control"
                                            placeholder="Escribe el contenido del articulo" rows="8"></textarea>
                                        <label class="form-label" for="BannerImage">Imagen del banner:</label>
                                        <input class="form-control" accept="image/*" type="file" name="bannerImage"
                                            id="BannerImage">
                                        <label class="form-label" for="ContentImage">Imagen del banner:</label>
                                        <input class="form-control" accept="image/*" type="file" name="contentImage"
                                            id="ContentImage">
                                        <label class="form-label" for="Presentation">Tipo de presentacion:</label>
                                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="Presentation" name="presentation">
                                            <option value="Formal">Formal</option>
                                            <option value="Informal">Informal</option>
                                        </select>
                                        <input type="number" name="id_user" value="{{ Auth::user()->id }}"
                                            id="createCategory" style="display: none">
                                        <label class="form-label" for="Category">Categoria:</label>
                                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="category" id="Category">
                                            @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->category}}</option>
                                            @endforeach
                                        </select>
                                        <label class="form-label" for="Tag">Etiqueta:</label>
                                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="tag" id="Tag">
                                            @foreach ($tags as $tag)
                                            <option value="{{$tag->id}}">{{$tag->tag}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection