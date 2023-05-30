<?php

namespace App\DataFixtures;

use App\Entity\Song;
use DateTimeImmutable;

/**
 * Class SongFixtures
 */
class SongFixtures extends AbstractBaseFixtures
{
    /**
     * Load data.
     */
    public function loadData(): void
    {
        for ($i = 0; $i < 10; ++$i) {
            $catalog = new Song();
            $catalog->setTitle($this->faker->sentence);
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
