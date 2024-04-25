<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240309163837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonces (id INT AUTO_INCREMENT NOT NULL, annonces_voitures_occasions_id INT NOT NULL, users_annonces_id INT DEFAULT NULL, titre VARCHAR(100) NOT NULL, date_de_publication VARCHAR(8) NOT NULL, UNIQUE INDEX UNIQ_CB988C6FFDED3A26 (annonces_voitures_occasions_id), INDEX IDX_CB988C6FE5334C42 (users_annonces_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, users_avis_id INT DEFAULT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, commentaire VARCHAR(2000) NOT NULL, date DATE NOT NULL, valide TINYINT(1) DEFAULT 0 NOT NULL, INDEX IDX_8F91ABF041736E95 (users_avis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formulaire_de_renseignement (id INT AUTO_INCREMENT NOT NULL, users_formulaire_id INT DEFAULT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, telephone VARCHAR(10) NOT NULL, email VARCHAR(180) NOT NULL, sujet VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, valide VARCHAR(255) NOT NULL, INDEX IDX_8AF6D566BEDDFBCB (users_formulaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE horaires (id INT AUTO_INCREMENT NOT NULL, users_horaires_id INT DEFAULT NULL, jours VARCHAR(10) NOT NULL, horaires_ouvertures_matin TIME DEFAULT NULL, horaires_fermetures_matin TIME DEFAULT NULL, horaires_ouvertures_soir TIME DEFAULT NULL, horaires_fermetures_soir TIME DEFAULT NULL, INDEX IDX_39B7118F23EF551E (users_horaires_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, voitures_occasions_id INT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, size INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_E01FBE6A5B12944E (voitures_occasions_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marques (id INT AUTO_INCREMENT NOT NULL, nom_marques VARCHAR(50) DEFAULT NULL, modeles VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, users_roles_id INT NOT NULL, nom VARCHAR(50) NOT NULL, INDEX IDX_B63E2EC7D84AB5C4 (users_roles_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE services (id INT AUTO_INCREMENT NOT NULL, users_services_id INT DEFAULT NULL, nom VARCHAR(50) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_7332E1697EE6F54 (users_services_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voitures_occasions (id INT AUTO_INCREMENT NOT NULL, voitures_ocassions_marques_id INT DEFAULT NULL, prix INT NOT NULL, annee DATE NOT NULL, kilometrage INT NOT NULL, carburant VARCHAR(50) NOT NULL, boite_de_vitesse VARCHAR(50) NOT NULL, INDEX IDX_7BD5F28B8877BDB2 (voitures_ocassions_marques_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6FFDED3A26 FOREIGN KEY (annonces_voitures_occasions_id) REFERENCES voitures_occasions (id)');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6FE5334C42 FOREIGN KEY (users_annonces_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF041736E95 FOREIGN KEY (users_avis_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE formulaire_de_renseignement ADD CONSTRAINT FK_8AF6D566BEDDFBCB FOREIGN KEY (users_formulaire_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE horaires ADD CONSTRAINT FK_39B7118F23EF551E FOREIGN KEY (users_horaires_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A5B12944E FOREIGN KEY (voitures_occasions_id) REFERENCES voitures_occasions (id)');
        $this->addSql('ALTER TABLE roles ADD CONSTRAINT FK_B63E2EC7D84AB5C4 FOREIGN KEY (users_roles_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE services ADD CONSTRAINT FK_7332E1697EE6F54 FOREIGN KEY (users_services_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE voitures_occasions ADD CONSTRAINT FK_7BD5F28B8877BDB2 FOREIGN KEY (voitures_ocassions_marques_id) REFERENCES marques (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6FFDED3A26');
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6FE5334C42');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF041736E95');
        $this->addSql('ALTER TABLE formulaire_de_renseignement DROP FOREIGN KEY FK_8AF6D566BEDDFBCB');
        $this->addSql('ALTER TABLE horaires DROP FOREIGN KEY FK_39B7118F23EF551E');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A5B12944E');
        $this->addSql('ALTER TABLE roles DROP FOREIGN KEY FK_B63E2EC7D84AB5C4');
        $this->addSql('ALTER TABLE services DROP FOREIGN KEY FK_7332E1697EE6F54');
        $this->addSql('ALTER TABLE voitures_occasions DROP FOREIGN KEY FK_7BD5F28B8877BDB2');
        $this->addSql('DROP TABLE annonces');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE formulaire_de_renseignement');
        $this->addSql('DROP TABLE horaires');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE marques');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE services');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE voitures_occasions');
        $this->addSql('DROP TABLE messenger_messages');
    }
}