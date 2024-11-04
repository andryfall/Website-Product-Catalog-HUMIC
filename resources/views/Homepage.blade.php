<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Catalog HUMIC</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dearflip/dist/dearflip.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        /* Navbar */
        .custom-navbar {
            background-color: #fff;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.5);
            position: sticky;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .nav-item {
            padding-right: 48px;
        }

        .navbar-text {
            color: #000000;
            font-size: 18px;
            font-weight: 600;
        }



        .nav-text:hover {
            color: #ff0000;
        }

        .nav-text.active {
            color: #ff0000;
        }


        .navbar-brand img {
            width: 221px;
            height: auto;
            padding-left: 48px;
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            min-height: 100vh;
            overflow: hidden;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 20px;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{url('/images/Hero.png')}}');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            z-index: 0;
        }

        .hero-title-white {
            color: #fff;
            font-size: 100px;
        }

        .hero-title-red {
            color: #c5181f;
            font-size: 100px;
        }

        .hero-title-catalog {
            font-size: 70px;
        }

        .hero-description {
            font-size: 30px;
            color: #fff;
            margin: 30px 0;
            max-width: 500px;
        }

        .hero-button {
            display: inline-block;
            padding: 18px 36px;
            background-color: #c5181f;
            color: #fff;
            font-size: 24px;
            text-transform: uppercase;
            border: none;
            border-radius: 30px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .hero-button:hover {
            background-color: #a41518;
        }

        .hero-left {
            max-width: 700px;
            text-align: left;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* About Us Section */
        .about-section {
            padding: 120px 20px;
            background-image: url('{{url('/images/bg-about.png')}}');
            background-size: cover;
            background-position: center;
            color: #fff;
        }

        .about-content {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
        }

        .about-image {
            flex: 0 0 35%;
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        .about-text {
            flex: 1;
            padding-left: 60px;
            text-align: left;
        }

        .about-title {
            font-size: 50px;
            text-align: center;
            margin-bottom: 40px;
        }

        .about-description {
            font-size: 24px;
            text-align: justify;
        }

        .about-button {
            display: inline-block;
            padding: 18px 36px;
            background-color: #fff;
            color: #c5181f;
            font-size: 22px;
            font-weight: 600;
            text-transform: uppercase;
            border: none;
            border-radius: 15px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        .about-button:hover {
            background-color: #bb9899;
        }

        /* Focused Section */
        .focused-section {
            padding: 60px 20px;
            background-color: #fff;
        }

        .focused-title {
            font-size: 50px;
            text-align: center;
            color: #c5181f;
            margin-bottom: 40px;
        }

        .focused-card {
            border: none;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 30px;
        }

        .card-image {
            width: 100%;
            height: 250px;
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            margin-bottom: 20px;
        }

        .focused-card h5 {
            font-size: 24px;
            color: #c5181f;
            margin-bottom: 20px;
        }

        .focused-card p {
            font-size: 18px;
            color: #555;
            font-weight: 500;
        }

        /* Catalog Section */
        .catalog-section {
        padding: 180px 20px;
        background-color: #b4262a;
        background-size: cover;
        background-position: center;
        }

        .catalog-title {
            font-size: 50px;
            text-align: center;
            color: #fff;
            margin-bottom: 120px;
        }

        .catalog-card {
            background-image: url('{{url('/images/bg-product.png')}}');
            background-size: cover;
            background-position: center;
            border: none;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            width: 100%;
            max-width: 400px;
            margin: 80px auto;
            position: relative;
            transition: transform 0.3s ease, background 0.3s ease;
            height: 500px;
            overflow: hidden;
        }

        .catalog-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 10px;
            z-index: 0;
        }

        .catalog-card:hover::before {
            opacity: 1;
        }

        .card-image-circular {
            width: 250px;
            height: 250px;
            border-radius: 50%;
            background-color: #fff;
            margin: 0 auto;
            margin-bottom: 20px;
            background-size: cover;
            background-position: center;
            transition: width 0.3s ease, height 0.3s ease;
            z-index: 1;
            position: relative;
        }

        .catalog-product-name {
            font-size: 30px;
            font-weight: bold;
            color: #ffffff;
            transition: font-size 0.3s ease, opacity 0.3s ease;
            z-index: 1;
            position: relative;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            letter-spacing: 1px;
        }


        .hovered-items {
            position: relative;
            z-index: 1;
        }

        .catalog-product-description,
        .catalog-button {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease, font-size 0.3s ease;
        }

        .catalog-card:hover .catalog-product-name {
            font-size: 18px;
            margin-top: 10px;
        }

        .catalog-card:hover .card-image-circular {
            width: 100px;
            height: 100px;
        }

        .catalog-card:hover .catalog-product-description,
        .catalog-card:hover .catalog-button {
            opacity: 1;
            visibility: visible;
        }

        .catalog-product-description {
            font-weight: 500;
            font-size: 18px;
            color: #ffffff;
            margin-top: 40px;
        }

        .catalog-button {
            display: inline-block;
            padding: 8px 16px;
            background-color: #ffffff;
            color: #000000;
            font-size: 14px;
            text-transform: uppercase;
            font-weight: 500;
            border: none;
            border-radius: 15px;
            text-decoration: none;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        .catalog-button:hover {
            background-color: #e0cbcc;
        }

        .catalog-swiper-container {
            overflow: hidden;
        }

        .catalog-swiper-pagination {
            bottom: 10px;
            text-align: center;
        }

        .catalog-swiper-next, .catalog-swiper-prev {
            color: #fff;
            width: 40px;
            height: 40px;
        }

        .catalog-swiper-next {
            right: 10px;
        }

        .catalog-swiper-prev {
            left: 10px;
        }

        .catalog-swiper-pagination .swiper-pagination-bullet-active {
            background-color: white;
            opacity: 1;
        }

        @media (max-width: 768px) {
            .catalog-swiper-pagination {
                bottom: 8px;
            }

            .catalog-swiper-next, .catalog-swiper-prev {
                width: 30px;
                height: 30px;
            }

            .catalog-swiper-next {
                visibility: hidden;
            }

            .catalog-swiper-prev {
                visibility: hidden;
            }
        }

        @media (max-width: 480px) {
            .catalog-swiper-pagination {
                bottom: 5px;
            }

            .catalog-swiper-next, .catalog-swiper-prev {
                width: 25px;
                height: 25px;
            }

            .catalog-swiper-next {
                visibility: hidden;
            }

            .catalog-swiper-prev {
                visibility: hidden;
            }

            .catalog-swiper-pagination .swiper-pagination-bullet {
                width: 6px;
                height: 6px;
            }
        }




        .loader {
            text-align: center;
            font-size: 24px;
            color: #ffffff;
            margin: 20px 0;
            font-weight: bold;
        }

        /* Footer */
        .footer {
            background-color: #333;
            padding: 40px 20px;
            text-align: center;
            color: #fff;
        }

        @media (max-width: 1200px) {
            .hero-title {
                font-size: 80px;
            }

            .hero-title-red {
                font-size: 80px;
            }

            .hero-title-catalog {
                font-size: 60px;
            }

            .about-title {
                font-size: 40px;
            }

            .catalog-card {
                width: 350px;
            }
        }

        @media (max-width: 992px) {
            .nav-item {
                padding-right: 24px;
            }

            .navbar-brand img {
                width: 180px;
                padding-left: 24px;
            }

            .hero-title {
                font-size: 70px;
            }

            .hero-title-red {
                font-size: 70px;
            }

            .hero-title-catalog {
                font-size: 50px;
            }

            .hero-description {
                font-size: 24px;
            }

            .hero-button {
                font-size: 20px;
                padding: 14px 28px;
            }

            .about-title {
                font-size: 35px;
            }

            .about-description {
                font-size: 20px;
            }

            .catalog-title {
                font-size: 40px;
                margin-bottom: 80px;
            }

            .catalog-card {
                width: 300px;
                margin: 60px auto;
            }
        }

        @media (max-width: 768px) {
            .nav-item {
                padding-right: 16px;
            }

            .navbar-brand img {
                width: 150px;
                padding-left: 16px;
            }

            .hero-title {
                font-size: 60px;
            }

            .hero-title-red {
                font-size: 60px;
            }

            .hero-title-catalog {
                font-size: 40px;
            }

            .hero-description {
                font-size: 20px;
                margin: 20px 0;
            }

            .hero-button {
                font-size: 18px;
                padding: 12px 24px;
            }

            .about-content {
                flex-direction: column;
                text-align: center;
            }

            .about-text {
                padding-left: 0;
            }

            .about-title {
                text-align: center;
            }

            .catalog-title {
                font-size: 35px;
                margin-bottom: 60px;
            }

            .catalog-card {
                width: 100%;
                max-width: 350px;
                border-radius: 20px 20px 10px 10px;
                margin: 40px auto;
            }
        }

        @media (max-width: 576px) {
            .nav-item {
                padding-right: 12px;
            }

            .navbar-brand img {
                width: 120px;
                padding-left: 12px;
            }

            .hero-title {
                font-size: 40px;
            }

            .hero-title-red {
                font-size: 40px;
            }

            .hero-title-catalog {
                font-size: 30px;
            }

            .hero-description {
                font-size: 18px;
                margin: 15px 0;
            }

            .hero-button {
                font-size: 16px;
                padding: 10px 20px;
            }

            .about-title {
                font-size: 30px;
            }

            .about-description {
                font-size: 18px;
            }

            .focused-title {
                font-size: 40px;
                margin-bottom: 30px;
            }

            .focused-card {
                margin-bottom: 20px;
            }

            .catalog-title {
                font-size: 30px;
                margin-bottom: 40px;
            }

            .catalog-card {
                width: 100%;
                max-width: 300px;
                border-radius: 15px 15px 10px 10px;
                margin: 30px auto;
            }

            .catalog-product-name {
                font-size: 18px;
            }

            .catalog-product-description {
                font-size: 14px;
            }

            .catalog-button {
                font-size: 16px;
                padding: 10px 20px;
            }
        }

        .footer {
            background-color: #333;
            color: #fff;
            padding: 40px 20px;
            width: 100%;
        }

        .footer-container {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-logo {
            flex: 1 1 200px;
            margin-bottom: 20px;
        }

        .footer-logo img {
            width: 150px;
            height: auto;
        }

        .footer-text {
            flex: 2 1 300px;
            margin-bottom: 20px;
            text-align: left;
        }

        .footer-text h3 {
            color: #c5181f;
            font-size: 26px;
            margin-bottom: 10px;
        }

        .footer-text p {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .footer-social {
            padding-top: 48px;
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            gap: 10px;
        }

        .footer-social a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            font-size: 14px;
            position: relative;
        }

        .footer-social a i {
            color: white;
            background-color: #c5181f;
            border-radius: 50%;
            padding: 10px;
            font-size: 18px;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }

        .footer-social a:hover i {
            background-color: #a11215;
        }

        .footer-bottom {
            text-align: center;
            font-size: 20px;
            margin-top: 20px;
            color: #c5181f;
            text-transform: uppercase;
        }

        .footer-bottom a {
            color: #c5181f;
            text-decoration: none;
        }

        .footer-bottom a:hover {
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .footer-logo img {
                width: 120px;
            }

            .footer-text h3 {
                font-size: 22px;
            }

            .footer-text p {
                font-size: 14px;
            }

            .footer-social {
                flex-direction: column;
                align-items: flex-start;
            }

            .footer-social a {
                font-size: 12px;
                margin-bottom: 5px; 
            }

            .footer-social a i {
                font-size: 16px;
            }
        }



    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{url('/images/logo-humic-text.png')}}" alt="Brand Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link navbar-text" href="#hero">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-text" href="#catalog">CATALOG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-text" href="#footer">CONTACT US</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="hero" class="hero-section">
        <div class="hero-background"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="hero-left">
                <h1 class="hero-title">
                    <span class="hero-title-white">RC</span>
                    <span class="hero-title-red">HUMIC</span><br>
                    <span class="hero-title-catalog">CATALOG</span>
                </h1>
                <p class="hero-description">Research Center Humic</p>
                <a href="#about" class="hero-button">Learn More</a>
            </div>
        </div>
    </section>

    <section id="about" class="about-section">
        <div class="about-content">
            <img src="{{url('/images/gambar-about.png')}}" alt="About Us Image" class="about-image">
            <div class="about-text">
                <h2 class="about-title">RC HUMIC</h2>
                <p class="about-description">HUMIC research center focuses on technology engineering that relates to human daily
                    activities support. We are interested in the development of wearable devices and sensors that are
                    integrated with the human body. In the science field, we are also interested in collecting
                    data and information about human body activities. From the data and information, we could use the Big Data concept to create knowledge and accurate information.</p>
                <a href="#catalog" class="about-button">See Catalog</a>
            </div>
        </div>
    </section>
    

    <section id="focused" class="focused-section">
        <h2 class="focused-title">RC HUMIC Focused</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="focused-card">
                    <div class="card-image" style="background-image: url('{{url('/images/focused1.png')}}');"></div>
                    <h5>Devices & Sensors</h5>
                    <p>Engineering using devices and sensors to support human daily activities.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="focused-card">
                    <div class="card-image" style="background-image: url('{{url('/images/focused2.png')}}');"></div>
                    <h5>Internet of Things (IoT)</h5>
                    <p>Engineering using devices and sensors to support human daily activities.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="focused-card">
                    <div class="card-image" style="background-image: url('{{url('/images/focused3.png')}}');"></div>
                    <h5>Big Data</h5>
                    <p>Engineering using devices and sensors to support human daily activities.</p>
                </div>
            </div>
        </div>
    </section>
    
    

    <section id="catalog" class="catalog-section">
        <h2 class="catalog-title">RC HUMIC CATALOG</h2>
    
        <div class="swiper catalog-swiper-container">
            <div class="swiper-wrapper " id="product-list">
                @foreach($catalogs as $catalog)
                    <div class="swiper-slide">
                        <div class="catalog-card">
                            <div class="card-image-circular" style="background-image: url('{{ $catalog['image'] }}');"></div>
                            <h5 class="catalog-product-name">{{ $catalog['name'] }}</h5>
                            <div class="hovered-items">
                                <p class="catalog-product-description">{{ $catalog['description'] }}</p>
                                <a href="{{ $catalog['pdf'] }}" class="catalog-button" target="_blank">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    
            <div class="swiper-pagination catalog-swiper-pagination"></div>
            <div class="swiper-button-next catalog-swiper-next"></div>
            <div class="swiper-button-prev catalog-swiper-prev"></div>
        </div>
    </section>

    
    
    
    
<!-- Footer -->
<footer id="footer" class="footer">
    <div class="footer-container">

        <div class="footer-logo">
            <img src="{{url('/images/logo-humic.png')}}" alt="HUMIC Logo">
        </div>

        <div class="footer-text">
            <h3>HUMIC ENGINEERING</h3>
            <p>HUMIC - Human Centric Engineering Research Center</p>
            <p>Jl. Telekomunikasi Terussan Buah Batu, Bandung Jawa Barat, Indonesia, 40257</p>
            <div class="footer-social">
                <a href="mailto:humic@telkomuniversity.ac.id">
                    <i class="fas fa-envelope"></i> humic@telkomuniversity.ac.id
                </a>
                <a href="https://humic.telkomuniversity.ac.id" target="_blank">
                    <i class="fas fa-globe"></i> humic.telkomuniversity.ac.id
                </a>
                <a href="https://instagram.com/humicengineering" target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://facebook.com/humicengineering" target="_blank">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="https://linkedin.com/in/humicengineering" target="_blank">
                    <i class="fab fa-linkedin"></i> humicengineering
                </a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <a href="https://humic.telkomuniversity.ac.id" class="footer-link">© 2024 HUMIC Research Center</a>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/dearflip/dist/dearflip.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const swiper = new Swiper('.catalog-swiper-container', {
                slidesPerView: 2,
                spaceBetween: 20,
                pagination: {
                    el: '.catalog-swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.catalog-swiper-next',
                    prevEl: '.catalog-swiper-prev',
                },
                loop: true,
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                    },
                    0: { 
                        slidesPerView: 1,
                    }
                }
            });
        });
    </script>
    
    
    
    
    
    
    
    
</body>

</html>
