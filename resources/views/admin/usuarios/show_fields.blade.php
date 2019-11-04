
<div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Detalle <small>Users</small></h2>
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
                    <article class="media event">

                      <div class="media-body">
                        <a class="title" href="#">  {!! Form::label('name', 'Name:') !!}</a>
                        <p>{!! $usuario->name !!}</p>
                      </div>
                    </article>
                    <article class="media event">

                      <div class="media-body">
                        <a class="title" href="#"> {!! Form::label('email', 'Email:') !!}</a>
                        <p>{!! $usuario->email !!}</p>
                      </div>
                    </article>
                    <article class="media event">

                      <div class="media-body">
                        <a class="title" href="#">    {!! Form::label('privilege', 'Privilege:') !!}</a>
                        <p>{!! $usuario->privilege !!}</p>
                      </div>
                    </article>
                    <article class="media event">

                      <div class="media-body">
                        <a class="title" href="#">{!! Form::label('status', 'Status:') !!}</a>
                        <p>{!! $usuario->status !!}</p>
                      </div>
                    </article>

                  </div>
                </div>
              </div>
