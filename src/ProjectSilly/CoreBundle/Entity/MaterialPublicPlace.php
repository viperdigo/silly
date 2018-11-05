<?php

namespace ProjectSilly\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="material_public_places")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class MaterialPublicPlace {

	const UNIT_MEASUREMENT_UNIT = 'unit';
	const UNIT_MEASUREMENT_METER = 'meter';
	const UNIT_MEASUREMENT_CUBIC_METER = 'cubic meter';
	const UNIT_MEASUREMENT_PIECE = 'piece';
	
	/**
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @ORM\ManyToOne(targetEntity="ProjectSilly\CoreBundle\Entity\Material", inversedBy="materi")
	 * @ORM\JoinColumn(name="fk_material", referencedColumnName="id")
	 * @Assert\NotBlank()
	 * */
	private $material;

	/**
	 * @ORM\ManyToOne(targetEntity="ProjectSilly\CoreBundle\Entity\PublicPlace", inversedBy="materials")
	 * @ORM\JoinColumn(name="fk_public_place", referencedColumnName="id")
	 * */
	private $publicPlace;

	/**
	 * @ORM\Column(name="quantity", type="decimal", precision=10, scale=2, nullable=false)
	 * @Assert\NotBlank()
	 */
	private $quantity;

	/**
	 * @ORM\Column(name="unit_measurement", type="string", columnDefinition="enum('unit','meter','piece','cubic meter')", nullable=true)
	 * @Assert\NotBlank()
	 */
	private $unitMeasurement;

	/**
	 * @ORM\Column(name="date_application", type="date", nullable=true)
	 * @Assert\NotBlank()
	 * @Assert\Date()
	 */
	private $dateApplication;
	
	/**
	 * @Gedmo\Timestampable(on="create")
	 * @ORM\Column(name="created_at", type="datetime")
	 */
	private $createdAt;

	/**
	 * @Gedmo\Timestampable(on="update")
	 * @ORM\Column(name="updated_at", type="datetime")
	 */
	private $updatedAt;

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId( $id ) {
		$this->id = $id;
	}

	/**
	 * @return MaterialCustomer
	 */
	public function getMaterial() {
		return $this->material;
	}

	/**
	 * @param Material $material
	 */
	public function setMaterial( Material $material ) {
		$this->material = $material;
	}

	/**
	 * @return mixed
	 */
	public function getPublicPlace() {
		return $this->publicPlace;
	}

	/**
	 * @param mixed $publicPlace
	 */
	public function setPublicPlace( $publicPlace ) {
		$this->publicPlace = $publicPlace;
	}
	
	/**
	 * @return mixed
	 */
	public function getCreatedAt() {
		return $this->createdAt;
	}

	/**
	 * @param mixed $createdAt
	 */
	public function setCreatedAt( $createdAt ) {
		$this->createdAt = $createdAt;
	}

	/**
	 * @return mixed
	 */
	public function getUpdatedAt() {
		return $this->updatedAt;
	}

	/**
	 * @param mixed $updatedAt
	 */
	public function setUpdatedAt( $updatedAt ) {
		$this->updatedAt = $updatedAt;
	}

	/**
	 * @return mixed
	 */
	public function getQuantity() {
		return $this->quantity;
	}

	/**
	 * @param mixed $quantity
	 */
	public function setQuantity( $quantity ) {
		$this->quantity = $quantity;
	}

	/**
	 * @return mixed
	 */
	public function getUnitMeasurement() {
		return $this->unitMeasurement;
	}

	/**
	 * @param mixed $unitMeasurement
	 */
	public function setUnitMeasurement( $unitMeasurement ) {
		$this->unitMeasurement = $unitMeasurement;
	}

	/**
	 * @return mixed
	 */
	public function getDateApplication() {
		return $this->dateApplication;
	}

	/**
	 * @param mixed $dateApplication
	 */
	public function setDateApplication( $dateApplication ) {
		$this->dateApplication = $dateApplication;
	}
	
}
