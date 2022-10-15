<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221015080809 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subfamilia DROP FOREIGN KEY FK_150B6A80C6BB373F');
        $this->addSql('ALTER TABLE subfamilia ADD CONSTRAINT FK_150B6A80C6BB373F FOREIGN KEY (CODFAMILIA) REFERENCES familia (CODFAMILIA) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subfamilia DROP FOREIGN KEY FK_150B6A80C6BB373F');
        $this->addSql('ALTER TABLE subfamilia ADD CONSTRAINT FK_150B6A80C6BB373F FOREIGN KEY (CODFAMILIA) REFERENCES familia (CODFAMILIA) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
