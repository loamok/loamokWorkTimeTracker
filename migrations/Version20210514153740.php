<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210514153740 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quick_cfg ('
                . 'id INT AUTO_INCREMENT NOT NULL, '
                . 'langue VARCHAR(2) DEFAULT NULL, '
                . 'country VARCHAR(2) DEFAULT NULL, '
                . 'time_zone VARCHAR(50) DEFAULT NULL, '
                . 'apply_winter_hours TINYINT(1) DEFAULT NULL, '
                . 'weekly_work_duration VARCHAR(255) DEFAULT NULL, '
                . 'created_at DATETIME NOT NULL, '
                . 'updated_at DATETIME NOT NULL, '
            . 'PRIMARY KEY(id)) '
            . 'DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE quick_cfg');
    }
}
