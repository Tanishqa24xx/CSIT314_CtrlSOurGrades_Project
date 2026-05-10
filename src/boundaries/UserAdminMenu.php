<?php
// boundaries/UserAdminMenu.php
session_start();
?>
<html>
<head>
    <style>
        h1 {
            margin-bottom: 20px;
        }

        /* Navbar container */
        .navbar {
            display: flex;
            align-items: center;
            gap: 20px; /* space between buttons */
            margin-bottom: 20px;
        }

        /* Navbar buttons (completely invisible) */
        .navbar button {
            all: unset;            /* resets all default button styles */
            padding: 8px 12px;     /* spacing */
            font-size: 16px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        /* Selected button styling */
        .navbar button.selected {
            font-size: 18px;       /* slightly bigger */
            text-decoration: underline;
            font-weight: bold;
        }

        /* Spacer to push Logout right */
        .navbar .spacer {
            flex-grow: 1;
        }

        /* Create button styling */
        .create-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.2s ease;
        }

        .create-btn:hover {
            background-color: #45a049;
        }
    </style>
    <script>
        function goToProfileCreate() {
            window.location.href = 'boundaries/UserProfileCreateForm.php';
        }
		
    </script>
    <title>Admin Menu</title>

</head>
<body>

    <h1> Admin Menu </h1>

    <div class="navbar">
        <button 
            class="<?php echo ($_GET['action'] ?? '') === '3_UserAdmin_Menu' ? 'selected' : '' ?>" 
            onclick="window.location='index.php?action=3_UserAdmin_Menu">
            User Profiles
        </button>

        <button 
            class="<?php echo ($_GET['action'] ?? '') === 'Something' ? 'selected' : '' ?>" 
            onclick="window.location='index.php?action=UserAccountMenuPage'">
            User Accounts
        </button>

        <button 
            class="<?php echo ($_GET['action'] ?? '') === 'Logout' ? 'selected' : '' ?>" 
            onclick="window.location='index.php?action=Logout'">
            Logout
        </button>
    </div>

    <a onclick="goToProfileCreate()" class="create-btn">+ Create New Profile</a>

    <?php
	// Display flash message once
	if (isset($_SESSION['flash_msg'])) {
		echo '<p style="color: green; font-weight: bold;">' . htmlspecialchars($_SESSION['flash_msg']) . '</p>';
		unset($_SESSION['flash_msg']); // Remove it so it won’t show again on refresh
	}
	?>

</body>
</html>
