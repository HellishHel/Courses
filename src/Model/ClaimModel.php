<?php

    namespace PensionFund\Model;

    use PensionFund\Config;

    class ClaimModel
    {
//        public function get($data)
//        {
//            $query = "
//                select cour.id,
//                       cour.name name,
//                       cat.name type,
//                       concat(u.firstname, ' ', u.surname, ' ', u.middlename) author
//                  from courses cour
//                       join categories cat on cat.id = cour.category_id
//                       join users u on u.id = cour.user_id
//                 where 1 = 1
//            ";
//
//            if (!empty($data->user_id)) {
//                $query .= ' and cour.user_id = ' . $data->user_id;
//            }
//
//            try {
//                $connection = Config::getDataBaseConnection();
//                $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
//
//                return $connection
//                    ->query($query)
//                    ->fetchAll(\PDO::FETCH_ASSOC);
//            } catch (\PDOException $e) {
//                print "Ошибка!: " . $e->getMessage() . "<br/>";
//                die();
//            }
//        }

        public function insert($data)
        {
            $query = "
                insert into claims (user_id, author_id, course_id)
                    values (:user_id, :author_id, :course_id)
            ";

            $dataInsert = [
                'user_id' => $data->user_id,
                'author_id' => $data->author_id,
                'course_id' => $data->course_id
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

        public function delete($data)
        {
            $query = "
                delete
                  from claims
                 where user_id = :user_id
                   and course_id = :course_id;
            ";

            $dataDelete = [
                'user_id' => $data->user_id,
                'course_id' => $data->course_id
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
