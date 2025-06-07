<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20250607132507 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Import données de test';
    }

    public function up(Schema $schema): void
    {
        // Insertion des catégories
        $this->addSql("INSERT INTO categorie (id, libelle) VALUES
            (1, 'Médecine générale'),
            (2, 'Cardiologie'),
            (3, 'Dermatologie'),
            (4, 'Pédiatrie'),
            (5, 'Psychiatrie')
        ");

        // Insertion des spécialités
        $this->addSql("INSERT INTO specialite (id, libelle, categorie_id) VALUES
            (1, 'Médecine générale', 1),
            (2, 'Cardiologie', 2),
            (3, 'Electrophysiologie', 2),
            (4, 'Dermatologie', 3),
            (5, 'Dermato-vénérologie', 3),
            (6, 'Pédiatrie générale', 4),
            (7, 'Néonatalogie', 4),
            (8, 'Psychiatrie adulte', 5),
            (9, 'Psychiatrie infanto-juvénile', 5)
        ");

        // Insertion des communautés
        $this->addSql("INSERT INTO communaute (id, nom) VALUES
            (1, 'Communauté Nord'),
            (2, 'Communauté Sud'),
            (3, 'Communauté Est'),
            (4, 'Communauté Ouest'),
            (5, 'Communauté Centre')
        ");

        // Insertion des professionnels (10 pros)
        $this->addSql("INSERT INTO professionnel (id, nom, prenom) VALUES
            (1, 'Dupont', 'Jean'),
            (2, 'Martin', 'Claire'),
            (3, 'Durand', 'Paul'),
            (4, 'Moreau', 'Sophie'),
            (5, 'Bernard', 'Luc'),
            (6, 'Leroy', 'Marie'),
            (7, 'Faure', 'Nicolas'),
            (8, 'Blanc', 'Julie'),
            (9, 'Gauthier', 'Thomas'),
            (10, 'Michel', 'Emma')
        ");

        // Insertion des adhésions (12 au total)
        // Pros 1 et 2 ont 2 communautés chacun, les autres 1 communauté
        $this->addSql("INSERT INTO adhesion (id, professionnel_id, communaute_id, date_deb, date_fin) VALUES
            (1, 1, 1, NOW(), NULL),
            (2, 1, 2, NOW(), NULL),
            (3, 2, 3, NOW(), NULL),
            (4, 2, 4, NOW(), NULL),
            (5, 3, 1, NOW(), NULL),
            (6, 4, 2, NOW(), NULL),
            (7, 5, 3, NOW(), NULL),
            (8, 6, 4, NOW(), NULL),
            (9, 7, 5, NOW(), NULL),
            (10, 8, 1, NOW(), NULL),
            (11, 9, 2, NOW(), NULL),
            (12, 10, 3, NOW(), NULL)
        ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM adhesion WHERE id BETWEEN 1 AND 12');
        $this->addSql('DELETE FROM professionnel WHERE id BETWEEN 1 AND 10');
        $this->addSql('DELETE FROM communaute WHERE id BETWEEN 1 AND 5');
        $this->addSql('DELETE FROM specialite WHERE id BETWEEN 1 AND 9');
        $this->addSql('DELETE FROM categorie WHERE id BETWEEN 1 AND 5');
    }

}
