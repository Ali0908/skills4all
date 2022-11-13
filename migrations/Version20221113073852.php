<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221113073852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car DROP INDEX UNIQ_773DE69D12469DE2, ADD INDEX IDX_773DE69D12469DE2 (category_id)');
        $this->addSql('ALTER TABLE car CHANGE category_id category_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car DROP INDEX IDX_773DE69D12469DE2, ADD UNIQUE INDEX UNIQ_773DE69D12469DE2 (category_id)');
        $this->addSql('ALTER TABLE car CHANGE category_id category_id INT DEFAULT NULL');
    }
}
