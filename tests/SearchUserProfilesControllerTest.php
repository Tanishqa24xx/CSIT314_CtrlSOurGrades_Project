<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/controllers/SearchUserProfilesController.php';
require_once __DIR__ . '/../src/entities/UserProfile.php';

class SearchUserProfilesControllerTest extends TestCase
{
    private $controller;
    private $userProfileMock;

    protected function setUp(): void
    {
        // Mock the UserProfile entity
        $this->userProfileMock = $this->createMock(UserProfile::class);

        // Inject mock into controller
        $this->controller = new SearchUserProfilesController($this->userProfileMock);
    }

    public function testSearchUserProfileReturnsResults()
    {
        $expectedResults = [
            ['pID' => 3, 'name' => 'User Admin', 'status' => 'Active'],
            ['pID' => 2, 'name' => 'CSR Rep', 'status' => 'Suspended']
        ];

        // Expect the mock to receive the call and return these results
        $this->userProfileMock
            ->expects($this->once())
            ->method('searchUserProfile')
            ->with('name', 'User')
            ->willReturn($expectedResults);

        $result = $this->controller->searchUserProfile('name', 'User');

        $this->assertEquals($expectedResults, $result);
    }

    public function testSearchUserProfileReturnsEmptyArrayWhenNoResults()
    {
        $this->userProfileMock
            ->expects($this->once())
            ->method('searchUserProfile')
            ->with('status', 'Active')
            ->willReturn([]);

        $result = $this->controller->searchUserProfile('status', 'Active');

        $this->assertEmpty($result);
    }
}
?>
