<?php
/**
 * db model
 *
 * Filename: DBModel.class.php
 *
 * @author liyan
 * @since 2014 7 18
 */
abstract class DBModel extends BaseDalEx {

    private $id;
    protected $main;

    protected static function defaultDB() {
        return DBJDY;
    }

    function __construct($id, $main = null) {
        $this->id = $id;
        $this->main = $main;
    }

    public function getID() {
        if (!$this->id) {
            $this->getMain();
        }
        return $this->id;
    }

    public function getMain() {
        if (!$this->main) {
            $this->main = static::getMainByID($this->id);
        }

        if (!$this->main) {
            throw new Exception("get main info fail", 1);
        }

        $this->id = $this->main[$this->key()];

        return $this->main;
    }

    protected static function getMainByID($id) {
        self::realEscapeString($id);
        $key = $this->key();
        $table = $this->table();
        $sql = "SELECT *
                FROM $table
                WHERE $key='$id'";
        return self::rs2rowline($sql);
    }

    public function v($key) {
        $main = $this->getMain();
        if (!isset($main[$key])) {
            return null;
        }
        return $main[$key];
    }

    abstract protected function key();

    abstract protected function table();

}
