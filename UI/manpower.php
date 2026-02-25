<?php
include 'db.php';

/* INSERT */
if (isset($_POST['add'])) {
    $designation = $_POST['designation'];
    $employees = $_POST['employees'];
    $salary = $_POST['salary'];

    mysqli_query($conn, "INSERT INTO man_power (designation,no_of_employees,salary_per_employee)
                         VALUES ('$designation','$employees','$salary')");
    header("Location: manpower.php");
    exit();
}

/* DELETE */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM man_power WHERE id=$id");
    header("Location: manpower.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM man_power");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Man Power Requirement</title>

<style>
    :root {
        --primary: #2563eb;
        --primary-dark: #1e40af;
        --bg: #f1f5f9;
        --card: #ffffff;
        --border: #e5e7eb;
        --text: #1f2937;
    }

    * { box-sizing: border-box; }

    body {
        margin: 0;
        padding: 15px;
        font-family: "Segoe UI", system-ui, sans-serif;
        background: var(--bg);
        color: var(--text);
    }

    h1 {
        font-size: 28px;
        margin: 20px;
        text-align: center;
        color: var(--primary-dark);
    }

    .container {
        background: var(--card);
        padding: 22px;
        border-radius: 14px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.06);
        margin-bottom: 30px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 12px;
        overflow: hidden;
    }

    thead th {
        background: var(--primary);
        color: #fff;
        padding: 12px;
    }

    tbody td {
        border-bottom: 1px solid var(--border);
        padding: 10px;
        text-align: center;
    }

    input[type="text"],
    input[type="number"] {
        width: 100%;
        padding: 7px 8px;
        border-radius: 6px;
        border: 1px solid var(--border);
    }

    .btn {
        padding: 7px 14px;
        border-radius: 6px;
        border: none;
        font-size: 13px;
        cursor: pointer;
        font-weight: 600;
    }

    .btn-add { background: #16a34a; color: #fff; }

    .btn-delete { background: #dc2626; color: #fff; }

    .total-box {
        margin-top: 25px;
        padding: 20px;
        border-radius: 14px;
        background: linear-gradient(135deg, #2563eb, #1e40af);
        color: white;
        font-size: 18px;
        font-weight: 600;
        text-align: right;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    .total-box strong {
        font-size: 22px;
    }
</style>

</head>

<body>
        <h1>Man Power Requirement</h1>
        <hr style="width:60%; margin:25px auto; border:none; height:5px; background:linear-gradient(to right, transparent, #000a1e, transparent);">

    <div class="container">


        <form method="POST">
            <table>
                <tr>
                    <td><input type="text" name="designation" placeholder="Designation" required></td>
                    <td><input type="number" name="employees" placeholder="No of Employees" required></td>
                    <td><input type="number" step="0.01" name="salary" placeholder="Salary per Employee (Monthly ₹)"
                            required></td>
                    <td><button type="submit" name="add" class="btn btn-add">Add</button></td>
                </tr>
            </table>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Designation</th>
                    <th>Employees</th>
                    <th>Monthly Salary (₹)</th>
                    <th>Year 1</th>
                    <th>Year 2</th>
                    <th>Year 3</th>
                    <th>Year 4</th>
                    <th>Year 5</th>
                    <th>Year 6</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $subtotal = array_fill(1,6,0);

                while($row = mysqli_fetch_assoc($result)) {

                    $monthly_total = $row['no_of_employees'] * $row['salary_per_employee'];
                    $year[1] = $monthly_total * 12;

                    for($i=2;$i<=6;$i++){
                        $year[$i] = $year[$i-1] * 1.10;
                    }

                    for($i=1;$i<=6;$i++){
                        $subtotal[$i] += $year[$i];
                    }
            ?>
                <tr>
                    <td>
                        <?php echo $row['designation']; ?>
                    </td>
                    <td>
                        <?php echo $row['no_of_employees']; ?>
                    </td>
                    <td>₹
                        <?php echo number_format($row['salary_per_employee'],2); ?>
                    </td>

                    <?php for($i=1;$i<=6;$i++){ ?>
                    <td>₹
                        <?php echo number_format($year[$i],2); ?>
                    </td>
                    <?php } ?>

                    <td><a href="?delete=<?php echo $row['id']; ?>" class="btn btn-delete">Delete</a></td>
                </tr>
                <?php } ?>

            </tbody>
        </table>

        <?php
            /* OFFICE EXPENDITURE */
            for($i=1;$i<=6;$i++){
                $overhead[$i] = $subtotal[$i] * 0.02;
                $travel[$i] = $subtotal[$i] * 0.05;
                $escalation[$i] = $subtotal[$i] * 0.01;
                $office_total[$i] = $overhead[$i] + $travel[$i] + $escalation[$i];
                $final_total[$i] = $subtotal[$i] + $office_total[$i];
            }
        ?>

        <div class="total-box">
            <h3>Yearly Totals</h3>
            <?php for($i=1;$i<=6;$i++){ ?>
            Year
            <?php echo $i; ?> : ₹
            <?php echo number_format($final_total[$i],2); ?><br>
            <?php } ?>
        </div>

    </div>
</body>

</html>