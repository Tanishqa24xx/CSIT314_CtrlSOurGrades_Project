<?php
// boundaries/ProfileList.php
require_once __DIR__ . '/../controllers/ViewUserProfileController.php';
require_once __DIR__ . '/../controllers/SuspendUserProfileController.php';

$controller = new ViewUserProfileController();

// Use profiles from parent if available, otherwise fetch all
if (!isset($profiles)) {
    $profiles = $controller->getUserProfiles();
}

// Handle filtering
$filter = $_POST['filter'] ?? 'all';
if ($filter !== 'all') {
    $profiles = array_filter($profiles, function($profile) use ($filter) {
        return strtolower($profile['status']) === strtolower($filter);
    });
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <style>
        body { font-family: Arial, sans-serif; background: #fafafa; margin: 40px; }
        .filter-buttons { margin-bottom: 15px; display: flex; gap: 10px; }
        .filter-buttons button {
            padding: 6px 14px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            color: white;
        }
        .filter-buttons button[name="filter"][value="all"] { background-color: #007bff; }
        .filter-buttons button[name="filter"][value="active"] { background-color: #28a745; }
        .filter-buttons button[name="filter"][value="suspended"] { background-color: #dc3545; }
        .filter-buttons button:hover { opacity: 0.85; transition: 0.2s; }

        table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        th, td { border: 1px solid #ddd; padding: 10px 12px; text-align: left; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        th { background: #f0f0f0; }
        .activity-button { background: none; border: none; cursor: pointer; margin-right: 5px; padding: 0; width: 32px; height: 32px; }
        .activity-button img { width: 100%; height: auto; display: block; }
        .activity-button:hover img { filter: brightness(80%); }
        .activity-button.disabled { cursor: not-allowed; opacity: 0.5; }
    </style>

    <script>
        function goToProfileUpdate(id) {
            window.location.href = 'boundaries/UserProfileUpdateForm.php?pID=' + id;
        }

        function viewUserProfile(id) {
            window.location.href = 'boundaries/ViewUserProfile.php?pID=' + id;
        }
        
        function suspendUserProfile(id) {
            window.location.href = 'boundaries/SuspendConfirmationPopup.php?pID=' + id;
        }
    </script>
</head>
<body>
	
	<!-- Filter Buttons -->
    <form method="post" class="filter-buttons">
        <button type="submit" name="filter" value="all" <?php if($filter=='all') echo 'style="opacity:0.7"'; ?>>All</button>
        <button type="submit" name="filter" value="active" <?php if($filter=='active') echo 'style="opacity:0.7"'; ?>>Active</button>
        <button type="submit" name="filter" value="suspended" <?php if($filter=='suspended') echo 'style="opacity:0.7"'; ?>>Suspended</button>

        <!-- Retain search state if SearchProfiles form submitted -->
        <?php if (!empty($_POST['searchBy'])): ?>
            <input type="hidden" name="searchBy" value="<?php echo htmlspecialchars($_POST['searchBy']); ?>">
        <?php endif; ?>
        <?php if (!empty($_POST['searchInput'])): ?>
            <input type="hidden" name="searchInput" value="<?php echo htmlspecialchars($_POST['searchInput']); ?>">
        <?php endif; ?>
        <?php if (isset($_POST['searchButton'])): ?>
            <input type="hidden" name="searchButton" value="1">
        <?php endif; ?>
    </form>
	
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Activities</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($profiles)) : ?>
                <?php foreach ($profiles as $profile) :
                    $isAdmin = strtolower($profile['name']) === 'user admin';
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($profile['pID']); ?></td>
                        <td><?php echo htmlspecialchars($profile['name']); ?></td>
                        <td><?php echo htmlspecialchars($profile['description']); ?></td>
                        <td><?php echo htmlspecialchars($profile['status']); ?></td>
                        <td>
                            <button class="activity-button" onclick="viewUserProfile(<?php echo $profile['pID']; ?>)">
                                <img src="boundaries/viewIcon.png" alt="View">
                            </button>
                            <button class="activity-button" onclick="goToProfileUpdate(<?php echo $profile['pID']; ?>)">
                                <img src="boundaries/updateIcon.png" alt="Update">
                            </button>
                            <button class="activity-button <?php echo $isAdmin ? 'disabled' : ''; ?>"
                                    <?php if (!$isAdmin) : ?>onclick="suspendUserProfile(<?php echo $profile['pID']; ?>)"<?php endif; ?>>
                                <img src="boundaries/suspendIcon.png" alt="Suspend">
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr><td colspan="5">No profiles found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
