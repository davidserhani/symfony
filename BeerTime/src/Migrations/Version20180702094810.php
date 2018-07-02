<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180702094810 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) DEFAULT NULL, city VARCHAR(255) NOT NULL, zip_code VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE table_event (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, capacity INT DEFAULT NULL, start_at DATETIME NOT NULL, end_at DATETIME NOT NULL, price VARCHAR(255) DEFAULT NULL, poster VARCHAR(255) NOT NULL, INDEX IDX_3752C7DF7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE table_event_table_user (table_event_id INT NOT NULL, table_user_id INT NOT NULL, INDEX IDX_71665CCBE14AC65B (table_event_id), INDEX IDX_71665CCBA55D929A (table_user_id), PRIMARY KEY(table_event_id, table_user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE table_event_category (table_event_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_3E6453ECE14AC65B (table_event_id), INDEX IDX_3E6453EC12469DE2 (category_id), PRIMARY KEY(table_event_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE table_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, zip_code VARCHAR(5) NOT NULL, birthdate DATETIME NOT NULL, role LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE table_event ADD CONSTRAINT FK_3752C7DF7E3C61F9 FOREIGN KEY (owner_id) REFERENCES table_user (id)');
        $this->addSql('ALTER TABLE table_event_table_user ADD CONSTRAINT FK_71665CCBE14AC65B FOREIGN KEY (table_event_id) REFERENCES table_event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE table_event_table_user ADD CONSTRAINT FK_71665CCBA55D929A FOREIGN KEY (table_user_id) REFERENCES table_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE table_event_category ADD CONSTRAINT FK_3E6453ECE14AC65B FOREIGN KEY (table_event_id) REFERENCES table_event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE table_event_category ADD CONSTRAINT FK_3E6453EC12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE table_event_category DROP FOREIGN KEY FK_3E6453EC12469DE2');
        $this->addSql('ALTER TABLE table_event_table_user DROP FOREIGN KEY FK_71665CCBE14AC65B');
        $this->addSql('ALTER TABLE table_event_category DROP FOREIGN KEY FK_3E6453ECE14AC65B');
        $this->addSql('ALTER TABLE table_event DROP FOREIGN KEY FK_3752C7DF7E3C61F9');
        $this->addSql('ALTER TABLE table_event_table_user DROP FOREIGN KEY FK_71665CCBA55D929A');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE table_event');
        $this->addSql('DROP TABLE table_event_table_user');
        $this->addSql('DROP TABLE table_event_category');
        $this->addSql('DROP TABLE table_user');
    }
}
