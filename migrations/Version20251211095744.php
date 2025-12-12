<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251211095744 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creneau';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD creneau_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D7D0729A9 FOREIGN KEY (creneau_id) REFERENCES creneau (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D7D0729A9 ON commande (creneau_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D7D0729A9');
        $this->addSql('DROP INDEX IDX_6EEAA67D7D0729A9 ON commande');
        $this->addSql('ALTER TABLE commande DROP creneau_id');
    }
}
