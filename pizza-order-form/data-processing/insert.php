<?php
    //This function handles inserting pizza form values into our db
    function insertPizzaValues($VALUES) {
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
                $name,
                $phone,
                $email,
                $address,
                $city,
                $state
            )
        ";

        //Insert customer into database
        $insertCustomer = @mysqli_query($cnxn, $customerSQL);

        //Get customerID out of database
        $customerRow = mysqli_fetch_assoc($insertCustomer);
        $customerId = $customerRow['customerID'];

        //Calculate the delivery boolean
        $deliveryBool = null;
        if ($delivery == "delivery") {
            $deliveryBool = True;
        } else {
            $deliveryBool = False;
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
        $selectPriceId = @mysqli_query($cnxn, $pizzaSizeSQL);
        $priceRow = mysqli_fetch_assoc($selectPriceId);
        $priceId = $promoRow['promoID'];

        //Run SQL query to find out the promoId for the promo code
        $promoSQL = "";
        if ($promo != "") {
            $promoSQL = "
                SELECT * FROM `Promos` WHERE code='$promo'
            ";
        }

        //Run SQL query to find out what the promoId is
        $selectPromoId = @mysqli_query($cnxn, $promoSQL);
        $promoRow = mysqli_fetch_assoc($selectPromoId);
        $promoId = null;
        if (mysql_num_rows($promoRow) > 0) {
            $promoId = $promoRow['promoID'];
        }

        //Calculate the timestamp for when the order is placed
        $date = date('m/d/Y h:i:s a', time());

        //SQL Query to insert new order into db
        //We won't define orderID, we will assume every order is new
        $orderSQL = "
            INSERT INTO Orders(
                customerId,
                topping1,
                topping2,
                topping3,
                delivery,
                promoID,
                priceID,
                promoID,
                order_placed
            ) VALUES (
                $customerId,
                $topping1,
                $topping2,
                $topping3,
                $deliveryBool,
                $priceId,
                $promoId,
                $date
            )
        ";

        //Insert order into database
        @mysqli_query($cnxn, $orderSQL);
    }

    //Clean up form responses to prevent security issues
    function clean_form_responses($data) {
        return trim(stripslashes(htmlspecialchars($data)));
    }
?>