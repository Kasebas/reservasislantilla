<?php

namespace App\Entity;

use App\Repository\ReservasRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ReservasRepository::class)]
class Reservas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'reservas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuarios $id_usuario = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha_checkin = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha_checkout = null;

    #[ORM\Column(type: 'string', length: 20)]
    #[Assert\Choice(choices: ['Pendiente', 'Confirmada', 'Cancelada'])]
    private string $estado = 'Pendiente';

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $precioReserva = null;

    #[ORM\Column(type: 'string', length: 20)]
    #[Assert\Choice(choices: ['Individual', 'Doble', 'Suite'])]
    private string $tipoHabitacion = 'Individual';

    #[ORM\Column]
    private ?bool $deleted = false;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUsuario(): ?Usuarios
    {
        return $this->id_usuario;
    }

    public function setIdUsuario(?Usuarios $id_usuario): static
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }

    public function getFechaCheckin(): ?\DateTimeInterface
    {
        return $this->fecha_checkin;
    }

    public function setFechaCheckin(\DateTimeInterface $fecha_checkin): static
    {
        $this->fecha_checkin = $fecha_checkin;

        return $this;
    }

    public function getFechaCheckout(): ?\DateTimeInterface
    {
        return $this->fecha_checkout;
    }

    public function setFechaCheckout(\DateTimeInterface $fecha_checkout): static
    {
        $this->fecha_checkout = $fecha_checkout;

        return $this;
    }

    public function getEstado(): string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): static
    {
        $this->estado = $estado;

        return $this;
    }

    public function getPrecioReserva(): ?string
    {
        return $this->precioReserva;
    }

    public function setPrecioReserva(string $precioReserva): static
    {
        $this->precioReserva = $precioReserva;

        return $this;
    }

    public function getTipoHabitacion(): string
    {
        return $this->tipoHabitacion;
    }

    public function setTipoHabitacion(string $tipoHabitacion): static
    {
        $this->tipoHabitacion = $tipoHabitacion;

        return $this;
    }

    public function isDeleted(): ?bool
    {
        return $this->deleted;
    }

    public function setDeleted(bool $deleted): static
    {
        $this->deleted = $deleted;

        return $this;
    }
}
