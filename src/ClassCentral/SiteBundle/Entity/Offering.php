<?php

namespace ClassCentral\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ClassCentral\SiteBundle\Entity\Offering
 */
class Offering {

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var date $startDate
     */
    private $startDate;

    /**
     * @var date $endDate
     */
    private $endDate;

    /**
     * @var boolean $exactDatesKnow
     */
    private $exactDatesKnow;

    /**
     * @var datetime $created
     */
    private $created;

    /**
     * @var datetime $modified
     */
    private $modified;

    /**
     * @var ClassCentral\SiteBundle\Entity\Course
     */
    private $course;

    /**
     * @var ClassCentral\SiteBundle\Entity\Initiative
     */
    private $initiative;

    /**
     *
     * @var string $url
     */
    private $url;

    /**
     * If this field is null then the course name will be displayed
     * @var string $name
     */
    private $name;

    /**
     *
     * @var string $videoIntro
     */
    private $videoIntro;

    /**
     * 
     * @var integer length
     */
    private $length;

    /**
     * This fields holds the status of the course. The values map as follows
     * 0 - Exact dates not know. Should show something like NA
     * 1 - Exact dates known
     * 2 - Exact dates not known, but month is availaible
     * 3 - Course is unavailaible and should not be shown anywhere
     * @var status
     */
    private $status;
    private $instructors;

    public function __construct() {
        $this->instructors = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set startDate
     *
     * @param date $startDate
     */
    public function setStartDate($startDate) {
        $this->startDate = $startDate;
    }

    /**
     * Get startDate
     *
     * @return date 
     */
    public function getStartDate() {
        return $this->startDate;
    }

    public function getStartTimestamp() {
        return strval($this->startDate->getTimestamp());
    }

    /**
     * Set endDate
     *
     * @param date $endDate
     */
    public function setEndDate($endDate) {
        $this->endDate = $endDate;
    }

    /**
     * Get endDate
     *
     * @return date 
     */
    public function getEndDate() {
        return $this->endDate;
    }

    /**
     * Set exactDatesKnow
     *
     * @param boolean $exactDatesKnow
     */
    public function setExactDatesKnow($exactDatesKnow) {
        $this->exactDatesKnow = $exactDatesKnow;
    }

    /**
     * Get exactDatesKnow
     *
     * @return boolean 
     */
    public function getExactDatesKnow() {
        return $this->exactDatesKnow;
    }

    /**
     * Set created
     *
     * @param datetime $created
     */
    public function setCreated($created) {
        $this->created = $created;
    }

    /**
     * Get created
     *
     * @return datetime 
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * Set modified
     *
     * @param datetime $modified
     */
    public function setModified($modified) {
        $this->modified = $modified;
    }

    /**
     * Get modified
     *
     * @return datetime 
     */
    public function getModified() {
        return $this->modified;
    }

    /**
     * Set course
     *
     * @param ClassCentral\SiteBundle\Entity\Course $course
     */
    public function setCourse(\ClassCentral\SiteBundle\Entity\Course $course) {
        $this->course = $course;
    }

    /**
     * Get course
     *
     * @return ClassCentral\SiteBundle\Entity\Course 
     */
    public function getCourse() {
        return $this->course;
    }

    /**
     * Set initiative
     * 
     * @param ClassCEntral\SiteBundle\Entitiy\Offering $offering
     */
    public function setInitiative(\ClassCentral\SiteBundle\Entity\Initiative $initiative = null) {
        $this->initiative = $initiative;
    }

    /**
     * Get Initative
     * 
     * @return ClassCentral\SiteBundle\Entity\Initiative
     */
    public function getInitiative() {
        return $this->initiative;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        if (empty($this->name) && isset($this->course)) {
            return $this->course->getName();
        }

        return $this->name;
    }

    public function getDisplayDate() {
        switch ($this->status) {
            case self::START_DATES_UNKNOWN:
                return "NA";
                break;
            case self::START_DATES_KNOWN:
                return $this->getStartDate()->format('jS M, Y');
                break;
            case self::START_MONTH_KNOW:
                return $this->getStartDate()->format('M, Y');
                break;
            default:
                return '';
        }
       
    }

    public function getUrl() {        
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getVideoIntro() {
        return $this->videoIntro;
    }

    public function setVideoIntro($videoIntro) {
        $this->videoIntro = $videoIntro;
    }

    public function getLength() {
        return $this->length;
    }

    public function setLength($length) {
        $this->length = $length;
    }

    public function getInstructors() {
        return $this->instructors;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    /**
    * Value that the status for offering can take
    *
    */
    const START_DATES_UNKNOWN = 0;
    const START_DATES_KNOWN = 1;
    const START_MONTH_KNOW = 2;
    const COURSE_NA = 3;
  
    /**
    * Returns a list of statuses
    * @return array
    */
    public static function getStatuses(){
        return array(
            self::START_DATES_UNKNOWN => 'Start Dates Unknown',
            self::START_DATES_KNOWN => 'Start Dates Known',
            self::START_MONTH_KNOW => 'Start Month Known',
            self::COURSE_NA => 'Course not available',
        );
    }

}
