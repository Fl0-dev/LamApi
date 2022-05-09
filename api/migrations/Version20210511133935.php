<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210511133935 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company_group ALTER color DROP NOT NULL');
        $this->addSql('ALTER TABLE company_group ALTER referral_code DROP NOT NULL');
        $this->addSql('ALTER TABLE company_group ALTER creation_year DROP NOT NULL');
        $this->addSql('ALTER TABLE company_group ALTER global_hr_mail_address DROP NOT NULL');
        $this->addSql('ALTER TABLE company_group ALTER turnover DROP NOT NULL');
        $this->addSql('ALTER TABLE company_group ALTER us_text DROP NOT NULL');
        $this->addSql('ALTER TABLE company_group ALTER "values" DROP NOT NULL');
        $this->addSql('ALTER TABLE company_group ALTER customers_desc DROP NOT NULL');
        $this->addSql('ALTER TABLE company_group ALTER customers_number DROP NOT NULL');
        $this->addSql('ALTER TABLE company_group ALTER website DROP NOT NULL');
        $this->addSql('ALTER TABLE company_group_job_type ALTER job_type TYPE JobType');
        $this->addSql('ALTER TABLE company_group_job_type ALTER job_type DROP DEFAULT');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE company_group ALTER color SET NOT NULL');
        $this->addSql('ALTER TABLE company_group ALTER referral_code SET NOT NULL');
        $this->addSql('ALTER TABLE company_group ALTER creation_year SET NOT NULL');
        $this->addSql('ALTER TABLE company_group ALTER global_hr_mail_address SET NOT NULL');
        $this->addSql('ALTER TABLE company_group ALTER turnover SET NOT NULL');
        $this->addSql('ALTER TABLE company_group ALTER us_text SET NOT NULL');
        $this->addSql('ALTER TABLE company_group ALTER values SET NOT NULL');
        $this->addSql('ALTER TABLE company_group ALTER customers_desc SET NOT NULL');
        $this->addSql('ALTER TABLE company_group ALTER customers_number SET NOT NULL');
        $this->addSql('ALTER TABLE company_group ALTER website SET NOT NULL');
        $this->addSql('ALTER TABLE company_group_job_type ALTER job_type TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE company_group_job_type ALTER job_type DROP DEFAULT');
    }
}
