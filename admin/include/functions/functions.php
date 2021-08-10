<?php

if(session_id() === "") session_start();

function count_visitors(){
        global $con;
        $stmt=$con->prepare("SELECT total FROM visitors where website_id = 1;");
        $stmt->execute();
        $count = $stmt->fetch();
        return $count['total'];
        }


        function get_patients_count(){
            global $con;
            $stmt=$con->prepare("SELECT COUNT(id) as count FROM patients;");
            $stmt->execute();
            $count = $stmt->fetch();
            return $count['count'];
          }


        function get_appointments_count(){

            global $con;
            $query = "SELECT COUNT(id) as count FROM appointments WHERE appointment_date >= now() ";
            $params = [];
            if(!is_admin()){
                $clinic_id = get_current_user_data()['clinic_id'];
                $query.=" AND clinic_id = ?";
                $params[]= $clinic_id;
            }
            $stmt=$con->prepare($query);
            $stmt->execute($params);
            $count = $stmt->fetch();
            return $count['count'];
        }

        function get_today_appointments_count(){
            global $con;
            $query = "SELECT COUNT(id) as count FROM appointments WHERE appointment_date = now() ";
            $params = [];
            if(!is_admin()){
                $clinic_id = get_current_user_data()['clinic_id'];
                $query.=" AND clinic_id = ?";
                $params[]= $clinic_id;
            }
            $stmt=$con->prepare($query);
            $stmt->execute($params);
            $count = $stmt->fetch();
            return $count['count'];
        }


        function get_current_user_data(){
            global $con;
            $query = "SELECT *   FROM users WHERE id = ?";
            $stmt=$con->prepare($query);
            $stmt->execute([get_current_user_id()]);
            return $stmt->fetch();

        }
        function get_current_user_id(){
            return $_SESSION['user_id'];
        }

        function is_user_authorized(){
              return isset($_SESSION['user_id']);

        }

        function is_doctor(){

            /* if($_SESSION['privilege_id'] == '1'){
                 return true;
             }
            return false;*/

            return  $_SESSION['privilege_id'] == '1';
        }

        function is_general_register(){
            return  $_SESSION['privilege_id'] == '2';
        }
        function is_admin(){
            return  $_SESSION['privilege_id'] == '3';
        }
