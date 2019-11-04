
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
            UBICACIÓN
                  </div>
                  <h1 class="pull-left"> <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('ubicacions.create') !!}">Crear</a></h1>
                  <div class="x_content">

                     @include('admin.ubicacions.table')
                  </div>
                </div>
              </div>



            </div>
          </div>
        </div>

@endsection


@section('script')
<script>
$(document).ready(function() {
  $('#inicio').DataTable({
    "language": {
      "url": "/admin/idioma/Spanish.json"
    }
  });
});
</script>
@endsection


