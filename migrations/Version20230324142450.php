<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230324142450 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'create table agent, specialite and nationalite';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agent (id INT AUTO_INCREMENT NOT NULL, nationalite_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL, identification_code INT NOT NULL, INDEX IDX_268B9C9D1B063272 (nationalite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agent_specialite (agent_id INT NOT NULL, specialite_id INT NOT NULL, INDEX IDX_96902DCE3414710B (agent_id), INDEX IDX_96902DCE2195E0F0 (specialite_id), PRIMARY KEY(agent_id, specialite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nationalite (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialite (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9D1B063272 FOREIGN KEY (nationalite_id) REFERENCES nationalite (id)');
        $this->addSql('ALTER TABLE agent_specialite ADD CONSTRAINT FK_96902DCE3414710B FOREIGN KEY (agent_id) REFERENCES agent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE agent_specialite ADD CONSTRAINT FK_96902DCE2195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY FK_268B9C9D1B063272');
        $this->addSql('ALTER TABLE agent_specialite DROP FOREIGN KEY FK_96902DCE3414710B');
        $this->addSql('ALTER TABLE agent_specialite DROP FOREIGN KEY FK_96902DCE2195E0F0');
        $this->addSql('DROP TABLE agent');
        $this->addSql('DROP TABLE agent_specialite');
        $this->addSql('DROP TABLE nationalite');
        $this->addSql('DROP TABLE specialite');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
