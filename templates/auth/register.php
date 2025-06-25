<?php include __DIR__ . '/../partials/header.php'; ?>
  <h1>Register</h1>
  <form method="post" action="/auth/register">
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
    <a href="/auth/google/redirect" class="btn btn-danger">Register with Google</a>
  </form>
<?php include __DIR__ . '/../partials/footer.php'; ?>
