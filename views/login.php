<main class="d-flex align-items-center justify-content-center min-vh-100 bg-light">
  <div class="card shadow border-0 p-4" style="max-width: 420px; width: 100%; border-radius: 16px;">
    
    <!-- Logo / Title -->
    <div class="text-center mb-4">
      <a href="index.php" class="text-decoration-none fs-4 fw-bold auth-card">
        Expense Tracker
      </a>
    </div>

    <!-- Tab Navigation -->
     <ul class="nav nav-tabs nav-fill small mb-3" id="authTab" role="tablist">
        <li class="nav-item">
          <button class="nav-link active" name="login" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab">Login</button>
        </li>
        <li class="nav-item">
          <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab">Register</button>
        </li>
      </ul>
    <div class="tab-content" id="authTabContent">

      <!-- Login Form -->
      <div class="tab-pane fade show active" id="login" role="tabpanel">
        <h6 class="text-center mb-3 text-secondary">Login to Your Account</h6>

        <?= $web_app->showAlert($msg) ?>

        <form method="POST" class="needs-validation" novalidate>
          <div class="mb-3">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
            <div class="invalid-feedback">Enter your username</div>
          </div>
          <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <div class="invalid-feedback">Enter your password</div>
          </div>
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
              <label class="form-check-label small" for="rememberMe">Remember me</label>
            </div>
            <a href="#" class="small text-decoration-none">Forgot password?</a>
          </div>
          <div class="text-center">
            <button class="btn btn-success" type="submit" name="btn_login">Register</button>
          </div>
        </form>
      </div>

      <!-- Registration Form -->
      <div class="tab-pane fade" id="register" role="tabpanel">
        <h6 class="text-center mb-3 text-secondary">Create an Account</h6>

        <form method="POST" class="needs-validation" novalidate>
          <div class="mb-3">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
            <div class="invalid-feedback">Enter a username</div>
          </div>
          <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
            <div class="invalid-feedback">Enter a valid email</div>
          </div>
          <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <div class="invalid-feedback">Enter a password</div>
          </div>
          <div class="mb-3">
            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
            <div class="invalid-feedback">Confirm your password</div>
          </div>
          <div class="form-check small mb-3">
            <input class="form-check-input" type="checkbox" id="termsCheck" required>
            <label class="form-check-label" for="termsCheck">
              I agree to the terms
            </label>
          </div>
          <div class="text-center">
            <button class="btn btn-success" type="submit" name="btn_register">Register</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</main>
