<?php
require_once __DIR__ . '/../php_utils/_dbConnect.php';

$content = '';
$query = "SELECT content FROM `about_us` ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $content = $row['content'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Map — Students' Affairs Office, IISER</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/about.css?v=<?php echo time(); ?>">

    <!-- ============ DYNAMIC CONTENT ============ -->
    <style>
        .about-content-wrapper {
            display: block;
        }

        .about-content-wrapper::after {
            content: "";
            display: table;
            clear: both;
        }

        .about-images {
            float: right;
            width: 45%;
            margin-left: 3rem;
            margin-bottom: 2rem;
        }

        @media (max-width: 768px) {
            .about-images {
                float: none;
                width: 100%;
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    <a href="#main" class="skip-link">Skip to main content</a>

    <?php include __DIR__ . '/../components/navbar.php'; ?>

    <div id="mobile-drawer-placeholder"></div>

    <main id="main">

        <!-- ============ PAGE HERO ============ -->
        <section class="page-hero about-hero">
            <div class="container page-hero-inner">
                <?php
                $breadcrumbTitle = 'Campus Map';
                include __DIR__ . '/../components/breadcrumb.php';
                ?>
                <h1 class="hero-title">Campus Map of IISER, Kolkata</h1>
                <p class="lede hero-subtitle">Find your way around the IISER Kolkata Campus</p>
            </div>
        </section>

        <!-- ============ ABOUT CONTENT ============ -->
        <section class="about-content" style="padding: 4rem 0;">
            <div class="container about-content-wrapper">

                <!-- Text Content -->
                <div class="about-text" style="width: 100%;">
                    <h2 style="margin-bottom: 2rem;">Campus Map</h2>
                    <img src="../images/Campus Map/campus-map.jpg" alt="Campus Map" style="max-width: 100%; height: auto; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                </div>

            </div>`
        </section>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const images = document.querySelectorAll('.fade-img');
                let currentIndex = 0;
                if (images.length > 0) {
                    setInterval(() => {
                        images[currentIndex].style.opacity = 0;
                        images[currentIndex].classList.remove('active');
                        currentIndex = (currentIndex + 1) % images.length;
                        images[currentIndex].style.opacity = 1;
                        images[currentIndex].classList.add('active');
                    }, 4000);
                }
            });
        </script>

    </main>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../layout/include.js"></script>
</body>

</html>