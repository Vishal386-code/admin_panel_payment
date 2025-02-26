@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container-fluid py-4">
        <p class="mb-4 text-muted fw-bold">
            Dashboard → <span class="text-primary">Admin</span>
        </p>


        <!-- Payment Summary Row -->
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card shadow-lg border-0 rounded p-4 text-center">
                    <h2 class="h5 text-gray-800">Pending Payments</h2>
                    <p class="display-4 text-warning fw-bold">{{ $pendingPayments }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card shadow-lg border-0 rounded p-4 text-center">
                    <h2 class="h5 text-gray-800">Completed Payments</h2>
                    <p class="display-4 text-success fw-bold">{{ $completePayments }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card shadow-lg border-0 rounded p-4 text-center">
                    <h2 class="h5 text-gray-800">Failed Payments</h2>
                    <p class="display-4 text-danger fw-bold">{{ $failedPayments }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card shadow-lg border-0 rounded p-4 text-center">
                    <h2 class="h5 text-gray-800">Failed Payments</h2>
                    <p class="display-4 text-danger fw-bold">{{ $failedPayments }}</p>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card shadow-lg border-0 rounded p-4">
                    <h2 class="h5 text-gray-800 text-center">Monthly Payments Chart</h2>
                    <canvas id="paymentChart" class="mt-3" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById('paymentChart').getContext('2d');

        var chartData = @json(array_values($chartData)); // Numeric values
        var chartLabels = @json(array_keys($chartData)); // Month names

        var gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(54, 162, 235, 0.6)');
        gradient.addColorStop(1, 'rgba(54, 162, 235, 0)');

        // ✅ Dynamically min/max values set karein
        var minValue = Math.min(...chartData);
        var maxValue = Math.max(...chartData);
        
        // ✅ Ensure min is not below 2000
        minValue = minValue < 2000 ? 2000 : minValue - 500; // Thoda padding de rahe hain
        maxValue = maxValue > 20000 ? maxValue + 2000 : 20000; // Ceiling 20000 ya thoda upar

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Total Payments',
                    data: chartData,
                    backgroundColor: gradient,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: false,
                        min: minValue,
                        max: maxValue,
                        ticks: {
                            stepSize: 2000 
                        }
                    }
                }
            }
        });
    });

    </script>
@endsection
