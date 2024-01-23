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
                            Yourblog - Administrador de etiquetas
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

                            <div class="feature col-md-3 m-2">
                                <div class="card">
                                    <div class="card-header bg-primary">
                                        <h4 class="text-center m-1">Crea tus etiquetas</h2>
                                    </div>
                                    <div class="card-body">
                                        <img src="..\img\tag.jpg" class="img-thumbnail" style="width: 50%; margin: 0% 25%;">
                                        <p class="mx-3 my-1">
                                            En Your Blog te damos la posibilidad de crear etiquetas de temas especificos de
                                            los cuales puedes clasificar tus articulos con ellas.
                                        </p>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary my-1" data-bs-toggle="modal"
                                                data-bs-target="#createTag{{ Auth::user()->id }}">
                                                Crea una nueva etiqueta ahora!!!
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @foreach ($tags as $tag)
                                <div class="feature col-md-4 m-2">
                                    <div class="card">
                                        <div class="card-header bg-primary">
                                            <h2 class="text-center m-1">{{ $tag->tag }}</h2>
                                        </div>
                                        <div class="card-body">
                                            <h3 class="mx-3 mt-2 font-bold text-center">
                                                {{ $tag->description }}
                                            </h3>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal"
                                                    data-bs-target="#editTag{{ $tag->id }}">
                                                    Editar Etiqueta
                                                </button>
                                                <br>
                                                <button type="button" class="btn btn-success m-2" data-bs-toggle="modal"
                                                    data-bs-target="#viewTag{{ $tag->id }}">
                                                    Ver Etiqueta
                                                </button>
                                                <br>
                                                <button type="button" class="btn btn-danger m-2" data-bs-toggle="modal"
                                                    data-bs-target="#deleteTag{{ $tag->id }}">
                                                    Borrar Etiqueta
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal de Editar Etiqueta -->
                                <div class="modal fade" id="editTag{{ $tag->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Editando Etiqueta</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('tags.update', $tag->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <label class="form-label" for="tag">Etiqueta:</label>
                                                    <input type="text" name="tag" id="tag" class="form-control"
                                                        placeholder="Nombre de la Etiqueta" value="{{ $tag->tag }}">
                                                    <label class="form-label" for="Description">Descripcion:</label>
                                                    <textarea name="description" id="Description" class="form-control" placeholder="Descripcion de la Etiqueta"
                                                        rows="4">{{ $tag->description }}</textarea>
                                                    <input type="number" name="id_user" value="{{ Auth::user()->id }}"
                                                        id="createtag" style="display: none">
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

                                <!-- Modal de Ver Etiqueta -->
                                <div class="modal fade" id="viewTag{{ $tag->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Editando Etiqueta</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('tags.show', $tag->id) }}" method="GET">
                                                @csrf
                                                <div class="modal-body">
                                                    <label class="form-label" for="tag">Etiqueta:</label>
                                                    <input type="text" name="tag" id="tag"
                                                        class="form-control" placeholder="Nombre de la Etiqueta"
                                                        disabled="true" value="{{ $tag->tag }}">
                                                    <label class="form-label" for="Description">Descripcion:</label>
                                                    <textarea name="description" id="Description" class="form-control" placeholder="Descripcion de la Etiqueta"
                                                        rows="4" disabled="true">{{ $tag->description }}</textarea>
                                                    <input type="number" name="id_user" value="{{ Auth::user()->id }}"
                                                        id="createtag" style="display: none">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="reset" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal de Borrar Etiqueta -->
                                <div class="modal fade" id="deleteTag{{ $tag->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Borrar Etiqueta</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('tags.destroy', $tag->id) }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('delete')
                                                <div class="modal-body">
                                                    <h3> ¿Estas seguro de borrar esta Etiqueta?</h3>
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

                        <!-- Modal de Crear Etiqueta -->
                        <div class="modal fade" id="createTag{{ Auth::user()->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Creando Etiqueta</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('tags.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <label class="form-label" for="tag">Etiqueta:</label>
                                            <input type="text" name="tag" id="tag" class="form-control"
                                                placeholder="Nombre de la etiqueta">
                                            <label class="form-label" for="Description">Descripcion:</label>
                                            <textarea name="description" id="Description" class="form-control"
                                                placeholder="Escribe la descripcion de la etiqueta" rows="4"></textarea>
                                            <input type="number" name="id_user" value="{{ Auth::user()->id }}"
                                                id="createtag" style="display: none">
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
