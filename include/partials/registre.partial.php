<main>
    <h2>Registre</h2>
    <form action="./include/processaRegistre.php" method="post">
    <div class="formulari">
    <label for="nom">Nom</label>
    <br>
    <input id="nom" name="nom" type="text" required maxlength="100" />
    </div>
    <div class="formulari">
    <label for="cognoms">Cognoms</label>
    <br>
    <input id="cognoms" name="cognoms" type="text" maxlength="150" />
    </div>
    <div class="formulari">
    <label for="adreca">Adreça</label>
    <br>
    <input id="adreca" name="adreca" type="text" maxlength="200" />
    </div>
    <div class="formulari">
    <label for="correu">Correu electrònic</label>
    <br>
    <input id="correu" name="correu" type="email" required maxlength="254" />
    </div>
    <div class="formulari">
    <label for="contrasenya">Contrasenya</label>
    <br>
    <input id="contrasenya" name="contrasenya" type="password" required minlength="8" />
    </div>
    <div class="formulari">
    <label for="telefon">Telèfon</label>
    <br>
    <input id="telefon" name="telefon" type="tel" pattern="[0-9+\s\-()]{6,20}"/>
    </div>
    <div class="formulari">
    <label for="donacio">Donació</label>
    <select id="donacio" name="donacio">
        <option value="" disabled selected>Selecciona import</option>
        <option value="5">5 €</option>
        <option value="10">10 €</option>
        <option value="20">20 €</option>
        <option value="50">50 €</option>
        <option value="altres">Altres</option>
    </select>
    </div>
    <div class="formulari">
    <label>Continent</label>
    <label><input id="europa" name="continent" type="radio" value="Europa"/> Europa</label>
    <label><input id="africa" name="continent" type="radio" value="Àfrica"/> Àfrica</label>
    <label><input id="americaN" name="continent" type="radio" value="Amèrica del Nord"/> Amèrica del Nord</label>
    <label><input id="americaS" name="continent" type="radio" value="Amèrica del Sud"/> Amèrica del Sud</label>
    <label><input id="asia" name="continent" type="radio" value="Àsia"/> Àsia</label>
    <label><input id="oceania" name="continent" type="radio" value="Oceania"/> Oceania</label> 

    </div>
    <div class="formulari">
    <input type="submit" value="Enviar">
    <input type="reset" value="Reset">
    </div>
    </form>
</main>