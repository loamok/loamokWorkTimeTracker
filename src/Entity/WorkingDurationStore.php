<?php

namespace App\Entity;

use App\Repository\WorkingDurationStoreRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

/**
 * @Broadcast()
 * @ORM\Entity(repositoryClass=WorkingDurationStoreRepository::class)
 */
class WorkingDurationStore {
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time_immutable")
     */
    private $start;

    /**
     * @ORM\Column(type="time_immutable")
     */
    private $end;

    public function getId(): ?int {
        return $this->id;
    }

    public function getStart(): ?\DateTimeImmutable {
        return $this->start;
    }

    public function setStart(\DateTimeImmutable $start): self {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeImmutable {
        return $this->end;
    }

    public function setEnd(\DateTimeImmutable $end): self {
        $this->end = $end;

        return $this;
    }
}
