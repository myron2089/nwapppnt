@foreach($myCardData as $data)
<div class="portlet light profile-sidebar-portlet custom-sidebar-portlet">
  <div class="profile-userpic">
	  <img src="{{url('')}}/{{$data->PICTURE}}" class="img-responsive" alt="Mi Avatar" style="max-width: 100%;">

    <div class="profile-usertitle">
      <div class="profile-usertitle-name">{{$data->FULLNAME}}</div>
    </div>
  </div>
	

  <div class="profile-usermenu custom-profile-usermenu">
      <ul class="nav">
          <li @if($checked=='profile') class="active" @endif>
              <a href="{{url('/perfil')}}">
                  <i class="icon-user float-right"></i> Perfil </a>
          </li>
          <li @if($checked=='account') class="active" @endif>
              <a href="{{url('/cuenta')}}">
                  <i class="icon-settings"></i> Configuración de Cuenta </a>
          </li>
          <li @if($checked=='events') class="active" @endif>
              <a href="{{url('/eventos')}}">
                  <i class="icon-calendar"></i> Eventos </a>
          </li>
        <!--  <li>
              <a href="{{url('visitantes/eventos')}}">
                  <i class="icon-star"></i> Actividades Favoritas </a>
          </li>-->

          <li>
              <a href="javascript:;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="fa fa-sign-out float-right"></i> Salir </a>
          </li>
      </ul>
  </div>




  <!--<div class="list-group profile-actions" style="margin-left: 0px; margin-right: 0px;">
    <a href="{{url('visitantes/perfil')}}" data-url="" class="list-group-item list-group-item-action clearfix get-content">Perfil<i class="icon-user float-right"></i></a>
    <a href="{{url('visitantes/cuenta')}}" data-url="" class="list-group-item list-group-item-action clearfix get-content">Cuenta<i class="icon-lock float-right"></i></a>
    <a href="{{url('visitantes/eventos')}}"  data-url="{{url('visitantes/eventos')}}" class="list-group-item list-group-item-action clearfix get-content">Eventos <i class="icon-calendar float-right"></i></a>
    <a href="#"  data-url="{{url('visitante/mis-actividades')}}" class="list-group-item list-group-item-action clearfix get-content">Actividades Favoritas <i class="icon-star float-right"></i></a>
    <a href="javascript:;"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="list-group-item list-group-item-action clearfix">Salir <i class="icon-line2-logout float-right"></i></a>
  </div>-->
     
</div>
@endforeach