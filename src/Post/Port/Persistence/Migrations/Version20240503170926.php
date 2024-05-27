<?php

declare(strict_types=1);

namespace App\Post\Port\Persistence\Migrations;

use App\Post\Port\Persistence\MysqlPostRepository;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240503170926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add table '.MysqlPostRepository::TABLE_NAME;
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE '.MysqlPostRepository::TABLE_NAME.' (id CHAR(36) NOT NULL, content LONGTEXT NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE '.MysqlPostRepository::TABLE_NAME);
    }
}
