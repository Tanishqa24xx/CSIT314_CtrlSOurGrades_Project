<?php
//controllers/SuspendUserProfileController.php

	require_once __DIR__ . '/../entities/UserProfile.php';

	class SuspendUserProfileController {
		private $entity;
		
		public function __construct($userProfile = null) {
			$this->entity = $userprofile ?? new UserProfile();
		}
		
		public function suspendUserProfile($pID) {
			$result = $this->entity->suspendProfile($pID);
			return $result; 
		} 
	}


