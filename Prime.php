<?php
function listPrimesBefore($number) {
	$max = intval(sqrt($number));
	$boolean = array_fill(0, $number, true);
	for ($i = 2; $i <= $max; $i++) {
		if ($boolean[$i - 1]) {
			for ($j = $i * $i; $j <= $number; $j += $i) {
				$boolean[$j - 1] = false;
			}
		}
	}
	$result = array();
	foreach ($boolean as $i => $is_prime) {
		if ($is_prime) {
			$result[] = $i + 1;
			}
	}
	return array('primesBefore' => $result, 'prime' => $is_prime);
	}
 ?>

<?php if(isset($_POST['number'])) $list = listPrimesBefore($_POST['number']); ?>

<form action="" method="POST">
	<input type="text" name="number"/>
	<input type="submit" value="check"/>
</form>
<?php if(isset($list)): ?>
<table>
	<tr>
	<?php foreach ($list['primesBefore'] as $value): ?>
		<td> <?= $value; ?> </td>
	<?php endforeach; ?>
	<?php if($list['prime']): ?>
		<td>YES</td>
	<?php else: ?>
		<td>NO</td>
	<?php endif; ?>
	</tr>
</table>
<?php endif; ?>