<?php 

    session_start();

    if (isset($_SESSION['admin_login'])) {
        header("location: admin/admin_home.php");
    }

    if (isset($_SESSION['employee_login'])) {
        header("location: employee/employee_home.php");
    }

    if (isset($_SESSION['user_login'])) {
        header("location: user/user_home.php");
    }
    $json = file_get_contents('https://ip.seeip.org/jsonip');

    //Decode JSON
    $json_data = json_decode($json,true);
    $ip= $json_data["ip"];
    $ip = trim($ip);
?>
<?php if(isset($_SESSION['success'])) : ?>
            <div class="alert alert-success">
                <h3>
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>

        <?php if(isset($_SESSION['error'])) : ?>
            <div class="alert alert-danger">
                <h3>
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </h3>
            </div>
        <?php endif ?>

<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Connexion Simplon</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="assets/js/init-alpine.js"></script>
  </head>
  <body>
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
      <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
        <div class="flex flex-col overflow-y-auto md:flex-row">
          <div class="h-32 md:h-auto md:w-1/2">
            <img aria-hidden="true" class="object-cover w-full h-full dark:hidden" src="assets/img/low-code.jpg"
              alt="Office" />
            <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block"
              src="assets/img/login-office-dark.jpeg" alt="Office" />
          </div>
            <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2 shadow-2xl">
                <div class="w-full shadow-2xl">
                <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                    Connexion
                </h1>
                <form action="login_db.php" method="post" > 
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Email</span>
                    <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="benyaya@gmail.com" name="txt_email"  />
                </label>
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Mot de passe</span>
                    <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="***************" type="password" name="txt_password" />
                </label>
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Address ip </span>
                    <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    type="text" name="ip"  value="<?=$ip; ?>" readonly />
                </label>
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Type d'utilisateur</span>
                    <select name="txt_role"  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                            <option value="" selected="selected">- Role -</option>
                            <option value="admin">Admin</option>
                            <option value="formateur">Formateur</option>
                            <option value="apprenant">Apprenant</option>
                    </select>
                </label>
                <!-- You should use a button here, as the anchor is only used for the example  -->
                <input type="submit" class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                 name="btn_login" >
                <hr class="my-8" />
                <p class="mt-4">
                    <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
                    href="./forgot-password.html">
                    Mot de passe oublié ?
                    </a>
                </p>
                </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>