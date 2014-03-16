<?


	/* Setup pg vars for display. */
	if ($pg == 0) $pg = 1;					//if no pg var is given, default to 1.
	$prev = $pg - 1;							//previous pg is pg - 1
	$next = $pg + 1;							//next pg is pg + 1
	$lastpg = ceil($total_pages/$limit);		//lastpg is = total pgs / items per pg, rounded up.
	$lpm1 = $lastpg - 1;						//last pg minus 1

	/*
		Now we apply our rules and draw the pagination object.
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpg > 1)
	{
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($pg > 1)
			$pagination.= "<a href=\"$targetpage&pg=$prev\">$l_previous</a>";
		else
			$pagination.= "";

		//pgs
		if ($lastpg < 7 + ($adjacents * 2))	//not enough pgs to bother breaking it up
		{
			for ($counter = 1; $counter <= $lastpg; $counter++)
			{
				if ($counter == $pg)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage&pg=$counter\">$counter</a>";
			}
		}
		elseif($lastpg > 5 + ($adjacents * 2))	//enough pgs to hide some
		{
			//close to beginning; only hide later pgs
			if($pg < 1 + ($adjacents * 2))
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $pg)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage&pg=$counter\">$counter</a>";
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage&pg=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage&pg=$lastpg\">$lastpg</a>";
			}
			//in middle; hide some front and some back
			elseif($lastpg - ($adjacents * 2) > $pg && $pg > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage&pg=1\">1</a>";
				$pagination.= "<a href=\"$targetpage&pg=2\">2</a>";
				$pagination.= "...";
				for ($counter = $pg - $adjacents; $counter <= $pg + $adjacents; $counter++)
				{
					if ($counter == $pg)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage&pg=$counter\">$counter</a>";
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage&pg=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage&pg=$lastpg\">$lastpg</a>";
			}
			//close to end; only hide early pgs
			else
			{
				$pagination.= "<a href=\"$targetpage&pg=1\">1</a>";
				$pagination.= "<a href=\"$targetpage&pg=2\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpg - (2 + ($adjacents * 2)); $counter <= $lastpg; $counter++)
				{
					if ($counter == $pg)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage&pg=$counter\">$counter</a>";
				}
			}
		}

		//next button
		if ($pg < $counter - 1)
			$pagination.= "<a href=\"$targetpage&pg=$next\">$l_next</a>";
		else
			$pagination.= "";
		$pagination.= "</div>\n";
	}

?>