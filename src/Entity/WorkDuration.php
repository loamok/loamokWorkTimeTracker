<?php

namespace App\Entity;

use App\Repository\WorkDurationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

/**
 * @Broadcast()
 * @ORM\Entity(repositoryClass=WorkDurationRepository::class)
 */
class WorkDuration {
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=DailyWorkDuration::class, inversedBy="workDurations")
     */
    private $dailyDurations;

    /**
     * @ORM\OneToMany(targetEntity=QuickCfg::class, mappedBy="workDuration")
     */
    private $quickCfgs;

    public function __construct() {
        $this->dailyDurations = new ArrayCollection();
        $this->quickCfgs = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(string $description): self {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|DailyWorkDuration[]
     */
    public function getDailyDurations(): Collection {
        return $this->dailyDurations;
    }

    public function addDailyDuration(DailyWorkDuration $dailyDuration): self {
        if (!$this->dailyDurations->contains($dailyDuration)) {
            $this->dailyDurations[] = $dailyDuration;
        }

        return $this;
    }

    public function removeDailyDuration(DailyWorkDuration $dailyDuration): self {
        $this->dailyDurations->removeElement($dailyDuration);

        return $this;
    }

    /**
     * @return Collection|QuickCfg[]
     */
    public function getQuickCfgs(): Collection {
        return $this->quickCfgs;
    }

    public function addQuickCfg(QuickCfg $quickCfg): self {
        if (!$this->quickCfgs->contains($quickCfg)) {
            $this->quickCfgs[] = $quickCfg;
            $quickCfg->setWorkDuration($this);
        }

        return $this;
    }

    public function removeQuickCfg(QuickCfg $quickCfg): self {
        if ($this->quickCfgs->removeElement($quickCfg)) {
            // set the owning side to null (unless already changed)
            if ($quickCfg->getWorkDuration() === $this) {
                $quickCfg->setWorkDuration(null);
            }
        }

        return $this;
    }
}
