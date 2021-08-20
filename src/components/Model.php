<?php

namespace app\components;

use ErrorException;
use PDOException;

class Model
{
    private $connection;

    protected $oldAttributes = [];

    public $attributes = [];

    public function __construct()
    {
        $this->connection = new DBConnection();
    }

    /**
     * @return string
     * @throws PDOException
     */
    public static function tableName(): string
    {
        throw new PDOException('Отсутсвует имя таблицы');
    }

    /**
     * @param array $conditions
     * @param bool $one
     * @return array|false|mixed|Model
     */
    private function models(array $conditions, bool $one = true)
    {
        $select_results = $this->select($conditions);

        $models = [];

        foreach ($select_results as $k => $row) {
            if($one && $k !== 0) {
                continue;
            }
            /** @var Model $model */
            $model = static::class;
            $model = new $model();
            foreach ($model->attributes as $attribute => $val) {
                $model->attributes[$attribute] = $row[$attribute];
                $model->oldAttributes[$attribute] = $row[$attribute];
            }

            $models[] = $model;
        }

        return ($one) ? current($models) : $models;
    }

    public function findOne(array $conditions = [])
    {
        return $this->models($conditions);
    }

    public function findAll(array $conditions = [])
    {
        return $this->models($conditions, false);
    }

    private function select(array $conditions)
    {
        $table = static::tableName();
        $sql = "SELECT * FROM `" . $table . "`";

        if($where = $this->where($conditions)) {
            $sql.= ' WHERE ' . implode(' AND ', $where);
        }

        return $this->connection->query($sql);
    }

    private function where(array $conditions)
    {
        $where = null;

        foreach ($conditions as $column => $value) {
            if(is_array($value)) {
                $value = implode(', ', $value);
                $where[] = "`$column` IN (`$value`)";
            } elseif(is_numeric($value)) {
                $where[] = "`$column` = $value";
            } else {
                $where[] = "`$column` = '$value'";
            }
        }

        return $where;
    }

    public function insert(): bool
    {
        $sql = sprintf("INSERT INTO `%s` (", static::tableName());

        $attrs = $this->attributes;

        if(isset($attrs['id'])) {
            unset($attrs['id']);
        }

        $sql .= "`" . implode('`, `', array_keys($attrs)) . "`) VALUES ('" . implode("', '", $attrs) . "')";

        if($result = $this->connection->prepare($sql)->execute()) {
            $this->oldAttributes = $this->attributes;
        }

        return $result;
    }

    public function update(array $conditions): bool
    {
        $attrs = $this->attributes;

        foreach ($attrs as $column => $val) {
            $attrs[$column] = "`$column` = '$val'";
        }

        $sql = "UPDATE `" . static::tableName() . "` SET " . implode(', ', $attrs);

        if($where = $this->where($conditions)) {
            $sql.= ' WHERE ' . implode(' AND ', $where);
        }

        if($result = $this->connection->prepare($sql)->execute()) {
            $this->oldAttributes = $this->attributes;
        }

        return $result;
    }

    public function delete(array $conditions): bool
    {
        $sql = "DELETE FROM `" . static::tableName() . "`";

        if($where = $this->where($conditions)) {
            $sql.= ' WHERE ' . implode(' AND ', $where);
        }

        return $this->connection->prepare($sql)->execute();
    }
}