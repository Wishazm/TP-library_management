<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css">
    <style>
        .shop-feature{
            color: brown;
            border-bottom: 1px solid brown;
        }
        .home-feature,.about-feature{
            color: black;
        }
        .about-feature:hover{
            color: brown;
            border-bottom: 1px solid brown;
        } 
        .home-feature:hover{
            color: brown;
            border-bottom: 1px solid brown;
        } 
        .shop-categories-container > a:nth-child(6){
            color: brown;
            text-decoration: underline;
            font-weight: 500;
        }
       
    </style>
    <link rel="icon" href="imgs/logo.png">
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
                        <a class="about-feature" href="#">About </a>
                    </div>
                </span>
                
                <span class="new-menu-icon">
                    <img src="imgs/magnifying-glass-solid.svg" alt="search">
                    <a href="#" class="openSidebar"><img src="imgs/bars-solid.svg" alt="bar"></a>
                </span>
                    
            </div>
        </main>
        <div class="shop-img-div">
            <img src="imgs/shop.jpg" alt="shop-img" class="shop-img">
            <div class=" parag">PRODUCTS</div>
            <div class="text">History</div>
        </div>
        <main class="shop-main">
            <div class="shop-books">
                <select >
                    <option disabled selected>Sort By ...</option>
                    <option>Sort By Price: Low To High</option>
                    <option>Sort By Price: High To Low</option>
                </select>

                

                <!---select from the database-->
                <div class="books-container">
                    <ul class="book-list">
                    <?php
                        $host = "localhost";
                        $username = "root";
                        $password = "1234";
                        $database = "library";

                        $conn = new mysqli($host, $username, $password, $database);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $itemsPerPage = 12;
                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $offset = ($page - 1) * $itemsPerPage;

                        $sql = "SELECT * FROM bookslist WHERE category = 'history' LIMIT $offset, $itemsPerPage";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo '<ul class="books-container">';
                            while ($row = $result->fetch_assoc()) {
                                echo '<li class="book-item">';
                                echo '<a  href="book.php?id=' . $row['id'] . '">';
                                echo '<img src="' . $row['bookimage'] . '" alt="' . '">';
                                echo '</a>';
                                echo '<div class="book-link">';
                                echo '</div>';
                               
                                echo '<p>' . $row['author'] . '</p>';
                                echo '<h3>' . $row['bookname'] . '</h3>';
                                echo '<span>' . $row['price'] . '</span>';
                                
                                
                                echo '</li>';
                            }
                            echo '</ul>';
                        
                            $prevPage = $page - 1;
                            $nextPage = $page + 1;
                        
                            echo '<div class="pagination">';
                            if ($prevPage > 0) {
                                echo '<a href="?page=' . $prevPage . '">Previous</a>';
                            }
                        
                            if ($result->num_rows >= $itemsPerPage) {
                                echo '<a href="?page=' . $nextPage . '">Next</a>';
                            }
                            echo '</div>';
                        } 
                        else {
                            echo "No books found in the database.";
                        }
                        
                        $conn->close();
                        ?>
                    </ul>
                </div>


            </div>
            <div class="shop-filter">
                <input type="search" name="search" id="search" placeholder="Search"><br>
                <span>Filter by price</span>
                <div class="slider-container">
                    <div class="price-range">
                        <div class="slider min-slider"></div>
                        <div class="slider max-slider"></div>
                    </div>
                    <p class="selected-price">Price: 0dh &#9148; 400dh</p><span><button></button></span>
                </div>
                <!--lines+logo-->
                <div class="lines">
                    <div class="line-1"></div>
                    <img src="imgs/logo.png" alt="">
                    <div class="line-1"></div>
                </div>
                <!--categories-->
                <div class="shop-categories">
                    <span>Categories</span>
                    <div class="shop-categories-container">
                        <a  href="drama.php">DRAMA</a> 
                        <a href="fantasy.php">FANTASY</a>
                        <a href="action.php">ACTION</a>
                        <a href="art.php">ART</a>
                        <a href="design.php">DESIGN</a>
                        <a href="history.php">HISTORY</a>
                    </div>
                </div>
                <!--lines+logo-->
                <div class="lines">
                    <div class="line-1"></div>
                    <img src="imgs/logo.png" alt="">
                    <div class="line-1"></div>
                </div>
                <div class="tags-div">
                    <span>Tags</span>
                    <div class="tags-content">
                        <a href="#">Adventure, </a>
                        <a href="#">Besrseller, </a>
                        <a href="#">Biography, </a>
                        <a href="#">Design, </a>
                        <a href="#">Fiction, </a>
                        <a href="#">New, </a>
                        <a href="#">Novel, </a>
                        <a href="#">Pulitzer,</a>
                    </div>
                </div>
                <!--lines+logo-->
                <div class="lines">
                    <div class="line-1"></div>
                    <img src="imgs/logo.png" alt="">
                    <div class="line-1"></div>
                </div>
                <!--instagram-->
                <div class="instagram-div">
                    <span>Instagram</span>
                    <div class="instagram-imgs">
                        <div>
                            <div class="image-container">
                                <img src="imgs/pexels-erik-mclean-7524996.jpg" alt="">
                                <div class="overlay">
                                    <p>Instagram</p>
                                </div>
                            </div>
                            <div class="image-container">
                                <img src="imgs/pexels-alina-vilchenko-1173648.jpg" alt="">
                                <div class="overlay">
                                    <p>Instagram</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="image-container">
                                <img src="imgs/pexels-erik-mclean-7524996.jpg" alt="">
                                <div class="overlay">
                                    <p>Instagram</p>
                                </div>
                            </div>
                            <div class="image-container">
                                <img src="imgs/pexels-alina-vilchenko-1173648.jpg" alt="">
                                <div class="overlay">
                                    <p>Instagram</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--lines+logo-->
                <div class="lines">
                    <div class="line-1"></div>
                    <img src="imgs/logo.png" alt="">
                    <div class="line-1"></div>
                </div>
                <!--social media-->
                <div class="filter-social">
                    <span>Social</span>
                    <span class="filter-icon">
                        <img src="imgs/twitter.png" alt="twitter">
                        <img src="imgs/instagram.svg" alt="instagram">
                        <img src="imgs/facebook-f.svg" alt="facebook">
                    </span>
                </div>


            </div>
        </main>



        <!--footer-->
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

<!--popping up div -->    
<!-- JavaScript code for the modal goes here -->
<script>
  // Get references to the modal and close button
  const modal = document.getElementById('bookModal');
  const closeModalBtn = document.getElementById('closeModal');

  // Function to open the modal and load book details
  function openModal(bookId) {
    modal.style.display = 'block';
    // Load book details via AJAX or fetch API
    // Replace 'your-api-endpoint' with the actual API endpoint
    fetch('your-api-endpoint?id=' + bookId)
      .then(response => response.json())
      .then(data => {
        const bookDetailsDiv = document.getElementById('bookDetails');
        bookDetailsDiv.innerHTML = `
          <h1>${data.bookname}</h1>
          <p>Author: ${data.author}</p>
          <p>Price: ${data.price}</p>
          <p>${data.description}</p>
          <!-- Add other book details as needed -->
        `;
      })
      .catch(error => {
        console.error('Error fetching data:', error);
      });
  }

  // Attach click event handlers to book links
  const bookLinks = document.querySelectorAll('.book-link');
  bookLinks.forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      const bookId = this.getAttribute('data-book-id');
      openModal(bookId);
    });
  });

  // Close the modal when the close button is clicked
  closeModalBtn.addEventListener('click', function () {
    modal.style.display = 'none';
  });

  // Close the modal when clicking outside of it
  window.addEventListener('click', function (e) {
    if (e.target === modal) {
      modal.style.display = 'none';
    }
  });
</script>

<!--slide the price-->
<script>
    const minSlider = document.querySelector('.min-slider');
    const maxSlider = document.querySelector('.max-slider');
    const selectedPrice = document.querySelector('.selected-price');
    const priceRange = document.querySelector('.price-range');

    // Price range in dollars
    const minPrice = 0;
    const maxPrice = 400; // Set the maximum price (e.g., 400)

    // Initial positions of the sliders (whole numbers)
    let minSliderPosition = minPrice;
    let maxSliderPosition = maxPrice;

    // Function to update the slider positions and selected price range
    function updateSliderPositions() {
        const minSliderPercentage = ((minSliderPosition - minPrice) / (maxPrice - minPrice)) * 100;
        const maxSliderPercentage = ((maxSliderPosition - minPrice) / (maxPrice - minPrice)) * 100;
        minSlider.style.left = `${minSliderPercentage}%`;
        maxSlider.style.left = `${maxSliderPercentage}%`;
        selectedPrice.textContent = `Price: ${minSliderPosition}dh - ${maxSliderPosition}dh`;
    }

    // Event listeners for dragging the sliders
    function createSliderDragHandler(slider, setPosition) {
        let isDragging = false;

        slider.addEventListener('mousedown', (e) => {
            isDragging = true;

            function moveSlider(e) {
                if (isDragging) {
                    const rect = priceRange.getBoundingClientRect();
                    const offsetX = e.clientX - rect.left;
                    const percentage = (offsetX / rect.width) * 100;
                    const newPosition = (percentage / 100) * (maxPrice - minPrice) + minPrice;
                    // Ensure the position is a whole number
                    setPosition(Math.round(Math.max(minPrice, Math.min(maxPrice, newPosition))));
                    updateSliderPositions();
                }
            }

            function stopSlider() {
                isDragging = false;
            }

            document.addEventListener('mousemove', moveSlider);
            document.addEventListener('mouseup', stopSlider);
        });
    }

    createSliderDragHandler(minSlider, (position) => {
        minSliderPosition = position;
    });
    createSliderDragHandler(maxSlider, (position) => {
        maxSliderPosition = position;
    });

    // Initialize the sliders
    updateSliderPositions();

</script>

<script>
    // Function to load books for a selected category
    function loadBooksForCategory(category) {
        // Use AJAX or fetch API to retrieve books for the selected category
        // Replace 'your-api-endpoint' with the actual API endpoint
        fetch('your-api-endpoint?category=' + category)
            .then(response => response.json())
            .then(data => {
                // Display the books in a designated div
                const booksDiv = document.getElementById('books-container');
                booksDiv.innerHTML = ''; // Clear existing content

                if (data.length > 0) {
                    data.forEach(book => {
                        const bookElement = document.createElement('div');
                        bookElement.classList.add('book');
                        bookElement.innerHTML = `
                            <h2>${book.name}</h2>
                            <p>Author: ${book.author}</p>
                            <p>Price: $${book.price}</p>
                            <img src="${book.image}" alt="${book.name}">
                        `;
                        booksDiv.appendChild(bookElement);
                    });
                } else {
                    booksDiv.innerHTML = '<p>No books found in this category.</p>';
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    // Add event listeners to category links
    const categoryLinks = document.querySelectorAll('.categories-link');
    categoryLinks.forEach(link => {
        link.addEventListener('click', event => {
            event.preventDefault();
            const category = link.textContent.trim(); // Get the category name from the link
            loadBooksForCategory(category);
        });
    });
</script>

</body>
</html>