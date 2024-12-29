<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GomuTv</title>
    <link
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
    <script src="mov_load.js"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark">
      <a class="navbar-brand" href="index.php" >GomuTV</a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div
        class="collapse navbar-collapse justify-content-center"
        id="navbarNav"
      >
        <ul class="navbar-nav">
          
          

          <li class="nav-item dropdown">
            <a style="color: black; text-align: center; text-decoration: none;" class="dropdown-toggle btn btn-light" data-toggle="dropdown" href="#"><i class="bi bi-person"></i></a>
            <ul class="dropdown-menu">
                <li style="text-align: center;"><a style="color: red;" href="admin.php">-> ADMIN PANEL</a></li>
                <li style="text-align: center;"><a style="color: darkgray;" href="#">Profiles Coming soon...</a></li>
            </ul>
          </li>
        </ul>
        <form id="searchForm" class="form-inline my-2 my-lg-0">
          <input
            id="searchInput"
            class="form-control mr-sm-2"
            type="search"
            placeholder="Search"
            aria-label="Search"
          />
          <button class="btn btn-outline-light my-2 my-sm-0" type="submit">
            Search
          </button>
        </form>
        
      </div>
      
    </nav>

    <div class="container text-center mt-5">
      <h1>Welcome to GomuTV</h1>
      <p>Your favorite place to watch TV shows and releases.</p>
    </div>

    <div class="container mt-5">
      <div class="row" id="cardContainer">
        
      </div>
    </div>

    <script src="loadcards.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>
