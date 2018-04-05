<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 class DateCreate{

 	public static function dateFormat($posted){
 		if($posted){
 			$date = strftime("%B %d, %Y", strtotime($posted));
 		    return $date;
 		}
 		return False;	
 	} 

 	public static function get_time($date){

	    if(empty($date)){
	        return "No date provided";
	    }

		$periods = array("second","minute","hour","day","week","month","year");
		$lengths = array("60","60","24","7","4.35","12","10");
		$now = time();
		$unix_time = strtotime($date);
	    //check validity of date
	    if(empty($unix_time)){
	        return "Bad date";
	    }
		//Is it future or past
		if($now > $unix_time){
		    $diff = $now - $unix_time;
		    $tense = "ago";
		}else{
		    $diff = $unix_time - $now;
		    $tense = "from now";
		}

		for($j=0; $diff>=$lengths[$j] && $j < count($lengths)-1; $j++){
		    $diff /= $lengths[$j];
		}

		$diff = round($diff);
		if($diff != 1){
		    $periods[$j] .= "s";
		}
		return "$diff $periods[$j] {$tense}";
	}

	public static function timeAgo($time_ago){
        $cur_time = time();
        $time_elapsed = $cur_time - strtotime($time_ago);
        $seconds = $time_elapsed ;
        $minutes = round($time_elapsed / 60 );
        $hours = round($time_elapsed / 3600);
        $days = round($time_elapsed / 86400 );
        $weeks = round($time_elapsed / 604800);
        $months = round($time_elapsed / 2600640 );
        $years = round($time_elapsed / 31207680 ); 

        if($seconds <= 60){
         	return  "$seconds seconds ago";
        }
        else if($minutes <=60){
            if($minutes==1){
             	return  "one minute ago";
            }
            else{
             	return  "$minutes minutes ago";
            }
        }
        else if($hours <=24){
            if($hours==1){
             	return  "an hour ago";
            }
            else{
             	return  "$hours hours ago";
            }
        }
        else if($days <= 7){
            if($days==1){
             	return  "yesterday";
            }
            else{
             	return  "$days days ago";
            }
        }
        else if($weeks <= 4.3){
            if($weeks==1){
             	return  "a week ago";
            }
            else{
             	return  "$weeks weeks ago";
            }
        }
        else if($months <=12){
            if($months==1){
             	return  "a month ago";
            }
            else{
             	return  "$months months ago";
            }
        }
        else{
            if($years==1){
             	return  "one year ago";
            }
            else{
             	return  "$years years ago";
            }
        }
	}

    public static function get_current_age($date_of_birth){
        $today = date("Y-m-d");
        $diff = date_diff(date_create($date_of_birth), date_create($today));
        return $diff->format('%y');
    }

    public static function custom_difference($date_1 , $date_2 , $differenceFormat = '%a'){
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);
        
        $interval = date_diff($datetime1, $datetime2);
        
        return $interval->format($differenceFormat);
    }

 }