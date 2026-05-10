<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/controllers/UpdateUserProfileController.php';
require_once __DIR__ . '/../src/entities/UserProfile.php';

class UpdateUserProfileControllerTest extends TestCase
{
    private $controller;
    private $userProfileMock;

    protected function setUp(): void
    {
        $this->userProfileMock = $this->createMock(UserProfile::class);
        $this->controller = new UpdateUserProfileController($this->userProfileMock);
    }

    public function testGetProfileByID()
    {
        $profile = ['pID'=>3, 'name'=>'User Admin','description'=>'Admin user','status'=>'Active'];

        $this->userProfileMock
            ->method('getProfileByID')
            ->with(3)
            ->willReturn($profile);

        $result = $this->controller->GetProfileByID(3);
        $this->assertEquals($profile, $result);
    }

    public function testUpdateProfile()
    {
        $this->userProfileMock
            ->method('updateProfile')
            ->with(4, 'Platform Manager', 'Updated description', 'Active')
            ->willReturn(true);

        $result = $this->controller->UpdateProfile(4, 'Platform Manager', 'Updated description', 'Active');
        $this->assertTrue($result);
    }
}
?>

