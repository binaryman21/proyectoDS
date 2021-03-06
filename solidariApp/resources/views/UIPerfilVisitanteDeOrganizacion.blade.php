@extends("layouts.master")

@section("contenido")
@parent
<div class="container-sm perfil bg-white p-2 px-lg-4">
    <div class="card card-user mb-3">
        <div class="card-img-block">
            <img id="cover" src="{{URL::asset('assets/img/cover.svg')}}" class="img-fluid" alt="portada de la organizacion">
        </div>
        <div class="card-body pt-5">
            <div class="media">
                <img id="urlFotoPerfilOrganizacion" class="rounded-circle imgPerfilOrg align-self-start mr-auto" src="{{URL::asset('assets/img/imgUserProfile.png')}}" alt="imagen de usuario">
            </div>
            <button class="user-action d-flex btn ml-auto p-0" type="button" data-toggle="modal" href="#modalSubscribirse" id="btnSuscribirse">Subscribirse</button>
            <div class="clearfix mb-n4"></div>
            <h5 class="card-title mt-2 loading ldg-w-sm" id="nombreOrganizacion"></h5>
            <h6 class="card-subtitle text-muted loading" id="tipoOrganizacion"></h6>
            <p class="card-text mt-4 loading ldg-w-lg ldg-block" id="descripcionOrganizacion"></p>
            <small class="card-text text-muted loading" id="fechaAltaUsuario"></small>
        </div>
    </div>
    <div class="row mb-4">
        <!-- necesidades -->
        <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title float-left">Necesidades</h6>
                <div class="input-group my-3">
                    <input class="form-control border-secondary border-right-0" type="text" id="campoBuscarPorTexto" placeholder="Categoría, descripción o nombre de la Org.">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary border-secondary border-left-0" id="btnBuscarNeccesidades" type="button"><i class="fa fa-search fa-xs"></i></button>
                    </div>
                </div>
                <div class="necesidades"></div>
            </div>
            <div id="navNecesidades"></div>
        </div>
            <div class="col-md-6">
                <div class="datos">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Contacto</h6>
                            <label for="inptEmail">Email</label>
                            <p class="mx-2 py-2 text-muted loading" id="correo"></p>
                            <label for="codArea">Telefono</label>
                            <div class="list-group list-group-flush mx-2 text-muted loading" id="listadoTelefonos"></div>
                            <label for="calle">Direccion</label>
                            <div class="list-group list-group-flush mx-2 text-muted loading ldg-w-lg ldg-block" id="listadoDomicilios"></div>
                        </div>
                    </div>
                </div>
                <div class="card comentarios mt-4">
                    <div class="card-body">
                        <div class="card-title clearfix">
                            <h6 class="float-left">Comentarios</h6><button class="btn float-right p-0" type="button" data-toggle="modal" href="#modalCalificar" id="btnCalificar">Calificar</button>
                        </div>
                        <div class="card comentario">
                            <div class="card-body">
                                <h5 class="card-title d-flex justify-content-between"> <span class="tituloComentario">Gran ayuda</span> <span class="fechaComentario">15/07/2020</span></h5>
                                <p class="card-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis molestias adipisci asperiores doloribus, soluta nostrum ab ea quasi ducimus aliquam. Illo accusamus rerum dignissimos aliquid culpa aperiam vitae ullam sunt.</p>
                            </div>
                        </div>
                        <div class="card comentario">
                            <div class="card-body">
                                <h5 class="card-title d-flex justify-content-between"> <span class="tituloComentario">Dudoso</span> <span class="fechaComentario">15/07/2020</span></h5>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora quasi, fuga voluptates accusamus odit id quam alias sint officia harum, explicabo veniam incidunt, repellat molestiae quaerat eum delectus eligendi beatae!</p>
                            </div>
                        </div>
                    <div id="navComentarios"><a href="JavaScript:Void(0);" rel="0" class="active">1</a> <a href="JavaScript:Void(0);" rel="1">2</a> </div></div>
                </div>
        </div>
    </div>
</div>
</div> <!-- container -->

@include("UIPerfilModales/UIModalCalificar")
@include("UIPerfilModales/UIModalReportar")
@include("UIPerfilModales/UIModalSubscribirse")
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="{{URL::asset('assets/js/utilidades.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/js/logueo.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/js/visitanteDeOrganizacion.js')}}"></script>
@endsection
