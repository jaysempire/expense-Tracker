<?php

include_once( 'Db.php' );

class Transaction{

    //using Namespaces
    use Db {
        Db::__construct as private __appConst;
    }

    protected $table = '';

    function __construct()
    {
        $this->__appConst();
        $this->table = DB_TABLE_TRANSAC;
    }

    function getRecentTransactions( array $dt ) 
    {
        $sql = "SELECT * FROM $this->table where user_id = ? ORDER by created_at DESC LIMIT 4 ";
        $res = $this->fetchMultiple( $sql, $dt );

        return $res ?? [];
    }

    function getAll( array $dt ) 
    {
        $sql = "SELECT * FROM $this->table where user_id = ? ORDER by created_at DESC";
        $res = $this->fetchMultiple( $sql, $dt );

        return $res ?? [];
    }

   public function getFilteredTransactions(array $data) 
   {
        $sql = "SELECT * FROM transactions WHERE 1";

        $params = [];

        $sql .= " AND user_id = ?";
        $params[] = $data['user_id'];

        if ($data['type'] !== '') {
            $sql .= " AND type = ?";
            $params[] = $data['type'];
        }

        if (!empty($data['start'])) {
            $sql .= " AND t_date >= ?";
            $params[] = $data['start'];
        }

        if (!empty($data['end'])) {
            $sql .= " AND t_date <= ?";
            $params[] = $data['end'];
        }

        $sql .= " ORDER BY t_date DESC";
        $res = $this->fetchMultiple($sql, $params);

        return $res ?? [];
    }


    function incomeSum( array $dt ) 
    {
        $sql = "SELECT SUM(amount) as income FROM $this->table where user_id = ? AND type = 1";
        $res = $this->fetchSingle( $sql, $dt );

        return $res['income'] ?? 0;
    }

    function expenseSum( array $dt ) 
    {
        $sql = "SELECT SUM(amount) as expense FROM $this->table where user_id = ? AND type = 0";
        $res = $this->fetchSingle( $sql, $dt );

        return $res['expense'] ?? 0;
    }

    function currentMonthIncome(array $dt)
    {
        $sql = "SELECT SUM(amount) 
                FROM $this->table 
                WHERE user_id = ? 
                AND type = 1 
                AND MONTH(t_date) = MONTH(CURRENT_DATE()) 
                AND YEAR(t_date) = YEAR(CURRENT_DATE())";
        
        $res = $this->fetchSingle($sql, $dt);
        return $res ?? 0;
    }

    function lastMonthIncome(array $dt)
    {
        $sql = "SELECT SUM(amount) 
                FROM $this->table 
                WHERE user_id = ? 
                AND type = 1 
                AND MONTH(t_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) 
                AND YEAR(t_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)";
        
        $res = $this->fetchSingle($sql, $dt);
        return $res ?? 0;
    }

    function currentMonthExpense(array $dt)
    {
        $sql = "SELECT SUM(amount) 
                FROM $this->table 
                WHERE user_id = ? 
                AND type = 0 
                AND MONTH(t_date) = MONTH(CURRENT_DATE()) 
                AND YEAR(t_date) = YEAR(CURRENT_DATE())";
        
        $res = $this->fetchSingle($sql, $dt);
        return $res ?? 0;
    }

    function lastMonthExpense(array $dt)
    {
        $sql = "SELECT SUM(amount) 
                FROM $this->table 
                WHERE user_id = ? 
                AND type = 0 
                AND MONTH(t_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) 
                AND YEAR(t_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)";
        
        $res = $this->fetchSingle($sql, $dt);
        return $res ?? 0;
    }

    function addNew( array $dt ) 
    {
        $sql = "INSERT INTO $this->table (`user_id`, `title`, `amount`, `type`, `t_date`)  VALUES (?, ?, ?, ?, ?)";
        $res = $this->runQuery( $sql, $dt );

        return $res ?? false;
    }

    function getMonthlyTransactionSummary(array $dt = [])
    {
        $sql = "
            SELECT 
                MONTH(t_date) AS month,
                YEAR(t_date) AS year,
                type,
                SUM(amount) AS total
            FROM $this->table WHERE user_id = ?
            GROUP BY year, month, type
            ORDER BY year, month
        ";

        return $this->fetchMultiple($sql, $dt) ?? [];
    }

}