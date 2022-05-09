<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210618134049 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company_group ALTER us_text TYPE TEXT');
        $this->addSql('ALTER TABLE company_group ALTER us_text DROP DEFAULT');
        $this->addSql('ALTER TABLE company_group ALTER us_text TYPE TEXT');
        $this->addSql('ALTER TABLE company_group ALTER "values" TYPE TEXT');
        $this->addSql('ALTER TABLE company_group ALTER "values" DROP DEFAULT');
        $this->addSql('ALTER TABLE company_group ALTER "values" TYPE TEXT');
        $this->addSql('ALTER TABLE company_group_job_type ALTER job_type TYPE JobType');
        $this->addSql('ALTER TABLE company_group_job_type ALTER job_type DROP DEFAULT');
        $this->addSql('ALTER TABLE company_group_team_media ALTER description TYPE TEXT');
        $this->addSql('ALTER TABLE company_group_team_media ALTER description DROP DEFAULT');
        $this->addSql('ALTER TABLE company_group_team_media ALTER description DROP NOT NULL');
        $this->addSql('ALTER TABLE company_group_team_media ALTER description TYPE TEXT');
        $this->addSql('ALTER TABLE offer ALTER missions TYPE TEXT');
        $this->addSql('ALTER TABLE offer ALTER missions DROP DEFAULT');
        $this->addSql('ALTER TABLE offer ALTER needs TYPE TEXT');
        $this->addSql('ALTER TABLE offer ALTER needs DROP DEFAULT');
        $this->addSql('ALTER TABLE offer ALTER works_with_us TYPE TEXT');
        $this->addSql('ALTER TABLE offer ALTER works_with_us DROP DEFAULT');
        $this->addSql('ALTER TABLE offer ALTER prospects_with_us TYPE TEXT');
        $this->addSql('ALTER TABLE offer ALTER prospects_with_us DROP DEFAULT');
        $this->addSql('ALTER TABLE offer ALTER recruitment_process TYPE TEXT');
        $this->addSql('ALTER TABLE offer ALTER recruitment_process DROP DEFAULT');
        $this->addSql('ALTER TABLE tool ALTER url DROP NOT NULL');
        $this->addSql('ALTER TABLE tool ALTER description TYPE TEXT');
        $this->addSql('ALTER TABLE tool ALTER description DROP DEFAULT');
        $this->addSql('ALTER TABLE tool ALTER description DROP NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE company_group ALTER us_text TYPE VARCHAR(5000)');
        $this->addSql('ALTER TABLE company_group ALTER us_text DROP DEFAULT');
        $this->addSql('ALTER TABLE company_group ALTER values TYPE VARCHAR(5000)');
        $this->addSql('ALTER TABLE company_group ALTER values DROP DEFAULT');
        $this->addSql('ALTER TABLE tool ALTER url SET NOT NULL');
        $this->addSql('ALTER TABLE tool ALTER description TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE tool ALTER description DROP DEFAULT');
        $this->addSql('ALTER TABLE tool ALTER description SET NOT NULL');
        $this->addSql('ALTER TABLE company_group_job_type ALTER job_type TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE company_group_job_type ALTER job_type DROP DEFAULT');
        $this->addSql('ALTER TABLE company_group_team_media ALTER description TYPE VARCHAR(5000)');
        $this->addSql('ALTER TABLE company_group_team_media ALTER description DROP DEFAULT');
        $this->addSql('ALTER TABLE company_group_team_media ALTER description SET NOT NULL');
        $this->addSql('ALTER TABLE offer ALTER missions TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE offer ALTER missions DROP DEFAULT');
        $this->addSql('ALTER TABLE offer ALTER needs TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE offer ALTER needs DROP DEFAULT');
        $this->addSql('ALTER TABLE offer ALTER works_with_us TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE offer ALTER works_with_us DROP DEFAULT');
        $this->addSql('ALTER TABLE offer ALTER prospects_with_us TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE offer ALTER prospects_with_us DROP DEFAULT');
        $this->addSql('ALTER TABLE offer ALTER recruitment_process TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE offer ALTER recruitment_process DROP DEFAULT');
    }
}
