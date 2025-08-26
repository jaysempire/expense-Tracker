<?php
    #   Author of the script
	#   Name: Jeremiah Achanya
	#   Email: jeremiahachanya@gmail.com
	#   Date created: 26/8/2024 
	#   Date modified: 26/8/2024 

    
    include_once('admin_auth.php');
	include_once('models/Transaction.php');
	include_once('models/User.php');

    $transac = new Transaction;
    $user = new User;
    $user_id = $_SESSION['user_id'];
    $transac_arr = [];
    $user_arr = $user->getById([$user_id]);


    if (isset($_POST['submit_btn'])) {
        $title = $_POST['transac_title'];
        $amount = $_POST['transac_amount'];
        $transac_type = $_POST['transac_type'];
        $date = $_POST['transac_date'];

        if (!$title || !$amount || !$transac_type || !$date) {
            $msg = $web_app->showAlertMsg('danger', 'Please fill in all required fields.');
        }

        $dt = [$user_id, $title, $amount, $transac_type, $date];

        if (!$transac->addNew($dt)) {
            $msg = $web_app->showAlertMsg('danger', 'Transaction Not Added!');
        } else {
            $msg = $web_app->showAlertMsg('success', 'Transaction Successfully Added!');
        }
    } else {

        if (isset($_POST['img_btn']) && isset($_FILES['user_image'])) {

            if (!$user_arr) {
                $_SESSION['msg'] = $web_app->showAlertMsg('danger', 'User not found!');
                header('Location: ./dashboard');
                exit();
            }

            $user_no = $user_arr['user_no'];
		    $file_name = $user_arr['user_img'] ?? '';
            $file_base_name = $user_no;

            if (!empty($file_name)) {

                $existing_img_path = "$upload_dir/profile_img/" . $file_name;

                if (file_exists($existing_img_path)) {
                    unlink($existing_img_path);
                }

            }

			$file_upload = $user->fileUpload("$upload_dir/profile_img", $_FILES['user_image'], $file_base_name);

            if ($file_upload['status']) {
				$file_name = $file_upload['file_name'];

				$dt = [$file_name, $user_no];
				$user->updateImg($dt);

				$_SESSION['msg'] = $web_app->showAlertMsg('success', 'User Image Successfully Updated!');
			} else {
				$_SESSION['msg'] .= $web_app->showAlertMsg('error', $file_upload['msg']);
			}

			header('Location: ./dashboard');
			exit();
        }
    }

    $income = $transac->incomeSum([$user_id]);
    $expense = $transac->expenseSum([$user_id]);
    $total = $income - $expense;

    $lastincome  = $transac->lastMonthIncome([$user_id]) ?? 0;
    $lastexpense  = $transac->lastMonthExpense([$user_id]) ?? 0;
    $currentincome  = $transac->currentMonthIncome([$user_id]) ?? 0;
    $currentexpense  = $transac->currentMonthExpense([$user_id]) ?? 0;

    $incomechange = $lastincome > 0 ? (($currentincome - $lastincome) / $lastincome) * 100 : 0;
    $expensechange = $lastexpense > 0 ? (($currentexpense - $lastexpense) / $lastexpense) * 100 : 0;

    if ($incomechange < 0) {
        $incometext = abs(round($incomechange)) . '% decrease from last month' ;
        $icon = 'bi bi-graph-down-arrow';
        $color = 'text-danger';
    } 
    else {
        $incometext = round($incomechange) . '% increase from last month';
        $icon = 'bi bi-graph-up-arrow';
        $color = 'text-success';
    }

    if ($expensechange < 0) {
        $expensetext = abs(round($expensechange)) . '% decrease from last month' ;
        $e_icon = 'bi bi-graph-down-arrow';
        $e_color = 'text-success';
    } 
    else {
        $expensetext = round($expensechange) . '% increase from last month';
        $e_icon = 'bi bi-graph-up-arrow';
        $e_color = 'text-danger';
    }

    $monthlyData = $transac->getMonthlyTransactionSummary([$user_id]);

    // Prepare chart data
    $chartMonths = [];
    $incomeData = [];
    $expenseData = [];

    // Helper: Convert month number to name
    function getMonthYearKey($month, $year) {
        return date('Y-m', strtotime("$year-$month-01"));
    }

    foreach ($monthlyData as $entry) {
        $key = getMonthYearKey($entry['month'], $entry['year']);

        if (!in_array($key, $chartMonths)) {
            $chartMonths[] = $key;
            $incomeData[$key] = 0;
            $expenseData[$key] = 0;
        }

        if ($entry['type'] == 1) {
            $incomeData[$key] = $entry['total'];
        } else {
            $expenseData[$key] = $entry['total'];
        }
    }

    // Final arrays for charting
    $finalIncome = [];
    $finalExpense = [];

    foreach ($chartMonths as $month) {
        $finalIncome[] = $incomeData[$month];
        $finalExpense[] = $expenseData[$month];
    }

    $chartData = [
        'labels' => $chartMonths,
        'income' => $finalIncome,
        'expense' => $finalExpense,
    ];

    $chartDataJson = json_encode($chartData);
    
    $transac_arr = $transac->getRecentTransactions([$user_id]);



    include_once( 'views/dashboard.php' );