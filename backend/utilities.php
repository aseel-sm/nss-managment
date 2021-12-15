<?php
require('dbconnect.php');
function get_user_type($username)
{
    global $conn;
    $sql="select user_type from volunteers_profile where username='$username'";

    if (mysqli_query($conn, $sql)) {
        $result=mysqli_query($conn, $sql);

        $row=mysqli_fetch_array($result);
        return $row['0'];
    } else {
        echo mysqli_error($conn);
    }
}




function is_user_exist($user)
{
    global $conn;
    $sql="select username from volunteers_profile where username='$user'";
    if (mysqli_query($conn, $sql)) {
        $result=mysqli_query($conn, $sql);
        if (mysqli_num_rows($result)>0) {
            return 1;
        } else {
            return 0;
        }
    }
}


function authenticate($username, $password, $tb_name)
{
    global $conn;
    $sql="select username,password from `$tb_name` where username='$username'";
    if (mysqli_query($conn, $sql)) {
        $result=mysqli_query($conn, $sql);
        if (mysqli_num_rows($result)==1) {
            $row=mysqli_fetch_array($result);
            if ($row[1]==$password) {
                return 1;
            } else {
                return 0;
            }
        } else {
            echo mysqli_error($conn);
        }
    } else {
        echo mysqli_error($conn);
    }
}


function get_blood()
{
    $blood=array('O+',"O-","A+","A-","AB-","AB+","B+","B-");
    return $blood;
}




function get_downloads()
{
    global $conn;
    $sql="select * from downloads";
    if (mysqli_query($conn, $sql)) {
        $result=mysqli_query($conn, $sql);
        return $result;
    }
}


function get_gallery_images()
{
    global $conn;
    $sql="select * from gallery";
    if (mysqli_query($conn, $sql)) {
        $result=mysqli_query($conn, $sql);
        return $result;
    }
}
function get_events()
{
    global $conn;
    $sql="select * from event order by start_date desc";
    if (mysqli_query($conn, $sql)) {
        $result=mysqli_query($conn, $sql);
        return $result;
    }
}
function get_notification()
{
    global $conn;
    $sql="select * from notification order by notification_time desc";
    if (mysqli_query($conn, $sql)) {
        $result=mysqli_query($conn, $sql);
        return $result;
    }
}
function get_dept()
{
    global $conn;
    $sql="select *from department";
    if (mysqli_query($conn, $sql)) {
        $result=mysqli_query($conn, $sql);
       
        return $result;
    }
}
function get_po()
{
    global $conn;
    $sql="select *from program_officers";
    if (mysqli_query($conn, $sql)) {
        $result=mysqli_query($conn, $sql);
       
        return $result;
    }
}
function get_user_details($user)
{
    global $conn;
    $sql="select v.* ,d.name as dept from volunteers_profile v, department d where username='$user' and v.dept_id=d.dept_id ";
    if (mysqli_query($conn, $sql)) {
        $result= mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($result);
        
        return $row;
    } else {
        echo mysqli_error($conn);
    }
}
function get_donor_details($user)
{
    global $conn;
    $sql="select b.* ,d.name as dept from blood_donor_profile b, department d where mobile_no='$user' and b.dept_id=d.dept_id ";
    if (mysqli_query($conn, $sql)) {
        $result= mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($result);
        
        return $row;
    } else {
        echo mysqli_error($conn);
    }
}
function get_volunteers()
{
    global $conn;
    $sql="select v.* ,d.name as dept from volunteers_profile v, department d where   v.dept_id=d.dept_id ";
    if (mysqli_query($conn, $sql)) {
        $result= mysqli_query($conn, $sql);
       


        return $result;
    } else {
        echo mysqli_error($conn);
    }
}
get_volunteers();
function get_volunteers_active()
{
    global $conn;
    $sql="select v.* ,d.name as dept from volunteers_profile v, department d where   v.dept_id=d.dept_id and v.is_active=1";
    if (mysqli_query($conn, $sql)) {
        $result= mysqli_query($conn, $sql);
       
        
        return $result;
    } else {
        echo mysqli_error($conn);
    }
}
function attendence_by_event($id)
{
    global $conn;
    
    $sql="SELECT vol_id from attendence where event_id='$id'";
    if (mysqli_query($conn, $sql)) {
        $result= mysqli_query($conn, $sql);
        $absent=array();
        if (mysqli_num_rows($result)>0) {
            while ($row=mysqli_fetch_array($result)) {
                array_push($absent, $row['vol_id']);
            }
           
            return $absent;
        } else {
            return "no";
        }
    } else {
        echo mysqli_error($conn);
    }
}

function get_leave($user)
{
    global $conn;
    $sql="SELECT l.*, e.name FROM leave_request as l,`event` as e where e.id=l.event_id and l.v_id='$user' ";
    if (mysqli_query($conn, $sql)) {
        $result= mysqli_query($conn, $sql);
        return $result;
    } else {
        echo mysqli_error($conn);
    }
}
function get_all_leave()
{
    global $conn;
    $sql="SELECT l.*,v.name as vname, e.name FROM leave_request as l,`event` as e,volunteers_profile as v where e.id=l.event_id  and v.id = l.v_id order by req_time desc";
    if (mysqli_query($conn, $sql)) {
        $result= mysqli_query($conn, $sql);
        return $result;
    } else {
        echo mysqli_error($conn);
    }
}

function get_valggid_events()
{
    global $conn;
    $sql="select id from event order by start_date desc";
    if (mysqli_query($conn, $sql)) {
        $result=mysqli_query($conn, $sql);
        $event=array();
        if (mysqli_num_rows($result)>0) {
            while ($row=mysqli_fetch_array($result)) {
                array_push($event, $row['id']);
            }
           
            return $result;
        }
    } else {
        return 0;
    }
}


function get_valid_events()
{
    global $conn;
    $sql="select id,name,start_date from event order by start_date desc";
    if (mysqli_query($conn, $sql)) {
        $result=mysqli_query($conn, $sql);


        return $result;
    }
}

function is_absent($eid, $vid)
{
    $absents=attendence_by_event($eid);
    if ($absents==0) {
        $absents=array();
    }
    $status=in_array($vid, $absents)?1:0;
    return $status;
}

function user_hour($vid){

    $user_hour=0;
    global $conn;
    $sql="select id,total_hour from event where is_valid=1";
    if (mysqli_query($conn, $sql)) {
        $result=mysqli_query($conn, $sql);
        while($event=mysqli_fetch_assoc($result)){
     //       echo $event['total_hour'];

                    if(is_absent($event['id'],$vid)==0){
                        $user_hour+=$event['total_hour'];

                    }
        }
    
        return $user_hour;

    }


}

user_hour(7);




function get_donors()
{
    global $conn;
    $sql="select *,d.name as d_name  from blood_donor_profile b,department d where b.is_active=1 and d.dept_id=b.dept_id";
    if (mysqli_query($conn, $sql)) {
        $result=mysqli_query($conn, $sql);


        return $result;
    }
}

function get_blood_requests()
{
    global $conn;
    $sql="select * from blood_request";
    if (mysqli_query($conn, $sql)) {
        $result=mysqli_query($conn, $sql);


        return $result;
    }
}


//
function academic_update($type)
{
    global $conn;
    if ($type=='volunteer') {
        $sql="select * from volunteers_profile";
        if ($result=mysqli_query($conn, $sql)) {
            while ($vol=mysqli_fetch_assoc($result)) {
                $id=$vol['id'];
                if ($vol['year_of_join']+2==date('Y')) {
                    $sql="update volunteers_profile set is_active=0 where id='$id'";
                    if (mysqli_query($conn, $sql)) {
                    } else {
                        echo mysqli_error($conn);
                    }
                }
            }
        } else {
            echo mysqli_error($conn);
        }
    }

    if ($type=='event') {
        $sql="select * from event";
        if ($result=mysqli_query($conn, $sql)) {
            while ($event=mysqli_fetch_assoc($result)) {
                $id=$event['id'];
                if ($event['is_valid']==1) {
                    $sql="update event set is_valid=0 where id='$id'";
                    if (mysqli_query($conn, $sql)) {
                    } else {
                        echo mysqli_error($conn);
                    }
                }
            }
        } else {
            echo mysqli_error($conn);
        }
    }

    if ($type=='donor') {
        $sql="select * from blood_donor_profile";
        if ($result=mysqli_query($conn, $sql)) {
            while ($donor=mysqli_fetch_assoc($result)) {
                $id=$donor['donor_id'];

                
                if ($donor['stdy_year']+1==4) {
                    $sql="update blood_donor_profile set is_active=0 where donor_id='$id'";
                    if (mysqli_query($conn, $sql)) {
                    } else {
                        echo mysqli_error($conn);
                    }
                }
            }
        } else {
            echo mysqli_error($conn);
        }
    }
}
function get_unit_status1()
{
    global $conn;
    $sql="select count(id) as c from volunteers_profile where is_active=1";
    if ($result=mysqli_query($conn, $sql)) {
        $row=mysqli_fetch_assoc($result);
          
        if ($row['c']==0) {
            return 0;
        } else {
            return $row['c'];
        }
    } else {
        echo mysqli_error($conn);
    }
}
function get_unit_status2()
{
    global $conn;
    $sql="select count(id) as c from event where is_valid=1";
    if ($result=mysqli_query($conn, $sql)) {
        $row=mysqli_fetch_assoc($result);
          
        if ($row['c']==0) {
            return 0;
        } else {
            return $row['c'];
        }
    } else {
        echo mysqli_error($conn);
    }
}
function get_unit_status3()
{
    global $conn;
    $sql="select count(donor_id) as c from blood_donor_profile where is_active=1";
    if ($result=mysqli_query($conn, $sql)) {
        $row=mysqli_fetch_assoc($result);
          
        if ($row['c']==0) {
            return 0;
        } else {
            return $row['c'];
        }
    } else {
        echo mysqli_error($conn);
    }
}
function get_unit_status4()
{
    global $conn;
    $sql="select count(id) as c from notification";
    if ($result=mysqli_query($conn, $sql)) {
        $row=mysqli_fetch_assoc($result);
          
        if ($row['c']==0) {
            return 0;
        } else {
            return $row['c'];
        }
    } else {
        echo mysqli_error($conn);
    }
}
function get_unit_status5()
{
    global $conn;
    $sql="select count(request_id) as c from blood_request where is_satisfied is null and is_verified=1";
    if ($result=mysqli_query($conn, $sql)) {
        $row=mysqli_fetch_assoc($result);
          
        if ($row['c']==0) {
            return 0;
        } else {
            return $row['c'];
        }
    } else {
        echo mysqli_error($conn);
    }
}
function get_unit_status6()
{
    global $conn;
    $sql="select count(request_id) as c from blood_request where is_verified is null";
    if ($result=mysqli_query($conn, $sql)) {
        $row=mysqli_fetch_assoc($result);
          
        if ($row['c']==0) {
            return 0;
        } else {
            return $row['c'];
        }
    } else {
        echo mysqli_error($conn);
    }
}
