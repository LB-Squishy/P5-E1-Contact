<?php

class Contact {

    private $id;
    private $name;
    private $email;
    private $phone_number;

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?string $id): void {
        $this->id = $id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $name): void {
        $this->name = $name;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(?string $email): void {
        $this->email = $email;
    }

    public function getPhoneNumber(): ?string {
        return $this->phone_number;
    }

    public function setPhoneNumber(?string $phone_number): void {
        $this->phone_number = $phone_number;
    }

    public function __toString(): string {
        return $this->getId(). ', ' . $this->getName(). ', ' . $this->getEmail(). ', ' . $this->getPhoneNumber();
    }

}