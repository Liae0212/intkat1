<?php

namespace App\DataFixtures;

use App\Entity\Catalog;
use DateTimeImmutable;

/**
 * Class CatalogFixtures
 */
class CatalogFixtures extends AbstractBaseFixtures
{
    /**
     * Load data.
     */
    public function loadData(): void
    {
        for ($i = 0; $i < 10; ++$i) {
            $catalog = new Catalog();
            $catalog->setTitle($this->faker->sentence);
            $catalog->setArtist($this->faker->name);
            $catalog->setGenre($this->faker->word);
            $catalog->setCreatedAt(
                DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days', '-1 days'))
            );
            $catalog->setUpdatedAt(
                DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days', '-1 days'))
            );

            $this->manager->persist($catalog);
        }

        $this->manager->flush();
    }
}
