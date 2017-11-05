<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email From Coin Cash Loan</title>
</head>
<body>
	<!-- header -->
	<header id="header">

	</header>
	<!-- end header -->

	<!-- body -->
	<section id="main_email">
		<?php
			switch ($typeEmail) {
				case 'EMAIL_ACTIVATE' :
					$msg = ''; // $data
					break;
				case 'REMINDER_1':
					$msg = '<h2>Email Reminder 1</h2>';
					$msg .= '<p>soluongthechap: ' . $data->soluongthechap . '</p>';
					$msg .= '<p>kieuthechap: ' . $data->kieuthechap . '</p>';
					$msg .= '<p>thoigianthechap: ' . $data->thoigianthechap . '</p>';
					$msg .= '<p>phantramlai: ' . $data->phantramlai . '</p>';
					$msg .= '<p><b>sotiencanvay: ' . $data->sotiencanvay . '</b></p>';
					$msg .= '<p><b>dutinhlai: ' . $data->dutinhlai . '</b></p>';
					$msg .= '<p>ngaygiaingan: ' . $data->ngaygiaingan . '</p>';
					$msg .= '<p><b>ngaydaohan: ' . $data->ngaydaohan . '</b></p>';
					break;
			}

			echo $msg;
		?>
	</section>
	<!-- end body -->

	<!-- footer -->
	<footer id="footer">

	</footer>
	<?php //echo "<pre>"; var_dump($data); die(); ?>
	<!-- end footer -->
</body>
</html>