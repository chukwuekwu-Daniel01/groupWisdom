<?php
session_start();

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: login.html");
    exit;
}

if (isset($_GET['theme'])) {
    $_SESSION['user_theme'] = $_GET['theme'];
    header("Location: index.php");
    exit;
}

$currentTheme = $_SESSION['user_theme'] ?? 'green';

include './backend/data.php';
?>
<!DOCTYPE html>
<html lang="en" data-theme="<?php echo htmlspecialchars($currentTheme); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Nigeria - Interactive Brochure</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root, [data-theme="green"] {
            --brand-bg: #FAFAFA;
            --brand-navy: #005c37;
            --brand-cyan: #008751;
        }
        [data-theme="blue"] {
            --brand-bg: #F4F7F6;
            --brand-navy: #0A2540;
            --brand-cyan: #0066CC;
        }
        [data-theme="maroon"] {
            --brand-bg: #FAFAFA;
            --brand-navy: #4A0E17;
            --brand-cyan: #800020;
        }
        body {
            background-color: var(--brand-bg);
            color: #333333;
            transition: background-color 0.3s ease;
        }
        .hero-section {
            background: linear-gradient(135deg, var(--brand-navy) 0%, #003620 100%);
            transition: background 0.3s ease;
        }
        .card-custom {
            border: none;
            border-radius: 8px;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .card-custom:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0, 135, 81, 0.15) !important;
        }
        .btn-cyan {
            background-color: var(--brand-cyan);
            color: #FFFFFF;
            border: none;
            transition: background-color 0.2s;
        }
        .btn-cyan:hover {
            filter: brightness(85%);
            color: #FFFFFF;
        }
        .text-navy {
            color: var(--brand-navy);
        }
    </style>
</head>
<body>

    <header class="hero-section text-white text-center py-5 mb-5 shadow-sm position-relative">
        
        <div class="position-absolute top-0 end-0 p-3 d-flex align-items-center gap-2">
            <div class="btn-group shadow-sm" role="group" aria-label="Theme Selection">
                <a href="index.php?theme=green" class="btn btn-sm btn-light border">Green</a>
                <a href="index.php?theme=blue" class="btn btn-sm btn-light border">Blue</a>
                <a href="index.php?theme=maroon" class="btn btn-sm btn-light border">Maroon</a>
            </div>
            <a href="./backend/logout.php" class="btn btn-outline-light btn-sm fw-bold px-3 rounded-pill shadow-sm">Logout &rarr;</a>
        </div>

        <div class="container py-3">
            <h1 class="display-4 fw-bold">Federal Republic of Nigeria</h1>
            <p class="lead opacity-75">Interactive Guide Through the 36 States & the Federal Capital Territory</p>
            <div class="mt-4 p-2 bg-white bg-opacity-10 d-inline-block rounded-3 border border-light border-opacity-25">
                <span class="fs-5 fw-medium text-light">
                    Welcome back, <strong class="text-warning"><?php echo htmlspecialchars($_SESSION['user_name']); ?></strong>
                </span>
            </div>
        </div>
    </header>

    <main class="container mb-5">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($statesData as $state): ?>
            <div class="col">
                <div class="card h-100 shadow-sm card-custom">
                    <div class="card-body d-flex flex-column">
                        <h4 class="card-title fw-bold text-navy mb-2">
                            <?php echo htmlspecialchars($state['name']); ?>
                        </h4>
                        <h6 class="card-subtitle mb-3 text-muted fst-italic">"<?php echo htmlspecialchars($state['slogan']); ?>"</h6>
                        <div class="mt-auto pt-3 border-top border-light">
                            <a href="states.php?name=<?php echo urlencode($state['name']); ?>" class="btn btn-cyan w-100 fw-semibold shadow-sm">Explore Details &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>

    <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>