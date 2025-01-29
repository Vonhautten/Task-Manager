<?php
    if(isset($_GET["page"]))
    {
        $hal=$_GET["page"];

        switch($hal)
        {

            case "about":
                include "halaman/about.php";
                break; 

            case "dashboard":
                include "halaman/dashboard/dashboard.php";
                break;

            case "tasks":
                include "halaman/tasks/tasks.php";
                break;     

            case "tasksadd":
                include "halaman/tasks/task_tambah.php";
                break;  

            case "tasksedit":
                include "halaman/tasks/task_edit.php";
                break;

            case "calendar":
                include "halaman/kalender/kalender.php";
                break; 

            case "feed":
                include "halaman/feedback.php";
                break; 

            case "logout":
                include "halaman/logout.php";
                break; 

            case "logout_aksi":
                include "halaman/logout_aksi.php";
                break; 
                
            default:
                include "halaman/dashboard/dashboard.php";
                break;
        }
    }
    else
    {
        include "halaman/dashboard/dashboard.php";
    }
?>
