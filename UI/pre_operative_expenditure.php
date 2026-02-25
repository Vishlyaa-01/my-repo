<?php
    include 'db.php';

    /* ---------------- INSERT ---------------- */
    if (isset($_POST['add'])) {
        $name = $_POST['registration_and_licenses'];
        $authority = $_POST['issuing_authority'];
        $cost = $_POST['approximate_cost'];

        $query = "INSERT INTO pre_operative_expenditure 
                (registration_and_licenses, issuing_authority, approximate_cost_in_rupees)
                VALUES ('$name', '$authority', '$cost')";
        mysqli_query($conn, $query);
        header("Location: pre_operative_expenditure.php");
        exit();
    }

    /* ---------------- DELETE ---------------- */
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        mysqli_query($conn, "DELETE FROM pre_operative_expenditure WHERE sr_no=$id");
        header("Location: pre_operative_expenditure.php");
        exit();
    }

    /* ---------------- UPDATE ---------------- */
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['registration_and_licenses'];
        $authority = $_POST['issuing_authority'];
        $cost = $_POST['approximate_cost'];

        $query = "UPDATE pre_operative_expenditure SET 
                registration_and_licenses='$name',
                issuing_authority='$authority',
                approximate_cost_in_rupees='$cost'
                WHERE sr_no=$id";
        mysqli_query($conn, $query);
        header("Location: pre_operative_expenditure.php");
        exit();
    }
    $totalQuery = mysqli_query($conn, "SELECT SUM(approximate_cost_in_rupees) AS total_amount FROM pre_operative_expenditure");
    $totalRow = mysqli_fetch_assoc($totalQuery);
    $totalAmount = $totalRow['total_amount'] ?? 0;

?>
<!DOCTYPE html>
<html>
<head>
<title>Registration & Licenses</title>

<style>
    /* ---- YOUR PROVIDED CSS ---- */
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
    input[type="text"], input[type="number"] {
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
    .btn-edit { background: #f59e0b; color: #fff; }
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

    <h1>Registration & Licenses</h1>
    <hr style="width:60%; margin:25px auto; border:none; height:5px; background:linear-gradient(to right, transparent, #000a1e, transparent);">
    
    <div class="container">

        <!-- -------- ADD FORM -------- -->
        <form method="POST">
            <table>
                <tr>
                    <td><input type="text" name="registration_and_licenses" placeholder="Registration & License Name" required></td>
                    <td><input type="text" name="issuing_authority" placeholder="Issuing Authority" required></td>
                    <td><input type="number" step="0.01" name="approximate_cost" placeholder="Cost in Rupees" required></td>
                    <td><button type="submit" name="add" class="btn btn-add">Add</button></td>
                </tr>
            </table>
        </form>

        <br>

        <!-- -------- DATA TABLE -------- -->
        <table>
            <thead>
            <tr>
                <th>Registration & Licenses</th>
                <th>Issuing Authority</th>
                <th>Cost (Crores)</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            <?php
            $result = mysqli_query($conn, "SELECT * FROM pre_operative_expenditure ORDER BY sr_no ASC");

            $counter = 1;
            while ($row = mysqli_fetch_assoc($result)) {

            ?>
            <tr>
                <form method="POST">
                    <td>
                        <input type="hidden" name="id" value="<?php echo $row['sr_no']; ?>">
                        <input type="text" name="registration_and_licenses" 
                        value="<?php echo $row['registration_and_licenses']; ?>">
                    </td>

                    <td>
                        <input type="text" name="issuing_authority" 
                        value="<?php echo $row['issuing_authority']; ?>">
                    </td>

                    <td>
                        <input type="number" step="0.01" name="approximate_cost" 
                        value="<?php echo $row['approximate_cost_in_rupees']; ?>">
                    </td>

                    <td>
                        <button type="submit" name="update" class="btn btn-edit">Edit</button>
                        <a href="?delete=<?php echo $row['sr_no']; ?>" 
                        onclick="return confirm('Are you sure?')" 
                        class="btn btn-delete">Delete</a>
                    </td>
                </form>
            </tr>
            <?php } ?>

            </tbody>
        </table>

        <div class="total-box">
            Total Pre-Operative Expenditure: 
            <strong>₹ <?php echo number_format($totalAmount, 2); ?></strong>
        </div>

    </div>
</body>
</html>
