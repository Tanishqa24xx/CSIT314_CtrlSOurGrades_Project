<?php
require_once __DIR__ . '/../entities/UserProfile.php';

class UpdateUserProfileController {
    private $entity;

    public function __construct($userProfile = null) {
        $this->entity = $userProfile ?? new UserProfile();
    }

    public function GetProfileByID($pID) {
        return $this->entity->getProfileByID($pID);
    }

    public function UpdateProfile($pID, $name, $description, $status) {
        return $this->entity->updateProfile($pID, $name, $description, $status);
    }
}
?>


