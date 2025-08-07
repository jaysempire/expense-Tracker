<main id="main" class="main">

  <!-- Page Title -->
  <div class="pagetitle mb-3">
    <h1>All Transactions</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active">Transactions</li>
      </ol>
    </nav>
  </div>

  <!-- Filter Card -->
  <div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
      <h5 class="card-title">Filter Transactions</h5>
      <form method="post" class="row g-3" >
        
        <!-- Transaction Type -->
        <div class="col-md-4">
          <label for="transacType" class="form-label">Transaction Type</label>
          <select class="form-select" name="type">
            <?= $web_app->createOptions_2($types, $_POST['type'] ?? '') ?>
          </select>
        </div>

        <!-- Start Date -->
        <div class="col-md-4">
          <label for="startDate" class="form-label">Start Date</label>
          <input type="date" class="form-control" name="start" value="<?= $web_app->persistData( $_POST['start'] ?? '', true, $clear )?>">
        </div>

        <!-- End Date -->
        <div class="col-md-4">
          <label for="endDate" class="form-label">End Date</label>
          <input type="date" class="form-control" name="end" value="<?= $web_app->persistData( $_POST['end'] ?? '', true, $clear )?>">
        </div>

        <!-- Submit Button -->
        <div class="col-12 d-flex justify-content-end">
          <button type="submit" name="btn_submit" class="btn btn-primary px-4">
            <i class="bi bi-funnel-fill me-1"></i> Filter
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Transactions Result Section -->
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <h5 class="card-title">Transaction Results</h5>

      <?php if (empty($transac_arr)) : ?>
        <p class="text-muted">No transactions found for the selected filters.</p>
      <?php else : ?>
        <div class="table-responsive">
          <table class="table table-hover table-bordered align-middle">
            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>Title</th>
                <th>Amount</th>
                <th>Type</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $sn = 1;
                foreach ($transac_arr as $transac) :
              ?>
              <tr>
                <td><?= $sn++ ?></td>
                <td><?= htmlspecialchars($transac['title']) ?></td>
                <td>&#8358;<?= number_format($transac['amount'], 2) ?></td>
                <td>
                  <span class="badge <?= $transac['type'] == 1 ? 'bg-success' : 'bg-danger' ?>">
                    <?= $transac['type'] == 1 ? 'Income' : 'Expense' ?>
                  </span>
                </td>
                <td><?= date('d M, Y', strtotime($transac['t_date'])) ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>
  </div>

</main>
