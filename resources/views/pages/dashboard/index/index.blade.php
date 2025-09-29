@extends('layouts.app-dashboard')

@section('content')

<div class="container-fluid py-4">
  @include('pages.dashboard.index.components.summary')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body p-3">
            <canvas id="userChart" height="50" width="100"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('customscript')]
  <script>
    const ctx = document.getElementById('userChart').getContext('2d');
    const userChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: @json($datasets)
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
  </script>
@endsection
