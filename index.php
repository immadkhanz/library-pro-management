<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibraryPro - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- 3D Background Container -->
    <div id="vanta-bg"></div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-glass sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="fas fa-book-open text-gold me-2"></i>Library<span>Pro</span></a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars text-white"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-2">
                    <li class="nav-item"><a class="nav-link active" href="index.php"><i class="fas fa-home me-1"></i> Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="add_book.php"><i class="fas fa-plus-circle me-1"></i> Add Book</a></li>
                    <li class="nav-item"><a class="nav-link" href="view_books.php"><i class="fas fa-list me-1"></i> View Books</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5 pt-4 mb-5">
        <div class="row align-items-center mb-5 animate-fade-in">
            <div class="col-lg-7">
                <div class="badge bg-dark border border-secondary text-gold px-3 py-2 rounded-pill mb-3 shadow-sm">
                    <i class="fas fa-star me-1"></i> Premium Web Engineering Project
                </div>
                <h1 class="display-3 fw-bold mb-4" style="line-height: 1.2;">Elevate Your <br><span class="text-gold">Library Experience</span></h1>
                <p class="lead text-muted-light mb-5 fs-4" style="max-width: 600px;">Manage your book collection effortlessly with our modern, fast, and highly secure platform built for the future.</p>
                <div class="d-flex gap-4">
                    <a href="add_book.php" class="btn btn-gold btn-lg shadow-lg"><i class="fas fa-plus me-2"></i>Add New Book</a>
                    <a href="view_books.php" class="btn btn-outline-gold btn-lg"><i class="fas fa-list me-2"></i>View Collection</a>
                </div>
            </div>
        </div>

        <?php
        include 'db_connect.php';
        
        // Fetch stats if table exists
        $total_books = 0;
        $total_value = 0;
        
        $check_table = $conn->query("SHOW TABLES LIKE 'books'");
        if ($check_table->num_rows > 0) {
            $result = $conn->query("SELECT COUNT(*) as count, SUM(price) as value FROM books");
            if ($result && $row = $result->fetch_assoc()) {
                $total_books = $row['count'];
                $total_value = $row['value'] ? $row['value'] : 0;
            }
        } else {
            echo "<div class='alert alert-warning glass-card p-4 mb-5 border-warning border-opacity-50 text-white'>
                    <h4 class='alert-heading text-warning'><i class='fas fa-exclamation-triangle me-2'></i>Database Not Found</h4>
                    <p class='mb-0'>The required database tables are missing. <a href='setup_db.php' class='text-gold fw-bold text-decoration-none border-bottom border-warning'>Click here to run the setup script.</a></p>
                  </div>";
        }
        ?>

        <!-- Stats Cards -->
        <div class="row g-4 animate-fade-in" style="animation-delay: 0.2s;">
            <div class="col-md-4">
                <div class="glass-card text-center h-100 p-5">
                    <div class="mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-dark bg-opacity-50 rounded-circle" style="width: 80px; height: 80px; border: 1px solid rgba(251,191,36,0.3);">
                            <i class="fas fa-book-reader text-gold fa-2x"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold display-5 mb-2"><?php echo $total_books; ?></h2>
                    <p class="text-muted-light mb-0 fs-5">Total Books in System</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-card text-center h-100 p-5">
                    <div class="mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-dark bg-opacity-50 rounded-circle" style="width: 80px; height: 80px; border: 1px solid rgba(251,191,36,0.3);">
                            <i class="fas fa-coins text-gold fa-2x"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold display-5 mb-2">$<?php echo number_format($total_value, 2); ?></h2>
                    <p class="text-muted-light mb-0 fs-5">Total Collection Value</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-card text-center h-100 p-5">
                    <div class="mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-dark bg-opacity-50 rounded-circle" style="width: 80px; height: 80px; border: 1px solid rgba(251,191,36,0.3);">
                            <i class="fas fa-server text-gold fa-2x"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold display-5 mb-2">24/7</h2>
                    <p class="text-muted-light mb-0 fs-5">System Availability</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.net.min.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            VANTA.NET({
                el: "#vanta-bg",
                mouseControls: true,
                touchControls: true,
                gyroControls: false,
                minHeight: 200.00,
                minWidth: 200.00,
                scale: 1.00,
                scaleMobile: 1.00,
                color: 0xfbbf24,
                backgroundColor: 0x050505,
                points: 10.00,
                maxDistance: 22.00,
                spacing: 18.00
            })
        })
    </script>
</body>
</html>
