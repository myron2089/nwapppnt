<div class="sidebar-widgets-wrap categories-container" data-animate="fadeIn">

	<div class="widget widget_links clearfix" style="box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.15); background: #fff; padding-top: 20px; padding-bottom: 20px; margin-top: 10px;">
		<h4>Categorías</h4>
		<div class="custom-line"></div>
		<!--<ul style="padding-left: 20px" class="cl-effect-21">
			
			<li><a href="#" class="hover-lines"></a></li>
			
		</ul>-->


		<div class="col-md-12 event-types-container" style="padding: 20px; margin-top: -20px;">
			@foreach($eventTypes as $type)

				<a href="{{url('/eventos/categorias')}}/{{mb_strtolower($type->eventTypeName,'UTF-8')}}" class="event-types-tag">{{$type->eventTypeName}}</a>
			@endforeach
		</div>
	</div>
	<div class="clear" style="height: 20px"></div>
	
		
</div> <!-- #end sidebar widgets -->