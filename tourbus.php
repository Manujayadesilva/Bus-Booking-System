<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tourist Attractions in Sri Lanka</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .banner-image {
        width: 100%;
        height: auto;
    }
    .bus-icon {
        width: 50px; 
        height: 50px;
        margin-right: 10px;
    }
    .travelling-aid {
        font-size: 2em; 
        font-weight: bold;
    }
    .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        border-radius: 5px; /* 5px rounded corners */
    }
    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }
  </style>
</head>
<body>

<img src="Travel1.png" alt="Sri Lanka Banner" class="banner-image">
<br><br>
<div class="container mt-3">
    <h1><b><center>Discover Sri Lanka through Voyage Facile</center></b></h1><br>
    <p>
    Sri Lanka, often referred to as the pearl of the Indian Ocean, is a mesmerizing island nation that boasts an incredible diversity of landscapes, cultures, and experiences within its relatively compact boundaries. From the sun-kissed, golden beaches that encircle the island to the cool, mist-shrouded hill country carpeted with tea plantations, Sri Lanka offers a range of natural beauty that is truly astonishing for its size.
    </p>
    <p>
    Venture into the heart of the island and you'll find ancient cities and heritage sites that whisper tales of a rich and complex history. The majestic Sigiriya Rock Fortress, a testament to ancient urban planning and artistic prowess, rises dramatically out of the central plains, while the sacred city of Anuradhapura, with its towering dagobas and ancient Bodhi tree, tells stories of a Buddhist civilization that has flourished for centuries.
    </p>
    <p>
    Wildlife enthusiasts will find Sri Lanka a paradise, with several national parks and reserves where elephants roam free, leopards prowl silently, and a myriad of bird species flutter in the treetops. Yala National Park, renowned for having one of the highest densities of leopards in the world, offers thrilling safaris, while the serene Sinharaja Forest Reserve, a UNESCO World Heritage Site, is a biodiversity hotspot, home to numerous endemic species.
    </p>
    <p>
    But Sri Lanka's beauty is not just in its landscapes and wildlife; it's also in its vibrant culture and the warmth of its people. The island's culture is a colorful tapestry woven from generations of heritage, influenced by Buddhist, Hindu, Muslim, and Christian traditions. Festivals such as Vesak and the Kandy Esala Perahera showcase the island's rich religious and cultural life through breathtaking processions, dance, and lights.
    </p>
    <p>
    Culinary adventurers will be delighted by Sri Lankan cuisine, a flavorful blend of rich spices, fresh fruits, vegetables, and seafood. From the iconic rice and curry with its myriad of tastes to unique street food delights and the sweet, milky tea that is a staple of the island, Sri Lankan cuisine is an integral part of the travel experience.
    </p>
    <p>
    Exploring Sri Lanka is an adventure of discovery, where ancient traditions seamlessly blend with modernity, and nature's beauty is preserved in stunning landscapes and wildlife reserves. Every corner of the island offers something unique, inviting travelers to immerse themselves in its beauty, history, and culture. Sri Lanka is not just a destination; it's an experience that will leave you with memories to cherish for a lifetime.
    </p>
</div>

<!-- Voyage Facile Tour Packages -->
<div class="container mt-5">
    <h3>Check out Voyage Facile Tour Packages</h3>

    <div class="row mt-3">
        
        <!-- PHP code to dynamically generate package cards/buttons -->
        <?php
            // Database connection
            $db_host = 'localhost';
            $db_user = 'dseuser';
            $db_password = '123';
            $db_db = 'voyagefacile1';
            
            $conn = new mysqli($db_host, $db_user, $db_password, $db_db);
            
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            // Fetch data from database
            $sql = "SELECT * FROM tourpackages";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Package: ' . $row["PackageName"] . '</h5>
                                    <p class="card-text">Destination: ' . $row["PackageDestination"] . '<br>Price: Rs.' . $row["PackagePrice"] . '<br>Duration: ' . $row["PackageDuration"] . '<br>Travellers: ' . $row["Travellers"] . '<br>Contact: ' . $row["ContactNumber"] . '</p>
                                </div>
                            </div>
                          </div>';
                }
            } else {
                echo "0 results";
            }
            $conn->close();
        ?>
        <!-- End of PHP code -->
    </div>
</div>

<!-- Order Package Button -->
<div class="container mt-5">
    <a href="packageorder.html" class="btn btn-primary">Order Package</a>
</div>

<!-- Carousel -->
<div class="container mt-5">
    <h3>Explore Sri Lanka's Attractions</h3>
    <div id="touristCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="acc1.jpg" class="d-block w-100" alt="Attraction 1">
            </div>
            <div class="carousel-item">
                <img src="acc2.jpg" class="d-block w-100" alt="Attraction 2">
            </div>
            <div class="carousel-item">
                <img src="acc3.jpeg" class="d-block w-100" alt="Attraction 3">
            </div>
            <div class="carousel-item">
                <img src="acc4.webp" class="d-block w-100" alt="Attraction 4">
            </div>
        </div>
        <a class="carousel-control-prev" href="#touristCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#touristCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function(){
    $('.carousel').carousel({
      interval: 2000
    });
  });
</script>
</body>
</html>


