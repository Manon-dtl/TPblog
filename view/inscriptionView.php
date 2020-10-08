<div align="center">
        <h2>Inscription</h2>
        <br /><br />
        <form method="POST" action="">
            <table>
                <tr>
                    <td align="right">
                        <label for="pseudo">Pseudo :</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if (isset($pseudo)) {echo $pseudo;} ?>" />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mail">Mail :</label>
                    </td>
                    <td>
                        <input type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if (isset($mail)) {echo $mail;} ?>" />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mailverif">Confirmation du mail :</label>
                    </td>
                    <td>
                        <input type="email" placeholder="Confirmez votre mail" id="mailverif" name="mailverif" value="<?php if (isset($mailverif)) {echo $mailverif;} ?>" />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="pass">Mot de passe :</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Votre mot de passe" id="pass" name="pass" />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="passverif">Confirmation du mot de passe :</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Confirmez votre mdp" id="passverif" name="passverif" />
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td align="center">
                        <br />
                        <input type="submit" name="forminscription" value="Je m'inscris" />
                    </td>
                </tr>
            </table>
        </form>
</div>