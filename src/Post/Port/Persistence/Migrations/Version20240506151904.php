<?php

declare(strict_types=1);

namespace App\Post\Port\Persistence\Migrations;

use App\Post\Port\Persistence\MysqlPostRepository;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240506151904 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add parent_post_id to '.MysqlPostRepository::TABLE_NAME.' table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE '.MysqlPostRepository::TABLE_NAME.' ADD parent_post_id CHAR(36) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE '.MysqlPostRepository::TABLE_NAME.' DROP parent_post_id');
    }
}
