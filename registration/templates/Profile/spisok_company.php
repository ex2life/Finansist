<!DOCTYPE html>

<html>
  <head>
	<title>Финансист онлайн</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link href="../css/bootstrap.min.css" rel="stylesheet"/> 
	<link href="../css/style.css" rel="stylesheet"/> 
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
	
  <body>
  	<div class="container">
	    <header class="header">
			<h1>Ваши компании, <?= $current_user['fullname'] ?></h1>
			
		</header>
		
		<div id="formlogin" class="jumbotron">
	   	<div class="wrapper">
		<?php if ($current_user): ?>
			<a href="#" class="user"><?= $current_user['fullname'] ?></a>  <a href="logout.php" class="button">Выход</a>
		<?php endif; ?>
	</div>
	<table class="users" border="1">
		<tr>
			<th>Название компании</th>
			<th>ОПФ</th>
			<th>ИНН</th>
			<th>СНО</th>
			<th>Команды</th>
		</tr>
		<?php foreach ($company_list as $i => $company): ?>
		<tr class="<?= ($i+1)%2 == 0 ? 'even' : 'odd' ?>">
			<td><?= $company['name'] ?></td>
			<td title="<?= $company['opf_full_name'] ?>"><?= $company['opf_brief_name'] ?></td>
			<td><?= $company['inn'] ?></td>
			<td title="<?= $company['sno_full_name'] ?>"><?= $company['sno_brief_name'] ?></td>
		    <td>
                <button type="submit" name="Edit" value="<?= $company['company_id'] ?>" /> <image width="20px" height="20px" src="../img/edit.png"> </button>
                <button type="submit" name="Del" value="<?= $company['company_id'] ?>" onclick="if(confirm(\'Точно желаете удалить?\'))submit();else return false;" /> <image width="20px" height="20px" src="../img/del.png"> </button>
            </td>
		</tr>
		<?php endforeach; ?>
	</table>

</div>
	</div>
  </body>
</html>