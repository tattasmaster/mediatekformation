<?php

namespace App\Tests\Validations;

use App\Entity\Formation;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Description of DateValidationsTest
 *
 * @author theok
 */
class DateValidationsTest extends KernelTestCase {
    public function getFormation(): Formation{
        return (new Formation());
    }
    
    public function assertErrors(Formation $formation, int $nbErreursAttendues, string $message="") {
        self::bootKernel();
        $validator = self::getContainer()->get(ValidatorInterface::class);
        $error = $validator->validate($formation);
        $this->assertCount($nbErreursAttendues, $error, $message);
    }
    
    public function testValidDateFormation() {
        $formation = $this->getFormation()->setPublishedAt(new DateTime("2023-04-01"));
        $this->assertErrors($formation, 0, "La date de création ne doit pas dépasser la date actuelle.");
    }
}
