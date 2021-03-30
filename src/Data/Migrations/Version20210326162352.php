<?php

declare(strict_types=1);

namespace App\Data\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210326162352 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('
            CREATE TABLE language (
                id INT PRIMARY KEY,
                name VARCHAR(255),
                new_field INT 
            )
        ');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('
            DROP TABLE language;
        ');
    }
}
