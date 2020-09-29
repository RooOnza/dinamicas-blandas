<?php

	include('db.php');
	include('function.php');
	$value = "";
	
	$query = 'SELECT * FROM users';

	$statement = $connection->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();

	$value = '<	table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="10%">Image</th>
							<th width="35%">First Name</th>
							<th width="35%">Last Name</th>
							<th width="10%">Edit</th>
							<th width="10%">Delete</th>
						</tr>
					</thead>';

	foreach($result as $row)
	{
		$image = '';
		if($row["image"] != '')	{
			$image = '<img src="./upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />';
		} else {
			$image = '';
		}
		$value.= '	<tr>
						<td>'.$image.'</td>
						<td>'.$row['first_name'].'</td>
						<td>'.$row['last_name'].'</td>
						<td> <button class="btn btn-success" id="btn_edit" data-id='.$row['id'].'><span class="fa fa-edit"></span></button> </td>
						<td> <button class="btn btn-danger" id="btn_delete" data-id1='.$row['id'].'><span class="fa fa-trash"></span></button> </td>
					</tr>';
	}
	$value.='</table>';
	
	echo json_encode(['status'=>'success','html'=>$value]);

?>