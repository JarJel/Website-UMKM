<?php
// Ambil IP lokal laptop
$ip = getHostByName(getHostName());

// Nama folder & file project
$projectPath = "/Landing-Page-CendikiaMuda/LandingPage/SD-LandingPage.php";

// Buat URL lengkap
$url = "http://" . $ip . $projectPath;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Akses dari HP</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      padding: 30px;
      text-align: center;
    }
    a {
      display: inline-block;
      padding: 12px 20px;
      background: #007bff;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <h1>✅ Link Akses HP</h1>
  <p>Pastikan HP & laptop ada di jaringan WiFi yang sama</p>
  <p><strong>IP Laptop:</strong> <?php echo $ip; ?></p>
  <a href="<?php echo $url; ?>" target="_blank">
    <?php echo $url; ?>
  </a>
</body>
</html>
