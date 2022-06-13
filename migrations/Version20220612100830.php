<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220612100830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE relations_user DROP FOREIGN KEY FK_3366B6811BFA63C8');
        $this->addSql('DROP TABLE relations');
        $this->addSql('DROP TABLE relations_user');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE relations (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE relations_user (relations_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_3366B6811BFA63C8 (relations_id), INDEX IDX_3366B681A76ED395 (user_id), PRIMARY KEY(relations_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE relations_user ADD CONSTRAINT FK_3366B6811BFA63C8 FOREIGN KEY (relations_id) REFERENCES relations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE relations_user ADD CONSTRAINT FK_3366B681A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }
}
