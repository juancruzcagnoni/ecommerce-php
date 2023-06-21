<section class="container">
    <h1 class="title mt-3">Ingresar al panel de administracion</h1>

    <form action="actions/log-in.php" method="post" class="log-form">
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div>
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <button type="submit" class="log-btn">Ingresar</button>
    </form>
</section>