<h1>List of posts</h1>
<ul>
<?php foreach($data as $row) { ?>
	<li><?=$row['id']?>:<?=$row['title']?></li>
<?php } ?>
</ul>
