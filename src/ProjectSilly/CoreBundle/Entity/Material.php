<?php

namespace ProjectSilly\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="materials")
 * @ORM\Entity()
 */
class Material {

	const TYPE_LINK = 'link';
	const TYPE_NETWORK = 'network';
	const TYPE_SEWER = 'sewer';

	/**
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @ORM\Column(name="type", type="string", columnDefinition="enum('link','network','sewer')", nullable=true)
	 */
	private $type;

	/**
	 * @ORM\Column(name="description", type="string", length=255, nullable=true)
	 */
	private $description;

	/**
	 * @ORM\Column(name="code", type="bigint", length=255, nullable=true)
	 */
	private $code;

	/**
	 * @ORM\Column(name="unit", type="string", length=255, nullable=true)
	 */
	private $unit;

	/**
	 * @ORM\OneToMany(targetEntity="ProjectSilly\CoreBundle\Entity\MaterialCustomer" , mappedBy="material" , cascade={"all"})
	 * */
	private $materialCustomer;

	/**
	 * @ORM\OneToMany(targetEntity="ProjectSilly\CoreBundle\Entity\MaterialPublicPlace" , mappedBy="material" , cascade={"all"})
	 * */
	private $materialPublicPlace;
	
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
	 * @return mixed
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param mixed $type
	 */
	public function setType( $type ) {
		$this->type = $type;
	}

	/**
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param mixed $description
	 */
	public function setDescription( $description ) {
		$this->description = $description;
	}

	/**
	 * @return mixed
	 */
	public function getCode() {
		return $this->code;
	}

	/**
	 * @param mixed $code
	 */
	public function setCode( $code ) {
		$this->code = $code;
	}

	/**
	 * @return mixed
	 */
	public function getUnit() {
		return $this->unit;
	}

	/**
	 * @param mixed $unit
	 */
	public function setUnit( $unit ) {
		$this->unit = $unit;
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
	public function getMaterialCustomer() {
		return $this->materialCustomer;
	}

	/**
	 * @return mixed
	 */
	public function getMaterialPublicPlace() {
		return $this->materialPublicPlace;
	}

	public function __toString() {
		return $this->getDescription();
	}
}
