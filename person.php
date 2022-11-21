<?php
abstract class CRUD 
{
    abstract public function create();
    abstract public function update();
    abstract public function photoUpdate();
    abstract public function delete();
    abstract public function get();
    abstract public function getSingle();
}

class Person extends CRUD
{
    private $connection;
    private $table = "persona";
    private $result;

    public $pid;
    public $name;
    public $phone;
    public $latitude;
    public $longitude;
    public $photo;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function get()
    {
        $this->result = mysqli_query($this->connection, "SELECT pid, nombre, telefono, latitud, longitud, foto FROM " . $this->table);
        if(mysqli_num_rows($this->result) > 0) {
            return $this->result;
        } else return null;
    }

    public function getSingle()
    {
        $this->result = mysqli_query($this->connection, "SELECT pid, nombre, telefono, latitud, longitud, foto FROM " . $this->table . " WHERE pid='" . $this->pid . "'");
        if(mysqli_num_rows($this->result) > 0) {
            $this->result = mysqli_fetch_assoc($this->result);
            return $this->result;
        } else return null;
    }

    public function create()
    {
        $this->pid = self::generateNumericalToken(13);
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->latitude = htmlspecialchars(strip_tags($this->latitude));
        $this->longitude = htmlspecialchars(strip_tags($this->longitude));

        return mysqli_query($this->connection, "INSERT INTO " . $this->table . "(pid, nombre, telefono, latitud, longitud, foto) VALUES('" . $this->pid . "','" .$this->name . "','" . $this->phone . "','" . $this->latitude . "','" . $this->longitude . "','" . $this->photo . "')");
    }

    public function update()
    {
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->latitude = htmlspecialchars(strip_tags($this->latitude));
        $this->longitude = htmlspecialchars(strip_tags($this->longitude));

        return mysqli_query($this->connection, "UPDATE " . $this->table . " SET nombre='" . $this->name . "', telefono='" . $this->phone . "', latitud ='" . $this->latitude . "', longitud = '" . $this->longitude . "' WHERE pid='" . $this->pid . "'");
    }

    public function photoUpdate()
    {
        return mysqli_query($this->connection, "UPDATE persona SET foto='" . $this->photo . "' WHERE pid='" . $this->pid . "'");
    }

    public function delete()
    {
        return mysqli_query($this->connection, "DELETE FROM " . $this->table . " WHERE pid='" . $this->pid . "'");
    }

    public function generateNumericalToken($size)
    {
        $numbers = '0123456789';
        $numbersLength = strlen($numbers);
        $randomNumbers = '';
        for ($i = 0; $i < $size; $i++) {
            $randomNumbers .= $numbers[rand(0, $numbersLength - 1)];
        }
        return $randomNumbers;
    }
}