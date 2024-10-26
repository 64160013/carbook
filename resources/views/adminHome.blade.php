@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Total Sales Card -->
                        <div class="col-md-3">
                            <div class="card text-center" style="background-color: #FFE3E3; border: none;">
                                <div class="card-body">
                                    <div class="icon mb-2">
                                        <i class="fas fa-chart-bar" style="font-size: 24px; color: #FF5A5A;"></i>
                                    </div>
                                    <h3 class="card-title">34</h3>
                                    <p class="card-text">จำนวนครั้งในการใช้รถ</p>
                                    <small class="text-muted">Last day +8%</small>
                                </div>
                            </div>
                        </div>

                        <!-- Total Order Card -->
                        <div class="col-md-3">
                            <div class="card text-center" style="background-color: #FFF3D4; border: none;">
                                <div class="card-body">
                                    <div class="icon mb-2">
                                        <i class="fas fa-file-invoice" style="font-size: 24px; color: #FFA726;"></i>
                                    </div>
                                    <h3 class="card-title">test</h3>
                                    <p class="card-text">ประเภทงาน</p>
                                    <small class="text-muted">Last day +5%</small>
                                </div>
                            </div>
                        </div>

                        <!-- Sold Card -->
                        <div class="col-md-3">
                            <div class="card text-center" style="background-color: #D4F7E2; border: none;">
                                <div class="card-body">
                                    <div class="icon mb-2">
                                        <i class="fas fa-tag" style="font-size: 24px; color: #66BB6A;"></i>
                                    </div>
                                    <h3 class="card-title">5</h3>
                                    <p class="card-text">ส่วนงาน</p>
                                    <small class="text-muted">Last day +1.2%</small>
                                </div>
                            </div>
                        </div>

                        <!-- Customers Card -->
                        <div class="col-md-3">
                            <div class="card text-center" style="background-color: #E3D4FF; border: none;">
                                <div class="card-body">
                                    <div class="icon mb-2">
                                        <i class="fas fa-users" style="font-size: 24px; color: #9C27B0;"></i>
                                    </div>
                                    <h3 class="card-title">8</h3>
                                    <p class="card-text">ผู้ขอใช้รถ</p>
                                    <small class="text-muted">Last day +0.5%</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Chart Section -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <canvas id="requestChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('requestChart').getContext('2d');
            var chartData = @json($chartData); // ส่งข้อมูลไปยัง JavaScript

            // ตรวจสอบว่ามีข้อมูลหรือไม่
            console.log(chartData);

            // จัดกลุ่มข้อมูลตาม user_id และ month
            var groupedData = {};

            chartData.forEach(function(data) {
                var key = data.user_id + '-' + data.month; // สร้างคีย์สำหรับผู้ใช้และเดือน
                if (!groupedData[key]) {
                    groupedData[key] = 0; // เริ่มต้นที่ 0
                }
                groupedData[key] += parseInt(data.total_requests); // เพิ่มค่าเป็นจำนวนเต็ม
            });

            var labels = [];
            var totalRequests = [];

            // สร้าง labels และ totalRequests จาก groupedData
            for (const key in groupedData) {
                labels.push(key.split('-')[1]); // ดึงเดือนจากคีย์
                totalRequests.push(groupedData[key]); // ดึงค่าจำนวนคำขอ
            }

            // สร้างกราฟ
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Number of Requests per User',
                        data: totalRequests,
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Month'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Total Requests'
                            }
                        }
                    }
                }
            });
        });
    </script>   

@endsection
