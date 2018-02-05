<?php
	final class TestCmpDate {
		
		public function BlaBla($Firts, $Second){
			return $this->CmpDate($Firts, $Second);
		}

		private function CmpDate($Firts, $Second){
		    $FirtsValue  = explode("/", $Firts);
		    $SecondValue = explode("/", $Second);

		    $FirtsDay    = $FirtsValue[0];
		    $FirtsMonth  = $FirtsValue[1];
		    $FirtsYear   = $FirtsValue[2];
		    $SecondDay   = $SecondValue[0];
		    $SecondMonth = $SecondValue[1];
		    $SecondYear  = $SecondValue[2];

		    $FirtsDays  = gregoriantojd($FirtsMonth, $FirtsDay, $FirtsYear);
		    $SecondDays = gregoriantojd($SecondMonth, $SecondDay, $SecondYear);

		    if (!checkdate($FirtsMonth, $FirtsDay, $FirtsYear))
		      return 0;
		    else if(!checkdate($SecondMonth, $SecondDay, $SecondYear))
		      return 0;
		    else
		      return  $FirtsDays - $SecondDays;
	  	}
	}

	$Execute = new TestCmpDate();

	$Days = $Execute->BlaBla("31/12/2016", "29/12/2016");

	if ($Days > 0)
		echo "Hacen falta <b>(".$Days.")</b> días para que finalice.";
	else if ($Days < 0)
		echo "Finalizado: Se ha pasado <b>(".abs($Days).")</b> días.";
	else
		echo "Este es el último día.";
?>