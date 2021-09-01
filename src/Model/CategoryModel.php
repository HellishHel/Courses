<?php

    namespace PensionFund\Model;

    use PensionFund\Config;

    class CategoryModel
    {
        public function get($data)
        {
            $query = "
                select *
                  from categories c
                 where 1 = 1
            ";

            if (!empty($data->category_id)) {
                $query .= ' and id = ' . $data->category_id;
            }

            try {
                $connection = Config::getDataBaseConnection();
                return $connection
                    ->query($query)
                    ->fetchAll(\PDO::FETCH_ASSOC);
            } catch (\PDOException $e) {
                print "Ошибка!: " . $e->getMessage() . "<br/>";
                die();
            }
        }

        public function insert($data)
        {
            $query = "
                insert into categories (name)
                    values (:name)
            ";

            $dataInsert = [
                'name' => $data->name
            ];

            try {
                $connection = Config::getDataBaseConnection();
                $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

                return $connection
                    ->prepare($query)
                    ->execute($dataInsert);
            } catch (\PDOException $e) {
                print "Ошибка!: " . $e->getMessage() . "<br/>";
                die();
            }
        }

        public function update($data)
        {
            $query = "
                update categories
                   set name = :name
                 where id = :id;
            ";

            $dataUpdate = [
                'id' => $data->id,
                'name' => $data->name
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

        public function delete($data)
        {
            $checkDelete = "
                select 1
                  from categories c
                       join courses cour on cour.category_id = c.id
                 where c.id = " . $data->id;

            $query = "
                delete
                  from categories
                 where id = :id;
            ";

            $dataDelete = [
                'id' => $data->id
            ];

            try {
                $connection = Config::getDataBaseConnection();
                $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

                $checkResult = null;

                $dataCheck = $connection
                    ->query($checkDelete);

                if ($dataCheck) {
                    $checkResult = $dataCheck->fetchAll();
                }

                if (count($checkResult) > 0) {
                    return -1;
                }

                return $connection
                    ->prepare($query)
                    ->execute($dataDelete);
            } catch (\PDOException $e) {
                print "Ошибка!: " . $e->getMessage() . "<br/>";
                die();
            }
        }
    }
