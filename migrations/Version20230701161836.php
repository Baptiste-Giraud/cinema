<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230701161836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movie_has_people DROP FOREIGN KEY fk_Movie_has_People_Movie1');
        $this->addSql('ALTER TABLE movie_has_people DROP FOREIGN KEY fk_Movie_has_People_People1');
        $this->addSql('ALTER TABLE movie_has_type DROP FOREIGN KEY fk_Movie_has_Type_Type1');
        $this->addSql('ALTER TABLE movie_has_type DROP FOREIGN KEY fk_Movie_has_Type_Movie1');
        $this->addSql('DROP TABLE movie_has_people');
        $this->addSql('DROP TABLE movie_has_type');
        $this->addSql('ALTER TABLE movie ADD poster_url VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE movie_has_people (Movie_id INT NOT NULL, People_id INT NOT NULL, INDEX IDX_EDC40D81B3B64B95 (People_id), INDEX IDX_EDC40D8176E5D4AA (Movie_id), PRIMARY KEY(Movie_id, People_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE movie_has_type (Movie_id INT NOT NULL, Type_id INT NOT NULL, INDEX IDX_D7417FBAF1B50F (Type_id), INDEX IDX_D7417FB76E5D4AA (Movie_id), PRIMARY KEY(Movie_id, Type_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE movie_has_people ADD CONSTRAINT fk_Movie_has_People_Movie1 FOREIGN KEY (Movie_id) REFERENCES movie (id)');
        $this->addSql('ALTER TABLE movie_has_people ADD CONSTRAINT fk_Movie_has_People_People1 FOREIGN KEY (People_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE movie_has_type ADD CONSTRAINT fk_Movie_has_Type_Type1 FOREIGN KEY (Type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE movie_has_type ADD CONSTRAINT fk_Movie_has_Type_Movie1 FOREIGN KEY (Movie_id) REFERENCES movie (id)');
        $this->addSql('ALTER TABLE movie DROP poster_url');
    }
}
