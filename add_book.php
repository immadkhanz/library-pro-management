<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book - LibraryPro</title>
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
                    <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-home me-1"></i> Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link active" href="add_book.php"><i class="fas fa-plus-circle me-1"></i> Add Book</a></li>
                    <li class="nav-item"><a class="nav-link" href="view_books.php"><i class="fas fa-list me-1"></i> View Books</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5 pt-4 mb-5">
        <div class="row justify-content-center animate-fade-in">
            <div class="col-md-8 col-lg-6">
                <div class="glass-card">
                    <div class="text-center mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-dark bg-opacity-50 rounded-circle mb-3" style="width: 70px; height: 70px; border: 1px solid rgba(251,191,36,0.3);">
                            <i class="fas fa-book-medical text-gold fa-2x"></i>
                        </div>
                        <h2 class="fw-bold">Add New Book</h2>
                        <p class="text-muted-light">Enter the details of the book below.</p>
                    </div>
                    
                    <?php
                    if (isset($_GET['success'])) {
                        echo '<div class="alert alert-success bg-transparent border-success text-success"><i class="fas fa-check-circle me-2"></i>Book added successfully!</div>';
                    }
                    if (isset($_GET['error'])) {
                        echo '<div class="alert alert-danger bg-transparent border-danger text-danger"><i class="fas fa-exclamation-circle me-2"></i>' . htmlspecialchars($_GET['error']) . '</div>';
                    }
                    ?>

                    <form action="insert.php" method="POST" id="addBookForm">
                        <div class="mb-4">
                            <label class="form-label text-muted-light">Book Title</label>
                            <div class="input-icon-wrapper">
                                <i class="fas fa-book"></i>
                                <input type="text" class="form-control form-control-lg" name="title" id="title" placeholder="e.g. Modern Web Engineering" required pattern="[A-Za-z\s]+" title="Title should contain only alphabetic characters and spaces">
                            </div>
                            <div class="invalid-feedback text-danger small mt-1 d-none" id="titleError"><i class="fas fa-info-circle me-1"></i>Only alphabetic characters and spaces allowed.</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted-light">Author Name</label>
                            <div class="input-icon-wrapper">
                                <i class="fas fa-user-edit"></i>
                                <input type="text" class="form-control form-control-lg" name="author" id="author" placeholder="e.g. Sir Kazim" required pattern="[A-Za-z\s]+" title="Author name should contain only alphabetic characters">
                            </div>
                            <div class="invalid-feedback text-danger small mt-1 d-none" id="authorError"><i class="fas fa-info-circle me-1"></i>Only alphabetic characters allowed.</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted-light">Price ($)</label>
                            <div class="input-icon-wrapper">
                                <i class="fas fa-dollar-sign"></i>
                                <input type="number" class="form-control form-control-lg" name="price" id="price" placeholder="0.00" step="0.01" min="0.01" required>
                            </div>
                        </div>

                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-gold btn-lg"><i class="fas fa-save me-2"></i>Save Book Record</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Client Side Validation Script -->
    <script>
        document.getElementById('title').addEventListener('input', function(e) {
            const regex = /^[A-Za-z\s]+$/;
            if (this.value && !regex.test(this.value)) {
                this.classList.add('is-invalid');
                document.getElementById('titleError').classList.remove('d-none');
            } else {
                this.classList.remove('is-invalid');
                if (this.value) this.classList.add('is-valid');
                document.getElementById('titleError').classList.add('d-none');
            }
        });

        document.getElementById('author').addEventListener('input', function(e) {
            const regex = /^[A-Za-z\s]+$/;
            if (this.value && !regex.test(this.value)) {
                this.classList.add('is-invalid');
                document.getElementById('authorError').classList.remove('d-none');
            } else {
                this.classList.remove('is-invalid');
                if (this.value) this.classList.add('is-valid');
                document.getElementById('authorError').classList.add('d-none');
            }
        });
    </script>
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
