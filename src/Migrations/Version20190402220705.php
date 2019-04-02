<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190402220705 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE disponibility (id BIGINT AUTO_INCREMENT NOT NULL, parking_id BIGINT DEFAULT NULL, reservation_id BIGINT DEFAULT NULL, date_start DATE NOT NULL, date_end DATE NOT NULL, price INT NOT NULL, INDEX fk_disponibility_parking1_idx (parking_id), INDEX fk_disponibility_reservation1_idx (reservation_id), UNIQUE INDEX id_UNIQUE (id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parking (id BIGINT AUTO_INCREMENT NOT NULL, type_id BIGINT DEFAULT NULL, user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, picture VARCHAR(255) DEFAULT NULL, description VARCHAR(500) NOT NULL, city VARCHAR(255) NOT NULL, district VARCHAR(255) NOT NULL, street VARCHAR(255) DEFAULT NULL, latitude NUMERIC(10, 8) NOT NULL, longitude NUMERIC(11, 8) NOT NULL, created_at DATETIME NOT NULL, update_at DATETIME DEFAULT NULL, INDEX fk_parking_type_idx (type_id), INDEX fk_parking_user1_idx (user_id), UNIQUE INDEX id_UNIQUE (id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id BIGINT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, date_start DATE NOT NULL, date_end DATE NOT NULL, paid TINYINT(1) NOT NULL, INDEX fk_reservation_user1_idx (user_id), UNIQUE INDEX id_UNIQUE (id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id BIGINT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, UNIQUE INDEX label_UNIQUE (label), UNIQUE INDEX id_UNIQUE (id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, picture VARCHAR(255) DEFAULT NULL, rib VARCHAR(30) DEFAULT NULL, iban VARCHAR(34) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE views_park (id BIGINT AUTO_INCREMENT NOT NULL, parking_id BIGINT DEFAULT NULL, user_id INT DEFAULT NULL, note_park INT NOT NULL, comment TEXT DEFAULT NULL, creation_date VARCHAR(255) NOT NULL, note_access INT DEFAULT NULL, note_cleaning INT DEFAULT NULL, note_price INT DEFAULT NULL, INDEX fk_views_park_parking1_idx (parking_id), INDEX fk_views_park_user1_idx (user_id), UNIQUE INDEX id_UNIQUE (id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE views_user (id BIGINT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, receiver_id INT DEFAULT NULL, note_user INT NOT NULL, comment TEXT DEFAULT NULL, creation_date DATE NOT NULL, note_amability INT DEFAULT NULL, note_well_being INT DEFAULT NULL, note_payment INT DEFAULT NULL, INDEX fk_views_user_user1_idx (user_id), INDEX fk_views_user_user2_idx (receiver_id), UNIQUE INDEX id_UNIQUE (id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE disponibility ADD CONSTRAINT FK_38BB9260F17B2DD FOREIGN KEY (parking_id) REFERENCES parking (id)');
        $this->addSql('ALTER TABLE disponibility ADD CONSTRAINT FK_38BB9260B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE parking ADD CONSTRAINT FK_B237527AC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE parking ADD CONSTRAINT FK_B237527AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE views_park ADD CONSTRAINT FK_8B6F6F76F17B2DD FOREIGN KEY (parking_id) REFERENCES parking (id)');
        $this->addSql('ALTER TABLE views_park ADD CONSTRAINT FK_8B6F6F76A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE views_user ADD CONSTRAINT FK_C2FBC40CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE views_user ADD CONSTRAINT FK_C2FBC40CCD53EDB6 FOREIGN KEY (receiver_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE disponibility DROP FOREIGN KEY FK_38BB9260F17B2DD');
        $this->addSql('ALTER TABLE views_park DROP FOREIGN KEY FK_8B6F6F76F17B2DD');
        $this->addSql('ALTER TABLE disponibility DROP FOREIGN KEY FK_38BB9260B83297E7');
        $this->addSql('ALTER TABLE parking DROP FOREIGN KEY FK_B237527AC54C8C93');
        $this->addSql('ALTER TABLE parking DROP FOREIGN KEY FK_B237527AA76ED395');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A76ED395');
        $this->addSql('ALTER TABLE views_park DROP FOREIGN KEY FK_8B6F6F76A76ED395');
        $this->addSql('ALTER TABLE views_user DROP FOREIGN KEY FK_C2FBC40CA76ED395');
        $this->addSql('ALTER TABLE views_user DROP FOREIGN KEY FK_C2FBC40CCD53EDB6');
        $this->addSql('DROP TABLE disponibility');
        $this->addSql('DROP TABLE parking');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE views_park');
        $this->addSql('DROP TABLE views_user');
    }
}
