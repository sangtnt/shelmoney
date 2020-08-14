<?php
    function findDate($date){
        $d = getdate(strtotime($date));
        $weekday = $d["weekday"];
        $weekday = strtolower($weekday);
        switch($weekday) {
            case 'monday':
                $weekday = 'Thứ hai';
                break;
            case 'tuesday':
                $weekday = 'Thứ ba';
                break;
            case 'wednesday':
                $weekday = 'Thứ tư';
                break;
            case 'thursday':
                $weekday = 'Thứ năm';
                break;
            case 'friday':
                $weekday = 'Thứ sáu';
                break;
            case 'saturday':
                $weekday = 'Thứ bảy';
                break;
            default:
                $weekday = 'Chủ nhật';
                break;
        }
        return $weekday." ".date_format(date_create($date), "d/m/Y");
    }

    if (!function_exists('currency_format')) {
        function currency_format($number, $suffix = 'đ') {
            if (!empty($number)&&$number!=0) {
                return number_format($number, 0, ',', '.') . "{$suffix}";
            }
            else{
                return "0đ";
            }
        }
    }
    function findAll(){
        require "./connectDatabase.php";
        $sql = "SELECT * FROM user";
        $users = $conn->query($sql);
        return $users;
    }
    function findAllSpendingByTime($date, $year){
        require "./connectDatabase.php";
        $id =$_SESSION["id"];
        $sql = "SELECT * FROM money_usage WHERE YEAR(date) = $year AND MONTH(date) = $date AND user_id='$id' ORDER BY date DESC";
        $result = $conn->query($sql);
        return $result;
    }
    function findAllBalance(){
        require "./connectDatabase.php";
        $id =$_SESSION["id"];
        $sql = "SELECT * FROM money_addition WHERE user_id='$id' ORDER BY date DESC";
        $result = $conn->query($sql);
        return $result;
    }
    function findAllDebtor(){
        require "./connectDatabase.php";
        $id =$_SESSION["id"];
        $sql = "SELECT * FROM debtor WHERE user_id='$id' ORDER BY date_borrow DESC";
        $result = $conn->query($sql);
        return $result;
    }
    function deleteDebtor($id, $amount){
        require "./connectDatabase.php";
        $userId = $_SESSION["id"];
        $sql = "DELETE FROM debtor WHERE id='$id'";
        $sql2 = "UPDATE user SET balance=balance+$amount WHERE id='$userId'";
        $conn->query($sql);
        $conn->query($sql2);
    }
    function editAmountDebtor($id, $amount){
        require "./connectDatabase.php";
        $userId = $_SESSION["id"];
        $sql = "UPDATE debtor SET amount=amount-$amount WHERE id='$id'";
        $sql2 = "UPDATE user SET balance=balance+$amount WHERE id='$userId'";
        $conn->query($sql);
        $conn->query($sql2);
    }
    function check($user){
        require "./connectDatabase.php";
        $sql = "SELECT * FROM user WHERE username = '$user->username' AND user_password = '$user->password'";
        $result = $conn->query($sql);
        if ($result->num_rows>0){
            while($row = $result->fetch_assoc()) {
                return $row['id'];
            }
        }
        else{
            return '';
        }
    }
    function moneyTotalUsedThisMonth(){
        require "./connectDatabase.php";
        $id =$_SESSION["id"];
        $sql = "SELECT * FROM money_usage WHERE YEAR(date) = YEAR(CURRENT_DATE) AND MONTH(date) = MONTH(CURRENT_DATE) AND user_id='$id'";
        $result = $conn->query($sql);
        $total = 0;
        if ($result->num_rows>0){
            while($row = $result->fetch_assoc()) {
                $total = $total + $row["amount"];
            }
        }
        return currency_format($total);
    }
    function moneyTotalUsedLastYear(){
        require "./connectDatabase.php";
        $id =$_SESSION["id"];
        $sql = "SELECT * FROM money_usage WHERE YEAR(date) = YEAR(CURRENT_DATE- INTERVAL 1 YEAR) AND user_id='$id'";
        $result = $conn->query($sql);
        $total = 0;
        if ($result->num_rows>0){
            while($row = $result->fetch_assoc()) {
                $total = $total + $row["amount"];
            }
        }
        return currency_format($total);
    }
    function moneyTotalUsedLastMonth(){
        require "./connectDatabase.php";
        $id =$_SESSION["id"];
        $sql = "SELECT * FROM money_usage WHERE YEAR(date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AND user_id='$id'";
        $result = $conn->query($sql);
        $total = 0;
        if ($result->num_rows>0){
            while($row = $result->fetch_assoc()) {
                $total = $total + $row["amount"];
            }
        }
        return currency_format($total);
    }
    function numberOfDebtor(){
        require "./connectDatabase.php";
        $id =$_SESSION["id"];
        $sql = "SELECT * FROM debtor WHERE user_id='$id'";
        $result = $conn->query($sql);
        return $result;
    }
    function balance(){
        require "./connectDatabase.php";
        $id =$_SESSION["id"];
        $sql = "SELECT balance FROM user WHERE id='$id'";
        $result = $conn->query($sql);
        $total = 0;
        if ($result->num_rows>0){
            while($row = $result->fetch_assoc()) {
                $total = $total + $row["balance"];
            }
        }
        return currency_format($total);
    }
    function addBalance($amount, $note){
        require "./connectDatabase.php";
        $id =$_SESSION["id"];
        $sql = "INSERT INTO money_addition (user_id, amount, note) VALUES ('$id', $amount,'$note')";
        $sql2 = "UPDATE user SET balance=balance+$amount WHERE id='$id'";
        $conn->query($sql);
        $conn->query($sql2);
    }
    function addSpending($amount, $note){
        require "./connectDatabase.php";
        $id =$_SESSION["id"];
        $sql = "INSERT INTO money_usage (user_id, amount, note) VALUES ('$id', $amount,'$note')";
        $sql2 = "UPDATE user SET balance=balance-$amount WHERE id='$id'";
        $conn->query($sql);
        $conn->query($sql2);
    }
    function addDebtor($name, $amount){
        require "./connectDatabase.php";
        $id =$_SESSION["id"];
        $sql = "INSERT INTO debtor (user_id, amount, fullname) VALUES ('$id', $amount,'$name')";
        $sql2 = "UPDATE user SET balance=balance-$amount WHERE id='$id'";
        $conn->query($sql);
        $conn->query($sql2);
    }
?>