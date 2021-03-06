<?php

namespace Billogram\Model\Customer;

use Billogram\Model\CreatableFromArray;

/**
 * @author Ibrahim Hizeoui <ibrahimhizeoui@gmail.com>
 */
class CustomerContact implements CreatableFromArray
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $phone;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return CustomerContact
     */
    public function withName(string $name)
    {
        $new = clone $this;
        $new->name = $name;

        return $new;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return CustomerContact
     */
    public function setEmail(string $email)
    {
        $new = clone $this;
        $new->email = $email;

        return $new;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     *
     * @return CustomerContact
     */
    public function setPhone(string $phone)
    {
        $new = clone $this;
        $new->phone = $phone;

        return $new;
    }

    public function toArray()
    {
        $data = [];
        if (null !== $this->name) {
            $data['name'] = $this->name;
        }
        if (null !== $this->email) {
            $data['email'] = $this->email;
        }
        if (null !== $this->phone) {
            $data['phone'] = $this->phone;
        }

        return $data;
    }

    /**
     * Create an API response object from the HTTP response from the API server.
     *
     * @param array $data
     *
     * @return self
     */
    public static function createFromArray(array $data)
    {
        $contact = new self();
        $contact->name = $data['name'] ?? null;
        $contact->email = $data['email'] ?? null;
        $contact->phone = $data['phone'] ?? null;

        return $contact;
    }
}
