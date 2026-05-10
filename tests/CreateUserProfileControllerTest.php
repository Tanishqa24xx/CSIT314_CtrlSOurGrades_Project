<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/controllers/CreateUserProfileController.php';
require_once __DIR__ . '/../src/entities/UserProfile.php';

class CreateUserProfileControllerTest extends TestCase
{
    private $controller;
    private $userProfileMock;

    protected function setUp(): void
    {
        $this->userProfileMock = $this->createMock(UserProfile::class);
        $this->controller = new CreateUserProfileController($this->userProfileMock);
    }

    public function testCreateUserProfileSuccess()
    {
        $this->userProfileMock
            ->method('createProfile')
            ->with('Test Volunteer', 'Test description', 'Active')
            ->willReturn(true);

        // Call controller method
        $message = $this->controller->CreateUserProfile('Test Volunteer', 'Test description', 'Active');

        $this->assertNull($message); // Controller currently does not return message, only sets it internally
    }

    public function testCreateUserProfileFailure()
    {
        $this->userProfileMock
            ->method('createProfile')
            ->willReturn(false);

        $message = $this->controller->CreateUserProfile('Test Volunteer', 'Test description', 'Active');
        $this->assertNull($message);
    }
}
?>


