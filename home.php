<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="imgs/logo.png">
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
    <style>
        .home-feature{
            color:brown;
            border-bottom: 1px solid brown ;
        }
        .shop-feature, .about-feature{
            color: black;
        }
        .shop-feature:hover, 
        .about-feature:hover{
            color: brown;
            border-bottom: 1px solid brown ;
        }
        .slideshow-container {
    position: relative;
    margin: auto;
    width: 100%;
    min-height: 70vh;
    overflow: hidden; /* Hide overflow to prevent space between slides */
    background-color: lightgray;
    margin-bottom: 130px;
}

.slide {
    display: none;
    position: absolute;
    width: 100%;
    min-height: 70vh;
}

/* Define the animation */
@keyframes slideToLeft {
    from {
        left: 0;
    }
    to {
        left: -100%;
    }
}

@keyframes slideToRight {
    from {
        left: 0;
    }
    to {
        left: 100%;
    }
}


    </style>
</head>
<body>
    <div class="container">
        <div class="sold-div">
            <div class="space-div">
                <span class="sold">FREE SHIPPING FOR ORDERS OVER $50</span>
                <span class="icon">
                    <img src="imgs/twitter.png" alt="twitter">
                    <img src="imgs/instagram.svg" alt="instagram">
                    <img src="imgs/facebook-f.svg" alt="facebook">
                </span>
            </div>
        </div>
        <main>
            <div class="new-menu">
                <span>
                    <img src="imgs/logo.png" alt="logo">
                </span>
                <span class="features">
                    <div class="menu-item">
                        <a class="home-feature" href="home.php">Home</a>
                    </div>
                    <div class="menu-item">
                        <a class="shop-feature" href="shop.php">Shop </a>
                    </div>
                    <div class="menu-item">
                        <a class="about-feature" href="#">About</a>
                    </div>
                </span>
                <span class="new-menu-icon">
                <img src="imgs/magnifying-glass-solid.svg" alt="search">
                    <img src="imgs/bars-solid.svg" alt="bar">
                </span>
            </div>

            <!--animation div-->
            <div class="slideshow-container">
                <div class="slide slide-one">
                    <video autoplay muted loop>
                        <source src="imgs/Untitled design (1).mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div class="slide slide-two">
                    <video autoplay muted loop>
                        <source src="imgs/Add a heading (1).mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div class="slide slide-three">
                    <video autoplay muted loop>
                        <source src="imgs/Add a heading (2).mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <button class="prev" onclick="changeSlide(-1)">❮</button>
                <button class="next" onclick="changeSlide(1)">❯</button>
            </div>
            
        </main>
        <div class="authors">
            
        </div>
        <footer>
            <div>
                <span class="footer-title">Publishers</span><br>
                <a href="#">Bestsellers</a><br>
                <a href="#">Interviews</a><br>
                <a href="#">Authors Story</a> <br>
                <a href="#">Book Fairs</a> <br>
                <a href="#">Help (FAQ)</a>
            </div>
            <div>
                <span class="footer-title">Contact</span>
                <p>Stay in touch with everything ChapterOne, follow us on social media and learn about new promotions.</p>
                <span class="icon">
                    <img src="imgs/twitter.png" alt="twitter">
                    <img src="imgs/instagram.svg" alt="instagram">
                    <img src="imgs/facebook-f.svg" alt="facebook">
                </span>
            </div>
            <div>
                <span class="footer-title">News & Update</span>
                <p>We’d love it if you subscribed to our newsletter! You’ll love it too.</p>
                <input type="email" name="email" id="email" placeholder="Email...">
            </div>
            <div class="footer-container">
                <span class="footer-title">Social media</span>

                <div class="social-media">
                    <div class="row">
                        <img src="imgs/pexels-erik-mclean-7524996.jpg" alt="">
                        <img src="imgs/pexels-cottonbro-studio-7703304.jpg" alt="">
                        <img src="imgs/pexels-alina-vilchenko-1173648.jpg" alt="">
                    </div>
                    <div class="row row-two">
                        <img src="imgs/pexels-erik-mclean-7524996.jpg" alt="">
                        <img src="imgs/pexels-cottonbro-studio-7703304.jpg" alt="">
                        <img src="imgs/pexels-alina-vilchenko-1173648.jpg" alt="">
                    </div>
                </div>


            </div>
        </footer>
        <nav>© 2023 QODE INTERACTIVE, ALL RIGHTS RESERVED</nav>
    </div>

    <script>
    let slideIndex = 1;
    showSlide(slideIndex);

    let currentVideo;

    setInterval(function () {
        changeSlide(1, true);
    }, 4000);

    function changeSlide(n, fromAuto) {
        showSlide((slideIndex += n), fromAuto);
    }

    function showSlide(n, fromAuto) {
        let slides = document.getElementsByClassName("slide");

        if (n > slides.length) {
            slideIndex = 1;
        }

        if (n < 1) {
            slideIndex = slides.length;
        }

        if (fromAuto) {
            // If transitioning due to auto-change, pause the current video
            if (currentVideo) {
                currentVideo.pause();
            }
        }

        for (let i = 0; i < slides.length; i++) {
            slides[i].style.animation = "";
            slides[i].style.display = "none";
        }

        let currentSlide = slides[slideIndex - 1];
        currentSlide.style.display = "block";

        if (fromAuto) {
            // Play the video in the current slide if it exists
            let video = currentSlide.querySelector("video");
            if (video) {
                video.play();
                currentVideo = video;
            }
        }

        // Set the animation direction based on whether it's a next or prev transition
        if (fromAuto) {
            currentSlide.style.animation = "slideInRight 1s forwards";
        } else {
            if (n > 0) {
                currentSlide.style.animation = "slideInRight 1s forwards";
            } else {
                currentSlide.style.animation = "slideInLeft 1s forwards";
            }
        }
    }

    function pauseAllVideos() {
        let videos = document.getElementsByTagName("video");
        for (let i = 0; i < videos.length; i++) {
            videos[i].pause();
        }
    }
</script>



</body>
</html>
