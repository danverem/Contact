<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>New Contact</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


</head>
<body>
    <nav>
        <div class="nav-wrapper">
            <a href="#" class="brand-logo">Contact Manager</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="#">Home page</a></li>
                <li><a href="#">New Contact</a></li>
                <li><a href="#">Update Contact</a> </li>
                <li><a href="#">Create Account</a></li>
            </ul>
        </div>
    </nav>
    <div class="wrapper">
        <div class="row">
            <form class="col s12" method="post" action="create.php">
                <div class="card">
                   <div class="card-content">
                       <span class="card-title darken-1">Add Contact</span>
                       <div class="row">
                           <div class="input-field col s6">
                               <i class="material-icons prefix">account_circle</i>
                               <input id="first_name" type="text" name="first" class="validate" required="">
                               <label for="first_name" class="active">First Name</label>
                           </div>
                           <div class="input-field col s6">
                               <i class="material-icons prefix">account_circle</i>
                               <input id="last_name" type="text" name="last" class="validate" required="">
                               <label for="last_name" class="active">Last Name</label>
                           </div>
                       </div>
                       <div class="row">
                           <div class="input-field col s6">
                               <i class="material-icons prefix">account_circle</i>
                               <input id="other_names" type="text" name="others">
                               <label for="other_names" class="active">Other Names</label>
                           </div>
                           <div class="input-field col s6">
                               <i class="material-icons prefix">phone</i>
                               <input id="telephone" type="tel" name="phone" class="validate" required="">
                               <label for="telephone" class="active">Telephone</label>
                           </div>
                       </div>
                       <div class="row">
                           <div class="input-field col s12">
                               <i class="material-icons prefix">email</i>
                               <input id="email" type="email" name="email">
                               <label for="email" class="active">Email Address</label>
                           </div>
                       </div>
                       <div class="row">
                           <div class="input-field col s12 right">
                               <button type="submit" class=" waves-effect waves-light btn-large" name="add">
                                   <i class="material-icons">add</i>
                               </button>
                           </div>

                       </div>
                   </div>
                </div>

            </form>
        </div>
    </div>
</body>
</html>