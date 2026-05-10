<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/controllers/SuspendUserProfileController.php';
require_once __DIR__ . '/../src/entities/UserProfile.php';

class SuspendUserProfileControllerTest extends TestCase
{
    private $controller;
    private $userProfileMock;

    protected function setUp(): void
    {
        // Mock the UserProfile entity
        $this->userProfileMock = $this->createMock(UserProfile::class);

        // Inject mock into controller
        $this->controller = new SuspendUserProfileController($this->userProfileMock);
    }

    public function testSuspendUserProfileSuccess()
    {
        // Simulate successful suspension of a profile (e.g., pID = 2 for CSR Rep)
        $this->userProfileMock
            ->expects($this->once())
            ->method('suspendProfile')
            ->with(2)
            ->willReturn(true);

        $result = $this->controller->suspendUserProfile(2);
        $this->assertTrue($result);
    }

    public function testSuspendUserProfileFailure()
    {
        // Simulate failed suspension (e.g., invalid pID = 99)
        $this->userProfileMock
            ->expects($this->once())
            ->method('suspendProfile')
            ->with(99)
            ->willReturn(false);

        $result = $this->controller->suspendUserProfile(99);
        $this->assertFalse($result);
    }
}
?>
