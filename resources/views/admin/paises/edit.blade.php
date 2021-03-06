@extends('admin.layout.master')

@section('content')

 <div class="right_col" role="main">
 <section class="content-header">

    </section>
          <div class="">

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  @include('flash::message')
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>

                  </div>
                  <div class="x_content">

                  @include('adminlte-templates::common.errors')
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="row">
                            {!! Form::model($paises, ['route' => ['paises.update', $paises->id], 'method' => 'patch']) !!}
                                @include('admin.paises.fields')
                            {!! Form::close() !!}
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


@section('script')



@endsection

