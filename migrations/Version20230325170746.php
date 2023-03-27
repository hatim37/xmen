<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230325170746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mission (id INT AUTO_INCREMENT NOT NULL, pays_id INT DEFAULT NULL, type_mission_id INT DEFAULT NULL, specialite_id INT DEFAULT NULL, planque_id INT NOT NULL, statut_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, code_name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date_start DATE NOT NULL, date_end DATE NOT NULL, INDEX IDX_9067F23CA6E44244 (pays_id), INDEX IDX_9067F23CA36F78B5 (type_mission_id), INDEX IDX_9067F23C2195E0F0 (specialite_id), INDEX IDX_9067F23CCE8A20B (planque_id), INDEX IDX_9067F23CF6203804 (statut_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mission_cible (mission_id INT NOT NULL, cible_id INT NOT NULL, INDEX IDX_71CBB306BE6CAE90 (mission_id), INDEX IDX_71CBB306A96E5E09 (cible_id), PRIMARY KEY(mission_id, cible_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mission_agent (mission_id INT NOT NULL, agent_id INT NOT NULL, INDEX IDX_B61DC3A0BE6CAE90 (mission_id), INDEX IDX_B61DC3A03414710B (agent_id), PRIMARY KEY(mission_id, agent_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mission_contact (mission_id INT NOT NULL, contact_id INT NOT NULL, INDEX IDX_DD5E7275BE6CAE90 (mission_id), INDEX IDX_DD5E7275E7A1254A (contact_id), PRIMARY KEY(mission_id, contact_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23CA6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23CA36F78B5 FOREIGN KEY (type_mission_id) REFERENCES type_mission (id)');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C2195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id)');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23CCE8A20B FOREIGN KEY (planque_id) REFERENCES planque (id)');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23CF6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('ALTER TABLE mission_cible ADD CONSTRAINT FK_71CBB306BE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mission_cible ADD CONSTRAINT FK_71CBB306A96E5E09 FOREIGN KEY (cible_id) REFERENCES cible (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mission_agent ADD CONSTRAINT FK_B61DC3A0BE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mission_agent ADD CONSTRAINT FK_B61DC3A03414710B FOREIGN KEY (agent_id) REFERENCES agent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mission_contact ADD CONSTRAINT FK_DD5E7275BE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mission_contact ADD CONSTRAINT FK_DD5E7275E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23CA6E44244');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23CA36F78B5');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23C2195E0F0');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23CCE8A20B');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23CF6203804');
        $this->addSql('ALTER TABLE mission_cible DROP FOREIGN KEY FK_71CBB306BE6CAE90');
        $this->addSql('ALTER TABLE mission_cible DROP FOREIGN KEY FK_71CBB306A96E5E09');
        $this->addSql('ALTER TABLE mission_agent DROP FOREIGN KEY FK_B61DC3A0BE6CAE90');
        $this->addSql('ALTER TABLE mission_agent DROP FOREIGN KEY FK_B61DC3A03414710B');
        $this->addSql('ALTER TABLE mission_contact DROP FOREIGN KEY FK_DD5E7275BE6CAE90');
        $this->addSql('ALTER TABLE mission_contact DROP FOREIGN KEY FK_DD5E7275E7A1254A');
        $this->addSql('DROP TABLE mission');
        $this->addSql('DROP TABLE mission_cible');
        $this->addSql('DROP TABLE mission_agent');
        $this->addSql('DROP TABLE mission_contact');
    }
}
