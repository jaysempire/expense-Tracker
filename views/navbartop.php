<header id="header" class="header fixed-top d-flex align-items-center" style="background-color: #ffffff; color: #003366; font-family: 'Poppins', sans-serif;">
  <div class="d-flex align-items-center justify-content-between w-100 px-3">

    <!-- Logo -->
    <a href="dashboard" class="logo d-flex align-items-center">
      <span class="d-none d-lg-block" style="color: #003366;">Expense Tracker</span>
    </a>

    <!-- Sidebar Toggle -->
    <i class="bi bi-list toggle-sidebar-btn ms-3" style="color: #003366; cursor: pointer;"></i>

    <!-- Add Transaction Button -->
    <button type="button" class="btn btn-light btn-sm ms-auto" data-bs-toggle="modal" data-bs-target="#addTransactionModal" style="background-color: #003366; color: #ffffff; font-family: 'Poppins', sans-serif;">
      <i class="bi bi-plus-circle me-1"></i> Add Transaction
    </button>
  </div>
</header>

  <!-- Add Transaction Modal -->
<div class="modal fade" id="addTransactionModal" tabindex="-1" aria-labelledby="addTransactionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="addTransactionModalLabel">
            <i class="fas fa-receipt me-2"></i>Add New Transaction
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-4">
            <label for="transactionTitle" class="form-label">
              <i class="fas fa-heading"></i> Transaction Title
            </label>
            <input type="text" class="form-control" id="transactionTitle" name="transac_title" required
              placeholder="e.g., Salary, Groceries, Rent Payment">
          </div>

          <div class="mb-4">
            <label for="transactionAmount" class="form-label">
              <i class="fas fa-money-bill-wave"></i> Amount
            </label>
            <div class="input-group">
              <span class="input-group-text">₦</span>
              <input type="number" step="0.01" class="form-control amount-input" 
                name="transac_amount" placeholder="0.00">
            </div>
          </div>

          <div class="mb-4">
            <label for="transactionType" class="form-label">
              <i class="fas fa-exchange-alt"></i> Transaction Type
            </label>
            <select class="form-select" id="transactionType" name="transac_type" required>
              <option value="">-- Select Transaction Type --</option>
              <option value="1">Income</option>
              <option value="0">Expense</option>
            </select>
          </div>

          <div class="mb-4">
            <label for="transactionDate" class="form-label">
              <i class="fas fa-calendar-day"></i> Date
            </label>
            <div class="position-relative">
              <input type="date" class="form-control" id="transactionDate" name="transac_date" required>
              <span class="input-icon"><i class="fas fa-calendar-alt"></i></span>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" name="submit_btn" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i>Add Transaction
          </button>
        </div>
      </form>
    </div>
  </div>
</div>



