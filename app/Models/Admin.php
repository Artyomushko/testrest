<?php

namespace App\Models;

class Admin extends Model
{
    protected string $key = 'login';

    private readonly int $id;
    private string $login;
    private string $password;

    /**
     * @inheritDoc
     */
    public static function getFileName(): string
    {
        return 'admins';
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @param bool   $toHash
     */
    public function setPassword(string $password, bool $toHash = false): void
    {
        $this->password = $toHash ? password_hash($password, PASSWORD_DEFAULT) : $password;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }
}