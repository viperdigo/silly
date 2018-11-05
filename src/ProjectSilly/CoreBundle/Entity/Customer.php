<?php

namespace ProjectSilly\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="customers")
 * @ORM\Entity(repositoryClass="ProjectSilly\CoreBundle\Repository\CustomerRepository")
 */
class Customer
{
    const PROPERTY_RELATIONSHIP_OWNER = 'owner';
    const PROPERTY_RELATIONSHIP_TENANT = 'tenant';

	const TYPE_ECONOMY_RESIDENTIAL = 'residential';
	const TYPE_ECONOMY_MERCHANT = 'merchant';
	const TYPE_ECONOMY_INDUSTRIAL = 'industrial';
	const TYPE_ECONOMY_PUBLIC = 'public';

	const SERVICE_NEW_LINK = 'new link';
	const SERVICE_CONSUME_ZERO_WITH_EXCHANGE = 'consume zero with exchange';
	const SERVICE_CONSUME_ZERO_WITHOUT_EXCHANGE = 'consume zero without exchange';
	const SERVICE_INACTIVE_WITH_EXCHANGE = 'inactive with exchange';
	const SERVICE_INACTIVE_WITHOUT_EXCHANGE = 'inactive without exchange';

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

	/**
	 * @ORM\ManyToOne(targetEntity="ProjectSilly\CoreBundle\Entity\PublicPlace")
	 * @ORM\JoinColumn(name="fk_public_place", referencedColumnName="id")
	 * @Assert\NotBlank()
	 */
	private $publicPlace;

    /**
     * @ORM\Column(name="rgi", type="integer", nullable=true)
     */
    private $rgi;

    /**
     * @ORM\Column(name="codification", type="string", length=255, nullable=true)
     */
    private $codification;

    /**
     * @ORM\Column(name="hydrometer", type="string", length=255, nullable=true)
     */
    private $hydrometer;

	/**
	 * @ORM\Column(name="seal_link", type="string", length=10, nullable=true)
	 */
	private $sealLink;

    /**
     * @ORM\Column(name="tl", type="string", length=255, nullable=true)
     */
    private $tl;

	/**
	 * @ORM\Column(name="service_one", type="string", columnDefinition="enum('new link','consume zero with exchange','consume zero without exchange','inactive with exchange','inactive without exchange')", nullable=true)
	 */
    private $serviceOne;

    /**
     * @ORM\Column(name="service_two", type="string", length=255, nullable=true)
     */
    private $serviceTwo;

    /**
     * @ORM\Column(name="social_tariff", type="string", length=255, nullable=true)
     */
    private $socialTariff;

    /**
     * @ORM\Column(name="expiration_social_tariff", type="datetime", nullable=true)
     */
    private $expirationSocialTariff;

    /**
     * @ORM\Column(name="number", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $number;

    /**
     * @ORM\Column(name="complement", type="string", length=255, nullable=true)
     */
    private $complement;

    /**
     * @ORM\Column(name="zipcode", type="string", length=8 , nullable=true)
     */
    private $zipcode;

    /**
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(name="document", type="string", length=13, nullable=true)
     */
    private $document;

    /**
     * @ORM\Column(name="social_security", type="string", length=255, nullable=true)
     */
    private $socialSecurity;

    /**
     * @ORM\Column(name="birthday_date", type="date", nullable=true)
     */
    private $birthdayDate;

    /**
     * @ORM\Column(name="home_phone", type="string", length=255, nullable=true)
     */
    private $homePhone;

    /**
     * @ORM\Column(name="cell_phone", type="string", length=255, nullable=true)
     */
    private $cellPhone;

    /**
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(name="water_tank", type="boolean")
     */
    private $waterTank;

    /**
     * @ORM\Column(name="property_relationship", type="string", columnDefinition="enum('owner','tenant')", nullable=true)
     */
    private $propertyRelationship;

    /**
     * @ORM\Column(name="time_occupation", type="integer", length=10, nullable=true)
     */
    private $timeOccupation;

    /**
     * @ORM\Column(name="amount_mature", type="integer", length=10, nullable=true)
     */
    private $amountMature;

	/**
	 * @ORM\Column(name="amount_children", type="integer", length=10, nullable=true)
	 */
	private $amountChildren;

	/**
	 * @ORM\Column(name="type_economy", type="string", columnDefinition="enum('residential','merchant','industrial','public')", nullable=true)
	 */
	private $typeEconomy;

    /**
     * @ORM\Column(name="saving_amount", type="integer", length=10, nullable=true)
     */
    private $savingAmount;

    /**
     * @ORM\Column(name="branch_activity", type="string", length=255, nullable=true)
     */
    private $branchActivity;

    /**
     * @ORM\Column(name="date_register", type="date", nullable=true)
     */
    private $dateRegister;

    /**
     * @ORM\Column(name="date_link", type="date", nullable=true)
     */
    private $dateLink;

	/**
	 * @ORM\OneToMany(targetEntity="ProjectSilly\CoreBundle\Entity\MaterialCustomer", mappedBy="customer", cascade={"all"})
	 * */
	private $materialCustomer;

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
		$this->materialCustomer = new ArrayCollection();
		$this->materials = new ArrayCollection();
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
	 * @return PublicPlace
	 */
	public function getPublicPlace() {
		return $this->publicPlace;
	}

	/**
	 * @param PublicPlace $publicPlace
	 */
	public function setPublicPlace(PublicPlace $publicPlace ) {
		$this->publicPlace = $publicPlace;
	}

	/**
	 * @return mixed
	 */
	public function getArea() {
		return $this->area;
	}

	/**
	 * @param mixed $area
	 */
	public function setArea( $area ) {
		$this->area = $area;
	}

	/**
	 * @return mixed
	 */
	public function getRgi() {
		return $this->rgi;
	}

	/**
	 * @param mixed $rgi
	 */
	public function setRgi( $rgi ) {
		$this->rgi = $rgi;
	}

	/**
	 * @return mixed
	 */
	public function getCodification() {
		return $this->codification;
	}

	/**
	 * @param mixed $codification
	 */
	public function setCodification( $codification ) {
		$this->codification = $codification;
	}

	/**
	 * @return mixed
	 */
	public function getHydrometer() {
		return $this->hydrometer;
	}

	/**
	 * @param mixed $hydrometer
	 */
	public function setHydrometer( $hydrometer ) {
		$this->hydrometer = $hydrometer;
	}

	/**
	 * @return mixed
	 */
	public function getTl() {
		return $this->tl;
	}

	/**
	 * @param mixed $tl
	 */
	public function setTl( $tl ) {
		$this->tl = $tl;
	}

	/**
	 * @return mixed
	 */
	public function getServiceOne() {
		return $this->serviceOne;
	}

	/**
	 * @param mixed $serviceOne
	 */
	public function setServiceOne( $serviceOne ) {
		$this->serviceOne = $serviceOne;
	}

	/**
	 * @return mixed
	 */
	public function getServiceTwo() {
		return $this->serviceTwo;
	}

	/**
	 * @param mixed $serviceTwo
	 */
	public function setServiceTwo( $serviceTwo ) {
		$this->serviceTwo = $serviceTwo;
	}

	/**
	 * @return mixed
	 */
	public function getSocialTariff() {
		return $this->socialTariff;
	}

	/**
	 * @param mixed $socialTariff
	 */
	public function setSocialTariff( $socialTariff ) {
		$this->socialTariff = $socialTariff;
	}

	/**
	 * @return mixed
	 */
	public function getExpirationSocialTariff() {
		return $this->expirationSocialTariff;
	}

	/**
	 * @param mixed $expirationSocialTariff
	 */
	public function setExpirationSocialTariff( $expirationSocialTariff ) {
		$this->expirationSocialTariff = $expirationSocialTariff;
	}

	/**
	 * @return mixed
	 */
	public function getNumber() {
		return $this->number;
	}

	/**
	 * @param mixed $number
	 */
	public function setNumber( $number ) {
		$this->number = $number;
	}

	/**
	 * @return mixed
	 */
	public function getComplement() {
		return $this->complement;
	}

	/**
	 * @param mixed $complement
	 */
	public function setComplement( $complement ) {
		$this->complement = $complement;
	}

	/**
	 * @return mixed
	 */
	public function getZipcode() {
		return $this->zipcode;
	}

	/**
	 * @param mixed $zipcode
	 */
	public function setZipcode( $zipcode ) {
		$this->zipcode = $zipcode;
	}

	/**
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName( $name ) {
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getDocument() {
		return $this->document;
	}

	/**
	 * @param mixed $document
	 */
	public function setDocument( $document ) {
		$this->document = $document;
	}

	/**
	 * @return mixed
	 */
	public function getSocialSecurity() {
		return $this->socialSecurity;
	}

	/**
	 * @param mixed $socialSecurity
	 */
	public function setSocialSecurity( $socialSecurity ) {
		$this->socialSecurity = $socialSecurity;
	}

	/**
	 * @return mixed
	 */
	public function getBirthdayDate() {
		return $this->birthdayDate;
	}

	/**
	 * @param mixed $birthdayDate
	 */
	public function setBirthdayDate( $birthdayDate ) {
		$this->birthdayDate = $birthdayDate;
	}

	/**
	 * @return mixed
	 */
	public function getHomePhone() {
		return $this->homePhone;
	}

	/**
	 * @param mixed $homePhone
	 */
	public function setHomePhone( $homePhone ) {
		$this->homePhone = $homePhone;
	}

	/**
	 * @return mixed
	 */
	public function getCellPhone() {
		return $this->cellPhone;
	}

	/**
	 * @param mixed $cellPhone
	 */
	public function setCellPhone( $cellPhone ) {
		$this->cellPhone = $cellPhone;
	}

	/**
	 * @return mixed
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param mixed $email
	 */
	public function setEmail( $email ) {
		$this->email = $email;
	}

	/**
	 * @return mixed
	 */
	public function getWaterTank() {
		return $this->waterTank;
	}

	/**
	 * @param mixed $waterTank
	 */
	public function setWaterTank( $waterTank ) {
		$this->waterTank = $waterTank;
	}

	/**
	 * @return mixed
	 */
	public function getPropertyRelationship() {
		return $this->propertyRelationship;
	}

	/**
	 * @param mixed $propertyRelationship
	 */
	public function setPropertyRelationship( $propertyRelationship ) {
		$this->propertyRelationship = $propertyRelationship;
	}

	/**
	 * @return mixed
	 */
	public function getTimeOccupation() {
		return $this->timeOccupation;
	}

	/**
	 * @param mixed $timeOccupation
	 */
	public function setTimeOccupation( $timeOccupation ) {
		$this->timeOccupation = $timeOccupation;
	}

	/**
	 * @return mixed
	 */
	public function getAmountMature() {
		return $this->amountMature;
	}

	/**
	 * @param mixed $amountMature
	 */
	public function setAmountMature( $amountMature ) {
		$this->amountMature = $amountMature;
	}

	/**
	 * @return mixed
	 */
	public function getAmountChildren() {
		return $this->amountChildren;
	}

	/**
	 * @param mixed $amountChildren
	 */
	public function setAmountChildren( $amountChildren ) {
		$this->amountChildren = $amountChildren;
	}

	/**
	 * @return mixed
	 */
	public function getTypeEconomy() {
		return $this->typeEconomy;
	}

	/**
	 * @param mixed $typeEconomy
	 */
	public function setTypeEconomy( $typeEconomy ) {
		$this->typeEconomy = $typeEconomy;
	}

	/**
	 * @return mixed
	 */
	public function getSavingAmount() {
		return $this->savingAmount;
	}

	/**
	 * @param mixed $savingAmount
	 */
	public function setSavingAmount( $savingAmount ) {
		$this->savingAmount = $savingAmount;
	}

	/**
	 * @return mixed
	 */
	public function getBranchActivity() {
		return $this->branchActivity;
	}

	/**
	 * @param mixed $branchActivity
	 */
	public function setBranchActivity( $branchActivity ) {
		$this->branchActivity = $branchActivity;
	}

	/**
	 * @return mixed
	 */
	public function getDateRegister() {
		return $this->dateRegister;
	}

	/**
	 * @param mixed $dateRegister
	 */
	public function setDateRegister( $dateRegister ) {
		$this->dateRegister = $dateRegister;
	}

	/**
	 * @return mixed
	 */
	public function getDateLink() {
		return $this->dateLink;
	}

	/**
	 * @param mixed $dateLink
	 */
	public function setDateLink( $dateLink ) {
		$this->dateLink = $dateLink;
	}

	/**
	 * @param MaterialCustomer $materialCustomer
	 *
	 * @return MaterialCustomer
	 */
	public function addMaterialCustomer(MaterialCustomer $materialCustomer) {
		return $this->materialCustomer[] = $materialCustomer;
	}

	/**
	 * @param MaterialCustomer $materialCustomer
	 *
	 * @return bool
	 */
	public function removeMaterialCustomer(MaterialCustomer $materialCustomer) {
		return $this->materialCustomer->removeElement($materialCustomer);
	}

	/**
	 * @return array
	 */
	public function getMaterials() {

		$materials = new ArrayCollection();

		foreach($this->materialCustomer as $mCustomer)
		{
			if(!$mCustomer instanceof MaterialCustomer)
			{
				continue;
			}

			$materials[] = $mCustomer;
		}
		return $materials;
	}

	/**
	 * @param $materials
	 */
	public function setMaterials( $materials ) {
		foreach($materials as $material)
		{
			$materialCustomer = new MaterialCustomer();

			$materialCustomer->setCustomer($this);
			$materialCustomer->setMaterial($material);

			$this->addMaterialCustomer($materialCustomer);
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

	/**
	 * @return mixed
	 */
	public function getSealLink() {
		return $this->sealLink;
	}

	/**
	 * @param mixed $sealLink
	 */
	public function setSealLink( $sealLink ) {
		$this->sealLink = $sealLink;
	}
	
}
