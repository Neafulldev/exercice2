<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250607134150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Insertion données tests';
    }

    public function up(Schema $schema): void
    {
        // Mise à jour des professionnels avec leur catégorie et spécialité
        $this->addSql("UPDATE professionnel SET categorie_id = 1, specialite_id = 1 WHERE id = 1"); // Dupont - Médecine générale
        $this->addSql("UPDATE professionnel SET categorie_id = 2, specialite_id = 2 WHERE id = 2"); // Martin - Cardiologie
        $this->addSql("UPDATE professionnel SET categorie_id = 2, specialite_id = 3 WHERE id = 3"); // Durand - Electrophysiologie
        $this->addSql("UPDATE professionnel SET categorie_id = 3, specialite_id = 4 WHERE id = 4"); // Moreau - Dermatologie
        $this->addSql("UPDATE professionnel SET categorie_id = 3, specialite_id = 5 WHERE id = 5"); // Bernard - Dermato-vénérologie
        $this->addSql("UPDATE professionnel SET categorie_id = 4, specialite_id = 6 WHERE id = 6"); // Leroy - Pédiatrie générale
        $this->addSql("UPDATE professionnel SET categorie_id = 4, specialite_id = 7 WHERE id = 7"); // Faure - Néonatalogie
        $this->addSql("UPDATE professionnel SET categorie_id = 5, specialite_id = 8 WHERE id = 8"); // Blanc - Psychiatrie adulte
        $this->addSql("UPDATE professionnel SET categorie_id = 5, specialite_id = 9 WHERE id = 9"); // Gauthier - Psychiatrie infanto-juvénile
        $this->addSql("UPDATE professionnel SET categorie_id = 1, specialite_id = 1 WHERE id = 10"); // Michel - Médecine générale
    }

    public function down(Schema $schema): void
    {
        $this->addSql("UPDATE professionnel SET categorie_id = NULL, specialite_id = NULL");
    }
}
