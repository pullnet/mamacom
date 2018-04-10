<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/02/13
//
//	CalenderHelper
//	CalenderHelper.php
//
//--------------------------------------------------


class CalenderHelper extends Helper{

	public $holiday=array();

	public function holiday($option){
		$this->holiday=$option;
	}

	public function view($today=null,$option=array()){

		//option 
		//	header.visible
		//	header.year
		//	header.month
		//	holiday.week
		//	holiday.day

		if(@$today){
			$year=phpx_date("Y",strtotime($today));
			$month=phpx_date("m",strtotime($today));
			$day=phpx_date("d",strtotime($today));
		}
		else
		{
			$year=phpx_date("Y");
			$month=phpx_date("m");
			$day=phpx_date("d");
		}

		if(!@$option["header"]){
			$option["header"]=array(
				"visible"=>true,
				"year"=>true,
				"month"=>true,
			);
		}
		if(@$option["header"]){
			if($option["header"]["year"]){
				$header_str=$year;
			}
			if($option["header"]["month"]){
				$header_str.=" ".$month;
			}
		}
		$option_table="";
		if(@$option["class"]){
			$option_table.='class="'.$option["class"].'"';
		}

		if(!@$option["holiday"]){
			$option["holiday"]=$this->holiday;
		}

		$html='<table cellspacing="0" cellpadding="0" '.@$option_table.'>';

		if(@$option["header"]["visible"]){
			$html.='<tr class="month">';
			$html.='<td colspan="7">'.@$header_str.'</td>';
			$html.="</tr>";
		}

		$week=array("日", "月", "火", "水", "木", "金", "土");

		$html.='<tr class="week">';
		for($j0=0;$j0<7;$j0++){
			$html.="<th>".$week[$j0]."</th>";
		}
		$html.="</tr>";

		//day
		$html.='<tbody class="days">';

		$totaldate=phpx_date("t",strtotime($year."-".$month."-01 00:00:00"));
		$startweek=phpx_date("w",strtotime($year."-".$month."-01 00:00:00"));
		$run_totaldate=$totaldate+$startweek;
		$totalweek=ceil($run_totaldate/7);
		$day=0;

		for($d0=0;$d0<6;$d0++){
			$html.='<tr>';


			for($d1=0;$d1<7;$d1++){
				if($d0==0){
					if($d1>=$startweek){
						$day++;
					}
				}
				else
				{
					$day++;
				}

				$option_day="";
				if($day!=0 && $day<=$totaldate){
					if(@$option["holiday"]){
						if(@$option["holiday"]["week"]){
							foreach($option["holiday"]["week"] as $ow_){


								if($ow_=="sunday" && phpx_date("w",strtotime($year."-".$month."-".$day." 00:00:00"))==0){
									$option_day.="hol ";
								}
								else if($ow_=="monday" && phpx_date("w",strtotime($year."-".$month."-".$day." 00:00:00"))==1){
									$option_day.="hol ";
								}
								else if($ow_=="tuesday" && phpx_date("w",strtotime($year."-".$month."-".$day." 00:00:00"))==2){
									$option_day.="hol ";
								}
								else if($ow_=="wednesday" && phpx_date("w",strtotime($year."-".$month."-".$day." 00:00:00"))==3){
									$option_day.="hol ";
								}
								else if($ow_=="thursday" && phpx_date("w",strtotime($year."-".$month."-".$day." 00:00:00"))==4){
									$option_day.="hol ";
								}
								else if($ow_=="friday" && phpx_date("w",strtotime($year."-".$month."-".$day." 00:00:00"))==5){
									$option_day.="hol ";
								}
								else if($ow_=="saturday" && phpx_date("w",strtotime($year."-".$month."-".$day." 00:00:00"))==6){
									$option_day.="hol ";
								}
							}
						}

						if(@$option["holiday"]["day"]){
							foreach($option["holiday"]["day"] as $od_){
								if(phpx_date("Y-m-d",strtotime($od_." 00:00:00"))==phpx_date("Y-m-d",strtotime($year."-".$month."-".$day." 00:00:00"))){
									$option_day.="hol ";
								}
							}
						}
					}
						if(@$option["today"]){
							if(phpx_date("Y-m-d",strtotime($today." 00:00:00"))==phpx_date("Y-m-d",strtotime($year."-".$month."-".$day." 00:00:00"))){
								$option_day.=$option["today"]." ";
							}
						}

					$html.='<td class="'.@$option_day.'"><span>'.$day."</span></td>";
				}
				else
				{
					$html.='<td class="'.@$option_day.'"><span>　</span></td>';
				}
			}

			$html.="</tr>";
		}
		$html.='</tbody>';
		$html.='</table>';


		echo $html;
	}
}
?>