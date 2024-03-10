<?php

namespace App\Entity;

use App\Repository\ReservasRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

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

    #[ORM\Column(type: Types::ARRAY)]
    private array $Estado = ['Pendiente', 'Confirmada', 'Cancelada'];

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $precioReserva = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $tipo_habitacion = ['Individual', 'Doble', 'Suite'];

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

    public function getEstado(): array
    {
        return $this->Estado;
    }

    public function setEstado(array $Estado): static
    {
        $this->Estado = $Estado;

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

    public function getTipoHabitacion(): array
    {
        return $this->tipo_habitacion;
    }

    public function setTipoHabitacion(array $tipo_habitacion): static
    {
        $this->tipo_habitacion = $tipo_habitacion;

        return $this;
    }
}
