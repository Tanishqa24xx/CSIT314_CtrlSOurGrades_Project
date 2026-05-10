<?php
// controllers/ViewUserProfileController.php
require_once __DIR__ . '/../entities/UserProfile.php';

class ViewUserProfileController {
    private $userProfileEntity;

    public function __construct($userProfile = null) {
        // Controller creates its own entity
        $this->userProfileEntity = $userProfile ?? new UserProfile();
    }

    public function GetUserProfiles() {
        $profiles = $this->userProfileEntity->viewProfiles();
        return $profiles;
    }

    public function GetProfileByID($pID) {
        return $this->userProfileEntity->getProfileByID($pID);
    }

}
?>


