<main>
    <h2>Contacte</h2>
    <form action="./include/processaContacte.php" method="post">
        <div class="formulari">
        <label for="correu">Correu electrònic</label>
        <br>
        <input type="email" id="correu" name="correu" required>
        </div>
        <div class="formulari">
        <label for="assumpte">Assumpte</label>
        <br>
        <input type="text" id="assumpte" name="assumpte" required>
        </div>
        <div class="formulari">
        <label for="missatge">Missatge</label>
        <br>
        <textarea id="missatge" name="missatge" rows="6" required></textarea>
        </div>
        <div class="formulari">
            <input type="submit" value="Enviar">
            <input type="reset" value="Reset">
        </div>
    </form>
</main>