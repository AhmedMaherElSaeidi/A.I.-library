<?php
include_once "Methods.php";
class ORM
{
    private $db = null;

    function __construct($database_object)
    {
        $this->db = $database_object;
    }

    function select_book($value, $bool)
    {
        $conditional_query = "SELECT * FROM book 
        JOIN author ON book.author_id = author.author_id 
        JOIN category ON category.category_id = book.category_id 
        WHERE category.category lIKE '%{$value}%' 
        OR book.book_name lIKE '%{$value}%'
        OR book.book_language lIKE '%{$value}%'
        OR author.author_name lIKE '%{$value}%'";

        $query = $bool ? $conditional_query : "SELECT * FROM book JOIN author ON book.author_id = author.author_id JOIN category ON category.category_id = book.category_id";
        $result = $this->db->query($query);

        if (!$result || $result->num_rows === 0) {
            return array(); // Return an empty array when there are no results or an error.
        }

        $array = array();
        while ($row = $result->fetch_assoc()) {
            $array[] = $row;
        }

        return $array;
    }

    function select_cart($subject, $value, $bool = True)
    {
        $query = "SELECT * FROM cart 
        JOIN book ON cart.book_id = book.book_id 
        JOIN author ON author.author_id = book.author_id 
        JOIN user ON user.user_id = cart.user_id";
        $query = $bool ? $query . " WHERE {$subject} lIKE {$value}" : $query . "";
        $result = $this->db->query($query);

        if (!$result || $result->num_rows === 0) {
            return array(); // Return an empty array when there are no results or an error.
        }

        $array = array();
        while ($row = $result->fetch_assoc()) {
            $array[] = $row;
        }

        return $array;
    }

    function select($tabel_name, $condition = "", $bool = False)
    {
        $query = $bool ? "SELECT * FROM {$tabel_name} WHERE {$condition}" : "SELECT * FROM {$tabel_name}";
        $result = $this->db->query($query);

        if (!$result || $result->num_rows === 0) {
            return array(); // Return an empty array when there are no results or an error.
        }

        $array = array();
        while ($row = $result->fetch_assoc()) {
            $array[] = $row;
        }

        return $array;
    }

    function insert($table_name, $values)
    {
        $result = $this->db->query("INSERT INTO {$table_name} values {$values}");
        return $result ? True : False;
    }

    function update($table_name, $where, $sets)
    {
        $result = $this->db->query("UPDATE {$table_name} SET {$sets} WHERE {$where}");
        return $result ? True : False;
    }

    function delete($table_name, $condition)
    {
        $result = $this->db->query("DELETE FROM {$table_name} WHERE {$condition}");
        return $result ? True : False;
    }

    function in_cart($user_id, $book_id)
    {
        $query = "SELECT * FROM cart WHERE cart.user_id={$user_id} AND cart.book_id={$book_id}";
        $result = $this->db->query($query);

        if (!$result || $result->num_rows === 0) {
            return False; // Return an empty array when there are no results or an error.
        }

        return true;
    }

    function upload_file($file_object, $allowed_extensions = array('jpg', 'jpeg', 'png', 'webp'))
    {
        $filename = rand(1000, 100000) . "-" . singleQuoteDuplicator($file_object["name"]);
        $temp_filename = singleQuoteDuplicator($file_object["tmp_name"]);
        $uploads_dir = __DIR__ . "/../assets/images/uploads/" . DoubleQuoteReducer($filename);
        $file_extension = pathinfo(singleQuoteDuplicator($file_object["name"]), PATHINFO_EXTENSION);

        if (in_array($file_extension, $allowed_extensions))
            if (move_uploaded_file($temp_filename, $uploads_dir))
                return $filename;

        return False;

    }

    function delete_file($file_name)
    {
        $uploads_dir = __DIR__ . "/../assets/images/uploads/{$file_name}";
        if (file_exists($uploads_dir))
            if (unlink($uploads_dir))
                return True;

        return False;
    }
}