<?php
// Asegurarse de que la sesión esté iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluir archivo de configuración
require_once "db_config.php";

// Verificar si el formulario fue enviado
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Verificar si el nombre de usuario está vacío
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor ingrese su nombre de usuario.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Verificar si la contraseña está vacía
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor ingrese su contraseña.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validar credenciales
    if(empty($username_err) && empty($password_err)){
        // Preparar una declaración select
        $sql = "SELECT id_cliente, usuario, contraseña FROM Clientes WHERE usuario = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Establecer parámetros
            $param_username = $username;
            
            // Intentar ejecutar la declaración preparada
            if(mysqli_stmt_execute($stmt)){
                // Almacenar resultado
                mysqli_stmt_store_result($stmt);
                
                // Verificar si existe el nombre de usuario, si es así, verificar la contraseña
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Vincular variables de resultado
                    mysqli_stmt_bind_result($stmt, $id_cliente, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if($password === $hashed_password){
                            // La contraseña es correcta, así que iniciar una nueva sesión
                            session_start();
                            
                            // Almacenar datos en variables de sesión
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id_cliente"] = $id_cliente;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirigir al usuario a la página de bienvenida
                            header("Location: dashboard.php");
                            exit();
                        } else{
                            // La contraseña no es válida, mostrar un mensaje de error genérico
                            $login_err = "Nombre de usuario o contraseña incorrectos.";
                        }
                    }
                } else{
                    // El nombre de usuario no existe, mostrar un mensaje de error genérico
                    $login_err = "Nombre de usuario o contraseña incorrectos.";
                }
            } else{
                $login_err = "Oops! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
            }

            // Cerrar declaración
            mysqli_stmt_close($stmt);
        }
    }
    
    // Cerrar conexión
    mysqli_close($conn);
}
?>