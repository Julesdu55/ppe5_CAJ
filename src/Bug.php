<?php
use Doctrine\Common\Collections\ArrayCollection;
// src/Bug.php
/**
 * @Entity @Table(name="bugs")
 **/
class Bug
{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     **/
    protected $id;
    /**
     * @Column(type="string",nullable=true)
     **/
    protected $resume;
    /**
     * @Column(type="string")
     **/
    protected $description;
    /**
     * @Column(type="string",nullable=true)
     */
    protected $capture;
    /**
     * @Column(type="datetime")
     **/
    protected $created;
    /**
     * @Column(type="string")
     **/
    protected $status;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="assignedBugs", cascade={"persist"})
     * @ORM\JoinColumn(name="engineer_id", referencedColumnName="id", nullable="true")
     **/
    protected $engineer;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="reportedBugs")
     **/
    protected $reporter;

    /**
     * @ManyToMany(targetEntity="Product")
     **/
    protected $products;
    /**
     * @Column(type="datetime",nullable=true)
     **/
    protected $resolution;

    public function getId()
    {
        return $this->id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setCreated(DateTime $created)
    {
        $this->created = $created;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $resume
     */
    public function setResume($resume)
    {
        $this->resume = $resume;
    }

    /**
     * @return mixed
     */
    public function getResume()
    {
        return $this->resume;
    }


    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function setEngineer($engineer)
    {
        $engineer->assignedToBug($this);
        $this->engineer = $engineer;
    }

    public function setReporter($reporter)
    {
        $reporter->addReportedBug($this);
        $this->reporter = $reporter;
    }

    public function getEngineer()
    {
        return $this->engineer;
    }

    public function getReporter()
    {
        return $this->reporter;
    }

    public function assignToProduct($product)
    {
        $this->products[] = $product;
    }

    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param mixed $resolution
     */
    public function setResolution($resolution)
    {
        $this->resolution = $resolution;
    }

    /**
     * @return mixed
     */
    public function getResolution()
    {
        return $this->resolution;
    }



    public function close()
    {
        $this->status = "CLOSE";
    }

    /**
     * @param mixed $capture
     */
    public function setCapture($capture)
    {
        $this->capture = $capture;
    }

    /**
     * @return mixed
     */
    public function getCapture()
    {
        return $this->capture;
    }

}