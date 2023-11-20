<?php

namespace App\Model;

class DiscographyManager extends AbstractManager
{
    public function selectAllAlbum(): array
    {
        $query = 'SELECT album.image, album.title, album.year, album.id, COUNT(song.album_id) as nb_song FROM album 
        LEFT JOIN song ON album.id=song.album_id group by album.id;';
          return $this->pdo->query($query)->fetchAll();
    }

    public function selectAllSongs(): array
    {
        $query = 'SELECT song.title, song.time, song.album_id, song.id 
        FROM song INNER JOIN album ON song.album_id=album.id';
          return $this->pdo->query($query)->fetchAll();
    }

    public function selectOneByIdAlbum(int $id): array|false
    {
        $statement = $this->pdo->prepare("SELECT * FROM album WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function selectOneByIdSong(int $id): array|false
    {
        $statement = $this->pdo->prepare("SELECT * FROM song WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function insertAlbum(array $albums, string $fileName): int
    {
        $statement = $this->pdo->prepare("INSERT INTO album (title, year, image) 
        VALUES (:title, :year, :image)");
        $statement->bindValue('title', $albums['title'], \PDO::PARAM_STR);
        $statement->bindValue('year', $albums['year'], \PDO::PARAM_STR);
        $statement->bindValue('image', $fileName, \PDO::PARAM_STR);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function insertSong(array $songs): int
    {
        $statement = $this->pdo->prepare("INSERT INTO song (title, time, album_id) 
        VALUES (:title, :time, :album_id)");
        $statement->bindValue('title', $songs['title'], \PDO::PARAM_STR);
        $statement->bindValue('time', $songs['time']);
        $statement->bindValue('album_id', $songs['album_id'], \PDO::PARAM_INT);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function updateAlbum(array $albums, string $fileName): bool
    {
        $statement = $this->pdo->prepare("UPDATE album SET id=:id, title=:title, 
        year=:year, image=:image WHERE id=:id");
        $statement->bindValue('id', $albums['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $albums['title'], \PDO::PARAM_STR);
        $statement->bindValue('year', $albums['year'], \PDO::PARAM_STR);
        $statement->bindValue('image', $fileName, \PDO::PARAM_STR);

        return $statement->execute();
    }

    public function updateSong(array $songs): bool
    {
        $statement = $this->pdo->prepare("UPDATE song SET id=:id, title=:title, 
        time=:time, album_id=:album_id WHERE id=:id");
        $statement->bindValue('id', $songs['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $songs['title'], \PDO::PARAM_STR);
        $statement->bindValue('time', $songs['time']);
        $statement->bindValue('album_id', $songs['album_id'], \PDO::PARAM_INT);

        return $statement->execute();
    }

    public function deleteAlbum(int $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM album WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }

    public function deleteSong(int $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM song WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}
