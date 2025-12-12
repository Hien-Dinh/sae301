<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251211103638 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creneau implanté';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE creneau ADD libelle VARCHAR(100) NOT NULL, ADD ordre INT DEFAULT NULL, DROP date, DROP heure_debut, DROP heure_fin, CHANGE service_id service_id INT NOT NULL, CHANGE est_disponible actif TINYINT NOT NULL');
        $this->addSql('ALTER TABLE service ADD slug VARCHAR(100) NOT NULL, ADD actif TINYINT NOT NULL, DROP description, CHANGE duree duree INT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E19D9AD2989D9B62 ON service (slug)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE creneau ADD date DATE NOT NULL, ADD heure_debut TIME NOT NULL, ADD heure_fin TIME NOT NULL, DROP libelle, DROP ordre, CHANGE service_id service_id INT DEFAULT NULL, CHANGE actif est_disponible TINYINT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_E19D9AD2989D9B62 ON service');
        $this->addSql('ALTER TABLE service ADD description LONGTEXT DEFAULT NULL, DROP slug, DROP actif, CHANGE duree duree INT NOT NULL');
    }
}
