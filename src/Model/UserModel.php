<?php

namespace PensionFund\Model;

use PensionFund\Config;

class UserModel
{
    public function get($data)
    {
        $query = "
                select *
                  from users
                 where 1 = 1
            ";

        if (!empty($data->user_id)) {
            $query .= ' and id = ' . $data->user_id;
        }

        try {
            $connection = Config::getDataBaseConnection();
            $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            return $connection
                ->query($query)
                ->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            print "Ошибка!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function getAuthors($id = null)
    {
        $query = "
                select id,
                       CONCAT(firstname, ' ', surname, ' ', middlename) name
                  from users
                 where 1 = 1
                   and role = 1
            ";

        if (!empty($id)) {
            $query .= ' and id = ' . $id;
        }

        try {
            $connection = Config::getDataBaseConnection();
            $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            return $connection
                ->query($query)
                ->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            print "Ошибка!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function update($data)
    {
        $query = "
                update users
                   set firstname = :firstname,
                       surname = :surname,
                       middlename = :middlename
                 where id = :id;
            ";

        $dataUpdate = [
            'id' => $data->id,
            'firstname' => $data->firstname,
            'surname' => $data->surname,
            'middlename' => $data->middlename
        ];

        try {
            $connection = Config::getDataBaseConnection();
            $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            return $connection
                ->prepare($query)
                ->execute($dataUpdate);
        } catch (\PDOException $e) {
            print "Ошибка!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
