<?php
	include_once('db_include.php');
	$output = '';
	$sql = "SELECT * FROM users WHERE user_first LIKE '%".$_POST["search"]."%'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result)) {
			$fuid = $row['user_id'];
			$fname = $row['user_first'];
			$flast = $row['user_last'];
			$fadd = $row['user_address'];
			$femail = $row['user_email'];
			$fdelete = $row['user_delete'];

			$output .='<br>
					<tbody>
					<tr style="border-bottom: 1px solid #607d8b;">
					<br>
					<td style="width:200px;">'.$row["user_first"].'</td>
					<td style="width:200px;">'.$row["user_last"].'</td>
					<td style="align:center;">'.$row["user_address"].'</td>
					<td style="align:center;">'.$row["user_email"].'</td>';
				if ($fdelete == 0) {
					$output .= "<td style='align:center;'><a href='admin_functions/alter.php?alter=$fuid'><button class='w3-btn w3-red'>Block</button></a></td>
							</tr>
							</tbody>
						</table>";
				}elseif ($fdelete == 1){
					$output .= "<td style='align:center;'><a href='admin_functions/restore.php?res=$fuid'><button class='w3-btn w3-blue'>Restore</button></a></td>
							</tr>
							</tbody>
						</table>";
				}
		}
	}else{
		echo'Data not found!';
	}echo $output;
?>