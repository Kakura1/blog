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
                            Yourblog - Administrador de categorias
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
                                        <h4 class="text-center m-1">Crea tus categorias</h2>
                                    </div>
                                    <div class="card-body">
                                        <img src="..\img\category.png" class="img-fluid rounded mx-auto d-block mb-4">
                                        <p class="mx-3">
                                            En your blog te damos la capacidad de crear carpetas de articulos en las cuales
                                            se clasifican a
                                            travez de categorias en las que con una descripcion permitiras a los lectores
                                            ver tus articulos relacionados.
                                        </p>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#createCategory{{ Auth::user()->id }}">
                                                Crea una nueva categoria ahora!!!
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @foreach ($categories as $category)
                                <div class="feature col-md-3 m-2">
                                    <div class="card" style="height: 100%">
                                        <div class="card-header bg-primary">
                                            <h4 class="text-center m-1">{{ $category->category }}</h2>
                                        </div>
                                        <div class="card-body">
                                            <img src="{{ $category->image }}" class="img-thumbnail">
                                            <p class="mx-3 mt-2">
                                                {{ $category->description }}
                                            </p>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal"
                                                    data-bs-target="#editCategory{{ $category->id }}">
                                                    Editar Categoria
                                                </button>
                                                <br>
                                                <button type="button" class="btn btn-success m-1" data-bs-toggle="modal"
                                                    data-bs-target="#viewCategory{{ $category->id }}">
                                                    Ver Categoria
                                                </button>
                                                <br>
                                                <button type="button" class="btn btn-danger m-1" data-bs-toggle="modal"
                                                    data-bs-target="#deleteCategory{{ $category->id }}">
                                                    Borrar Categoria
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal de Editar Categoria -->
                                <div class="modal fade" id="editCategory{{ $category->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Editando Categoria</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('categories.update', $category->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <label class="form-label" for="Category">Categoria:</label>
                                                    <input type="text" name="category" id="Category"
                                                        class="form-control" placeholder="Nombre de la categoria"
                                                        value="{{ $category->category }}">
                                                    <label class="form-label" for="Description">Descripcion:</label>
                                                    <textarea name="description" id="Description" class="form-control" placeholder="Descripcion de la categoria"
                                                        rows="4">{{ $category->description }}</textarea>
                                                    <label class="form-label" for="Image">Imagen:</label>
                                                    <img src="{{ $category->image }}" class="img-thumbnail">
                                                    <label for="changeImage" class="form-label mx-1">Cambiar Imagen:</label>
                                                    <input class="form-control" accept="image/*" type="file"
                                                        name="changeImage" id="changeImage">
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

                                <!-- Modal de Ver Categoria -->
                                <div class="modal fade" id="viewCategory{{ $category->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Editando Categoria</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('categories.show', $category->id) }}" method="GET">
                                                @csrf
                                                <div class="modal-body">
                                                    <label class="form-label" for="Category">Categoria:</label>
                                                    <input type="text" name="category" id="Category"
                                                        class="form-control" placeholder="Nombre de la categoria"
                                                        disabled="true" value="{{ $category->category }}">
                                                    <label class="form-label" for="Description">Descripcion:</label>
                                                    <textarea name="description" id="Description" class="form-control" placeholder="Descripcion de la categoria"
                                                        rows="4" disabled="true">{{ $category->description }}</textarea>
                                                    <label class="form-label" for="Image">Imagen:</label>
                                                    <img src="{{ $category->image }}" class="img-thumbnail">
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

                                <!-- Modal de Borrar Categoria -->
                                <div class="modal fade" id="deleteCategory{{ $category->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Borrar Categoria</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('categories.destroy', $category->id) }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('delete')
                                                <div class="modal-body">
                                                    <h3> ¿Estas seguro de borrar esta categoria?</h3>
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

                        <!-- Modal de Crear Categoria -->
                        <div class="modal fade" id="createCategory{{ Auth::user()->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Creando Categoria</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('categories.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <label class="form-label" for="Category">Categoria:</label>
                                            <input type="text" name="category" id="Category" class="form-control"
                                                placeholder="Nombre de la categoría">
                                            <label class="form-label" for="Description">Descripcion:</label>
                                            <textarea name="description" id="Description" class="form-control"
                                                placeholder="Escribe la descripcion de la categoria" rows="4"></textarea>
                                            <label class="form-label" for="Image">Imagen:</label>
                                            <input class="form-control" accept="image/*" type="file" name="image"
                                                id="Image">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
