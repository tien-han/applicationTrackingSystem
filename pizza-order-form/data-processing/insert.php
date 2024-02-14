<?php
    //This function handles inserting pizza form values into our db
    function insertPizzaValues($VALUES) {
        echo "<div>Thank you for your order!</><br />";

        //Get and clean form responses
        $name = clean_form_responses($VALUES["fname"]);
        $phone = clean_form_responses($VALUES["phone"]);
        $email = clean_form_responses($VALUES["email"]);
        $address = clean_form_responses($VALUES["address"]);
        $city = clean_form_responses($VALUES["city"]);
        $state = clean_form_responses($VALUES["state"]);
        $delivery = clean_form_responses($VALUES["delivery"]);
        $promo = clean_form_responses($VALUES["promo"]);
        $size = clean_form_responses($VALUES["size"]);
        $topping1 = clean_form_responses($VALUES["topping"][0]);
        $topping2 = clean_form_responses($VALUES["topping"][1]);
        $topping3 = clean_form_responses($VALUES["topping"][2]);

        //Get DB Connection credentials
        require '/home/cicadagr/pizzadb.php';

        //SQL Query to insert new customer into db
        //We won't define customerID, we will assume every new order is from a new customer
        $customerSQL = "
            INSERT INTO Customers (
                name,
                phone,
                email,
                streetAddress,
                city,
                state
            ) VALUES (
                '$name',
                '$phone',
                '$email',
                '$address',
                '$city',
                '$state'
            )
        ";

        //Insert customer into database
        if (mysqli_query($cnxn, $customerSQL)) {
            echo "<br />New customer record created successfully<br /><br />";
        } else {
            echo "Error: " . $customerSQL . "<br>" . mysqli_error($cnxn);
        }

        //Get customerID out of database
        $customerIdSQL = "SELECT * FROM Customers ORDER BY customerID DESC LIMIT 1";
        $customerIdsResult = mysqli_query($cnxn, $customerIdSQL);
        $customerId = mysqli_fetch_assoc($customerIdsResult);
        $customerId = $customerId["customerID"];

        //Calculate the delivery value
        $deliveryVal = 0;
        if ($delivery == "delivery") {
            $deliveryVal = 1;
        }

        //SQL for getting the "priceId" of a pizza size
        $pizzaSizeSQL = "";
        if ($size == "sm") {
            $pizzaSizeSQL = "
                SELECT * FROM `Prices` WHERE description='small'
            ";
        } elseif ($size == "md") {
            $pizzaSizeSQL = "
                SELECT * FROM `Prices` WHERE description='Medium'
            ";
        } else {
            $pizzaSizeSQL = "
                SELECT * FROM `Prices` WHERE description='Large'
            ";
        }

        //Run SQL query to find out the priceId of the pizza size
        $selectPriceId = mysqli_query($cnxn, $pizzaSizeSQL);
        $priceRow = mysqli_fetch_assoc($selectPriceId);
        $priceId = $priceRow['priceID'];

        //Run SQL query to find out the promoId for the promo code
        $promoId = "";
        if ($promo != "") {
            $promoSQL = "SELECT * FROM `Promos` WHERE code='$promo'";

            //Run SQL query to find out what the promoId is
            $selectPromoId = mysqli_query($cnxn, $promoSQL);
            $promoRow = mysqli_fetch_assoc($selectPromoId);
            $promoId = $promoRow['promoID'];
        }

        //Calculate the timestamp for when the order is placed
        $date = date('Y-m-d H:i:s', time());

        //SQL Query to insert new order into db
        //We won't define orderID, we will assume every order is new
        $orderSQL = "";

        if ($promoId == "") {
            $orderSQL = "
            INSERT INTO Orders(
                customerId,
                topping1,
                topping2,
                topping3,
                delivery,
                priceID,
                order_placed
            ) VALUES (
                '$customerId',
                '$topping1',
                '$topping2',
                '$topping3',
                '$deliveryVal',
                '$priceId',
                '$date'
            )";
        } else {
            $orderSQL = "
            INSERT INTO Orders(
                customerId,
                topping1,
                topping2,
                topping3,
                delivery,
                priceID,
                promoID,
                order_placed
            ) VALUES (
                '$customerId',
                '$topping1',
                '$topping2',
                '$topping3',
                '$deliveryVal',
                '$priceId',
                '$promoId',
                '$date'
            )";
        }

        if (mysqli_query($cnxn, $orderSQL)) {
            echo "New order record created successfully<br /><br />";
        } else {
            echo "Error: " . $orderSQL . "<br>" . mysqli_error($cnxn);
        }
    }

    //Clean up form responses to prevent security issues
    function clean_form_responses($data) {
        return trim(stripslashes(htmlspecialchars($data)));
    }
?>