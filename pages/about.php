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
    <title>About Us — Students' Affairs Office, IISER</title>
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
                $breadcrumbTitle = 'About Us';
                include __DIR__ . '/../components/breadcrumb.php';
                ?>
                <h1 class="hero-title">Office of Students' Affairs</h1>
                <p class="lede hero-subtitle">Supporting Student Life at IISER Kolkata</p>
            </div>
        </section>

        <!-- ============ ABOUT CONTENT ============ -->
        <section class="about-content" style="padding: 4rem 0;">
            <div class="container about-content-wrapper">

                <!-- Right Side: Changing Images (Floated) -->
                <div class="about-images" style="position: relative; height: 400px; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                    <img class="fade-img active" loading="lazy" src="../images/Whole campus/0499_D.JPG" alt="Campus View" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; opacity: 1; transition: opacity 1s ease-in-out;">
                    <img class="fade-img" loading="lazy" src="../images/Administrative Building/0423_D.JPG" alt="Administrative Building" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0; transition: opacity 1s ease-in-out;">
                    <img class="fade-img" loading="lazy" src="../images/Hostels/0454_D.JPG" alt="Hostels" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0; transition: opacity 1s ease-in-out;">
                </div>

                <!-- Text Content -->
                <div class="about-text">
                    <?php if (!empty($content)): ?>
                        <div class="ql-editor" style="padding: 0; text-align: left;">
                            <?php echo $content; ?>
                        </div>
                    <?php else: ?>
                        <h2 style="font-size: 2.5rem; margin-bottom: 0.5rem; color: var(--text-dark, #333);">Our Mission</h2>
                        <p style="font-size: 1.1rem; line-height: 1.6; color: var(--text-muted, #666); margin-bottom: 1rem;">
                            At the Students' Affairs Office, we are dedicated to creating an environment where every student can thrive both academically and personally. We believe that a supportive and engaging campus life is essential for holistic development.
                        </p>
                        <p style="font-size: 1.1rem; line-height: 1.6; color: var(--text-muted, #666); margin-bottom: 1rem;">
                            From providing state-of-the-art facilities to fostering a vibrant community through various clubs and events, our team works tirelessly to ensure your journey at IISER Kolkata is memorable and enriching. We are your home away from home.
                        </p>
                        <p style="font-size: 1.1rem; line-height: 1.6; color: var(--text-muted, #666); margin-bottom: 1rem;">
                            Our office oversees all aspects of student accommodation, mess facilities, and campus security. We ensure that our diverse student body has access to comprehensive physical and mental healthcare, allowing you to focus completely on your scientific aspirations.
                        </p>
                        <p style="font-size: 1.1rem; line-height: 1.6; color: var(--text-muted, #666);">
                            Beyond essentials, we actively encourage participation in our robust extracurricular framework. With numerous cultural, technical, and sports clubs, the Students' Affairs Office strives to cultivate leadership, teamwork, and a spirit of innovation outside the classroom.
                        </p>
                    <?php endif; ?>
                </div>

            </div>
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