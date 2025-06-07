<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250607133908 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            ALTER TABLE professionnel ADD categorie_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE professionnel ADD specialite_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE professionnel ADD CONSTRAINT FK_7A28C10FBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE professionnel ADD CONSTRAINT FK_7A28C10F2195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_7A28C10FBCF5E72D ON professionnel (categorie_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_7A28C10F2195E0F0 ON professionnel (specialite_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE professionnel DROP CONSTRAINT FK_7A28C10FBCF5E72D
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE professionnel DROP CONSTRAINT FK_7A28C10F2195E0F0
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_7A28C10FBCF5E72D
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_7A28C10F2195E0F0
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE professionnel DROP categorie_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE professionnel DROP specialite_id
        SQL);
    }
}
