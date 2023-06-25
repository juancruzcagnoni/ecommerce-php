<section>
    <div class="container">
        <h1 class="title">Iniciar sesion</h1>

        <form action="actions/log-in.php" method="post">
            <div class="form-fila">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control">
            </div>
            
            <div class="form-fila">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>

            <button type="submit" class="log-btn">Ingresar</button>
        </form>
    </div>
</section>