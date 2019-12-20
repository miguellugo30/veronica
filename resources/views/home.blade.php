@extends('adminlte::master')

@section('title', 'Nimbus CCC')

<div class="content-wrapper" style="margin-left: 0px;">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="card mb-3">
                <!--img src="http://104.152.200.148/ccs/Empresas/imagenes/modulos_superior.jpg" class="card-img-top img-fluid" alt="Nimbus CCC"-->
                <img src="https://3pm93uct67m3g6as311i2ld1-wpengine.netdna-ssl.com/wp-content/uploads/2016/10/Call-Center-Solution-Dubai.jpg" class="card-img-top img-fluid" alt="Nimbus CCC">
                <div class="card-body col-lg-12 justify-content-md-center" style="display: flex;">
                    <div class="row col-lg-12 ">

                        <div class="col col-sm-2 col-md-2 ca-menu text-center card m-1 bg-primary text-white thumbnail">
                            <a href="{{url("/inbound")}}">

                                <div class="pt-3">
                                    <i class="fas fa-phone-volume fa-5x"></i>
                                    <i class="fas fa-caret-left fa-3x"></i>
                                    <i class="fas fa-caret-left fa-3x"></i>
                                </div>
                                <div class="pt-3">
                                    <h6>Inbound</h6>
                                </div>
                            </a>
                        </div>

                            <div class="col  text-center card m-1 bg-secondary text-white">
                                <div class="pt-3">
                                    <i class="fas fa-phone-volume fa-5x"></i>
                                    <i class="fas fa-caret-right fa-3x"></i>
                                    <i class="fas fa-caret-right fa-3x"></i>
                            </div>
                            <div class="pt-3">
                                <h6>Outbound</h6>
                            </div>
                        </div>
                        <div class="col  text-center card m-1 bg-success text-white thumbnail">
                            <a href="{{url("/monitor")}}">
                                <div class="pt-3">
                                    <i class="fas fa-headset fa-5x"></i>
                                </div>
                                <div class="pt-3">
                                    <h6>Monitor & Coaching</h6>
                                </div>
                            </a>
                        </div>
                        <div class="col  text-center card m-1 bg-danger text-white thumbnail">
                            <a href="/recording">
                            <div class="pt-3">
                                <i class="fas fa-microphone-alt fa-5x"></i>
                            </div>
                            <div class="pt-3">
                                <h6>Recording Suite</h6>
                            </div>
                            </a>
                        </div>
                        <div class="col  text-center card m-1 bg-info text-white thumbnail">
                            <div class="pt-3">
                                <i class="fas fa-sitemap fa-5x"></i>
                            </div>
                            <div class="pt-3">
                                <h6>Intelligent IVR</h6>
                            </div>
                        </div>
                        <div class="col  text-center card m-1 bg-secondary text-white thumbnail">
                            <div class="pt-3">
                                <i class="fas fa-tasks fa-5x"></i>
                            </div>
                            <div class="pt-3">
                                <h6>Survey Generator</h6>
                            </div>
                        </div>
                        <div class="w-100 d-none d-md-block"></div><!-- Salto de linea -->
                        <div class="col  text-center card m-1 bg-secondary text-white thumbnail">
                            <div class="pt-3">
                                <i class="fas fa-hand-holding-usd fa-5x"></i>
                            </div>
                            <div class="pt-3">
                                <h6>Billing</h6>
                            </div>
                        </div>
                        <div class="col  text-center card m-1  bg-success text-white thumbnail">
                            <div class="pt-3">
                                <i class="fas fa-phone-square fa-5x"></i>
                            </div>
                            <div class="pt-3">
                                <h6>Voice Message Broadcasting</h6>
                            </div>
                        </div>
                        <div class="col  text-center card m-1 bg-danger text-white ">
                            <div class="pt-3">
                                <i class="fas fa-envelope-square fa-5x"></i>
                            </div>
                            <div class="pt-3">
                                <h6>Vioce Mail</h6>
                            </div>
                        </div>
                        <div class="col  text-center card m-1 bg-info text-white ">
                            <div class="pt-3">
                                <i class="fas fa-users fa-5x"></i>
                            </div>
                            <div class="pt-3">
                                <h6>Conference & Meetme</h6>
                            </div>
                        </div>
                        <div class="col  text-center card m-1 bg-secondary text-white thumbnail">
                            <div class="pt-3">
                                <i class="fas fa-sms fa-5x"></i>
                            </div>
                            <div class="pt-3">
                                <h6>SMS Server</h6>
                            </div>
                        </div>
                        <div class="col  text-center card m-1 bg-primary text-white thumbnail">
                            <a href="{{url("/settings")}}">
                                <div class="pt-3">
                                    <i class="fas fa-cogs fa-5x"></i>
                                </div>
                                <div class="pt-3">
                                    <h6>Settings</h6>
                                </div>
                            </a>
                        </div>
                        <div class="w-100 d-none d-md-block"></div><!-- Salto de linea -->
                        <div class="col  text-center card m-1 bg-danger text-white thumbnail">
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <div class="pt-3">
                                    <i class="fas fa-sign-out-alt fa-5x"></i>
                                </div>
                                <div class="pt-3">
                                    <h6>Logout</h6>
                                </div>
                            </a>
                             <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                                 @if(config('adminlte.logout_method'))
                                     {{ method_field(config('adminlte.logout_method')) }}
                                 @endif
                                 {{ csrf_field() }}
                             </form>
                        </div>
                    </div>
                </div><!-- card-body -->
            </div><!-- card mb-3 -->
        </div><!-- row justify-content-md-center -->
    </div><!-- container -->
</div><!-- content-wrapper -->
