<?php

namespace NRTest\PetClinicBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Faker;

use NRTest\PetClinicBundle\Entity\Owner;
use NRTest\PetClinicBundle\Entity\PetType;
use NRTest\PetClinicBundle\Entity\Pet;
use NRTest\PetClinicBundle\Entity\Visit;
use NRTest\PetClinicBundle\Entity\Vet;
use NRTest\PetClinicBundle\Entity\Specialty;

class PopulateCommand extends ContainerAwareCommand
{
	protected function configure()
	{
		$this
			->setName("petclinic:populate")
			->setDescription("Populate the petclinic database with standard data")
		;
	}
	
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$faker = Faker\Factory::create();
		
		$em = $this->getContainer()->get('doctrine')->getEntityManager();
		
		$petTypeNames = array("bird", "cat", "dog", "fish", "hamster", "horse", "iguana", "lizard", 
							"mouse", "pig", "rabbit", "rat", "snake", "snake", "tortoise", "turtle");
		
		$petNames = array("Max", "Tigger", "Jake", "Tiger", "Buddy", "Smokey", "Maggie", "Bear", "Sam", "Kitty",
						"Molly", "Bailey", "Sassy", "Shadow", "Simba", "Patch", "Lady", "Lucky", "Sadie", "Misty", 
						"Rocky", "Sammy", "Lucy", "Princess", "Oreo", "Daisy", "Samantha", "Buster", "Charlie", 
						"Casey", "Boots", "Cody", "Brandy", "Oliver", "Duke", "Precious", "Missy", "Bandit", 
						"Oscar", "Jack", "Fluffy", "Ginger", "Harley", "Whiskers", "Abby", "Gizmo", "Rusty", "Taz", 
						"Sasha", "Midnight", "Sandy", "Toby", "Baby", "Murphy", "Pepper", "Dakota", "Spike", 
						"Sophie", "Katie", "Annie");
		
		$specialtyNames = array("dentistry", "dermatology", "emergency", "imaging", "radiology", "surgery", "vision");

		
		foreach ($petTypeNames as $petTypeName) 
		{
			$petType = new PetType();
			$petType->setName($petTypeName);
			$em->persist($petType);
			$em->flush();
		}
		
		$petTypes = $em->getRepository("NRTestPetClinicBundle:PetType")->findAll();
		
		for ($i =0; $i < 100; $i++) 
		{
			$owner = new Owner();
			$owner->setFirstName($faker->firstName());
			$owner->setLastName($faker->lastName());
			$owner->setAddress($faker->streetAddress());
			$owner->setCity($faker->city());
			$owner->setTelephone("408-555-1212");
			
			$em->persist($owner);
			$em->flush();
			
			$petCount = rand(1, 5);
			for ($j = 0; $j < $petCount; $j++) 
			{
				$pet = new Pet();
				$pet->setName($petNames[rand(0, count($petNames)-1)]);
				$pet->setBirthDate($this->getRandomBirthdate());
				$pet->setPetType($petTypes[rand(0,count($petTypes)-1)]);
				$pet->setOwner($owner);				

				$em->persist($pet);
				$em->flush();
				
				$visitCount = rand(1,3);
				for ($k = 0; $k < $visitCount; $k++ )
				{
					$visit = new Visit();
					$visit->setVisitDate($this->getRandomBirthdate());
					$visit->setDescription($faker->text(200));
					$visit->setPet($pet);
					
					$em->persist($visit);
					$em->flush();
				}
			}
		} 

		foreach ($specialtyNames as $specialtyName) 
		{
			$specialty = new Specialty();
			$specialty->setName($specialtyName);
			$em->persist($specialty);
			$em->flush();
		}		
		$specialties = $em->getRepository("NRTestPetClinicBundle:Specialty")->findAll();
		
		for ($i = 0; $i < 100; $i++) {
			
			$vet = new Vet();
			$vet->setFirstName($faker->firstName());
			$vet->setLastName($faker->lastName());
			
			$specialtyCount = rand(1,4);
			$indexs = array();
			
			for ( $j = 0; $j < $specialtyCount; $j ++) 
			{
				array_push($indexs, rand(0, count($specialties) -1));
			}
			$specialtyIndexes = array_unique($indexs);
			foreach ($specialtyIndexes as $index)
			{
				$vet->addSpecialty( $specialties[$index] );
			}
			
			$em->persist($vet);
			$em->flush();
		}
		
	}

	protected function getRandomBirthdate()
	{
		$startDate = strtotime("2005-01-01");
		$endDate   = strtotime("2010-12-12");
		$days = round( ($endDate - $startDate) / (60*60*24) );
		$n = rand(0, $days);
		return new \DateTime(date("Y-m-d", strtotime("2005-01-01 + $n days")));
	}

}