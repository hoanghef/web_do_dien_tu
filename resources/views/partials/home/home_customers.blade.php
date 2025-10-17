<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ElectroShop - Linh kiện PC chất lượng cao</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: "Poppins", sans-serif;
            background-color: #0d0d0d;
            color: #fff;
            overflow-x: hidden;
        }
        a { text-decoration: none; }

        /* HERO SECTION */
        #hero {
            position: relative;
            width: 100%;
            height: 95vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        #hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('{{ asset("storage/home/logo.jpg") }}') center/cover no-repeat;
            filter: brightness(0.35) blur(6px);
            z-index: 1;
        }
        #hero .container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 1200px;
            padding: 0 30px;
        }

        .swiper-container {
            width: 100%;
            height: 100%;
        }
        .swiper-wrapper {
            height: 100%;
        }
        .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
            flex-wrap: wrap; /* vẫn cho wrap để mobile */
            height: 100%;
        }
        .swiper-slide .content {
            flex: 1 1 50%;
            min-width: 300px;
            animation: fadeInUp 1.2s ease;
        }
        .swiper-slide h1 {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.3;
        }
        .swiper-slide p {
            color: #dcdcdc;
            font-size: 1.05rem;
            margin-bottom: 30px;
            line-height: 1.7;
        }

        .btn-get-started {
            display: inline-block;
            background: linear-gradient(90deg, #ff2e2e, #b00000);
            color: #fff;
            padding: 13px 34px;
            border-radius: 30px;
            font-weight: 600;
            letter-spacing: 0.3px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(255, 0, 0, 0.3);
        }
        .btn-get-started:hover {
            transform: translateY(-3px);
            background: linear-gradient(90deg, #b00000, #ff2e2e);
            box-shadow: 0 6px 16px rgba(255, 0, 0, 0.4);
        }

        .hero-img {
            flex: 1 1 40%;
            min-width: 250px;
            display: flex;
            justify-content: center;
        }
        .hero-img img {
            max-width: 350px;
            width: 100%;
            height: auto;
            border-radius: 16px;
            box-shadow: 0 6px 25px rgba(255, 50, 50, 0.35);
            transition: transform 0.5s ease;
            display: block;
        }
        .hero-img img:hover {
            transform: scale(1.05);
        }

        .swiper-pagination {
            position: absolute;
            bottom: 25px;
            width: 100%;
            text-align: center;
            z-index: 3;
        }
        .swiper-pagination-bullet {
            background: #fff;
            opacity: 0.6;
            width: 12px;
            height: 12px;
            margin: 0 6px !important;
            transition: 0.3s;
        }
        .swiper-pagination-bullet-active {
            background: #ff2e2e;
            opacity: 1;
            transform: scale(1.3);
        }

        @media (max-width: 768px) {
            .swiper-slide {
                flex-direction: column;
                text-align: center;
            }
            .hero-img img {
                width: 85%;
                margin-top: 25px;
            }
            .swiper-slide h1 {
                font-size: 2rem;
            }
        }

        @keyframes fadeInUp {
            from {opacity: 0; transform: translateY(30px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>
<section id="hero">
    <div class="container">
        <div class="swiper-container">
            <div class="swiper-wrapper">

                <!-- SLIDE 1 -->
                <div class="swiper-slide">
                    <div class="content">
                        <h1>Khám phá thế giới linh kiện PC</h1>
                        <p>ElectroShop mang đến card đồ họa, RAM, mainboard, SSD và PSU chính hãng — hiệu năng cao, giá cạnh tranh.</p>
                        <a href="{{ url('/product') }}" class="btn-get-started">Xem sản phẩm</a>
                    </div>
                    <div class="hero-img">
                        <img src="{{ 'storage/home/123.jpg' }}" class="img-fluid" alt="Linh kiện PC" />
                    </div>
                </div>

                <!-- SLIDE 2 -->
                <div class="swiper-slide">
                    <div class="content">
                        <h1>Tối ưu sức mạnh cho hệ thống của bạn</h1>
                        <p>Từ card RTX mạnh mẽ đến RAM DDR5 tốc độ cao, ElectroShop giúp bạn xây dựng dàn máy mơ ước.</p>
                        <a href="{{ url('/product') }}" class="btn-get-started">Khám phá ngay</a>
                    </div>
                    <div class="hero-img">
                        <img src="{{ 'storage/home/1234.jpg' }}" class="img-fluid" alt="Linh kiện PC" />
                    </div>
                </div>

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 0,
        centeredSlides: true,
        autoplay: { delay: 4000, disableOnInteraction: false },
        pagination: { el: '.swiper-pagination', clickable: true },
        effect: 'fade',
        fadeEffect: { crossFade: true }
    });
</script>
</body>
</html>
