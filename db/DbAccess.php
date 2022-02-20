<?php

namespace Db;

use PDO;

class DbAccess
{
    /**
     * @var PDO $db
     */

    private $db;
    static $fosrmStart = "<form method='post' action=''>";
    static $formEnd = "</form>";

    public function __construct()
    {
        SingletonDbInit::initiateDb();
        $this->db = SingletonDbInit::getDb();
    }

    public function chooseRequest(array $post)
    {
        if (isset($post["bookByPublisher"])) {
            $this->findBookByPublisher($post["publisher"]);
        } elseif (isset($post["literatureByDate"])) {
            $this->findLiteratureByDate($post["dateStart"], $post["dateEnd"]);
        } elseif (isset($post["bookByAuthor"])) {
            $this->findBookByAuthor($post["author"]);
        }
    }

    private function findBookByPublisher(string $publisher)
    {
        $statement = $this->db->prepare("SELECT name, ISBN, publisher, date, quantity FROM literatures WHERE publisher=?");
        $statement->execute([$publisher]);

        echo "<table style='text-align: center'>";
        echo "<tr><th>Name</th><th>ISBN</th><th>Publisher</th><th>Year</th><th>Number Of Pages</th></tr>";
        while ($data = $statement->fetch()) {
            echo "
                <tr>
                    <td>{$data['name']}</td>
                    <td>{$data['ISBN']}</td>
                    <td>{$data['publisher']}</td>
                    <td>{$data['date']}</td>
                    <td>{$data['quantity']}</td>
                </tr>
            ";
        }
    }

    private function findLiteratureByDate(mixed $dateStart, mixed $dateEnd)
    {
        $statement = $this->db->prepare("SELECT name, date, literate FROM literatures WHERE date BETWEEN ? AND ?");
        $statement->execute([$dateStart, $dateEnd]);

        echo "<table style='text-align: center'>";
        echo "<tr><th>Name</th><th>Date</th><th>Literate</th>";
        while ($data = $statement->fetch()) {
            echo "
                <tr>
                    <td>{$data['name']}</td>
                    <td>{$data['date']}</td>
                    <td>{$data['literate']}</td>
                </tr>
            ";
        }
    }

    private function findBookByAuthor(string $author)
    {
        $statement = $this->db->prepare("
            SELECT literatures.name, ISBN, publisher, date, quantity, authors.name FROM literatures
            INNER JOIN book_authors ON literatures.ID_Book = book_authors.FID_Book
            INNER JOIN authors ON book_authors.FID_Authors = authors.ID_Authors 
            WHERE literatures.literate = 'Book' AND authors.name = ?
        ");
        $statement->execute([$author]);

        echo "<table style='text-align: center'>";
        echo "<tr><th>Name</th><th>ISBN</th><th>Publisher</th><th>Year</th><th>Number Of Pages</th><th>Author Name</th></tr>";
        while ($data = $statement->fetch()) {
            echo "
                <tr>
                    <td>{$data[0]}</td>
                    <td>{$data['ISBN']}</td>
                    <td>{$data['publisher']}</td>
                    <td>{$data['date']}</td>
                    <td>{$data['quantity']}</td>
                    <td>{$data['name']}</td>
                </tr>
            ";
        }
    }

    public function viewSelect(string $name)
    {
        if ($name === "publisher") {
            $statement = $this->db->query("SELECT DISTINCT {$name} FROM literatures WHERE literate='Book'");
        } elseif ($name === "author") {
            $statement = $this->db->query("SELECT DISTINCT name FROM authors");
        }

        echo "<select name='$name'>";
        while ($data = $statement->fetch()) {
            echo "<option value='$data[0]'>$data[0]</option>";
        }
        echo "</select>";
        if ($name === "publisher") {
            echo "<input type='submit' name='bookByPublisher' value='Find Book'>";
        } elseif ($name === "author") {
            echo "<input type='submit' name='bookByAuthor' value='Find Book'>";
        }
    }

    public function viewDate()
    {
        echo "<label>From Date: <input type='date' name='dateStart'></label>";
        echo "<label> To Date: <input type='date' name='dateEnd'></label>";
        echo "<input type='submit' name='literatureByDate' value='Find Literature'>";
    }
}