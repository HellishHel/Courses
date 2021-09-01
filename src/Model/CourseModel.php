<?php

    namespace PensionFund\Model;

    use PensionFund\Config;

    class CourseModel
    {
        public function get($data)
        {
            $query = "
                select cour.id,
                       cour.name name,
                       cat.name type,
                       u.id author_id,
                       concat(u.firstname, ' ', u.surname, ' ', u.middlename) author,
                       (
                           select count(1)
                             from claims cl
                            where cl.course_id = cour.id
                       ) count_users,
                       case when exists(
                           select 1
                             from claims cl
                            where cl.user_id = " . ($data->user_id ? $data->user_id : 'null') . "
                              and cl.course_id = cour.id
                       ) then 1
                       else 0
                       end is_claim
                  from courses cour
                       join categories cat on cat.id = cour.category_id
                       join users u on u.id = cour.user_id
                 where 1 = 1
            ";

            if (!empty($data->author_id)) {
                $query .= ' and cour.user_id = ' . $data->author_id;
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

        public function insert($data)
        {
            $query = "
                insert into courses (name, category_id, user_id)
                    values (:name, :category_id, :user_id)
            ";

            $dataInsert = [
                'name' => $data->name,
                'category_id' => $data->category_id,
                'user_id' => $data->author_id
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
                update courses
                   set name = :name,
                       category_id = :category_id
                 where id = :id;
            ";

            $dataUpdate = [
                'id' => $data->id,
                'name' => $data->name,
                'category_id' => $data->category_id
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
            $query = "
                delete
                  from courses
                 where id = :id;
            ";

            $dataDelete = [
                'id' => $data->id
            ];

            try {
                $connection = Config::getDataBaseConnection();
                $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

                return $connection
                    ->prepare($query)
                    ->execute($dataDelete);
            } catch (\PDOException $e) {
                print "Ошибка!: " . $e->getMessage() . "<br/>";
                die();
            }
        }
    }
