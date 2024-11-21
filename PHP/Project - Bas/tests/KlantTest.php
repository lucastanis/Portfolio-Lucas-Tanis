<?php
// auteur: Lucas Tanis
// functie: Unittest class Klant

use PHPUnit\Framework\TestCase;
use Bas\classes\Klant;


class KlantTest extends TestCase{
    
	protected $klant;

    protected function setUp(): void {
        $this->klant = new Klant();
    }

	public function testgetKlanten(){
		$klanten = $this->klant->getKlanten();
        $this->assertIsArray($klanten);
		$this->assertTrue(count($klanten) > 0, "Aantal moet groter dan 0 zijn");
	}

	public function testGetKlant(){
		$klantId = 1; 
		$klant = $this->klant->getKlant($klantId);
		$this->assertEquals($klantId, $klant['klantId']);
	}
	
}
	
?>