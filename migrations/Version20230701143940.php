<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230701143940 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movie_has_people DROP role, DROP significance');
        $this->addSql('ALTER TABLE movie_has_people RENAME INDEX fk_movie_has_people_people1 TO IDX_EDC40D81B3B64B95');
        $this->addSql('ALTER TABLE movie_has_type RENAME INDEX fk_movie_has_type_type1 TO IDX_D7417FBAF1B50F');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movie_has_people ADD role VARCHAR(255) NOT NULL, ADD significance VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE movie_has_people RENAME INDEX idx_edc40d81b3b64b95 TO fk_Movie_has_People_People1');
        $this->addSql('ALTER TABLE movie_has_type RENAME INDEX idx_d7417fbaf1b50f TO fk_Movie_has_Type_Type1');
    }
}
