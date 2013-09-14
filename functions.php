<?php

//Check if a number is positive or negative and add color accordingly
function ispos($val) {
    if ( $val >= 0 ) {
        return "positive";
    }
    else {
        return "negative";
    }
}

if( isset($_POST['salary']) ) {

    $salary = $_POST['salary'];
    $rent = -$_POST['rent'];

    
    //Amount to put into 401k each year
    $retire401k = -(.02) * $salary;
    
    //By default, no car and no public transit
    $car = 0;
    $public_transit = 0;
    
    $location = $_POST['location'];
    if ($location == 'NYC') {
        $col = 1.6;
        
        $health_ins = -1200 * $col;
        $salary_adj = $salary + $retire401k + $health_ins;
        
        $state_tax = -($salary_adj) * 0.0645;
        $city_tax = -($salary_adj - 60000) * 0.03648 - 2047;
        
        $public_transit = 1.5;
        $car = 0;
    }
    else if ($location == 'A2') {
    $health_ins = -1200 * $col;
        $col = 1;
        
        $health_ins = -1200 * $col;
        $salary_adj = $salary + $retire401k + $health_ins;
        
        $state_tax = -($salary_adj) * 0.0435;
        $city_tax = 0;
        
        $public_transit = 0;
        $car = 1;
    }
    else if ($location == 'Cincinnati') {
        $col = .9;
        
        $health_ins = -1200 * $col;
        $salary_adj = $salary + $retire401k + $health_ins;
        
        $state_tax = -($salary_adj) * 0.0411;
        $city_tax = -($salary_adj) * 0.021;
        
        $public_transit = 0;
        $car = 1;
    }
    else if ($location == 'DC-VA') {
        $col = 1.4;
        
        $health_ins = -1200 * $col;
        $salary_adj = $salary + $retire401k + $health_ins;
        
        $state_tax = -($salary_adj - 17000) * 0.0575 - 720;
        $city_tax = 0;
        
        $car = 1;
        $public_transit = 1;
    }
    else if ($location == 'Memphis') {
        $col = .85;
        
        $health_ins = -1200 * $col;
        $salary_adj = $salary + $retire401k + $health_ins;
        
        $state_tax = 0;
        $city_tax = 0;
        
        $car = 1;
        $public_transit = 0;
    }
    else if ($location == 'Boston') {
        $col = 1.4;
        
        $health_ins = -1200 * $col;
        $salary_adj = $salary + $retire401k + $health_ins;
        
        $state_tax = -$salary_adj * 0.053;
        $city_tax = 0;
        
        $car = 1;
        $public_transit = 1;
    }
    else if ($location == 'Kansas City') {
        $col = .97;
        
        $health_ins = -1200 * $col;
        $salary_adj = $salary + $retire401k + $health_ins;
        
        $state_tax = -$salary_adj * 0.06;
        $city_tax = -$salary_adj * 0.01;
        
        $car = 1;
        $public_transit = 0;
    }
    else if ($location == 'Madison') {
        $col = 1.07;
        
        $health_ins = -1200 * $col;
        $salary_adj = $salary + $retire401k + $health_ins;
        
        $state_tax = -($salary_adj - 21130) * 0.065 - 1135.66;
        $city_tax = 0;
        
        $car = 1;
        $public_transit = 0;
    }
    else if ($location == 'Austin') {
        $col = .94;
        
        $health_ins = -1200 * $col;
        $salary_adj = $salary + $retire401k + $health_ins;
        
        $state_tax = 0;
        $city_tax = 0;
        
        $car = 1;
        $public_transit = 0;
    }
    else if ($location == 'Portland') {
        $col = 1.1348;
        
        $health_ins = -1200 * $col;
        $salary_adj = $salary + $retire401k + $health_ins;
        
        $state_tax = -( (.05 * 3100) + (.07 * 4849) + ($salary_adj - 7951) * .09 );
        $city_tax = -$salary_adj * .06318;
        
        $car = 1;
        $public_transit = 0;
    }
    else if ($location == 'Other') {
        $state_tax = -($salary_adj - $_POST['s_mod1']) * $_POST['s_rate'] - $_POST['s_mod2'];
        $city_tax = -($salary_adj - $_POST['c_mod1']) * $_POST['c_rate'] - $_POST['c_mod2'];
        
        $col = $_POST['col'];
        $salary_adj = $salary + $retire401k + $health_ins;
        
        if ( isset($_POST['car']) && ($_POST['car'] == 'on') ) { $car = 1; }
        if (isset($_POST['transit']) && ($_POST['transit'] == 'on')) {$public_transit = 1;}
    }
    $water = 0;
    $electricity = 0;
    $gas = 0;
    $cable = 0;
    if ( isset($_POST['water']) && ($_POST['water'] == 'on') ) { $water = 1; }
    if (isset($_POST['electricity']) && ($_POST['electricity'] == 'on')) {$electricity = 1;}
    if (isset($_POST['gas']) && ($_POST['gas'] == 'on')) {$gas = 1;}
    if (isset($_POST['cable']) && ($_POST['cable'] == 'on')) {$cable = 1;}

    $budget = array(
        "Pre-Tax" => array(
            "401k" => $retire401k,
            "Health Insurance" => $health_ins
        ),
        
        "Taxes" => array(
            "Social Security" => -($salary * 0.062),
            "Medicare" => -($salary * 0.0145),
            "Federal Tax" => -($salary_adj - 34500) * 0.25 - 4750,
            "State Tax" => $state_tax,
            "City Tax" => $city_tax
        ),
        
        "Transportation" => array(
            "Public Transit" => 12 * -70 * $public_transit,
            "Car Insurance" => 12 * -100 * $col * $car,
            "Car Payment" => 12 * -215.89 * $car,
            "Gasoline" => 12 * -80 * $col * $car,
        ),
        
        "Apartment" => array(
            "Rent" => $rent * 12,
            "Electricity" => -50 *12 * $electricity,
            "Water" => -20 * 12 * $water,
            "Gas" => -20 * 12 * $gas,
            "Cable/Internet" => -100 * 12 * $cable,
        ),
        
        "Expenses" => array(
            "Phone" => -80 * 12,
            "Groceries" => 12 * -250 * $col,
            "Restaurants" => 12 * -100 * $col,
            "Shopping" => 12 * -400 * $col,
        ),
        "Financial" => array(
            "Loan Payment" => 12 * -507,
        ),
    );
    if ($public_transit == 0) {
        unset($budget["Transportation"]["Public Transit"]);
    }
    if ($car == 0) {
        unset($budget["Transportation"]["Car Insurance"]);
        unset($budget["Transportation"]["Car Payment"]);
        unset($budget["Transportation"]["Gasoline"]);
    }
}
?>