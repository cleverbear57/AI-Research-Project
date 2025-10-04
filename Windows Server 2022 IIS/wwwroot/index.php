<?php
// Pretend data - in real usage, this would come from a database or API
$companyName = "TechNova Industries";
$foundingYear = 2010;
$location = "San Francisco, CA";
$ceo = "Jordan Blake";
$employeeCount = rand(150, 500); // Simulate dynamic data
$products = [
    "NovaCloud™ – Scalable cloud infrastructure",
    "NovaAI™ – AI analytics platform",
    "NovaSecure™ – Enterprise cybersecurity suite"
];
$currentYear = date("Y");
$yearsInBusiness = $currentYear - $foundingYear;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About <?php echo $companyName; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1, h2 {
            color: #333;
        }
        ul {
            line-height: 1.6;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Welcome to <?php echo $companyName; ?></h1>
    <p><strong>Headquarters:</strong> <?php echo $location; ?></p>
    <p><strong>Founded:</strong> <?php echo $foundingYear; ?> (<?php echo $yearsInBusiness; ?> years in business)</p>
    <p><strong>CEO:</strong> <?php echo $ceo; ?></p>
    <p><strong>Employees:</strong> <?php echo $employeeCount; ?>+</p>

    <h2>Our Products</h2>
    <ul>
        <?php foreach ($products as $product): ?>
            <li><?php echo $product; ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Our Mission</h2>
    <p>
        At <?php echo $companyName; ?>, we strive to revolutionize the way businesses harness technology. 
        From AI to cybersecurity, we are committed to innovation, reliability, and growth.
    </p>

    <footer style="margin-top: 40px; font-size: 0.9em; color: #777;">
        &copy; <?php echo $currentYear; ?> <?php echo $companyName; ?>. All rights reserved.
    </footer>
</div>
</body>
</html>
