<main id="main" class="main">

  <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
  <div class="row gx-2 gy-3"> <!-- Reduced gutter spacing -->

    <?= $web_app->showAlert( $msg, true) ?>

    <!-- Total Balance Card -->
    <div class="col-md-4">
      <div class="card border-0 shadow rounded-3">
        <div class="card-body d-flex align-items-center justify-content-between p-3">
          <!-- Text Content -->
          <div>
            <h6 class="card-title text-muted fw-medium mb-1">Total Balance</h6>
            <h4 class="text-dark fw-bold mb-2">&#8358;<?= number_format($total)?></h4>
            <div class="d-flex align-items-center">
              <i class="bi bi-arrow-up-circle-fill text-success me-1"></i>
              <span class="text-success small">$500 this week</span>
            </div>
          </div>

          <!-- Icon -->
          <div class="bg-primary bg-opacity-10 rounded-circle p-3 ms-3">
            <i class="bi bi-wallet fs-3 text-primary"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Total Income Card -->
    <div class="col-md-4">
      <div class="card border-0 shadow rounded-3">
        <div class="card-body d-flex align-items-center justify-content-between p-3">
          
          <!-- Text Content -->
          <div>
            <h6 class="card-title text-muted fw-medium mb-1">Total Income</h6>
            <h4 class="text-success fw-bold mb-2">&#8358;<?= number_format($income)?></h4>
            <div class="d-flex align-items-center">
              <i class="<?=$icon?> <?=$color?> me-1"></i>
              <span class="<?=$color?> small"> <?=$incometext?> </span>
            </div>
          </div>

          <!-- Icon -->
          <div class="bg-success bg-opacity-10 rounded-circle p-3 ms-3">
            <i class="bi bi-arrow-up-circle fs-3 text-success"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Total Expense Card -->
    <div class="col-md-4">
      <div class="card border-0 shadow rounded-3">
        <div class="card-body d-flex align-items-center justify-content-between p-3">
          
          <!-- Text Content -->
          <div>
            <h6 class="card-title text-muted fw-medium mb-1">Total Expense</h6>
            <h4 class="text-danger fw-bold mb-2">&#8358;<?= number_format($expense)?></h4>
            <div class="d-flex align-items-center">
              <i class="<?=$e_icon?> <?=$e_color?> me-1"></i>
              <span class="<?=$e_color?> small"><?= $expensetext ?></span>
            </div>
          </div>

          <!-- Icon -->
          <div class="bg-danger bg-opacity-10 rounded-circle p-3 ms-3">
            <i class="bi bi-arrow-down-circle fs-3 text-danger"></i>
          </div>
        </div>
      </div>
    </div>

  </div>
  
  <div class="row gx-3 gy-4">
    <!-- Recent Transactions Card -->
    <div class="col-md-6">
      <div class="card h-100 shadow-sm border-0 rounded-3">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
          <h5 class="mb-0 fw-semibold text-dark">Recent Transactions</h5>
          <a href="transaction" class="btn btn-sm text-white px-3 rounded-pill opacity-75" style="background-color: #003366;">
            See More
          </a>
        </div>
        <div class="card-body" style="max-height: 350px; overflow-y: auto;">
          <ul class="list-group list-group-flush">
            <?php
              $output = '';
              foreach ($transac_arr as $transac) {
                $output .= $web_app->transacDetailCard($transac);
              }
              echo $output;
            ?>
          </ul>
        </div>
      </div>
    </div>

    <!-- Monthly Transaction Chart Card -->
    <div class="col-md-6">
      <div class="card h-100 shadow-sm border-0 rounded-3">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
          <h5 class="mb-0 fw-semibold text-dark">Monthly Transaction Trend</h5>
          <span class="text-muted small">Income vs Expense</span>
        </div>
        <div class="card-body">
          <div id="transactionTrendChart" style="min-height: 300px;"></div>

          <script>
            document.addEventListener("DOMContentLoaded", () => {
              const chartData = <?= $chartDataJson ?>;

              new ApexCharts(document.querySelector("#transactionTrendChart"), {
                chart: {
                  type: 'line',
                  height: 300,
                  toolbar: { show: false }
                },
                series: [
                  { name: 'Income', data: chartData.income },
                  { name: 'Expense', data: chartData.expense }
                ],
                colors: ['#28a745', '#dc3545'], // Green for income, red for expense
                stroke: {
                  width: 3,
                  curve: 'smooth'
                },
                markers: {
                  size: 5,
                  colors: ['#28a745', '#dc3545'],
                  strokeWidth: 2,
                  strokeColors: '#fff',
                  hover: { size: 7 }
                },
                xaxis: {
                  categories: chartData.labels,
                  labels: { rotate: -45 }
                },
                yaxis: {
                  labels: {
                    formatter: val => '₦' + val.toLocaleString()
                  }
                },
                tooltip: {
                  y: {
                    formatter: val => '₦' + val.toLocaleString()
                  }
                },
                legend: {
                  position: 'top',
                  horizontalAlign: 'right'
                }
              }).render();
            });
          </script>
        </div>
      </div>
    </div>
  </div>

</main>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
