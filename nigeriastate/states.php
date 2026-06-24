<?php
session_start();

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: login.html");
    exit;
}

$currentTheme = $_SESSION['user_theme'] ?? 'green';

include './backend/data.php';

$targetState = $_GET['name'] ?? '';

$activeRecord = null;

foreach ($statesData as $record) {
    if ($record['name'] === $targetState) {
        $activeRecord = $record;
        break; 
    }
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="<?php echo htmlspecialchars($currentTheme); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php 
        if ($activeRecord) {
            echo htmlspecialchars($activeRecord['name']) . " State Profile";
        } else {
            echo "State Profile Not Found";
        }
        ?>
    </title>
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
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            transition: background-color 0.3s ease;
        }
        
        .btn-floating-back {
            position: absolute;
            top: 2rem;
            left: 2rem;
            z-index: 10;
            background: white;
            color: var(--brand-navy);
            border-radius: 50px;
            padding: 0.5rem 1.2rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: transform 0.2s, box-shadow 0.2s, color 0.2s;
            text-decoration: none;
            font-weight: 600;
        }
        .btn-floating-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.12);
            color: var(--brand-cyan);
        }

        .dossier-wrapper {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.06), 0 1px 3px rgba(0,0,0,0.05);
            min-height: 70vh;
        }

        .panel-brand {
            background: linear-gradient(145deg, var(--brand-navy) 0%, #111111 100%);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            transition: background 0.3s ease;
        }
        .panel-brand::after {
            content: '';
            position: absolute;
            top: 0; right: 0; bottom: 0; left: 0;
            background: radial-gradient(circle at top right, rgba(255, 255, 255, 0.05), transparent 60%);
        }

        .stat-block {
            border-left: 3px solid var(--brand-cyan);
            padding-left: 1.25rem;
            margin-bottom: 2rem;
            transition: border-color 0.3s ease;
        }
        .stat-label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #888;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }
        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--brand-navy);
            line-height: 1.2;
            transition: color 0.3s ease;
        }

        .mineral-tag {
            border: 1px solid var(--brand-cyan);
            color: var(--brand-cyan);
            background: transparent;
            padding: 0.4rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: background 0.2s, color 0.3s, border-color 0.3s;
        }
        .mineral-tag:hover {
            background: rgba(0, 0, 0, 0.02);
        }
        
        .text-theme-highlight {
            color: var(--brand-cyan) !important;
            transition: color 0.3s ease;
        }
    </style>
</head>
<body class="position-relative d-flex align-items-center min-vh-100 py-5">

    <a href="index.php" class="btn-floating-back d-none d-md-inline-block">
        &larr; Overview
    </a>

    <main class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-10">
                
                <?php if ($activeRecord): ?>
                    <div class="dossier-wrapper row g-0">
                        <div class="col-lg-5 panel-brand p-5 text-center text-lg-start">
                            <div class="position-relative z-1">
                                <h6 class="text-uppercase tracking-widest opacity-75 mb-3">State Profile</h6>
                                <h1 class="display-3 fw-bold mb-4"><?php echo htmlspecialchars($activeRecord['name']); ?></h1>
                                <div class="bg-white bg-opacity-10 p-4 rounded-3 border border-light border-opacity-25 shadow-sm">
                                    <p class="fs-5 fst-italic mb-0">"<?php echo htmlspecialchars($activeRecord['slogan']); ?>"</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7 p-5 p-lg-5 bg-white">
                            
                            <a href="index.php" class="text-navy text-decoration-none fw-bold mb-4 d-inline-block d-md-none">
                                &larr; Back to Overview
                            </a>

                            <div class="row mt-lg-4">
                                <div class="col-md-6">
                                    <div class="stat-block">
                                        <div class="stat-label">Executive Governor</div>
                                        <div class="stat-value"><?php echo htmlspecialchars($activeRecord['governor']); ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="stat-block">
                                        <div class="stat-label">Total Land Mass</div>
                                        <div class="stat-value"><?php echo number_format($activeRecord['size']); ?> km&sup2;</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="stat-block">
                                        <div class="stat-label">Estimated Population</div>
                                        <div class="stat-value text-theme-highlight"><?php echo number_format($activeRecord['population']); ?></div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-5 opacity-10">

                            <h5 class="fw-bold text-navy mb-4">Natural & Mineral Resources</h5>
                            <div class="d-flex flex-wrap gap-2">
                                <?php foreach ($activeRecord['minerals'] as $mineral): ?>
                                    <span class="mineral-tag">
                                        <?php echo htmlspecialchars($mineral); ?>   
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                <?php else: ?>
                    <div class="card border-0 shadow-lg p-5 text-center bg-white rounded-4 mx-auto" style="max-width: 500px;">
                        <div class="text-danger mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-geo-alt-fill opacity-75" viewBox="0 0 16 16">
                                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                            </svg>
                        </div>
                        <h2 class="fw-bold text-navy mb-3">Territory Uncharted</h2>
                        <p class="text-muted mb-4 fs-5">We couldn't locate the data for "<strong><?php echo htmlspecialchars($targetState); ?></strong>".</p>
                        <a href="index.php" class="btn btn-cyan px-4 py-3 fw-semibold rounded-pill w-100">
                            Return to Dashboard
                        </a>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </main>

</body>
</html>