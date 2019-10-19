<?php

namespace App\Tests\Domain\User\Entity;


use App\Domain\User\Entity\Activity;
use PHPUnit\Framework\TestCase;

class ActivityTest extends TestCase
{
    /** @var Activity */
    private $activity;

    protected function setUp(): void
    {
        $this->activity = new Activity();
    }

    public function testGetCreatedAt()
    {
        $this->assertInstanceOf(\DateTimeImmutable::class, $this->activity->getCreatedAt());
    }

    public function testUpdatedAt()
    {
        $this->assertEquals($this->activity->getUpdatedAt(), null);
    }

    public function testIsBlocked()
    {
        $this->assertEquals($this->activity->isBlocked(), false);
    }

    public function testIsConfirmed()
    {
        $this->assertEquals($this->activity->isConfirmed(), false);
    }

    public function testOnUpdated()
    {
        $activityUpdated = $this->activity->onUpdated();

        $this->assertInstanceOf(\DateTimeImmutable::class, $activityUpdated->getUpdatedAt());
    }

    public function testBlock()
    {
        $activityBlocked = $this->activity->block();

        $this->assertEquals(true, $activityBlocked->isBlocked());
    }

    public function testConfirm()
    {
        $activityBlocked = $this->activity->confirm();

        $this->assertEquals(true, $activityBlocked->isConfirmed());
    }
}