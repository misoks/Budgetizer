<?php
    include_once('functions.php');
?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>The Budgetizer</title>
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css" media="all">
    
    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width" />
  
    <link rel="shortcut icon" href="favicon.png" />
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
</head>

<body>

<h1><a href="/budgetizer">Budgetize Me!</a></h1>

 <div class="container container--inputs">
        <form method="post" action="index.php">
            <table class="">
                <tr>
                    <td class="label"><label for="salary">Salary</label></td>
                    <td class="field">
                        $<input type="number" name="salary" id="salary" value="<?php echo $salary ?>">
                    </td>
                </tr>
                <tr>
                    <td class="label"><label for="rent">Rent</label></td>
                    <td class="field">
                        $<input type="number" name="rent" id="rent" value="<?php echo -$rent ?>">
                    </td>
                </tr>
                <tr>
                    <td class="label">Utilities</td>
                    <td class="field">
                        <input name="water" type="checkbox" id="util-water" <?php if(isset($_POST['water'])){echo 'checked';} ?>>
                            <label for="util-water">Water</label><br>
                        <input name="electricity" type="checkbox" id="util-elec" <?php if(isset($_POST['electricity'])){echo 'checked';} ?>>
                            <label for="util-elec">Electricity</label><br>
                        <input name="gas" type="checkbox" id="util-gas" <?php if(isset($_POST['gas'])){echo 'checked';} ?>>
                            <label for="util-gas">Gas</label><br>
                        <input name="cable" type="checkbox" id="util-cable"<?php if(isset($_POST['cable'])){echo 'checked';} ?>>
                            <label for="util-cable">Cable</label>
                    </td>
                </tr>
                <tr>
                    <td class="label">Location</td>
                    <td class="field">
                        <select name="location" id="location-list">
                                <option value="NYC" <?php if(isset($_POST['location']) && $location=="NYC"){echo 'selected';} ?>>New York, NY</option>
                                <option value="A2" <?php if(isset($_POST['location']) && $location=="A2"){echo 'selected';} ?>>Ann Arbor, MI</option>
                                <option value="Cincinnati" <?php if(isset($_POST['location']) && $location=="Cincinnati"){echo 'selected';} ?>>Cincinnati, OH</option>
                                <option value="DC-VA" <?php if(isset($_POST['location']) && $location=="DC-VA"){echo 'selected';} ?>>D.C. Metro (VA)</option>
                                <option value="Memphis" <?php if(isset($_POST['location']) && $location=="Memphis"){echo 'selected';} ?>>Memphis, TN</option>
                                <option value="Boston" <?php if(isset($_POST['location']) && $location=="Boston"){echo 'selected';} ?>>Boston, MA</option>
                                <option value="Kansas City" <?php if(isset($_POST['location']) && $location=="Kansas City"){echo 'selected';} ?>>Kansas City, MO</option>
                                <option value="Madison" <?php if(isset($_POST['location']) && $location=="Madison"){echo 'selected';} ?>>Madison, WI</option>
                                <option value="Austin" <?php if(isset($_POST['location']) && $location=="Austin"){echo 'selected';} ?>>Austin, TX</option>
                                <option value="Portland" <?php if(isset($_POST['location']) && $location=="Portland"){echo 'selected';} ?>>Portland, OR</option>
                                <option value="Other" id="other-location" <?php if(isset($_POST['location']) && $location=="Other"){echo 'selected';} ?>>Other</option>
                        <select>
                    </td>
                </tr>
                <tr class="custom-box">
                    <td class="label">State Tax</td>
                    <td class="field">
                    (Gross salary - <input class="mod" name="s_mod1" value="<?php 
                        if(isset($_POST['s_mod1'])) { 
                            echo $_POST['s_mod1'];
                        } else { echo '0'; } ?>">) * <input class="mod mod--rate" name="s_rate" value="<?php 
                        if(isset($_POST['s_rate'])) { 
                            echo $_POST['s_rate'];
                        } else { echo '0.05'; } ?>"> + <input class="mod" name="s_mod2" value="<?php 
                        if(isset($_POST['s_mod2'])) { 
                            echo $_POST['s_mod2'];
                        } else { echo '0'; } ?>">
                    </td>
                </tr>
                 <tr class="custom-box">
                    <td class="label">City Tax</td>
                    <td class="field">
                    (Gross salary - <input class="mod" name="c_mod1" value="<?php 
                        if(isset($_POST['c_mod1'])) { 
                            echo $_POST['c_mod1'];
                        } else { echo '0'; } ?>">) * <input class="mod mod--rate" name="c_rate" value="<?php 
                        if(isset($_POST['c_rate'])) { 
                            echo $_POST['c_rate'];
                        } else { echo '0.02'; } ?>"> + <input class="mod" name="c_mod2" value="<?php 
                        if(isset($_POST['c_mod2'])) { 
                            echo $_POST['c_mod2'];
                        } else { echo '0'; } ?>">
                    </td>
                </tr>
                <tr class="custom-box">
                    <td class="label">Cost of Living Modifier</td>
                    <td class="field">
                        <input class="mod mod--col" name="col" value="<?php 
                        if(isset($_POST['col'])) { 
                            echo $_POST['col'];
                        } else { echo '1'; } ?>"><br>
                        <span class="caption">Number to multiply variable costs by. i.e. If cost of living
                            is 75% higher than in Ann Arbor, put 1.75 here. <a href="http://www.bankrate.com/calculators/savings/moving-cost-of-living-calculator.aspx" target="_blank">Use this for reference</a>.</span>
                    </td>
                </tr>
                <tr class="custom-box">
                    <td class="label">Car?</td>
                    <td class="field">
                        <input name="car" type="checkbox"><br>
                    </td>
                </tr>
                <tr class="custom-box">
                    <td class="label">Public transit?</td>
                    <td class="field">
                        <input name="transit" type="checkbox"><br>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Calculate">
                    </td>
                </tr>
            </table>
        </form>
       </div>

<?php if( isset($_POST['salary']) ) { ?>
<div class="container container--budget">
    <table>
        <tr class="heading">
            <th></th>
            <th>Annual</th>
            <th>Monthly</th>
            <th class="value-cell--weekly">Weekly</th>
        </tr>
        <tr>
            <td class="label">Salary</td>
            <td class="value-cell value-cell--annual"><?php echo number_format((float)$salary, 2, '.', ''); ?></td>
            <td class="value-cell value-cell--monthly"><?php echo number_format((float)$salary/12, 2, '.', ''); ?></td>
            <td class="value-cell value-cell--weekly"><?php echo number_format((float)$salary/52, 2, '.', ''); ?></td>
    </table>
        <?php foreach ($budget as $arr_key => $arr) {
            echo "<h3 class='table-subheading'>$arr_key</h3><table>";
            foreach ($arr as $key => $value) {
                $posneg = ispos($value);
                $yr = number_format((float)$value, 2, '.', '');
                $mo = number_format((float)$value/12, 2, '.', '');
                $wk = number_format((float)$value/52, 2, '.', '');
                echo "<tr>
                    <td class='label'>$key</td>
                    <td class='$posneg value-cell value-cell--annual'>$yr</td>
                    <td class='$posneg value-cell value-cell--monthly'>$mo</td>
                    <td class='$posneg value-cell value-cell--weekly'>$wk</td>
                </tr>";
            }
            echo "</table>";
        }
        ?>
        <?php $total =  $salary 
                        + array_sum($budget['Pre-Tax']) 
                        + array_sum($budget['Taxes']) 
                        + array_sum($budget['Transportation']) 
                        + array_sum($budget['Apartment']) 
                        + array_sum($budget['Expenses']) 
                        + array_sum($budget['Financial']);
            $posneg_total = ispos($total);
        ?>
        <table>
        <tr class="total-row">
        
            <td class="label value-cell">Total</td>
            <?php echo "
            <td class='$posneg_total value-cell value-cell--annual'>".money_format('$%i', $total)."</td>
            <td class='$posneg_total value-cell value-cell--monthly'>".money_format('$%i', $total/12)."</td>
            <td class='$posneg_total value-cell value-cell--weekly'>".money_format('$%i', $total/52)."</td>"; ?>
        </tr>
    </table>
</div>
<?php } ?>
   
      </body>  
</html>