<?php
mysqli_report(MYSQLI_REPORT_OFF);

$conn = @mysqli_connect('127.0.0.1:3999', 'root', '', 'register');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>DB Down Simulation</title>
    <style>
      body { font-family: Arial, sans-serif; padding: 32px; }
      .ok { color: #116611; }
      .error { color: #aa2222; font-weight: 700; }
    </style>
  </head>
  <body>
    <h1>Database Failure Simulation</h1>
    <?php if ($conn): ?>
      <p class="ok">Unexpectedly connected.</p>
    <?php else: ?>
      <p class="error">Connection failed: simulated database server is unavailable.</p>
    <?php endif; ?>
  </body>
</html>
