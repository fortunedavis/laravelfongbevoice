@extends("admin.index")
@section("admin")

<!-- <div id="success-message" class="alert alert-success" style="display:none;"></div> -->
    
<div class="admin_home_container">
        <div class="overall_data">
            <div>
                <h4>Users</h4>
                <p>{{$users_number}}</p>
            </div>
            <div>
                <h4>Record</h4>
                <p>{{$records_number}}</p>
            </div>
            <div>
                <h4>Validateurs</h4>
                <p>...</p>
            </div>
            <div>
                <h4>Best Recorder</h4>
                <p>{{$best->name}}</p>
                <p>{{$best->records_count}} records</p>
            </div>
        </div>

        <div class="overall_statistic">
            <div>
                <h4>{{ $chart1->options['chart_title'] }}</h4>
                {!! $chart1->renderHtml() !!}
            </div>
            <div>
                <h4>{{ $chart2->options['chart_title'] }}</h4>
                {!! $chart2->renderHtml() !!} 
            </div>
        </div>
    </div>
@endsection
@section('javascript')
{!! $chart1->renderChartJsLibrary() !!}
{!! $chart2->renderChartJsLibrary() !!}

{!! $chart1->renderJs() !!}
{!! $chart2->renderJs() !!}
@endsection
