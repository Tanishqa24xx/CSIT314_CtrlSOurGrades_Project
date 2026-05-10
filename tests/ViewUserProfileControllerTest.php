<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/controllers/ViewUserProfileController.php';
require_once __DIR__ . '/../src/entities/UserProfile.php';

class ViewUserProfileControllerTest extends TestCase
{
    private $controller;
    private $userProfileMock;

    protected function setUp(): void
    {
        // Mock the UserProfile entity
        $this->userProfileMock = $this->createMock(UserProfile::class);

        // Inject mock into controller
        $this->controller = new ViewUserProfileController($this->userProfileMock);
    }

    public function testGetUserProfiles()
    {
        $expectedProfiles = [
            ['pID' => 1, 'name' => 'Person-in-Need', 'status' => 'Active'],
            ['pID' => 2, 'name' => 'CSR Rep', 'status' => 'Active'],
            ['pID' => 3, 'name' => 'User Admin', 'status' => 'Active'],
            ['pID' => 4, 'name' => 'Platform Manager', 'status' => 'Active']
        ];

        $this->userProfileMock
            ->expects($this->once())
            ->method('viewProfiles')
            ->willReturn($expectedProfiles);

        $result = $this->controller->GetUserProfiles();
        $this->assertEquals($expectedProfiles, $result);
    }

    public function testGetProfileByID()
    {
        $expectedProfile = [
            'pID' => 2,
            'name' => 'CSR Rep',
            'description' => 'Customer service representative',
            'status' => 'Active'
        ];

        $this->userProfileMock
            ->expects($this->once())
            ->method('getProfileByID')
            ->with(2)
            ->willReturn($expectedProfile);

        $result = $this->controller->GetProfileByID(2);
        $this->assertEquals($expectedProfile, $result);
    }
}
?>
