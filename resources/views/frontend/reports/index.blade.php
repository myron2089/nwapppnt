@extends('layouts.expositor.app')
@section('content')

    <!-- BEGIN PAGE CONTENT BODY -->

                <div class="row">
                    <h1>Reportes</h1>
                    @php
                        $engine = App::make("getReporticoEngine");
                        $engine->initial_execute_mode = "MENU";
                        $engine->access_mode = "ONEPROJECT";
                        $engine->initial_project = "SuperAdminReports";
                        $engine->initial_project_password = "cjKuWwQwBYcyQSXgoUtLxcjZiYYzgJbRsfFWkyAmeVLjov";
                        $engine->clear_reportico_session = true;
                        $engine->execute();
                    @endphp
                </div>

@endsection