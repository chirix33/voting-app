<?php

		require 'uploads/fpdf/fpdf.php';
		require 'includes/database.inc.php';

		ob_start();

		//First
		$sql = "SELECT * FROM elections WHERE session = 1";
		$query = mysqli_query($conn, $sql);

		while ($theElection = mysqli_fetch_assoc($query)) {
			# code...
			$election = $theElection['name'];

		}

		class PDF extends FPDF{

			function Header() {

				$year = date("Y") . "/";
				$nextYear = date("Y")+1;

				$fontFamily = 'Helvetica';
				$bold = 'B';
				$fontSize = 16;

				$this->SetFont($fontFamily, $bold, $fontSize);

				$this->SetFillColor(180,180,255);

				$this->SetDrawColor(50,50,100);

				$this->Cell(0,10,'Election Report ' . $year.$nextYear,1,0,'C');

				$this->Ln(15);

				/*$this->SetFont('Arial','B',11);

				$this->SetFillColor(180,180,255);

				$this->SetDrawColor(50,50,100);

				$this->Cell(64,5,'Picture',1,0,'',true);
				$this->Cell(63,5,'Name',1,0,'',true);
				$this->Cell(63,5,'Votes',1,1,'',true);*/

			}


			function Footer()
			{
				# code...
				$this->SetFont("Arial","I",10);
				$this->Cell(190,0,'','T',1,'',true);
				$copyright = 'Copyright © 2018 by Ashraf Abdul-Muumin & Moro Tijani';
				$this->Cell(0,10,$copyright,0,0,'C');
				$this->Ln(8);
				$this->Cell(0,10,'Page ' . $this->PageNo() . " of {AllPages}",0,0,'C');
			}


		    }

			$pdf = new PDF('P','mm','A4');

			$pdf->AliasNbPages('{AllPages}');

			$pdf->AddPage();

			$pdf->SetTitle("Report for election");

			$pdf->SetAutoPageBreak(true,10);

			$pdf->SetFont('Arial','',9);

			$pdf->SetDrawColor(50,50,100);

			$height = 5;

			$voteTurnOut = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM students"));

			$voteTurnOutTxt = strtoupper($election . "  (votes turnout: " . $voteTurnOut . ")");

			$pdf->SetFont('Arial','B', 9);
			$pdf->Cell(0,10,$voteTurnOutTxt,1,1,'C');


			$query=mysqli_query($conn,"SELECT * FROM positions WHERE election = '$election'");

			$numberOfPositions=mysqli_num_rows($query);

			$numberOfVoters=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM students"));

			//Need to declare a variable that would be used as a cycler to rank the candidates(ie, 1st, 2nd and 3rd)
			//...And also the number that need to be cycled

			while ($position = mysqli_fetch_assoc($query)) {
				# code...
				$cycler = 1;
				$PositionName = strtoupper($position['name']);
				$cycled = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM votecounts"));
				$pdf->SetFont('Arial','BU',9);
				$pdf->Cell(0,10,$PositionName,1,1,'C');
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(63,10,'Candidate',0,0);
				$pdf->SetX(70);
				$pdf->Cell(64,10,'Picture',0,0);
				$pdf->SetX(170);
				$pdf->Cell(63,10,'Votes',0,1);
				$pdf->SetFont('Arial','B',9);
				$pdf->Ln(5);
					$VoteCounts=mysqli_query($conn,"SELECT * FROM votecounts WHERE election = '$election' AND position = '$PositionName' ORDER BY result DESC");
					while ($counts = mysqli_fetch_assoc($VoteCounts)) {
						# code...
						$CandName = $counts['name'];
						$CandResult = $counts['result'];
						$pdf->Cell(64,0,$CandName,0,0);
							$GetImages=mysqli_query($conn,"SELECT * FROM candidates WHERE election = '$election' AND position = '$PositionName' AND name = '$CandName'");
							while ($image=mysqli_fetch_assoc($GetImages)) {
								# code...

								$pdf->Cell(65,0,$pdf->Image('../'.$image['picture'],$pdf->GetX(),$pdf->GetY(),20,22.5),0,0,'R');
							}

									// code...
									for (; $cycler <= $cycled; $cycler++) {

											if ($cycler == 1) {
												$pdf->Cell(63,0,$CandResult . ' out of ' . $numberOfVoters . ' (' . round(($CandResult/$numberOfVoters) * 100,0,PHP_ROUND_HALF_UP) .'%) Main',0,0,'R');
											}elseif ($cycler == 2) {
												$pdf->Cell(63,0,$CandResult . ' out of ' . $numberOfVoters . ' (' . round(($CandResult/$numberOfVoters) * 100,0,PHP_ROUND_HALF_UP) .'%) 1st Assist',0,0,'R');
											}elseif ($cycler == 3) {
												$pdf->Cell(63,0,$CandResult . ' out of ' . $numberOfVoters . ' (' . round(($CandResult/$numberOfVoters) * 100,0,PHP_ROUND_HALF_UP) .'%) 2nd Assist',0,0,'R');
											}elseif($cycler == 4) {
												$pdf->Cell(63,0,$CandResult . ' out of ' . $numberOfVoters . ' (' . round(($CandResult/$numberOfVoters) * 100,0,PHP_ROUND_HALF_UP) .'%) 3rd Assist',0,0,'R');
											}elseif ($cycler == 5) {
												$pdf->Cell(63,0,$CandResult . ' out of ' . $numberOfVoters . ' (' . round(($CandResult/$numberOfVoters) * 100,0,PHP_ROUND_HALF_UP) .'%) 4th Assist',0,0,'R');
											}else {
												$pdf->Cell(63,0,$CandResult . ' out of ' . $numberOfVoters . ' (' . round(($CandResult/$numberOfVoters) * 100,0,PHP_ROUND_HALF_UP) .'%)',0,0,'R');
											}

										if (++$cycler) {  break; 	}

									}



						$pdf->Ln(50);

					}

				$pdf->Ln(15);

			}

			$pdf->Output();


		ob_end_flush();
