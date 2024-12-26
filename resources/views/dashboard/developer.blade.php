@extends('layouts.master')
@section('header')
Developer Dashboard
@endsection
@section('content')

<!-- Check for Session Success -->
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Toast.fire({
            icon: '{{ session('icon') }}',
            title: '{{ session('success') }}'
        });
    });
</script>
@endif

@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Toast.fire({
            icon: 'error',
            title: '{{ $errors->first() }}'  // Show the first validation error
        });
    });
</script>
@endif

<!-- Main Content -->
<div class="row">
  <!-- Left col: Create Role -->
  <section class="col-lg-12 connectedSortable">
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Visitor Statistics (Last 7 Days)</h3>
    </div>
    <div class="card-body">
        <canvas id="visitorChart"></canvas>
    </div>
</div>

<script>
    const ctx = document.getElementById('visitorChart').getContext('2d');
    const visitorChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($dates) !!},
            datasets: [{
                label: 'Visitors',
                data: {!! json_encode($counts) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</section>


</div>






@endsection
