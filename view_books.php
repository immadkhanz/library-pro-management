<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Books - LibraryPro</title>
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
                    <li class="nav-item"><a class="nav-link" href="add_book.php"><i class="fas fa-plus-circle me-1"></i> Add Book</a></li>
                    <li class="nav-item"><a class="nav-link active" href="view_books.php"><i class="fas fa-list me-1"></i> View Books</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5 pt-4 mb-5">
        <div class="row mb-4 align-items-center animate-fade-in">
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <div class="bg-dark bg-opacity-50 p-3 rounded-circle me-3" style="border: 1px solid rgba(251,191,36,0.3);">
                        <i class="fas fa-swatchbook text-gold fa-2x"></i>
                    </div>
                    <h2 class="fw-bold mb-0">Library Collection</h2>
                </div>
            </div>
            <div class="col-md-6 text-md-end mt-4 mt-md-0">
                <a href="add_book.php" class="btn btn-gold shadow-sm"><i class="fas fa-plus me-2"></i>Add New Book</a>
            </div>
        </div>

        <?php
        if (isset($_GET['success'])) {
            $msg = $_GET['success'] == 'added' ? 'Book added successfully!' : ($_GET['success'] == 'updated' ? 'Book updated successfully!' : 'Book deleted successfully!');
            echo '<div class="alert alert-success bg-transparent border-success text-success animate-fade-in"><i class="fas fa-check-circle me-2"></i>' . $msg . '</div>';
        }
        ?>

        <div class="glass-card animate-fade-in p-0 overflow-hidden" style="animation-delay: 0.1s;">
            <div class="table-responsive">
                <table class="table table-glass table-hover mb-0">
                    <thead>
                        <tr>
                            <th width="8%" class="text-center">#</th>
                            <th width="32%">Book Title</th>
                            <th width="25%">Author</th>
                            <th width="15%">Price</th>
                            <th width="20%" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'db_connect.php';
                        $sql = "SELECT * FROM books";
                        $result = $conn->query($sql);
                        
                        if ($result && $result->num_rows > 0) {
                            $count = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td class='text-center text-muted-light'>" . $count++ . "</td>";
                                echo "<td class='fw-medium'><i class='fas fa-book text-gold me-3 opacity-75'></i>" . htmlspecialchars($row['title']) . "</td>";
                                echo "<td><i class='fas fa-user-edit text-muted-light me-2 opacity-50'></i>" . htmlspecialchars($row['author']) . "</td>";
                                echo "<td class='text-gold fw-bold'>$" . number_format($row['price'], 2) . "</td>";
                                echo "<td class='text-center'>
                                        <a href='edit.php?id=" . $row['id'] . "' class='btn btn-sm btn-outline-info me-2 px-3 rounded-pill' title='Edit'><i class='fas fa-edit me-1'></i> Edit</a>
                                        <a href='#' onclick='confirmDelete(" . $row['id'] . ")' class='btn btn-sm btn-outline-danger px-3 rounded-pill' title='Delete'><i class='fas fa-trash me-1'></i> Delete</a>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center py-5 text-muted-light'><i class='fas fa-box-open fa-3x mb-3 opacity-50 d-block'></i>No books found in the collection.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        });

        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#3b82f6',
                confirmButtonText: 'Yes, delete it!',
                background: '#0f172a',
                color: '#f8fafc',
                customClass: {
                    popup: 'border border-secondary'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'delete.php?id=' + id;
                }
            })
        }
    </script>
</body>
</html>
