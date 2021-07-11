<?php

namespace App\Entity;

use App\Repository\QuickCfgRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=QuickCfgRepository::class)
 */
class QuickCfg {
    
    use TimestampableEntity;
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $langue;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $timeZone;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $applyWinterHours;

    /**
     * @ORM\ManyToOne(targetEntity=WorkDuration::class, inversedBy="quickCfgs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $workDuration;

    public function getId(): ?int {
        return $this->id;
    }

    public function getNamed(): ?string {
        return $this->named;
    }

    public function setNamed(string $named): self {
        $this->named = $named;

        return $this;
    }

    public function getLangue(): ?string {
        return $this->langue;
    }

    public function setLangue(?string $langue): self {
        $this->langue = $langue;

        return $this;
    }

    public function getCountry(): ?string {
        return $this->country;
    }

    public function setCountry(?string $country): self {
        $this->country = $country;

        return $this;
    }

    public function getTimeZone(): ?string {
        return $this->timeZone;
    }

    public function setTimeZone(?string $timeZone): self {
        $this->timeZone = $timeZone;

        return $this;
    }

    public function getApplyWinterHours(): ?bool {
        return $this->applyWinterHours;
    }

    public function setApplyWinterHours(?bool $applyWinterHours): self {
        $this->applyWinterHours = $applyWinterHours;

        return $this;
    }

    public function getWeeklyWorkDuration(): ?string {
        return $this->weeklyWorkDuration;
    }

    public function setWeeklyWorkDuration(?string $weeklyWorkDuration): self {
        $this->weeklyWorkDuration = $weeklyWorkDuration;

        return $this;
    }

    public function getWorkDuration(): ?WorkDuration {
        return $this->workDuration;
    }

    public function setWorkDuration(?WorkDuration $workDuration): self {
        $this->workDuration = $workDuration;

        return $this;
    }
    
}
