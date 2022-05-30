<?php

namespace App\Transversal;

use App\Utils\Utils;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait for using Slug
 */
trait Slug
{
    /**
     * Slug
     *
     */
    #[ORM\Column(type: "string", length: 255)]
    private ?string $slug = null;

    /**
     * Get Slug value
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * Set Slug value
     */
    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Check if has a valid Slug
     */
    public function hasSlug(): bool
    {
        $slug = $this->getSlug();

        return is_string($slug) && strlen($slug) > 0;
    }

    /**
     * @ORM\PrePersist
     */
    public function setSlugBeforePersist(): void
    {
        if (!$this->hasSlug()) {
            $this->setSlug($this->getSlugFromEntityName());
        }
    }

    /**
     * Get a valid Slug from the Entity Name/Title if exists, else random string
     *
     * @return string
     */
    public function getSlugFromEntityName(): string
    {
        $name = Utils::generateRandomString(rand(15, 25), 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');

        if (method_exists($this, 'getName') && method_exists($this, 'hasName') && $this->hasName()) {
            $name = $this->getName();
        } elseif (method_exists($this, 'getTitle') && method_exists($this, 'hasTitle') && $this->hasTitle()) {
            $name = $this->getTitle();
        }

        return self::getSlugifyString($name);
    }

    /**
     * Get a valid Slug from given string
     * Source: https://stackoverflow.com/questions/2103797/url-friendly-username-in-php/2103815#2103815
     *
     * @param string $str
     *
     * @return string
     */
    static public function getSlugifyString(string $str): string
    {
        return strtolower(
            trim(
                preg_replace(
                    '~[^0-9a-z]+~i',
                    '-',
                    html_entity_decode(
                        preg_replace(
                            '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i',
                            '$1',
                            htmlentities($str, ENT_QUOTES, 'UTF-8')
                        ),
                        ENT_QUOTES,
                        'UTF-8'
                    )
                ),
                '-'
            )
        );
    }
}
