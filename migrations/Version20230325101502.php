<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230325101502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'creating table cible';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cible (id INT AUTO_INCREMENT NOT NULL, nationalite_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL, code_name VARCHAR(255) NOT NULL, INDEX IDX_E15DEC3B1B063272 (nationalite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cible ADD CONSTRAINT FK_E15DEC3B1B063272 FOREIGN KEY (nationalite_id) REFERENCES nationalite (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cible DROP FOREIGN KEY FK_E15DEC3B1B063272');
        $this->addSql('DROP TABLE cible');
    }
}
