<?php
    include_once('admin_auth.php');
    include_once('models/Transaction.php');

    $transac = new Transaction;
    $transac_arr = [];
    $types = [
                '' => '-- All Types --',
                '1' => 'Income',
                '0' => 'Expense'
            ];
    $user_id = $_SESSION['user_id'];


    if (isset($_POST['btn_submit'])) {
        $type = $_POST['type'] ?? '';
        $start = $_POST['start'] ?? '';
        $end = $_POST['end'] ?? '';

        $dt = [
                'user_id' => $user_id,
                'type' => $type,
                'start' => $start,
                'end' => $end,
            ];

        $transac_arr = $transac->getFilteredTransactions($dt);
    }
    else {
        $transac_arr = $transac->getAll([$user_id]);
    }

    


    include_once( 'views/transaction.php' );