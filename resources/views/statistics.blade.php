@extends('home')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <div class="register_card">
            

            <div class="user_chart_card">
                <div class="user_chart_info">
                    <h4>Total</h4>
                    <p id="total"></p>
                </div>
                <div>
                <canvas id="myChart" style=""></canvas>

                </div>
            </div>
        </div>
        <script src="chart-controller.js"></script>

@stop
