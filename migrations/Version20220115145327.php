<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220115145327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Added DifficultyLevel entity and relation with Recipe entity';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE difficulty_level (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, level INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipe ADD difficulty_level_id INT NOT NULL');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B13764890943 FOREIGN KEY (difficulty_level_id) REFERENCES difficulty_level (id)');
        $this->addSql('CREATE INDEX IDX_DA88B13764890943 ON recipe (difficulty_level_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B13764890943');
        $this->addSql('DROP TABLE difficulty_level');
        $this->addSql('DROP INDEX IDX_DA88B13764890943 ON recipe');
        $this->addSql('ALTER TABLE recipe DROP difficulty_level_id');
    }
}
