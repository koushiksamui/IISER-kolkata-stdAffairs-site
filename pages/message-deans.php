<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message from the Deans — Students' Affairs Office, IISER</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/about.css">
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
                $breadcrumbTitle = 'Message from the Deans';
                include __DIR__ . '/../components/breadcrumb.php';
                ?>
                <h1 class="hero-title">Message from the DoSA</h1>
                <p class="lede hero-subtitle">Fostering excellence, well-being, and a vibrant campus life</p>
            </div>
        </section>

        <!-- ============ MESSAGE CONTENT ============ -->
        <section class="section" style="padding: 4rem 0;">
            <div class="container">

                <!-- Dean Message Layout -->
                <div class="dean-message-layout">

                    <!-- DOSA Profile -->
                    <div class="dean-card">
                        <div class="dean-photo">
                            <img src="../images/Deans/DOSA.jpg" alt="Dean of Students' Affairs (DOSA)">
                        </div>
                        <div class="dean-info">
                            <h3 style="color: var(--navy-900); font-weight: 700;">Prof. Koushik Dutta</h3>
                            <p style="color: var(--gold-600); font-weight: 600; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.05em;">Dean of Students' Affairs (DOSA)</p>

                            <div class="dean-contact">
                                <p><i class="fa-solid fa-phone"></i> +91 33 6136 0000 Extn: 1353</p>
                                <p><i class="fa-solid fa-envelope"></i> koushik [at] iiserkol.ac.in</p>
                            </div>
                        </div>
                    </div>

                    <!-- Message Text -->
                    <div class="deans-message-text about-text">
                        <h2>Message</h2>
                        <p style="text-align: justify;">Many congratulations and a warm welcome to IISER Kolkata! We are confident that your journey here will be enriching, memorable, and full of lifelong friendships. IISER Kolkata will offer you not only academic training and research exposure, but also opportunities for personal growth, community life, and exploration beyond the classroom. The Office of the Dean, Academic Affairs, also known as the Academic Cell, looks after all academic matters of the Institute, from admission to the awarding of degrees. For academic issues, BS-MS students may contact the Institute UGAC Convenor, IPhD students may contact the departmental UGAC Convenor, and PhD students may contact the departmental PGAC Convenor. Students may also approach the General Secretaries, Academic, of the Students’ Affairs Council for help in presenting academic concerns. The Office of the Dean of Students’ Affairs, through the Students’ Affairs Section, is committed to student welfare, hostel life, campus activities, and overall well-being. It acts as a liaison between students, faculty members, and the administration, and serves as a central point of contact for student-related support, campus resources, and policy-related queries.</p>
                    </div>

                </div>

            </div>
        </section>

    </main>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../layout/include.js"></script>

    <script>
        // Active tab setting if needed (e.g. for navigation)
        // No ajax needed anymore for this page.
    </script>

    <style>
        .dean-message-layout {
            display: flex;
            gap: 4rem;
            align-items: flex-start;
        }

        .dean-card {
            flex-shrink: 0;
            text-align: left;
            width: 320px;
        }

        .dean-photo {
            aspect-ratio: 544 / 433;
            overflow: hidden;
            margin-bottom: 16px;
            border-radius: var(--radius-md);
        }

        .dean-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;
            display: block;
        }

        .dean-info {
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .dean-contact {
            margin-top: 1rem;
            display: flex;
            flex-direction: column;
            gap: 8px;
            border-top: 1px solid var(--grey-200, #eee);
            padding-top: 1rem;
        }

        .dean-contact p {
            color: var(--grey-600);
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
            line-height: 1.4;
        }

        .dean-contact i {
            color: var(--gold-500);
            font-size: 1rem;
            width: 16px;
            text-align: center;
        }

        .deans-message-text {
            flex-grow: 1;
            margin: 0;
            text-align: left;
        }

        @media (max-width: 900px) {
            .dean-message-layout {
                flex-direction: column;
                gap: 2rem;
            }
        }
    </style>

</body>

</html>