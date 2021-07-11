<?php

namespace App\Entity;

use App\Repository\DailyWorkDurationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

/**
 * @Broadcast()
 * @ORM\Entity(repositoryClass=DailyWorkDurationRepository::class)
 */
class DailyWorkDuration {
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $dayLong;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $dayShort;

    /**
     * @ORM\ManyToOne(targetEntity=WorkingDurationStore::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $morningHours;

    /**
     * @ORM\ManyToOne(targetEntity=WorkingDurationStore::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $afternoonHours;

    /**
     * @ORM\ManyToMany(targetEntity=WorkDuration::class, mappedBy="dailyDurations")
     */
    private $workDurations;

    public function __construct() {
        $this->workDurations = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getDayLong(): ?string {
        return $this->dayLong;
    }

    public function setDayLong(string $dayLong): self {
        $this->dayLong = $dayLong;

        return $this;
    }

    public function getDayShort(): ?string {
        return $this->dayShort;
    }

    public function setDayShort(string $dayShort): self {
        $this->dayShort = $dayShort;

        return $this;
    }

    public function getMorningHours(): ?WorkingDurationStore {
        return $this->morningHours;
    }

    public function setMorningHours(?WorkingDurationStore $morningHours): self {
        $this->morningHours = $morningHours;

        return $this;
    }

    public function getAfternoonHours(): ?WorkingDurationStore {
        return $this->afternoonHours;
    }

    public function setAfternoonHours(?WorkingDurationStore $afternoonHours): self {
        $this->afternoonHours = $afternoonHours;

        return $this;
    }

    /**
     * @return Collection|WorkDuration[]
     */
    public function getWorkDurations(): Collection {
        return $this->workDurations;
    }

    public function addWorkDuration(WorkDuration $workDuration): self {
        if (!$this->workDurations->contains($workDuration)) {
            $this->workDurations[] = $workDuration;
            $workDuration->addDailyDuration($this);
        }

        return $this;
    }

    public function removeWorkDuration(WorkDuration $workDuration): self {
        if ($this->workDurations->removeElement($workDuration)) {
            $workDuration->removeDailyDuration($this);
        }

        return $this;
    }
}
