<?php

namespace ProjectSilly\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="areas")
 * @ORM\Entity()
 */
class Area
{
    const UGR_SANTANA = 'santana';
    const UGR_FREGUESIA = 'freguesia';
    const UGR_PIRITUBA = 'pirituba';
    const UGR_EXTREMO_NORTE = 'extremo norte';
    const UGR_BRAGANTINA = 'bragantina';

	const YES ='yes';
	const NO = 'no';
	const PARTIAL = 'partial';

	const RELEASE_PLOY = 'ploy';

	const POLO_VILA_MARIA = 'vila maria';
	const POLO_SANTANA = 'santana';
	const POLO_FREGUESIA = 'freguesia';
	const POLO_PIRITUBA = 'pirituba';
	const POLO_FRANCO_DA_ROCHA = 'franco da rocha';
	const POLO_BRAGANCA = 'braganca';
	const POLO_SOCORRO = 'socorro';

	const PROPERTY_TOWNHALL = 'townhall';
	const PROPERTY_STATE = 'state';
	const PROPERTY_PRIVATE = 'private';
	const PROPERTY_OTHERS = 'others';

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(name="ugr", type="string", columnDefinition="enum('santana','freguesia','pirituba','extremo norte','bragantina')")
     * @Assert\NotBlank()
     */
    private $ugr;

    /**
     * @var PublicPlace
     *
     * @ORM\OneToMany(targetEntity="PublicPlace", mappedBy="area")
     */
    private $publicPlace;

    /**
     * @ORM\Column(name="polo", type="string", columnDefinition="enum('vila maria','santana','freguesia','pirituba','franco da rocha','braganca','socorro')", nullable=true)
     */
    private $polo;

    /**
     * @ORM\Column(name="liberation", type="string", columnDefinition="enum('yes','no','ploy')", nullable=true)
     */
    private $liberation;

    /**
     * @ORM\Column(name="date_liberation", type="date", nullable=true)
     */
    private $dateLiberation;

    /**
     * @ORM\Column(name="property", type="string", columnDefinition="enum('townhall','state','private','others')", nullable=true)
     */
    private $property;

    /**
     * @ORM\Column(name="eletric_energy", type="string", columnDefinition="enum('yes','no','partial')", nullable=true)
     */
    private $eletricEnergy;

    /**
     * @ORM\Column(name="garbage_collection", type="string", columnDefinition="enum('yes','no','partial')", nullable=true)
     */
    private $garbageCollection;

    /**
     * @ORM\Column(name="street_lighting", type="string", columnDefinition="enum('yes','no','partial')", nullable=true)
     */
    private $streetLighting;

    /**
     * @ORM\Column(name="type_housing", type="string", length=255, nullable=true)
     */
    private $typeHousing;

    /**
     * @ORM\Column(name="contact_leadership", type="string", length=255, nullable=true)
     */
    private $contactLeadership;

    /**
     * @ORM\Column(name="social_action", type="boolean", nullable=true)
     */
    private $socialAction;

    /**
     * @ORM\Column(name="date_social_action", type="date", nullable=true)
     */
    private $dateSocialAction;

    /**
     * @ORM\Column(name="estimated_links", type="string", length=255, nullable=true)
     */
    private $estimatedLinks;

    /**
     * @ORM\Column(name="accepts_backhoe", type="boolean")
     */
    private $acceptsBackhoe;

    /**
     * @ORM\Column(name="sewer", type="string", columnDefinition="enum('yes','no','partial')", nullable=true)
     */
    private $sewer;

    /**
     * @ORM\Column(name="sense_cadastral", type="string", columnDefinition="enum('yes','no','partial')", nullable=true)
     */
    private $senseCadastral;

    /**
     * @ORM\Column(name="date_sense_cadastral", type="date", nullable=true)
     */
    private $dateSenseCadastral;

    /**
     * @ORM\Column(name="sketches", type="string", columnDefinition="enum('yes','no','partial')", nullable=true)
     */
    private $sketches;

    /**
     * @ORM\Column(name="date_sketches", type="date", nullable=true)
     */
    private $dateSketches;

    /**
     * @ORM\Column(name="design", type="string", columnDefinition="enum('yes','no','partial')", nullable=true)
     */
    private $design;

    /**
     * @ORM\Column(name="date_design", type="date", nullable=true)
     */
    private $dateDesign;

    /**
     * @ORM\Column(name="creating_rgi", type="string", columnDefinition="enum('yes','no','partial')", nullable=true)
     */
    private $creatingRgi;

    /**
     * @ORM\Column(name="date_creating_rgi", type="date", nullable=true)
     */
    private $dateCreatingRgi;

    /**
     * @ORM\Column(name="low_signs", type="string", columnDefinition="enum('yes','no','partial')", nullable=true)
     */
    private $lowSigns;

    /**
     * @ORM\Column(name="date_low_signs", type="date", nullable=true)
     */
    private $dateLowSigns;

    /**
     * @ORM\Column(name="date_prevision_start_project", type="date", nullable=true)
     */
    private $datePrevisionStartProject;

    /**
     * @ORM\Column(name="date_prevision_end_project", type="date", nullable=true)
     */
    private $datePrevisionEndProject;

    /**
     * @ORM\Column(name="filed_documentation", type="string", columnDefinition="enum('yes','no','partial')", nullable=true)
     */
    private $filedDocumentation;

    /**
     * @ORM\Column(name="comments", type="string", length=255, nullable=true)
     */
    private $comments;

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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return PublicPlace
     */
    public function getPublicPlace()
    {
        return $this->publicPlace;
    }

    /**
     * @param PublicPlace $publicPlace
     */
    public function setPublicPlace($publicPlace)
    {
        $this->publicPlace = $publicPlace;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getUgr()
    {
        return $this->ugr;
    }

    /**
     * @param mixed $ugr
     */
    public function setUgr($ugr)
    {
        $this->ugr = $ugr;
    }

    /**
     * @return mixed
     */
    public function getPolo()
    {
        return $this->polo;
    }

    /**
     * @param mixed $polo
     */
    public function setPolo($polo)
    {
        $this->polo = $polo;
    }

    /**
     * @return mixed
     */
    public function getLiberation() {
        return $this->liberation;
    }

    /**
     * @param mixed $liberation
     */
    public function setLiberation( $liberation ) {
        $this->liberation = $liberation;
    }
    
    /**
     * @return mixed
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * @param mixed $property
     */
    public function setProperty($property)
    {
        $this->property = $property;
    }

    /**
     * @return mixed
     */
    public function getEletricEnergy()
    {
        return $this->eletricEnergy;
    }

    /**
     * @param mixed $eletricEnergy
     */
    public function setEletricEnergy($eletricEnergy)
    {
        $this->eletricEnergy = $eletricEnergy;
    }

    /**
     * @return mixed
     */
    public function getGarbageCollection()
    {
        return $this->garbageCollection;
    }

    /**
     * @param mixed $garbageCollection
     */
    public function setGarbageCollection($garbageCollection)
    {
        $this->garbageCollection = $garbageCollection;
    }

    /**
     * @return mixed
     */
    public function getStreetLighting()
    {
        return $this->streetLighting;
    }

    /**
     * @param mixed $streetLighting
     */
    public function setStreetLighting($streetLighting)
    {
        $this->streetLighting = $streetLighting;
    }

    /**
     * @return mixed
     */
    public function getTypeHousing()
    {
        return $this->typeHousing;
    }

    /**
     * @param mixed $typeHousing
     */
    public function setTypeHousing($typeHousing)
    {
        $this->typeHousing = $typeHousing;
    }

    /**
     * @return mixed
     */
    public function getContactLeadership()
    {
        return $this->contactLeadership;
    }

    /**
     * @param mixed $contactLeadership
     */
    public function setContactLeadership($contactLeadership)
    {
        $this->contactLeadership = $contactLeadership;
    }

    /**
     * @return mixed
     */
    public function getSocialAction()
    {
        return $this->socialAction;
    }

    /**
     * @param mixed $socialAction
     */
    public function setSocialAction($socialAction)
    {
        $this->socialAction = $socialAction;
    }

    /**
     * @return mixed
     */
    public function getEstimatedLinks()
    {
        return $this->estimatedLinks;
    }

    /**
     * @param mixed $estimatedLinks
     */
    public function setEstimatedLinks($estimatedLinks)
    {
        $this->estimatedLinks = $estimatedLinks;
    }

    /**
     * @return mixed
     */
    public function getAcceptsBackhoe() {
        return $this->acceptsBackhoe;
    }

    /**
     * @param mixed $acceptsBackhoe
     */
    public function setAcceptsBackhoe( $acceptsBackhoe ) {
        $this->acceptsBackhoe = $acceptsBackhoe;
    }

    /**
     * @return mixed
     */
    public function getSewer()
    {
        return $this->sewer;
    }

    /**
     * @param mixed $sewer
     */
    public function setSewer($sewer)
    {
        $this->sewer = $sewer;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * @return mixed
     */
    public function getDateLiberation() {
        return $this->dateLiberation;
    }

    /**
     * @param mixed $dateLiberation
     */
    public function setDateLiberation( $dateLiberation ) {
        $this->dateLiberation = $dateLiberation;
    }

    /**
     * @return mixed
     */
    public function getDateSocialAction() {
        return $this->dateSocialAction;
    }

    /**
     * @param mixed $dateSocialAction
     */
    public function setDateSocialAction( $dateSocialAction ) {
        $this->dateSocialAction = $dateSocialAction;
    }

    /**
     * @return mixed
     */
    public function getSenseCadastral() {
        return $this->senseCadastral;
    }

    /**
     * @param mixed $senseCadastral
     */
    public function setSenseCadastral( $senseCadastral ) {
        $this->senseCadastral = $senseCadastral;
    }

    /**
     * @return mixed
     */
    public function getDateSenseCadastral() {
        return $this->dateSenseCadastral;
    }

    /**
     * @param mixed $dateSenseCadastral
     */
    public function setDateSenseCadastral( $dateSenseCadastral ) {
        $this->dateSenseCadastral = $dateSenseCadastral;
    }

    /**
     * @return mixed
     */
    public function getSketches() {
        return $this->sketches;
    }

    /**
     * @param mixed $sketches
     */
    public function setSketches( $sketches ) {
        $this->sketches = $sketches;
    }

    /**
     * @return mixed
     */
    public function getDateSketches() {
        return $this->dateSketches;
    }

    /**
     * @param mixed $dateSketches
     */
    public function setDateSketches( $dateSketches ) {
        $this->dateSketches = $dateSketches;
    }

    /**
     * @return mixed
     */
    public function getDesign() {
        return $this->design;
    }

    /**
     * @param mixed $design
     */
    public function setDesign( $design ) {
        $this->design = $design;
    }

    /**
     * @return mixed
     */
    public function getDateDesign() {
        return $this->dateDesign;
    }

    /**
     * @param mixed $dateDesign
     */
    public function setDateDesign( $dateDesign ) {
        $this->dateDesign = $dateDesign;
    }

    /**
     * @return mixed
     */
    public function getCreatingRgi() {
        return $this->creatingRgi;
    }

    /**
     * @param mixed $creatingRgi
     */
    public function setCreatingRgi( $creatingRgi ) {
        $this->creatingRgi = $creatingRgi;
    }

    /**
     * @return mixed
     */
    public function getDateCreatingRgi() {
        return $this->dateCreatingRgi;
    }

    /**
     * @param mixed $dateCreatingRgi
     */
    public function setDateCreatingRgi( $dateCreatingRgi ) {
        $this->dateCreatingRgi = $dateCreatingRgi;
    }

    /**
     * @return mixed
     */
    public function getLowSigns() {
        return $this->lowSigns;
    }

    /**
     * @param mixed $lowSigns
     */
    public function setLowSigns( $lowSigns ) {
        $this->lowSigns = $lowSigns;
    }

    /**
     * @return mixed
     */
    public function getDateLowSigns() {
        return $this->dateLowSigns;
    }

    /**
     * @param mixed $dateLowSigns
     */
    public function setDateLowSigns( $dateLowSigns ) {
        $this->dateLowSigns = $dateLowSigns;
    }

    /**
     * @return mixed
     */
    public function getDatePrevisionStartProject() {
        return $this->datePrevisionStartProject;
    }

    /**
     * @param mixed $datePrevisionStartProject
     */
    public function setDatePrevisionStartProject( $datePrevisionStartProject ) {
        $this->datePrevisionStartProject = $datePrevisionStartProject;
    }

    /**
     * @return mixed
     */
    public function getDatePrevisionEndProject() {
        return $this->datePrevisionEndProject;
    }

    /**
     * @param mixed $datePrevisionEndProject
     */
    public function setDatePrevisionEndProject( $datePrevisionEndProject ) {
        $this->datePrevisionEndProject = $datePrevisionEndProject;
    }

    /**
     * @return mixed
     */
    public function getFiledDocumentation() {
        return $this->filedDocumentation;
    }

    /**
     * @param mixed $filedDocumentation
     */
    public function setFiledDocumentation( $filedDocumentation ) {
        $this->filedDocumentation = $filedDocumentation;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
