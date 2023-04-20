<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Tests;

use App\Entity\Formation;
use DateTime;
use PHPUnit\Framework\TestCase;

/**
 * Description of DateTest
 *
 * @author theok
 */
class DateTest extends TestCase {
    public function testgetPublishedAtString(){
        $formation = new Formation();
        $formation->setPublishedAt(new DateTime("2021-01-04 17:00:12"));
        $this->assertEquals("04/01/2021", $formation->getPublishedAtString());
    }
}
