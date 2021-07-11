<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210711094639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(''
                . 'CREATE TABLE daily_work_duration ('
                .   'id INT AUTO_INCREMENT NOT NULL, '
                .   'morning_hours_id INT NOT NULL, '
                .   'afternoon_hours_id INT NOT NULL, '
                .   'day_long VARCHAR(50) NOT NULL, '
                .   'day_short VARCHAR(5) NOT NULL, '
                . 'INDEX IDX_816A532A5A1C6275 (morning_hours_id), '
                . 'INDEX IDX_816A532A83016466 (afternoon_hours_id), '
                . 'PRIMARY KEY(id)) '
                . 'DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` '
                . 'ENGINE = InnoDB'
                . '');
        $this->addSql(''
                . 'CREATE TABLE work_duration ('
                .   'id INT AUTO_INCREMENT NOT NULL, '
                .   'name VARCHAR(255) NOT NULL, '
                .   'description VARCHAR(255) NOT NULL, '
                . 'PRIMARY KEY(id)) '
                . 'DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` '
                . 'ENGINE = InnoDB'
                . '');
        $this->addSql(''
                . 'CREATE TABLE work_duration_daily_work_duration ('
                .   'work_duration_id INT NOT NULL, '
                .   'daily_work_duration_id INT NOT NULL, '
                . 'INDEX IDX_9AAAFB1F2878671B (work_duration_id), '
                . 'INDEX IDX_9AAAFB1F6F6A8056 (daily_work_duration_id), '
                . 'PRIMARY KEY(work_duration_id, daily_work_duration_id)) '
                . 'DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` '
                . 'ENGINE = InnoDB'
                . '');
        $this->addSql(''
                . 'CREATE TABLE working_duration_store ('
                .   'id INT AUTO_INCREMENT NOT NULL, '
                .   'start TIME NOT NULL COMMENT \'(DC2Type:time_immutable)\', '
                .   'end TIME NOT NULL COMMENT \'(DC2Type:time_immutable)\', '
                . 'PRIMARY KEY(id)) '
                . 'DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` '
                . 'ENGINE = InnoDB'
                . '');
        $this->addSql('ALTER TABLE daily_work_duration ADD CONSTRAINT FK_816A532A5A1C6275 FOREIGN KEY (morning_hours_id) REFERENCES working_duration_store (id)');
        $this->addSql('ALTER TABLE daily_work_duration ADD CONSTRAINT FK_816A532A83016466 FOREIGN KEY (afternoon_hours_id) REFERENCES working_duration_store (id)');
        $this->addSql('ALTER TABLE work_duration_daily_work_duration ADD CONSTRAINT FK_9AAAFB1F2878671B FOREIGN KEY (work_duration_id) REFERENCES work_duration (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE work_duration_daily_work_duration ADD CONSTRAINT FK_9AAAFB1F6F6A8056 FOREIGN KEY (daily_work_duration_id) REFERENCES daily_work_duration (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quick_cfg ADD work_duration_id INT NOT NULL, DROP weekly_work_duration');
        $this->addSql('ALTER TABLE quick_cfg ADD CONSTRAINT FK_A2433C052878671B FOREIGN KEY (work_duration_id) REFERENCES work_duration (id)');
        $this->addSql('CREATE INDEX IDX_A2433C052878671B ON quick_cfg (work_duration_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE work_duration_daily_work_duration DROP FOREIGN KEY FK_9AAAFB1F6F6A8056');
        $this->addSql('ALTER TABLE quick_cfg DROP FOREIGN KEY FK_A2433C052878671B');
        $this->addSql('ALTER TABLE work_duration_daily_work_duration DROP FOREIGN KEY FK_9AAAFB1F2878671B');
        $this->addSql('ALTER TABLE daily_work_duration DROP FOREIGN KEY FK_816A532A5A1C6275');
        $this->addSql('ALTER TABLE daily_work_duration DROP FOREIGN KEY FK_816A532A83016466');
        $this->addSql('DROP TABLE daily_work_duration');
        $this->addSql('DROP TABLE work_duration');
        $this->addSql('DROP TABLE work_duration_daily_work_duration');
        $this->addSql('DROP TABLE working_duration_store');
        $this->addSql('DROP INDEX IDX_A2433C052878671B ON quick_cfg');
        $this->addSql('ALTER TABLE quick_cfg ADD weekly_work_duration VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP work_duration_id');
    }
}
