<?php

namespace AppBundle\Entity;

/**
 * EntryTag
 */
class EntryTag
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Entries
     */
    private $entry;

    /**
     * @var \AppBundle\Entity\Tags
     */
    private $tag;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set entry
     *
     * @param \AppBundle\Entity\Entries $entry
     *
     * @return EntryTag
     */
    public function setEntry(\AppBundle\Entity\Entries $entry = null)
    {
        $this->entry = $entry;

        return $this;
    }

    /**
     * Get entry
     *
     * @return \AppBundle\Entity\Entries
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * Set tag
     *
     * @param \AppBundle\Entity\Tags $tag
     *
     * @return EntryTag
     */
    public function setTag(\AppBundle\Entity\Tags $tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return \AppBundle\Entity\Tags
     */
    public function getTag()
    {
        return $this->tag;
    }
}

