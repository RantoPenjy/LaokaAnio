<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240503105557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE day_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE non_viande (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, min_price_per_person INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plat (id INT AUTO_INCREMENT NOT NULL, day_type_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, min_price_per_person INT NOT NULL, INDEX IDX_2038A2073D89FC11 (day_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plat_viande (plat_id INT NOT NULL, viande_id INT NOT NULL, INDEX IDX_5C2222EAD73DB560 (plat_id), INDEX IDX_5C2222EA4C61F684 (viande_id), PRIMARY KEY(plat_id, viande_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plat_non_viande (plat_id INT NOT NULL, non_viande_id INT NOT NULL, INDEX IDX_8003B044D73DB560 (plat_id), INDEX IDX_8003B0444172E1C4 (non_viande_id), PRIMARY KEY(plat_id, non_viande_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE viande (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, min_price_per_person INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE plat ADD CONSTRAINT FK_2038A2073D89FC11 FOREIGN KEY (day_type_id) REFERENCES day_type (id)');
        $this->addSql('ALTER TABLE plat_viande ADD CONSTRAINT FK_5C2222EAD73DB560 FOREIGN KEY (plat_id) REFERENCES plat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plat_viande ADD CONSTRAINT FK_5C2222EA4C61F684 FOREIGN KEY (viande_id) REFERENCES viande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plat_non_viande ADD CONSTRAINT FK_8003B044D73DB560 FOREIGN KEY (plat_id) REFERENCES plat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plat_non_viande ADD CONSTRAINT FK_8003B0444172E1C4 FOREIGN KEY (non_viande_id) REFERENCES non_viande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137D73DB560 FOREIGN KEY (plat_id) REFERENCES plat (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B137D73DB560');
        $this->addSql('ALTER TABLE plat DROP FOREIGN KEY FK_2038A2073D89FC11');
        $this->addSql('ALTER TABLE plat_viande DROP FOREIGN KEY FK_5C2222EAD73DB560');
        $this->addSql('ALTER TABLE plat_viande DROP FOREIGN KEY FK_5C2222EA4C61F684');
        $this->addSql('ALTER TABLE plat_non_viande DROP FOREIGN KEY FK_8003B044D73DB560');
        $this->addSql('ALTER TABLE plat_non_viande DROP FOREIGN KEY FK_8003B0444172E1C4');
        $this->addSql('DROP TABLE day_type');
        $this->addSql('DROP TABLE non_viande');
        $this->addSql('DROP TABLE plat');
        $this->addSql('DROP TABLE plat_viande');
        $this->addSql('DROP TABLE plat_non_viande');
        $this->addSql('DROP TABLE viande');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
