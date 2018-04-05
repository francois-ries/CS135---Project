<?php
echo $result; 
?>


<!DOCTYPE html>
<html lang="en" class="gr__getbootstrap_com" http-equiv="Content-Type"> 
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Checkout</title>
        <!-- <link rel="stylesheet" href="layout.css"> -->
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/form-validation.css" rel="stylesheet">

        <!-- jQuery  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>-->
        
    </head>

    <body class="bg-light" ata-gr-c-s-loaded="true" algoad="[&quot;cjgplikomfepokpgoiomongcpddafcdl&quot;]">
        <div class="container" id = 'ajax_comp'>
            <div class="py-5 text-center">
                <h2>Register</h2>
            </div>

            <!-- Customer Information and Validation  -->
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Please enter the following information.</h4>
                    <form name="frmRegister" method="post">
            
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">First name</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder=""  required="">
                                <div class="invalid-feedback">
                                Valid first name is required.
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="lastName">Last name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName"  placeholder=""  required="">
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="sid">Student ID <span class="text-muted"></span></label>
                            <input type="text" class="form-control" id="sid" name='sid' placeholder="30316074" >
                            <div class="invalid-feedback">
                                Please enter a valid student id.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email">Email </label>
                            <input type="email" class="form-control" id="email" name ='email' placeholder="you@example.com" >
                            <div class="invalid-feedback">
                                Please enter a valid email address for reservation updates.
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="phone">Phone <span class="text-muted"></span></label>
                            <input type="text" class="form-control" id="phone" name='phone' placeholder="000-000-0000" >
                            <div class="invalid-feedback">
                                Please enter a valid phone number for reservation updates.
                            </div>
                        </div>
            

                        <div class="mb-3">
                            <label for="password">Password <span class="text-muted"></span></label>
                            <input type="text" class="form-control" id="password" name='password' >
                            <div class="invalid-feedback">
                                Please enter a password.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="cpassword">Confirm Password <span class="text-muted"></span></label>
                            <input type="text" class="form-control" id="cpassword" name='cpassword' >
                            <div class="invalid-feedback">
                                Please confirm the password.
                            </div>
                        </div>  

                        <h4 class="mb-3">To register as admin, please enter admin key.</h4>
                        <div class="mb-3">
                            <label for="admin">Admin Key<span class="text-muted"></span></label>
                            <input type="text" class="form-control" id="key" name='key' >
                            <div class="invalid-feedback">
                                Please enter admin code if you are registering an admin account.
                            </div>
                        </div>  
                                                              
                                    
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit" id = 'submit' name = 'submit'>Register</button>
                </form>
            </div>  
        </div>


    <!-- AJAX Component --> 
    <script type="text/javascript">
        $(function() {
            // IMPORTANT: Fill in your client key
            var clientKey = "js-fXan2MeOEdx86PFbuO6YnyCh4GcN20RlY5CVTvfPh43ptk8lTZLOHePI79oTPpNu";
            
            var cache = {};
            var container = $("#ajax_comp");
            var errorDiv = container.find("div.text-error");
            
            /** Handle successful response */
            function handleResp(data)
            {
                // Check for error
                if (data.error_msg)
                    errorDiv.text(data.error_msg);
                else if ("city" in data)
                {
                    // Set city and state
                    container.find("input[name='city']").val(data.city);
                    container.find("input[name='state']").val(data.state);
                }
            }
            
            // Set up event handlers
            container.find("input[name='zipcode']").on("keyup change", function() {
                // Get zip code
                var zipcode = $(this).val().substring(0, 5);
                if (zipcode.length == 5 && /^[0-9]+$/.test(zipcode))
                {
                    // Clear error
                    //errorDiv.empty();
                    errorDiv.text("called to test zipcode")
                    
                    // Check cache
                    if (zipcode in cache)
                    {
                        handleResp(cache[zipcode]);
                    }
                    else
                    {
                        // Build url
                        var url = "https://www.zipcodeapi.com/rest/"+clientKey+"/info.json/" + zipcode + "/radians";
                        
                        // Make AJAX request
                        $.ajax({
                            "url": url,
                            "dataType": "json"
                        }).done(function(data) {
                            handleResp(data);
                    
                            // Store in cache
                            cache[zipcode] = data;
                        }).fail(function(data) {
                            if (data.responseText && (json = $.parseJSON(data.responseText)))
                            {
                                // Store in cache
                                cache[zipcode] = json;
                                
                                // Check for error
                                if (json.error_msg)
                                    errorDiv.text(json.error_msg);
                            }
                            else
                                errorDiv.text('Request failed.');
                        });
                    }
                }
            }).trigger("change");
        });
    </script>

        
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

        <!-- <script src="jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
       
        <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
        <script src="popper.min.js"></script>
        <script src="bootstrap.min.js"></script>
        <script src="holder.min.js"></script>
        <!--- Example starter JavaScript for disabling form submissions if there are invalid fields-->
        <script>
                  (function() {
                'use strict';
                window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.value == "") {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                    // form.classList.add('was-validated');
                    }, false);
                });
                }, false);
            })();
        </script>    

    </body>
</html>