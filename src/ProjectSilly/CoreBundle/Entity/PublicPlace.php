<?php

namespace ProjectSilly\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="public_places")
 * @ORM\Entity()
 */
class PublicPlace {

	const TYPE_AIRPORT = 'aeroporto';
	const TYPE_AVENUE = 'avenida';
	const TYPE_STREET = 'rua';
	const TYPE_PARK = 'parque';
	const TYPE_ROAD = 'estrada';
	const TYPE_YARD = 'jardim';
	const TYPE_ALLEY = 'viela';
	const TYPE_LANE = 'travessa';

	const TYPE_BED_ASPHALT = 'asphalt';
	const TYPE_BED_LAND = 'land';
	const TYPE_BED_CEMENTED = 'cemented';
	const TYPE_BED_BLOCKS = 'blocks';
	const TYPE_BED_PARALLELEPIPED = 'parallelepiped';
	const TYPE_BED_OTHERS = 'others';
	const TYPE_BED_MIRACEMA = 'miracema';
	const TYPE_BED_SPECIAL = 'special';

	const TYPE_RIDE_ASPHALT = 'asphalt';
	const TYPE_RIDE_LAND = 'land';
	const TYPE_RIDE_CEMENTED = 'cemented';
	const TYPE_RIDE_BLOCKS = 'blocks';
	const TYPE_RIDE_PARALLELEPIPED = 'parallelepiped';
	const TYPE_RIDE_OTHERS = 'others';
	const TYPE_RIDE_MIRACEMA = 'miracema';
	const TYPE_RIDE_SPECIAL = 'special';

	/**
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @ORM\Column(name="type_public_place", type="string", columnDefinition="enum('aeroporto','avenida','rua','parque','estrada','jardim','viela','travessa')")
	 */
	private $typePublicPlace;

	/**
	 * @ORM\Column(name="public_place", type="string", length=255, nullable=false)
	 */
	private $publicPlace;

	/**
	 * @ORM\Column(name="type_bed", type="string", columnDefinition="enum('asphalt','land','cemented','blocks','parallelepiped','others','miracema','special')")
	 * @Assert\NotBlank()
	 */
	private $typeBed;

	/**
	 * @ORM\Column(name="type_ride", type="string", columnDefinition="enum('asphalt','land','cemented','blocks','parallelepiped','others','miracema','special')")
	 * @Assert\NotBlank()
	 */
	private $typeRide;

	/**
	 * @var Customer
	 *
	 * @ORM\OneToMany(targetEntity="Customer", mappedBy="publicPlace")
	 */
	private $customer;

	/**
	 * @ORM\ManyToOne(targetEntity="ProjectSilly\CoreBundle\Entity\Area")
	 * @ORM\JoinColumn(name="fk_area", referencedColumnName="id", nullable=false)
	 * @Assert\NotBlank()
	 */
	private $area;

	/**
	 * @ORM\OneToMany(targetEntity="ProjectSilly\CoreBundle\Entity\MaterialPublicPlace", mappedBy="publicPlace", cascade={"all"})
	 * */
	private $materialPublicPlace;

	/**
	 * @var array
	 */
	private $materials;

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

	public function __construct() {
		$this->materialPublicPlace = new ArrayCollection();
		$this->materials           = new ArrayCollection();
	}

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
	 * @return mixed
	 */
	public function getTypePublicPlace() {
		return $this->typePublicPlace;
	}

	/**
	 * @param mixed $typePublicPlace
	 */
	public function setTypePublicPlace( $typePublicPlace ) {
		$this->typePublicPlace = $typePublicPlace;
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
	public function getTypeBed() {
		return $this->typeBed;
	}

	/**
	 * @param mixed $typeBed
	 */
	public function setTypeBed( $typeBed ) {
		$this->typeBed = $typeBed;
	}

	/**
	 * @return mixed
	 */
	public function getTypeRide() {
		return $this->typeRide;
	}

	/**
	 * @param mixed $typeRide
	 */
	public function setTypeRide( $typeRide ) {
		$this->typeRide = $typeRide;
	}

	/**
	 * @return Customer
	 */
	public function getCustomer() {
		return $this->customer;
	}

	/**
	 * @param Customer $customer
	 */
	public function setCustomer( Customer $customer ) {
		$this->customer = $customer;
	}

	/**
	 * @return Area
	 */
	public function getArea() {
		return $this->area;
	}

	/**
	 * @param Area $area
	 */
	public function setArea( Area $area ) {
		$this->area = $area;
	}

	/**
	 * @param MaterialPublicPlace $materialPublicPlace
	 *
	 * @return MaterialPublicPlace
	 */
	public function addMaterialPublicPlace( MaterialPublicPlace $materialPublicPlace ) {
		return $this->materialPublicPlace[] = $materialPublicPlace;
	}

	/**
	 * @param MaterialPublicPlace $materialPublicPlace
	 *
	 * @return mixed
	 */
	public function removeMaterialPublicPlace( MaterialPublicPlace $materialPublicPlace ) {
		return $this->materialPublicPlace->removeElement( $materialPublicPlace );
	}

	/**
	 * @return array
	 */
	public function getMaterials() {

		$materials = new ArrayCollection();

		foreach ( $this->materialPublicPlace as $mPublicPlace ) {
			if ( ! $mPublicPlace instanceof MaterialPublicPlace ) {
				continue;
			}

			$materials[] = $mPublicPlace;
		}

		return $materials;
	}

	/**
	 * @param $materials
	 */
	public function setMaterials( $materials ) {
		foreach ( $materials as $material ) {
			$materialPublicPlace = new MaterialPublicPlace();

			$materialPublicPlace->setPublicPlace( $this );
			$materialPublicPlace->setMaterial( $material );

			$this->addMaterialPublicPlace( $materialPublicPlace );
		}
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

	public function __toString() {
		return $this->getTypePublicPlace() . " " . $this->getPublicPlace();
	}


}
