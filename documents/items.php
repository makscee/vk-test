<head>
	<style>
		table {
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}

		td, th {
			border: 1px solid #dddddd;
			text-align: left;
			padding: 8px;
		}

		tr:nth-child(even) {
			background-color: #dddddd;
		}
</style>
</head>
<a href="create.php">Create new item</a>
</br>
</br>
<form>
	Sorting
	<select name="column">
		<option value="id">ID</option>
		<option value="price">Price</option>
	</select>
	<select name="order">
		<option value="asc">Asc</option>
		<option value="desc">Desc</option>
	</select>
	<input type="submit" value="Sort">
</form>
<table style="width:100%">
  <tr>
    <th>ID</th>
    <th>Name</th>
	<th>Description</th>
    <th>Price</th>
  </tr>
<?php
$mysqli = new mysqli("localhost", "root", "", "db");
$order = array_key_exists('order', $_GET) ? $_GET['order'] : 'asc';
$column = array_key_exists('column', $_GET) ? $_GET['column'] : 'id';
echo "select * from items order by $column $order";
$res = $mysqli->query("select * from items order by $column $order");
if(!$res)
	echo "error " . $mysqli->errno . ' ' . $mysqli->error;
while($row = mysqli_fetch_assoc($res)) {
	echo "
		<tr>
			<td>${row['id']}</td>
			<td><a href='item.php?id=${row['id']}'>${row['name']}</a></td>
			<td>${row['description']}</td>
			<td>${row['price']}</td>
		</tr>";
}
?>
</table>