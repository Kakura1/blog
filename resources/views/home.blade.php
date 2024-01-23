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
                            Yourblog - Inicio
                        </h2>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h3 class="text-center mb-3">
                            La pagina que te permitira crear tus propio blog personal.
                        </h3>
                        <h3 class="text-center mb-3">
                            Y en la cual podras administrar diferentes articulos a traves de etiquetas y categorias.
                        </h3>
                    </div>
                    <div class="row mt-3 justify-content-center ">
                        <div class="feature col-md-4 m-2">
                            <div class="card pb-2">
                                <div class="card-header bg-primary mb-3">
                                    <h4 class="text-center m-1">Crea tus articulos</h2>
                                </div>
                                <div class="card-body">
                                    <img src="..\img\article.jpg" class="rounded mx-auto d-block pb-4">
                                    <p class="mx-3">
                                        En Your Blog te brindamos la capacidad de crear tus propios articulos en los cuales puedes agregar desde texto a imagenes,
                                        ademas de darte la opcion de elegir el tipo de presentacion al articulo que creas.
                                    </p>
                                    <div class="text-center">
                                        <a href="/articles" class="btn btn-primary">Administrador de Articulos</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="feature col-md-3 m-2">
                            <div class="card">
                                <div class="card-header bg-primary">
                                    <h4 class="text-center m-1">Crea tus etiquetas</h2>
                                </div>
                                <div class="card-body">
                                    <img src="..\img\tag.jpg" class="img-thumbnail">
                                    <p class="mx-3">
                                        En Your Blog te damos la posibilidad de crear etiquetas de temas especificos de los cuales puedes clasificar tus articulos con ellas.
                                    </p>
                                    <div class="text-center">
                                        <a href="/tags" class="btn btn-primary">Administrador de Etiquetas</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="feature col-md-4 m-2">
                            <div class="card">
                                <div class="card-header bg-primary mb-4">
                                    <h4 class="text-center m-1">Crea tus categorias</h2>
                                </div>
                                <div class="card-body">
                                    <img src="..\img\category.png" class="rounded mx-auto d-block mb-4">
                                    <p class="mx-3">
                                        En your blog te damos la capacidad de crear carpetas de articulos en las cuales se clasifican a 
                                        travez de categorias en las que con una descripcion permitiras a los lectores ver tus articulos relacionados.
                                    </p>
                                    <div class="text-center">
                                        <a href="/categories" class="btn btn-primary">Administrador de Categorias</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
