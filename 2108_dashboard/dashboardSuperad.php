<?php
include 'db_connection.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';

// SQL query to fetch admins
$sql = "SELECT ID, Fullname, Email, User_lvl, Birthday FROM customers_info WHERE User_lvl = 2 AND (Fullname LIKE ? OR Email LIKE ?)";
$stmt = $conn->prepare($sql);
$search_term = "%" . $search . "%";
$stmt->bind_param("ss", $search_term, $search_term);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Super Admin</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/fullcalendar.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/tooplate.css">

    <style>
        .search-container {
            position: relative;
            width: 100%;
        }

        .search-input {
            width: calc(100% - 35px); 
            max-width: 500px;
            padding: 10px 35px 10px 15px;
            font-size: 16px;
            border-radius: 25px;
            border: 1px solid #ced4da;
            background-color: #f8f9fa;
        }

        .search-input:focus {
            border-color:rgb(116, 51, 13);
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        }

        .search-button {
            position: absolute;
            top: 20%;
            right: 15px;
            transform: translateX(-1400%);
            background-color: transparent;
            border: none;
            color: #7ac27e;
            font-size: 18px;
            cursor: pointer;
        }

        .search-button:hover {
            color: rgb(19, 121, 28);
        }

        table {
            background-color:#7ac27e; 
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 12px;
            text-align: left;
        }

        table th {
            background-color:rgb(73, 143, 85);
            color: white;
        }

        table td {
            background-color: #ffffff;
        }

        .create-button {
            display: flex;
            justify-content: flex-start;  
            align-items: center; 
            margin-bottom: 10px;
            margin-left: 10px; 
        }

        .create-button a {
            padding: 10px 20px; 
            background-color:rgb(189, 118, 71);  
            color: white;
            font-size: 16px;
            border-radius: 25px;  
            text-decoration: none;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
            transition: background-color 0.3s, transform 0.3s ease-in-out;
            display: inline-flex;
        }

        .create-button a:hover {
            background-color:rgb(73, 143, 85);  
            transform: translateY(-2px); 
        }

        .create-button a:active {
            transform: translateY(1px); 
        }
    </style>
</head>

<body id="reportsPage">
    <div class="" id="home">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-xl navbar-light bg-light">
                        <a class="navbar-brand" href="#">
                            <i class="fas fa-3x fa-tachometer-alt tm-site-icon"></i>
                        </a>
                        <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Admins List
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="admins_archive.php">Admins Archive</a>
                                    </div>
                                </li>
                            </ul>
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link d-flex" href="login.html">
                                        <i class="far fa-user mr-2 tm-logout-icon"></i>
                                        <span>Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>

                    <br>
                    <div class="row mb-3">
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <form method="GET" class="d-flex justify-content-center w-75">
                                <div class="search-container w-100">
                                    <input type="text" name="search" class="search-input" placeholder="Search Admins..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                                    <button type="submit" class="search-button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                            
                            <div class="create-button">
                                <a href="createAdmin.php" class="btn">Create New Account</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Birthday</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $row['ID']; ?></td>
                                        <td><?php echo $row['Fullname']; ?></td>
                                        <td><?php echo $row['Email']; ?></td>
                                        <td><?php echo $row['Birthday']; ?></td>
                                        <td>
                                            <a href="edit_admin.php?id=<?php echo $row['ID']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="delete_admin.php?id=<?php echo $row['ID']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this admin?');">Delete</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
