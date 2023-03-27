<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230327132757 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Comment DROP FOREIGN KEY Comment_ibfk_1');
        $this->addSql('ALTER TABLE Comment DROP FOREIGN KEY Comment_ibfk_2');
        $this->addSql('DROP INDEX recipe_id ON Comment');
        $this->addSql('DROP INDEX user_id ON Comment');
        $this->addSql('ALTER TABLE Comment ADD question_id INT DEFAULT NULL, DROP recipe_id, DROP user_id, DROP content');
        $this->addSql('ALTER TABLE Comment ADD CONSTRAINT FK_9474526C1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('CREATE INDEX IDX_9474526C1E27F6BF ON Comment (question_id)');
        $this->addSql('ALTER TABLE Question DROP date, CHANGE title title VARCHAR(255) DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('DROP INDEX username ON User');
        $this->addSql('ALTER TABLE User ADD roles JSON NOT NULL, DROP username, DROP type, CHANGE email email VARCHAR(180) NOT NULL');
        $this->addSql('ALTER TABLE User RENAME INDEX email TO UNIQ_8D93D649E7927C74');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C1E27F6BF');
        $this->addSql('DROP INDEX IDX_9474526C1E27F6BF ON comment');
        $this->addSql('ALTER TABLE comment ADD user_id INT DEFAULT NULL, ADD content TEXT DEFAULT NULL, CHANGE question_id recipe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT Comment_ibfk_1 FOREIGN KEY (recipe_id) REFERENCES Question (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT Comment_ibfk_2 FOREIGN KEY (user_id) REFERENCES User (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX recipe_id ON comment (recipe_id)');
        $this->addSql('CREATE INDEX user_id ON comment (user_id)');
        $this->addSql('ALTER TABLE question ADD date DATE NOT NULL, CHANGE title title VARCHAR(255) NOT NULL, CHANGE description description TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE `user` ADD username VARCHAR(255) NOT NULL, ADD type VARCHAR(255) NOT NULL, DROP roles, CHANGE email email VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX username ON `user` (username)');
        $this->addSql('ALTER TABLE `user` RENAME INDEX uniq_8d93d649e7927c74 TO email');
    }
}
