<?php
class Hijri extends CI_Model
{
    function timestamp2enDate($time_stmap)
    {
	$dates= explode(" ", $time_stmap);
	list($y,$m,$d)=explode("-",$dates[0]);
	return "{$d} ".$this->enName($m)." $y";
    }
	function toArabicDateFull($date)
	{
		$datex= explode("-",$date); 
		$date = new DateTime($date);
		$d=$date->getTimestamp() ;
		$dayname= date('w',$d);
		$hijri = $this->GregorianToHijri( $d );
		echo $this->dayName($dayname)." ".$hijri[1].' '.$this->monthName($hijri[0]).' '.$hijri[2]." هـ ";
		echo " - الموافق ".$datex[2]." ".$this->enName($datex[1])." ".$datex[0] ." م";
	}
	
	function toArabicDate($date)
	{
		$datex= explode("-",$date); 
		$date = new DateTime($date);
		$d=$date->getTimestamp() ;
		$dayname= date('w',$d);
		$hijri = $this->GregorianToHijri( $d );
		return $this->dayName($dayname)." ".$hijri[1].' '.$this->monthName($hijri[0]).' '.$hijri[2]." هـ ";
	}
    function monthName($i) // $i = 1..12
    {
        static $month  = array(
            "محرم", "صفر", "ربيع أولl", "ربيع آخر",
            "جمادى أول", "جمادى آخر", "رجب", "شعبان",
            "رمضان", "شوال", "ذو القعدة", "ذو الحجة"
        );
        return $month[$i-1];
    }
    
    function enName($i) // $i = 1..12
    {
        static $month  = array(
        "يناير",
        "فبراير",
        "مارس",
        "ابريل",
        "مايو",
        "يونيو",
        "يوليو",
        "اغسطس",
        "سبتمبر",
        "اكتوبر",
        "نوفمبر",
        "ديسمبر"
        );
        return $month[$i-1];
    }
    
    function dayName($a)
    {
    	switch($a){
    		case 0:
    			$d="الاحد";
    			break;
    		case 1:
    			$d="الاثنين";
    			break;
    		case 2:
    			$d="الثلاثاء";
    			break;
    		case 3:
    			$d="الاربعاء";
    			break;
    		case 4:
    			$d="الخميس";
    			break;
    		case 5:
    			$d="الجمعة";
    			break;
    		case 6:
    			$d="السبت";
    			break;
    	}
    	return $d;
    }

    function GregorianToHijri($time = null)
    {
        if ($time === null) $time = time();
        $m = date('m', $time);
        $d = date('d', $time);
        $y = date('Y', $time);

        return Hijri::JDToHijri(
            cal_to_jd(CAL_GREGORIAN, $m, $d, $y));
    }

    function HijriToGregorian($m, $d, $y)
    {
        return jd_to_cal(CAL_GREGORIAN,
            Hijri::HijriToJD($m, $d, $y));
    }

    # Julian Day Count To Hijri
    function JDToHijri($jd)
    {
        $jd = $jd - 1948440 + 10632;
        $n  = (int)(($jd - 1) / 10631);
        $jd = $jd - 10631 * $n + 354;
        $j  = ((int)((10985 - $jd) / 5316)) *
            ((int)(50 * $jd / 17719)) +
            ((int)($jd / 5670)) *
            ((int)(43 * $jd / 15238));
        $jd = $jd - ((int)((30 - $j) / 15)) *
            ((int)((17719 * $j) / 50)) -
            ((int)($j / 16)) *
            ((int)((15238 * $j) / 43)) + 29;
        $m  = (int)(24 * $jd / 709);
        $d  = $jd - (int)(709 * $m / 24);
        $y  = 30*$n + $j - 30;

        return array($m, $d, $y);
    }

    # Hijri To Julian Day Count
    function HijriToJD($m, $d, $y)
    {
        return (int)((11 * $y + 3) / 30) +
            354 * $y + 30 * $m -
            (int)(($m - 1) / 2) + $d + 1948440 - 385;
    }
}